<?php

namespace Database\Factories;

use App\Models\Penilaian;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenilaianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Penilaian::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'siswa_id' => $this->faker->word,
        'kriteria_detail_id' => $this->faker->word,
        'bobot' => $this->faker->randomDigitNotNull,
        'ket' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
