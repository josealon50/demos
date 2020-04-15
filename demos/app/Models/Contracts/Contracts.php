<?php

namespace App\Models\Contracts;

use Illuminate\Database\Eloquent\Model;


class Contracts extends Model
{
    use SoftDeletes; 

    protected $table = 'contracts';

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
