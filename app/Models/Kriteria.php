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

    use \App\Traits\TraitUuid;

    public $table = 'kriterias';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nama',
        'bobot',
        'jenis',
        'kode',
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
        'jenis' => 'string',
        'kode' => 'string',
        'tipe' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama' => 'required',
        'bobot' => 'required||numeric|between:0,100',
        'jenis' => 'required',
        'kode' => 'nullable',
        'tipe' => 'nullable'
    ];

    /**
     * Get all of the kriteriaDetail for the Kriteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kriteriaDetail()
    {
        return $this->hasMany(Kriteriadetail::class, 'kriteria_id', 'id');
    }
}