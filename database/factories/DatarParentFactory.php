<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DatarParentFactory extends Factory
{
    protected $model = \App\Models\DatarParent::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->paragraphs(3, true),
            'order' => $this->faker->numberBetween(1, 100),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
