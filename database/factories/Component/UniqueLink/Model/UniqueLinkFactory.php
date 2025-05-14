<?php

declare(strict_types=1);

namespace Database\Factories\Component\UniqueLink\Model;

use App\Component\UniqueLink\Model\UniqueLink;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UniqueLink>
 */
final class UniqueLinkFactory extends Factory
{
    protected $model = UniqueLink::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->randomNumber(),
            'user_id' => fake()->randomNumber(),
            'code' => fake()->lexify(),
            'salt' => fake()->lexify(),
            'expires_at' => fake()->dateTime(),
        ];
    }
}
