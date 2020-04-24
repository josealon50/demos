<?php
namespace App\Transformers;

use App\Models\Users;
use League\Fractal;
use Carbon\Carbon;

class UsersTransformer extends Fractal\TransformerAbstract
{

    public $type = 'users';

    public function transform( Users $user )
    {
        return [
            'id' => $user->id,
            'username' => $user->username,
            'created_at' => Carbon::parse($user->created_at)->toDateTimeString(),
            'updated_at' => Carbon::parse($user->updated_at)->toDateTimeString(),
        ];
    }
}
