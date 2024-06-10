<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LeadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function agent_cannot_create_lead()
    {
        // Crear un usuario con el rol de 'agent'
        $user = User::factory()->create(['role' => 'agent']);

        // Autenticar como el usuario
        $this->actingAs($user, 'api');

        // Intentar hacer una petición POST a la ruta 'lead'
        $response = $this->postJson(url('lead'));

        // Verificar que la respuesta sea 'Unauthorized'
        $response->assertStatus(403);
        $response->assertJson([
            "meta" => [
                "success" => false,
                "errors" => [
                    "Unauthorized"
                ]
            ]
        ]);
    }

    /** @test */
    public function manager_can_create_lead()
    {
        // Crear un usuario con el rol de 'manager'
        $user = User::factory()->create(['role' => 'manager']);

        // Autenticar como el usuario
        $this->actingAs($user, 'api');

        // Intentar hacer una petición POST a la ruta 'lead'
        $response = $this->getJson(url('leads'));

        // Verificar que la respuesta sea 'OK'
        $response->assertStatus(200);
        $response->assertJson([
            "meta" => [
                "success" => true,
                "errors" => []
            ]
        ]);
    }

    /** @test */
    public function manager_can_see_all_leads()
    {
        // Crear un usuario con el rol de 'manager'
        $user = User::factory()->create(['role' => 'manager']);

        // Autenticar como el usuario
        $this->actingAs($user, 'api');

        // Intentar hacer una petición GET a la ruta 'leads'
        $response = $this->getJson(url('leads'));

        // Verificar que la respuesta sea 'OK'
        $response->assertStatus(200);
        $response->assertJson([
            "meta" => [
                "success" => true,
                "errors" => []
            ]
        ]);
    }

    /** @test */
    public function manager_can_see_lead()
    {
        // Crear un usuario con el rol de 'manager'
        $user = User::factory()->create(['role' => 'manager']);

        // Autenticar como el usuario
        $this->actingAs($user, 'api');

        // Crear un lead asociado al usuario
        $lead = Lead::create([
            'name' => 'Lead 1',
            'source' => 'web',
            'owner' => $user->id,
            'created_by' => $user->id,
        ]);

        // Intentar hacer una petición GET a la ruta 'leads'
        $response = $this->getJson(url('lead/' . $lead->id));

        // Verificar que la respuesta sea 'OK'
        $response->assertStatus(200);
        $response->assertJson([
            "meta" => [
                "success" => true,
                "errors" => []
            ]
        ]);
    }
}
