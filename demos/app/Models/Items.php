<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Model;

class Items extends Model{

    use SoftDeletes; 

    protected $table = 'items';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'item_code',
        'name',
        'description',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}


?>
