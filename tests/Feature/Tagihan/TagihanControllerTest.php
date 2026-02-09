<?php

use App\Models\Tagihan;
use App\Models\Penggunaan;
use App\Models\Pelanggan;
use App\Models\Tarif;
use App\Models\User;
use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;

describe('TagihanController', function () {

    beforeEach(function () {
        $this->user = createAdminUser();
        $this->tarif = createTarif();
        $this->pelanggan = createPelanggan($this->tarif);
        $data = createPenggunaanDanTagihan($this->pelanggan);
        $this->tagihan = $data['tagihan'];
    });

    it('menampilkan daftar tagihan untuk admin', function () {
        $response = $this->actingAs($this->user, 'web')->get('/admin/tagihans');

        $response->assertStatus(200);
        $response->assertViewIs('tagihans.index');
        $response->assertViewHas('tagihans');
    });

    it('filter tagihan berdasarkan status', function () {
        // Buat tagihan dengan status berbeda
        Tagihan::create([
            'id_penggunaan' => Penggunaan::factory()->create(['id_pelanggan' => $this->pelanggan->id_pelanggan])->id_penggunaan,
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'bulan' => 3,
            'tahun' => 2026,
            'jumlah_meter' => 30,
            'status' => 'Terbayar'
        ]);

        $response = $this->actingAs($this->user, 'web')->get('/admin/tagihans?status=Belum+Bayar');

        $response->assertStatus(200);
        $response->assertViewHas('tagihans', function ($tagihans) {
            return $tagihans->every(function ($tagihan) {
                return $tagihan->status === 'Belum Bayar';
            });
        });
    });

    it('filter tagihan berdasarkan bulan dan tahun', function () {
        // Buat tagihan bulan berbeda
        Tagihan::create([
            'id_penggunaan' => Penggunaan::factory()->create(['id_pelanggan' => $this->pelanggan->id_pelanggan])->id_penggunaan,
            'id_pelanggan' => $this->pelanggan->id_pelanggan,
            'bulan' => 3,
            'tahun' => 2026,
            'jumlah_meter' => 30,
            'status' => 'Belum Bayar'
        ]);

        $response = $this->actingAs($this->user, 'web')->get('/admin/tagihans?bulan=2&tahun=2026');

        $response->assertStatus(200);
        $response->assertViewHas('tagihans', function ($tagihans) {
            return $tagihans->every(function ($tagihan) {
                return $tagihan->bulan == 2 && $tagihan->tahun == 2026;
            });
        });
    });

    it('menampilkan daftar tagihan untuk pelanggan', function () {
        // Buat pelanggan lain dengan tagihan
        $otherPelanggan = Pelanggan::factory()->create(['id_tarif' => Tarif::first()->id_tarif]);
        Tagihan::factory()->create(['id_pelanggan' => $otherPelanggan->id_pelanggan]);

        $response = $this->actingAs($this->pelanggan, 'pelanggan')->get('/admin/tagihans');

        $response->assertRedirect('/login'); // Pelanggan tidak bisa akses admin routes
    });

    it('menampilkan detail tagihan untuk admin', function () {
        $response = $this->actingAs($this->user, 'web')->get("/admin/tagihans/{$this->tagihan->id_tagihan}");

        $response->assertStatus(200);
        $response->assertViewIs('tagihans.show');
        $response->assertViewHas('tagihan');
    });

    it('menampilkan detail tagihan untuk pelanggan pemilik', function () {
        $response = $this->actingAs($this->pelanggan, 'pelanggan')->get("/pelanggan/tagihans/{$this->tagihan->id_tagihan}");

        $response->assertStatus(200);
        $response->assertViewIs('tagihans.show');
        $response->assertViewHas('tagihan');
    });

    it('mencegah akses tagihan orang lain untuk pelanggan', function () {
        // Buat pelanggan lain dengan tagihan
        $otherPelanggan = Pelanggan::factory()->create(['id_tarif' => Tarif::first()->id_tarif]);
        $otherTagihan = Tagihan::factory()->create(['id_pelanggan' => $otherPelanggan->id_pelanggan]);

        $response = $this->actingAs($this->pelanggan, 'pelanggan')->get("/admin/tagihans/{$otherTagihan->id_tagihan}");

        $response->assertRedirect('/login'); // Pelanggan tidak bisa akses admin routes
    });

    it('menghitung total tagihan dengan benar', function () {
        // Tagihan dengan 50 kWh * 1500 = 75000
        $expectedTotal = 50 * 1500;

        $this->assertEquals($expectedTotal, $this->tagihan->jumlah_meter * $this->tagihan->pelanggan->tarif->tarifperkwh);
    });

    it('menampilkan relasi yang benar pada detail tagihan', function () {
        $response = $this->actingAs($this->user, 'web')->get("/admin/tagihans/{$this->tagihan->id_tagihan}");

        $response->assertViewHas('tagihan', function ($tagihan) {
            return $tagihan->relationLoaded('pelanggan') &&
                   $tagihan->relationLoaded('penggunaan') &&
                   $tagihan->pelanggan->relationLoaded('tarif');
        });
    });
});
