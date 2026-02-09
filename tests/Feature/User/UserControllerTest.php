<?php

use App\Models\User;
use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

describe('UserController', function () {

    beforeEach(function () {
        $this->user = createAdminUser();
    });

    it('menampilkan daftar user', function () {
        User::factory()->count(3)->create();

        $response = $this->actingAs($this->user, 'web')->get('/admin/users');

        $response->assertStatus(200);
        $response->assertViewIs('users.index');
        $response->assertViewHas('users');
    });

    it('menampilkan form create user', function () {
        $response = $this->actingAs($this->user, 'web')->get('/admin/users/create');

        $response->assertStatus(200);
        $response->assertViewIs('users.create');
    });

    it('berhasil menyimpan user baru', function () {
        $level = Level::create(['nama_level' => 'Operator']);

        $data = [
            'username' => 'testuser',
            'nama_admin' => 'Test User',
            'id_level' => $level->id_level,
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];

        $response = $this->actingAs($this->user, 'web')->post('/admin/users', $data);

        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'username' => 'testuser',
            'nama_admin' => 'Test User',
            'id_level' => $level->id_level
        ]);

        $user = User::where('username', 'testuser')->first();
        $this->assertTrue(Hash::check('password123', $user->password));
    });

    it('validasi user baru', function () {
        $data = [
            'username' => '', // Kosong
            'nama_admin' => '',
            'id_level' => '',
            'password' => '123', // Terlalu pendek
            'password_confirmation' => '456' // Tidak match
        ];

        $response = $this->actingAs($this->user, 'web')->post('/admin/users', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['username', 'nama_admin', 'id_level', 'password']);
    });

    it('menampilkan detail user', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($this->user, 'web')->get("/admin/users/{$user->id_user}");

        $response->assertStatus(200);
        $response->assertViewIs('users.show');
        $response->assertViewHas('user');
    });

    it('menampilkan form edit user', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($this->user, 'web')->get("/admin/users/{$user->id_user}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('users.edit');
        $response->assertViewHas('user');
    });

    it('berhasil update user', function () {
        $user = User::factory()->create();
        $level = Level::create(['nama_level' => 'Operator']);

        $data = [
            'username' => 'updateduser',
            'nama_admin' => 'Updated User',
            'id_level' => $level->id_level,
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123'
        ];

        $response = $this->actingAs($this->user, 'web')->put("/admin/users/{$user->id_user}", $data);

        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'id_user' => $user->id_user,
            'username' => 'updateduser',
            'nama_admin' => 'Updated User',
            'id_level' => $level->id_level
        ]);

        $updatedUser = User::find($user->id_user);
        $this->assertTrue(Hash::check('newpassword123', $updatedUser->password));
    });

    it('validasi update user', function () {
        $user = User::factory()->create();

        $data = [
            'username' => '',
            'nama_admin' => '',
            'id_level' => '',
            'password' => '123',
            'password_confirmation' => '456'
        ];

        $response = $this->actingAs($this->user, 'web')->put("/admin/users/{$user->id_user}", $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['username', 'nama_admin', 'id_level', 'password']);
    });

    it('berhasil delete user', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($this->user, 'web')->delete("/admin/users/{$user->id_user}");

        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('users', ['id_user' => $user->id_user]);
    });

    it('tidak bisa delete user sendiri', function () {
        $response = $this->actingAs($this->user, 'web')->delete("/admin/users/{$this->user->id_user}");

        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('error');

        $this->assertDatabaseHas('users', ['id_user' => $this->user->id_user]);
    });

    it('menampilkan relasi level dengan benar', function () {
        $level = Level::create(['nama_level' => 'Operator']);
        $user = User::factory()->create(['id_level' => $level->id_level]);

        $this->assertEquals('Operator', $user->level->nama_level);
    });
});
