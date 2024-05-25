<?php

namespace Raakkan\Yali\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Raakkan\Yali\Models\Language;

class LanguageFactory extends Factory
{
    protected $model = Language::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->country,
            'code' => $this->faker->unique()->languageCode,
            'rtl' => $this->faker->boolean,
            'is_active' => $this->faker->boolean(80),
            'is_default' => false,
        ];
    }
}
