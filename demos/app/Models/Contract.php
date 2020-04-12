<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Contract extends Model
{
    use SoftDeletes; 

    public $timestamps = true;


    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'contract_num',
        'description',
        'budget',
        'num_demos',
        'num_endcaps',
        'start_at',
        'end_at',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}


?>
