<?php

use App\Models\Pelanggan;
use App\Models\User;
use App\Models\Level;
use App\Models\Tarif;
use Illuminate\Foundation\Testing\RefreshDatabase;

describe('PelangganController', function () {

    beforeEach(function () {
        $this->user = createAdminUser();
        $this->tarif = createTarif();
    });

    it('menampilkan daftar pelanggan', function () {
        Pelanggan::factory()->count(3)->create(['id_tarif' => $this->tarif->id_tarif]);

        $response = $this->actingAs($this->user, 'web')->get('/admin/pelanggans');

        $response->assertStatus(200);
        $response->assertViewIs('pelanggans.index');
        $response->assertViewHas('pelanggans');
    });

    it('menampilkan form create pelanggan', function () {
        $response = $this->actingAs($this->user, 'web')->get('/admin/pelanggans/create');

        $response->assertStatus(200);
        $response->assertViewIs('pelanggans.create');
    });

    it('berhasil menyimpan pelanggan baru', function () {
        $data = [
            'username' => 'testcustomer',
            'password' => 'password123',
            'nomor_kwh' => '1234567890',
            'nama_pelanggan' => 'Test Customer',
            'alamat' => 'Jl. Test No. 123',
            'id_tarif' => $this->tarif->id_tarif
        ];

        $response = $this->actingAs($this->user, 'web')->post('/admin/pelanggans', $data);

        $response->assertRedirect('/admin/pelanggans');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('pelanggans', [
            'username' => 'testcustomer',
            'nomor_kwh' => '1234567890',
            'nama_pelanggan' => 'Test Customer',
            'alamat' => 'Jl. Test No. 123',
            'id_tarif' => $this->tarif->id_tarif
        ]);
    });

    it('validasi pelanggan baru', function () {
        $data = [
            'username' => '', // Kosong
            'password' => '123', // Terlalu pendek
            'nomor_kwh' => '123', // Terlalu pendek
            'nama_pelanggan' => '',
            'alamat' => '',
            'id_tarif' => ''
        ];

        $response = $this->actingAs($this->user, 'web')->post('/admin/pelanggans', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['username', 'password', 'nomor_kwh', 'nama_pelanggan', 'alamat', 'id_tarif']);
    });

    it('nomor_kwh harus unik', function () {
        Pelanggan::factory()->create([
            'nomor_kwh' => '1234567890',
            'id_tarif' => $this->tarif->id_tarif
        ]);

        $data = [
            'username' => 'testcustomer',
            'password' => 'password123',
            'nomor_kwh' => '1234567890', // Duplikat
            'nama_pelanggan' => 'Test Customer',
            'alamat' => 'Jl. Test No. 123',
            'id_tarif' => $this->tarif->id_tarif
        ];

        $response = $this->actingAs($this->user, 'web')->post('/admin/pelanggans', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['nomor_kwh']);
    });

    it('menampilkan detail pelanggan', function () {
        $pelanggan = Pelanggan::factory()->create(['id_tarif' => $this->tarif->id_tarif]);

        $response = $this->actingAs($this->user, 'web')->get("/admin/pelanggans/{$pelanggan->id_pelanggan}");

        $response->assertStatus(200);
        $response->assertViewIs('pelanggans.show');
        $response->assertViewHas('pelanggan');
    });

    it('menampilkan form edit pelanggan', function () {
        $pelanggan = Pelanggan::factory()->create(['id_tarif' => $this->tarif->id_tarif]);

        $response = $this->actingAs($this->user, 'web')->get("/admin/pelanggans/{$pelanggan->id_pelanggan}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('pelanggans.edit');
        $response->assertViewHas('pelanggan');
    });

    it('berhasil update pelanggan', function () {
        $pelanggan = Pelanggan::factory()->create(['id_tarif' => $this->tarif->id_tarif]);

        $data = [
            'username' => 'updatedcustomer',
            'nomor_kwh' => '0987654321',
            'nama_pelanggan' => 'Updated Customer',
            'alamat' => 'Jl. Updated No. 456',
            'id_tarif' => $this->tarif->id_tarif
        ];

        $response = $this->actingAs($this->user, 'web')->put("/admin/pelanggans/{$pelanggan->id_pelanggan}", $data);

        $response->assertRedirect('/admin/pelanggans');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('pelanggans', array_merge($data, ['id_pelanggan' => $pelanggan->id_pelanggan]));
    });

    it('validasi update pelanggan', function () {
        $pelanggan = Pelanggan::factory()->create(['id_tarif' => $this->tarif->id_tarif]);

        $data = [
            'username' => '',
            'nomor_kwh' => '123',
            'nama_pelanggan' => '',
            'alamat' => '',
            'id_tarif' => ''
        ];

        $response = $this->actingAs($this->user, 'web')->put("/admin/pelanggans/{$pelanggan->id_pelanggan}", $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['username', 'nama_pelanggan', 'alamat', 'id_tarif']);
    });

    it('berhasil delete pelanggan', function () {
        $pelanggan = Pelanggan::factory()->create(['id_tarif' => $this->tarif->id_tarif]);

        $response = $this->actingAs($this->user, 'web')->delete("/admin/pelanggans/{$pelanggan->id_pelanggan}");

        $response->assertRedirect('/admin/pelanggans');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('pelanggans', ['id_pelanggan' => $pelanggan->id_pelanggan]);
    });

    it('menampilkan relasi tarif dengan benar', function () {
        $tarif = Tarif::factory()->create(['daya' => '1300 VA', 'tarifperkwh' => 2000]);
        $pelanggan = Pelanggan::factory()->create(['id_tarif' => $tarif->id_tarif]);

        $this->assertEquals('1300 VA', $pelanggan->tarif->daya);
        $this->assertEquals(2000, $pelanggan->tarif->tarifperkwh);
    });

    it('menampilkan relasi penggunaan dengan benar', function () {
        $pelanggan = Pelanggan::factory()->create(['id_tarif' => $this->tarif->id_tarif]);

        // Buat beberapa penggunaan
        $pelanggan->penggunaans()->create([
            'bulan' => '2024-01',
            'tahun' => '2024',
            'meter_awal' => 100,
            'meter_ahir' => 150
        ]);

        $this->assertCount(1, $pelanggan->penggunaans);
        $penggunaan = $pelanggan->penggunaans->first();
        $this->assertEquals(50, $penggunaan->meter_ahir - $penggunaan->meter_awal);
    });
});
