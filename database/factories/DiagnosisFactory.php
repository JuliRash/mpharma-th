<?php

namespace Database\Factories;

use App\Models\Diagnosis;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DiagnosisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public $model = Diagnosis::class;
    public function definition()
    {
        return [
            "category_code" => Str::random(5),
            "category_title" => $this->faker->sentence,
            "diagnosis_code" => Str::random(5),
            "full_code" => uniqid(6),
            "abbreviated_description" => $this->faker->sentence,
            "full_description" => $this->faker->sentence,
        ];
    }
}
