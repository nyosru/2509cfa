<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Datar2Factory extends Factory
{
    protected $model = \App\Models\Datar2::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->paragraphs(2, true),
            'parent_id' => DatarParent::factory(),
            'order' => $this->faker->numberBetween(1, 100),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
