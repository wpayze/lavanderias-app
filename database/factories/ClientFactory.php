<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "identity" => $this->faker->isbn13(),
            "name" => $this->faker->firstName(),
            "telephone" => $this->faker->phoneNumber(),
            "email" => $this->faker->email(),
            "company_id" => 1
        ];
    }
}
