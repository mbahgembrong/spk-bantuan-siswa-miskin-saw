<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bantuan extends Model
{
    use SoftDeletes;

    use HasFactory;

    use \App\Traits\TraitUuid;
    public $table = 'bantuans';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nama',
        'jumlah',
        'kuota',
        'status',
        'ganda',
        'keterangan',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string',
        'jumlah' => 'integer',
        'kuota' => 'integer',
        'status' => 'string',
        'ganda' => 'string',
        'keterangan' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama' => 'required',
        'jumlah' => 'required|numeric',
        'kuota' => 'required|numeric',
        'ganda' => 'required|in:1,0',
        'keterangan' => 'nullable',
    ];

    /**
     * Get all of the sisswaBantuan for the Bantuan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function siswaBantuan()
    {
        return $this->hasMany(SiswaBantuan::class, 'bantuan_id');
    }
}
