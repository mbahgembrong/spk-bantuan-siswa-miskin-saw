<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PenilaianDetail
 * @package App\Models
 * @version April 18, 2023, 2:36 pm UTC
 *
 * @property uuid $penilaian_id
 * @property uuid $kriteria_id
 * @property number $bobot
 * @property string $keterangan
 */
class PenilaianDetail extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'penilaian_details';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'penilaian_id',
        'kriteria_id',
        'bobot',
        'keterangan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'bobot' => 'float',
        'keterangan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'penilaian_id' => 'required|exists:penilaians,id',
        'kriteria_id' => 'required|exists:kriterias,id',
        'bobot' => 'nullable|numeric|digits_between:0.99,99',
        'keterangan' => 'nullable'
    ];

    
}
