<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Role
 * @package App\Models
 * @version April 18, 2023, 2:33 pm UTC
 *
 * @property string $role
 */
class Role extends Model
{
    use SoftDeletes;

    use HasFactory;

    use \App\Traits\TraitUuid;
    public $table = 'roles';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'role'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'role' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'role' => 'required'
    ];


}
