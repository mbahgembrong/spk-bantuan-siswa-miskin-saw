<?php

namespace Database\Factories;

use App\Models\PenilaianDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenilaianDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PenilaianDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'penilaian_id' => $this->faker->word,
        'kriteria_id' => $this->faker->word,
        'bobot' => $this->faker->randomDigitNotNull,
        'keterangan' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
