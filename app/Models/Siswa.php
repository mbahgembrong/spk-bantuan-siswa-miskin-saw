<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Siswa
 * @package App\Models
 * @version April 18, 2023, 2:36 pm UTC
 *
 * @property string $nis
 * @property string $nama
 * @property string $alamat
 * @property string $jenis_kelamin
 * @property string $tanggal_lahir
 * @property string $ibu
 * @property string $ayah
 * @property string $foto
 */
class Siswa extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'siswas';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'nis',
        'nama',
        'alamat',
        'jenis_kelamin',
        'tanggal_lahir',
        'ibu',
        'ayah',
        'foto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nis' => 'string',
        'nama' => 'string',
        'alamat' => 'string',
        'jenis_kelamin' => 'string',
        'tanggal_lahir' => 'date',
        'ibu' => 'string',
        'ayah' => 'string',
        'foto' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nis' => 'required',
        'nama' => 'required',
        'alamat' => 'required',
        'jenis_kelamin' => 'required',
        'tanggal_lahir' => 'required|date',
        'ibu' => 'required',
        'ayah' => 'required',
        'foto' => 'required|image'
    ];

    
}
