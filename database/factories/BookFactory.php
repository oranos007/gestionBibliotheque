<?php

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    public function definition()
    {
        return [
            'isbn' => $this->faker->isbn13, // ✅ REQUIRED FIELD
            'title' => $this->faker->sentence(4),
            'publisher' => $this->faker->company,
            'year' => $this->faker->year,
            'quantity' => $this->faker->numberBetween(1, 10),
            'category' => $this->faker->word,
            'volume' => null, // Optional, set to null unless used
            'author1' => $this->faker->name,
            'author2' => $this->faker->name,
            'author3' => $this->faker->name,
            'author4' => $this->faker->name,
            'available' => true,
        ];
    }
}