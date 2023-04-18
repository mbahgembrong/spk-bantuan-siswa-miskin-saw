<?php

namespace Database\Factories;

use App\Models\Kriteriadetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class KriteriadetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kriteriadetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kriteria_id' => $this->faker->word,
        'nama' => $this->faker->word,
        'bobot' => $this->faker->randomDigitNotNull,
        'kode' => $this->faker->word,
        'tipe' => $this->faker->word,
        'ket' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
