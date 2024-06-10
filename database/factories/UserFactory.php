<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function __construct()
    {
        parent::__construct();
        static::$password = Hash::make('PASSWORD');
    }

    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->userName,
            'password' => static::$password,
            'last_login' => $this->faker->dateTime,
            'is_active' => $this->faker->boolean,
            'role' => 'agent',
        ];
    }
}
