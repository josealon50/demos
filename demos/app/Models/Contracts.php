<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contracts extends Model
{
    use SoftDeletes; 

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [ 
        'contract_num', 'vendor_id', 'description', 'budget', 'num_demos', 'num_endcaps', 'start_at', 'end_at', 'deleted_at', 'created_at', 'updated_at' 
    ];

    /**
     * The attributes that are hidden 
     *
     * @var array
     */
    protected $hidden = [ 'id' ];

    /**
     * The attributes that are dates 
     *
     * @var array
     */
    protected $dates = [ 'start_at', 'end_at', 'created_at', 'updated_at', 'deleted_at' ];

}
?>
