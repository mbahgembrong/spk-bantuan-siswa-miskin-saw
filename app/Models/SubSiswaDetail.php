<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubSiswaDetail extends Model
{
    use SoftDeletes;

    use HasFactory;

    use \App\Traits\TraitUuid;
    public $table = 'sub_siswa_details';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'siswa_detail_id',
        'kriteria_id',
        'kriteria_detail_id',
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
        'keterangan' => 'string'
    ];
    /**
     * Get the siswaDetail that owns the SubSiswaDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswaDetail()
    {
        return $this->belongsTo(SiswaDetail::class, 'siswa_detail_id');
    }

    /**
     * Get the kriteriaDetailId that owns the SubSiswaDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kriteriaDetailId()
    {
        return $this->belongsTo(Kriteriadetail::class, 'kriteria_detail_id');
    }

}
