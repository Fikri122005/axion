<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the login screen can be rendered.
     */
    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
        $response->assertSee('Masuk ke Akun');
        $response->assertSee('Alamat Email');
        $response->assertSee('Kata Sandi');
    }

    /**
     * Test that users can authenticate using the login screen.
     */
    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create([
            'email' => 'dokter@axionvet.test',
            'password' => 'password123',
            'is_active' => true,
        ]);

        $response = $this->post(route('login'), [
            'email' => 'dokter@axionvet.test',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('admin.dashboard'));
    }

    /**
     * Test that users cannot authenticate with invalid password.
     */
    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'email' => 'dokter@axionvet.test',
            'password' => 'password123',
        ]);

        $response = $this->post(route('login'), [
            'email' => 'dokter@axionvet.test',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    /**
     * Test that inactive users cannot authenticate.
     */
    public function test_users_can_not_authenticate_when_inactive(): void
    {
        User::factory()->create([
            'email' => 'inactive@axionvet.test',
            'password' => 'password123',
            'is_active' => false,
        ]);

        $response = $this->post(route('login'), [
            'email' => 'inactive@axionvet.test',
            'password' => 'password123',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    /**
     * Test that the registration screen can be rendered.
     */
    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
        $response->assertSee('Registrasi Akun');
        $response->assertSee('Daftar Sekarang');
    }

    /**
     * Test that new users can register.
     */
    public function test_new_users_can_register(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'Dr. Budi Santoso',
            'email' => 'budi@axionvet.test',
            'password' => 'secret1234',
            'password_confirmation' => 'secret1234',
            'terms' => '1',
        ]);

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'name' => 'Dr. Budi Santoso',
            'email' => 'budi@axionvet.test',
            'role' => 'user',
            'is_active' => 1,
        ]);
        $response->assertRedirect(route('admin.dashboard'));
    }

    /**
     * Test that users can logout.
     */
    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $this->assertGuest();
        $response->assertRedirect(route('login'));
    }
}
