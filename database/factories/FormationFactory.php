<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FormationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'name' => $this->faker->jobTitle(),
            'resume' => $this->faker->sentence(),
            'city' => $this->faker->city(),
            'city_department' => $this->faker->departmentNumber(),
            'start_date' => $this->faker->date('Y-m-d', 'now'),
            'end_date' => $this->faker->date('Y-m-d', 'now'),

        ];
    }
}
