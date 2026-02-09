<?php

use App\Models\Tarif;
use App\Models\User;
use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;

describe('TarifController', function () {

    beforeEach(function () {
        $this->user = createAdminUser();
    });

    it('menampilkan daftar tarif', function () {
        Tarif::factory()->count(3)->create();

        $response = $this->actingAs($this->user, 'web')->get('/admin/tarifs');

        $response->assertStatus(200);
        $response->assertViewIs('tarifs.index');
        $response->assertViewHas('tarifs');
    });

    it('menampilkan form create tarif', function () {
        $response = $this->actingAs($this->user, 'web')->get('/admin/tarifs/create');

        $response->assertStatus(200);
        $response->assertViewIs('tarifs.create');
    });

    it('berhasil menyimpan tarif baru', function () {
        $data = [
            'daya' => '1300 VA',
            'tarifperkwh' => 2000
        ];

        $response = $this->actingAs($this->user, 'web')->post('/admin/tarifs', $data);

        $response->assertRedirect('/admin/tarifs');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('tarifs', $data);
    });

    it('validasi tarif baru', function () {
        $data = [
            'daya' => '', // Kosong
            'tarifperkwh' => -100 // Negatif
        ];

        $response = $this->actingAs($this->user, 'web')->post('/admin/tarifs', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['daya', 'tarifperkwh']);
    });

    it('menampilkan detail tarif', function () {
        $tarif = Tarif::factory()->create();

        $response = $this->actingAs($this->user, 'web')->get("/admin/tarifs/{$tarif->id_tarif}");

        $response->assertStatus(200);
        $response->assertViewIs('tarifs.show');
        $response->assertViewHas('tarif');
    });

    it('menampilkan form edit tarif', function () {
        $tarif = Tarif::factory()->create();

        $response = $this->actingAs($this->user, 'web')->get("/admin/tarifs/{$tarif->id_tarif}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('tarifs.edit');
        $response->assertViewHas('tarif');
    });

    it('berhasil update tarif', function () {
        $tarif = Tarif::factory()->create();

        $data = [
            'daya' => '2200 VA',
            'tarifperkwh' => 2500
        ];

        $response = $this->actingAs($this->user, 'web')->put("/admin/tarifs/{$tarif->id_tarif}", $data);

        $response->assertRedirect('/admin/tarifs');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('tarifs', array_merge($data, ['id_tarif' => $tarif->id_tarif]));
    });

    it('validasi update tarif', function () {
        $tarif = Tarif::factory()->create();

        $data = [
            'daya' => '',
            'tarifperkwh' => 'not_numeric'
        ];

        $response = $this->actingAs($this->user, 'web')->put("/admin/tarifs/{$tarif->id_tarif}", $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['daya', 'tarifperkwh']);
    });

    it('berhasil delete tarif', function () {
        $tarif = Tarif::factory()->create();

        $response = $this->actingAs($this->user, 'web')->delete("/admin/tarifs/{$tarif->id_tarif}");

        $response->assertRedirect('/admin/tarifs');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('tarifs', ['id_tarif' => $tarif->id_tarif]);
    });

    it('menghitung tarif per kWh dengan benar', function () {
        $tarif = Tarif::factory()->create([
            'daya' => '900 VA',
            'tarifperkwh' => 1500
        ]);

        $this->assertEquals(1500, $tarif->tarifperkwh);
        $this->assertEquals('900 VA', $tarif->daya);
    });
});
