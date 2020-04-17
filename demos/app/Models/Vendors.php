<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendors extends Model{

    use SoftDeletes; 

    protected $table = 'vendors';

    protected $dateFormat = 'm/d/Y';


    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [ 'id', 'vendor_code', 'name', 'deleted_at', 'created_at', 'updated_at' ];
    
    /**
     * The attributes that are dates
     *
     * @var array
     */
    protected $dates = [  'deleted_at', 'created_at', 'updated_at' ];

    /**
     * Casting of attributes
     *
     * @var array
     */
    protected $casts = [ 'deleted_at'  => 'date:m/d/Y', 'created_at' => 'date:m/d/Y', 'updated_at' => 'date:m/d/Y', ];
}
?>
