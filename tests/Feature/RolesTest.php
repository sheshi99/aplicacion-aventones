<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RolesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_puede_acceder_a_panel_admin()
    {
        $admin = User::factory()->create(['rol' => 'admin']);

        $this->actingAs($admin)
            ->get('/admin')
            ->assertStatus(200);
    }

    /** @test */
    public function chofer_no_puede_acceder_a_panel_admin()
    {
        $chofer = User::factory()->create(['rol' => 'chofer']);

        $this->actingAs($chofer)
            ->get('/admin')
            ->assertRedirect('/')
            ->assertSessionHas('error', 'No tiene permiso para acceder.');
    }

    /** @test */
    public function pasajero_no_puede_acceder_a_panel_admin()
    {
        $pasajero = User::factory()->create(['rol' => 'pasajero']);

        $this->actingAs($pasajero)
            ->get('/admin')
            ->assertRedirect('/')
            ->assertSessionHas('error', 'No tiene permiso para acceder.');
    }
}
