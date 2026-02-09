<?php

use App\Models\Penggunaan;
use App\Models\Pelanggan;
use App\Models\Tarif;
use App\Models\Tagihan;
use App\Models\User;
use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;

describe('PenggunaanController', function () {

    beforeEach(function () {
        $this->user = createAdminUser();
        $this->tarif = createTarif();
        $this->pelanggan = createPelanggan($this->tarif);
    });

    it('menampilkan daftar penggunaan', function () {
        Penggunaan::factory()->create(['id_pelanggan' => $this->pelanggan->id_pelanggan]);

        $response = $this->actingAs($this->user, 'web')->get('/admin/penggunaans');

        $response->assertStatus(200);
        $response->assertViewIs('penggunaans.index');
        $response->assertViewHas('penggunaans');
    });

    it('menampilkan form create penggunaan', function () {
        $response = $this->actingAs($this->user, 'web')->get('/admin/penggunaans/create');

        $response->assertStatus(200);
        $response->assertViewIs('penggunaans.create');
        $response->assertViewHas('pelanggans');
    });

    it('berhasil menyimpan penggunaan baru dengan tagihan otomatis', function () {
        $data = [
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'bulan' => 2,
            'tahun' => 2026,
            'meter_ahir' => 150
        ];

        $response = $this->actingAs($this->user, 'web')->post('/admin/penggunaans', $data);

        $response->assertRedirect('/admin/penggunaans');
        $response->assertSessionHas('success');

        // Verifikasi data tersimpan
        $this->assertDatabaseHas('penggunaans', [
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'bulan' => 2,
            'tahun' => 2026,
            'meter_awal' => 0, // Meter awal pertama kali 0
            'meter_ahir' => 150
        ]);

        // Verifikasi tagihan otomatis dibuat
        $penggunaan = Penggunaan::where('id_pelanggan', $this->pelanggan->id_pelanggan)->first();
        $this->assertDatabaseHas('tagihans', [
            'id_penggunaan' => $penggunaan->id_penggunaan,
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'bulan' => 2,
            'tahun' => 2026,
            'jumlah_meter' => 150,
            'status' => 'Belum Bayar'
        ]);
    });

    it('menghitung meter awal dari bulan sebelumnya', function () {
        // Buat penggunaan bulan sebelumnya
        Penggunaan::create([
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'bulan' => 1,
            'tahun' => 2026,
            'meter_awal' => 0,
            'meter_ahir' => 100
        ]);

        $data = [
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'bulan' => 2,
            'tahun' => 2026,
            'meter_ahir' => 150
        ];

        $this->actingAs($this->user, 'web')->post('/admin/penggunaans', $data);

        // Verifikasi meter_awal diambil dari meter_ahir bulan sebelumnya
        $this->assertDatabaseHas('penggunaans', [
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'bulan' => 2,
            'tahun' => 2026,
            'meter_awal' => 100, // Dari meter_ahir bulan sebelumnya
            'meter_ahir' => 150
        ]);
    });

    it('mencegah duplikasi penggunaan untuk bulan yang sama', function () {
        // Buat penggunaan bulan Februari
        Penggunaan::create([
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'bulan' => 2,
            'tahun' => 2026,
            'meter_awal' => 0,
            'meter_ahir' => 100
        ]);

        $data = [
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'bulan' => 2, // Bulan yang sama
            'tahun' => 2026,
            'meter_ahir' => 150
        ];

        $response = $this->actingAs($this->user, 'web')->post('/admin/penggunaans', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['bulan' => 'Penggunaan untuk bulan ini sudah ada.']);
    });

    it('validasi meter_ahir harus lebih besar dari meter_awal', function () {
        $data = [
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'bulan' => 2,
            'tahun' => 2026,
            'meter_ahir' => 0 // Sama dengan meter_awal (0)
        ];

        $response = $this->actingAs($this->user, 'web')->post('/admin/penggunaans', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['meter_ahir']);
    });

    it('mengembalikan meter awal via AJAX', function () {
        // Buat penggunaan bulan sebelumnya
        Penggunaan::create([
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'bulan' => 1,
            'tahun' => 2026,
            'meter_awal' => 0,
            'meter_ahir' => 100
        ]);

        $response = $this->actingAs($this->user, 'web')->get('/admin/penggunaans/get-meter-awal?id_pelanggan=' . $this->pelanggan->id_pelanggan . '&bulan=2&tahun=2026');

        $response->assertStatus(200);
        $response->assertJson([
            'meter_awal' => 100,
            'bulan_sebelumnya' => '1/2026'
        ]);
    });

    it('menampilkan detail penggunaan', function () {
        $penggunaan = Penggunaan::factory()->create(['id_pelanggan' => $this->pelanggan->id_pelanggan]);

        $response = $this->actingAs($this->user, 'web')->get("/admin/penggunaans/{$penggunaan->id_penggunaan}");

        $response->assertStatus(200);
        $response->assertViewIs('penggunaans.show');
        $response->assertViewHas('penggunaan');
    });

    it('menghapus penggunaan dan tagihan terkait', function () {
        $penggunaan = Penggunaan::factory()->create(['id_pelanggan' => $this->pelanggan->id_pelanggan]);
        Tagihan::create([
            'id_penggunaan' => $penggunaan->id_penggunaan,
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'bulan' => 2,
            'tahun' => 2026,
            'jumlah_meter' => 50,
            'status' => 'Belum Bayar'
        ]);

        $response = $this->actingAs($this->user, 'web')->delete("/admin/penggunaans/{$penggunaan->id_penggunaan}");

        $response->assertRedirect('/admin/penggunaans');
        $response->assertSessionHas('success');

        // Verifikasi data terhapus
        $this->assertDatabaseMissing('penggunaans', ['id_penggunaan' => $penggunaan->id_penggunaan]);
        $this->assertDatabaseMissing('tagihans', ['id_penggunaan' => $penggunaan->id_penggunaan]);
    });
});
