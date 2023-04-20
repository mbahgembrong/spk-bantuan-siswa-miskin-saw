<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Kriteriadetail
 * @package App\Models
 * @version April 18, 2023, 2:35 pm UTC
 *
 * @property uuid $kriteria_id
 * @property string $nama
 * @property number $bobot
 * @property string $kode
 * @property string $tipe
 * @property string $ket
 */
class Kriteriadetail extends Model
{
    use SoftDeletes;

    use HasFactory;

    use \App\Traits\TraitUuid;
    public $table = 'kriteriadetails';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'kriteria_id',
        'nama',
        'bobot',
        'kode',
        'tipe',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string',
        'bobot' => 'float',
        'kode' => 'string',
        'tipe' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'kriteria_id' => 'required|exists:kriterias,id',
        'nama' => 'required',
        'bobot' => 'required|numeric|between:0,100',
        'kode' => 'nullable',
        'tipe' => 'nullable',
    ];

    /**
     * Get the kriteria that owns the Kriteriadetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}