<?php

use App\Models\User;
use App\Models\Level;

describe('AuthController', function () {

    beforeEach(function () {
        createAdminLevel();
    });

    it('menampilkan form login ketika belum login', function () {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    });

    it('redirect ke dashboard admin ketika sudah login sebagai admin', function () {
        $user = User::factory()->create([
            'id_level' => 1
        ]);

        $response = $this->actingAs($user, 'web')->get('/login');

        $response->assertRedirect('/admin/dashboard');
    });

    it('menampilkan form login ketika admin logout', function () {
        $user = User::factory()->create([
            'id_level' => 1
        ]);

        $response = $this->actingAs($user, 'web')->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest('web');
    });

    it('gagal login dengan kredensial salah', function () {
        $response = $this->post('/login', [
            'username' => 'wronguser',
            'password' => 'wrongpass'
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors();
        $this->assertGuest('web');
    });

    it('berhasil login admin dengan kredensial benar', function () {
        $user = User::factory()->create([
            'username' => 'admin',
            'password' => bcrypt('password'),
            'id_level' => 1
        ]);

        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => 'password'
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($user, 'web');
    });

    it('mencegah akses admin routes tanpa login', function () {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    });
});
