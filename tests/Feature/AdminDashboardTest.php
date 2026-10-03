<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    /**
     * Test that the AdminLTE dashboard page loads successfully.
     */
    public function test_admin_dashboard_can_be_rendered(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
        $response->assertSee('AdminLTE');
        $response->assertSee('New Orders');
    }
}
