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
        'proses',
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
        'status' => 'required|in:proses,selesai',
        'ganda' => 'required|in:true,false',
        'keterangan' => 'nullable',
    ];
}