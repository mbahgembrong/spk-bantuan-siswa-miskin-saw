<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaBantuan extends Model
{
    use SoftDeletes;

    use HasFactory;

    use \App\Traits\TraitUuid;
    public $table = 'siswa_bantuans';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'bantuan_id',
        'siswa_id',
        'bobot',
        'keterangan',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'bobot' => 'float',
        'keterangan' => 'string',
    ];

    /**
     * Get the siswa that owns the SiswaBantuan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}