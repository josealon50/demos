<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractsToItems extends Model
{
    use SoftDeletes; 

    protected $table = 'contracts_to_items';

    protected $dateFormat = 'm/d/Y';

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [ 'id', 'contract_id', 'item_id', 'deleted_at', 'created_at',  'updated_at' ];

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
    protected $dates = [  'created_at', 'updated_at', 'deleted_at' ];

    /**
     * Casting of attributes
     *
     * @var array
     */
    protected $casts = [ 'deleted_at'  => 'date:m/d/Y', 'created_at' => 'date:m/d/Y', 'updated_at' => 'date:m/d/Y', ];

}
