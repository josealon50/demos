<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stores extends Model{

    use SoftDeletes; 

    protected $table = 'stores';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'store_code',
        'name',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}


?>
