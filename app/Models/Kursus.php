<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Kursus
 * @package App\Models
 * @version February 27, 2018, 5:39 pm UTC
 */
class Kursus extends Model
{
    use SoftDeletes;

    public $table = 'kursuses';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama',
        'kategori',
        'alamat',
        'longitude',
        'latitude'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string',
        'kategori' => 'string',
        'alamat' => 'string',
        'longitude' => 'double',
        'latitude' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama' => 'required',
        'kategori' => 'required',
        'alamat' => 'required',
        'longitude' => 'required',
        'latitude' => 'required'
    ];

    
}
