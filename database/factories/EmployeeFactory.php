<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'qrcode' => rand(1000, 9999),
            'employeenumber' => rand(100, 99999),
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'middlename' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'position' => 'parttime',
            'username' => $this->faker->userName(),
            'password' => Hash::make(12345678)
        ];
    }
}
