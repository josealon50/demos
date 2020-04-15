<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model{

    use SoftDeletes; 

    protected $table = 'departments';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'department_codes',
        'name',
        'description',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}


?>
