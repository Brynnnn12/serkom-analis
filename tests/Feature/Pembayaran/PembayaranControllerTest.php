<?php

use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\Penggunaan;
use App\Models\Pelanggan;
use App\Models\Tarif;
use App\Models\User;
use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;

describe('PembayaranController', function () {

    beforeEach(function () {
        $this->user = createAdminUser();
        $this->tarif = createTarif();
        $this->pelanggan = createPelanggan($this->tarif);
        $data = createPenggunaanDanTagihan($this->pelanggan);
        $this->tagihan = $data['tagihan'];
    });

    it('menampilkan daftar pembayaran untuk admin', function () {
        Pembayaran::factory()->create([
            'id_tagihan' => $this->tagihan->id_tagihan,
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'id_user' => $this->user->id_user
        ]);

        $response = $this->actingAs($this->user, 'web')->get('/admin/pembayarans');

        $response->assertStatus(200);
        $response->assertViewIs('pembayarans.index');
        $response->assertViewHas(['pembayarans', 'isAdmin']);
    });

    it('menampilkan form create pembayaran', function () {
        $response = $this->actingAs($this->user, 'web')->get('/admin/pembayarans/create');

        $response->assertStatus(200);
        $response->assertViewIs('pembayarans.create');
    });

    it('berhasil memproses pembayaran dengan atomic transaction', function () {
        $totalTagihan = 50 * 1500; // jumlah_meter * tarif_per_kwh
        $biayaAdmin = 2500;
        $totalBayar = $totalTagihan + $biayaAdmin;

        $data = [
            'id_tagihan' => $this->tagihan->id_tagihan,
            'biaya_admin' => $biayaAdmin
        ];

        $response = $this->actingAs($this->user, 'web')->post('/admin/pembayarans', $data);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Verifikasi pembayaran tersimpan
        $this->assertDatabaseHas('pembayarans', [
            'id_tagihan' => $this->tagihan->id_tagihan,
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'id_user' => $this->user->id_user,
            'biaya_admin' => $biayaAdmin,
            'total_bayar' => $totalBayar
        ]);

        // Verifikasi status tagihan berubah menjadi 'Terbayar'
        $this->assertDatabaseHas('tagihans', [
            'id_tagihan' => $this->tagihan->id_tagihan,
            'status' => 'Terbayar'
        ]);
    });

    it('mencegah pembayaran tagihan yang sudah dibayar', function () {
        // Update tagihan menjadi sudah dibayar
        $this->tagihan->update(['status' => 'Terbayar']);

        $data = [
            'id_tagihan' => $this->tagihan->id_tagihan,
            'uang_dibayar' => 100000,
            'biaya_admin' => 2500
        ];

        $response = $this->actingAs($this->user, 'web')->post('/admin/pembayarans', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['id_tagihan' => 'Tagihan ini sudah dibayar.']);
    });

    it('menampilkan detail pembayaran untuk admin', function () {
        $pembayaran = Pembayaran::factory()->create([
            'id_tagihan' => $this->tagihan->id_tagihan,
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'id_user' => $this->user->id_user
        ]);

        $response = $this->actingAs($this->user, 'web')->get("/admin/pembayarans/{$pembayaran->id_pembayaran}");

        $response->assertStatus(200);
        $response->assertViewIs('pembayarans.show');
        $response->assertViewHas('pembayaran');
    });

    it('mencegah akses pembayaran orang lain untuk pelanggan', function () {
        // Buat pelanggan lain
        $otherPelanggan = Pelanggan::factory()->create(['id_tarif' => $this->tarif->id_tarif]);
        $otherTagihan = Tagihan::factory()->create(['id_pelanggan' => $otherPelanggan->id_pelanggan]);

        $pembayaran = Pembayaran::factory()->create([
            'id_tagihan' => $otherTagihan->id_tagihan,
            'id_pelanggan' => $otherPelanggan->id_pelanggan,
            'id_user' => $this->user->id_user
        ]);

        // Login sebagai pelanggan pertama
        $response = $this->actingAs($this->pelanggan, 'pelanggan')->get("/admin/pembayarans/{$pembayaran->id_pembayaran}");

        $response->assertRedirect('/login'); // Redirect to login since not authenticated for web
    });

    it('mencegah edit pembayaran', function () {
        $pembayaran = Pembayaran::factory()->create([
            'id_tagihan' => $this->tagihan->id_tagihan,
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'id_user' => $this->user->id_user
        ]);

        $response = $this->actingAs($this->user, 'web')->get("/admin/pembayarans/{$pembayaran->id_pembayaran}/edit");

        $response->assertRedirect('/admin/pembayarans');
        $response->assertSessionHas('error', 'Pembayaran tidak bisa diedit.');
    });

    it('mencegah update pembayaran', function () {
        $pembayaran = Pembayaran::factory()->create([
            'id_tagihan' => $this->tagihan->id_tagihan,
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'id_user' => $this->user->id_user
        ]);

        $response = $this->actingAs($this->user, 'web')->put("/admin/pembayarans/{$pembayaran->id_pembayaran}");

        $response->assertRedirect('/admin/pembayarans');
        $response->assertSessionHas('error', 'Pembayaran tidak bisa diupdate.');
    });

    it('mencegah delete pembayaran untuk audit trail', function () {
        $pembayaran = Pembayaran::factory()->create([
            'id_tagihan' => $this->tagihan->id_tagihan,
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'id_user' => $this->user->id_user
        ]);

        $response = $this->actingAs($this->user, 'web')->delete("/admin/pembayarans/{$pembayaran->id_pembayaran}");

        $response->assertRedirect('/admin/pembayarans');
        $response->assertSessionHas('error', 'Pembayaran tidak bisa dihapus untuk alasan audit.');
    });
});
