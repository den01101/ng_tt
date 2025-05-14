<?php

declare(strict_types=1);

namespace Database\Factories\Component\User\Model;

use App\Component\User\Model\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<User>
 */
final class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->randomNumber(),
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
