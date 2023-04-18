<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Penilaian
 * @package App\Models
 * @version April 18, 2023, 2:36 pm UTC
 *
 * @property uuid $siswa_id
 * @property uuid $kriteria_detail_id
 * @property number $bobot
 * @property string $ket
 */
class Penilaian extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'penilaians';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'siswa_id',
        'kriteria_detail_id',
        'bobot',
        'ket'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'bobot' => 'float',
        'ket' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'siswa_id' => 'required|exists:siswas,id',
        'kriteria_detail_id' => 'required|exists:kriteria_details,id',
        'bobot' => 'nullable|numeric|digits_between:0.99,99',
        'ket' => 'nullable'
    ];

    
}
