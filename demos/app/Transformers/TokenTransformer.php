<?php
namespace App\Transformers;

use League\Fractal;
use Carbon\Carbon;

class TokenTransformer extends Fractal\TransformerAbstract
{

    public $type = 'token';

    public function transform( Array $token )
    {
        return [
            'id' => null,
            'token' => $token['token'],
            'type' => $token['token_type'],
            'expires_in' => $token['expires_in'],
        ];
    }
}
