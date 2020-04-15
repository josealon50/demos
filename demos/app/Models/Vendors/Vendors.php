<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendors extends Model{

    use SoftDeletes; 

    protected $table = 'vendors';

    public $timestamps = true;


    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'vendor_code',
        'name',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}


?>
