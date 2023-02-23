<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'prefecture'    => $this->faker->prefecture(),
            'city'          => $this->faker->city(),
            'address'       => $this->faker->streetAddress(),
            'customer_name' => $this->faker->name()
        ];
    }
}
