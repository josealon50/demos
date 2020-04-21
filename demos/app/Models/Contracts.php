<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contracts extends Model
{
    use SoftDeletes; 

    protected $dateFormat = 'm/d/Y';

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [ 'id', 'contract_num', 'vendor_id', 'description', 'budget', 'num_demos', 'num_endcaps', 'start_at', 'end_at', 'deleted_at', 'created_at', 'updated_at' ];

    /**
     * Hidden Attributes
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Date attributes
     *
     * @var array
     */
    protected $dates = [ 'start_at', 'end_at', 'created_at', 'updated_at', 'deleted_at' ];

    /**
     * Casting of attributes
     *
     * @var array
     */
    protected $casts = [ 'deleted_at'  => 'date:m/d/Y', 'created_at' => 'date:m/d/Y', 'updated_at' => 'date:m/d/Y', ];

    public function vendor(){
        return $this->hasOne('App\Models\Vendors', 'id');
    }

    public function items(){
        return $this->hasMany( 'App\Models\ContractsToItems', 'contract_id');
    }

}
?>
