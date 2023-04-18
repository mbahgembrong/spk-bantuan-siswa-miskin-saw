<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Kriteria
 * @package App\Models
 * @version April 18, 2023, 2:35 pm UTC
 *
 * @property string $nama
 * @property number $bobot
 * @property string $tipe
 */
class Kriteria extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'kriterias';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'nama',
        'bobot',
        'tipe'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string',
        'bobot' => 'float',
        'tipe' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama' => 'required',
        'bobot' => 'required||numeric|between:0,99.99',
        'tipe' => 'required'
    ];

    
}
