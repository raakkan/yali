<?php

namespace Raakkan\Yali\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Raakkan\Yali\Models\Language;
use Raakkan\Yali\Models\Translation;

class TranslationFactory extends Factory
{
    protected $model = Translation::class;

    public function definition(): array
    {
        return [
            'group' => $this->faker->word,
            'key' => $this->faker->unique()->word,
            'value' => $this->faker->sentence,
            'note' => $this->faker->optional()->sentence,
            'language_code' => function () {
                return Language::factory()->create()->code;
            },
            'language_id' => function (array $attributes) {
                return Language::where('code', $attributes['language_code'])->first()->id;
            },
        ];
    }
}
