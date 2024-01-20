<?php

namespace Database\Factories;

use App\Models\Calidade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CalidadeFactory extends Factory
{
    protected $model = Calidade::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'medida' => $this->faker->name,
			'precio' => $this->faker->name,
        ];
    }
}
