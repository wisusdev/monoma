<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function username_is_required()
    {
        $data = $this->validCredentials(['username' => '']);

        $response = $this->postJson(url('auth'), $data);
        $response->assertJsonValidationErrors(['username' => 'required']);
    }

    /** @test */
    public function password_is_required()
    {
        $data = $this->validCredentials(['password' => '']);

        $response = $this->postJson(url('auth'), $data);
        $response->assertJsonValidationErrors(['password' => 'required']);
    }

    /** @test */
    public function username_must_be_string()
    {
        $data = $this->validCredentials(['username' => 123]);

        $response = $this->postJson(url('auth'), $data);
        $response->assertJsonValidationErrors(['username' => 'string']);
    }

    /** @test */
    public function password_must_be_string()
    {
        $data = $this->validCredentials(['password' => 123]);

        $response = $this->postJson(url('auth'), $data);
        $response->assertJsonValidationErrors(['password' => 'string']);
    }

    protected function validCredentials(mixed $overrides = []): array
    {
        return array_merge([
            'username' => 'tester',
            'password' => 'PASSWORD',
        ], $overrides);
    }
}
