<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;
use Illuminate\Support\Facades\Auth;
use App\Transformers\TokenTransformer;
use League\Fractal;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;



class Controller extends BaseController
{
    public function getFractalManager(){
        $request = app(Request::class);
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());
        if (!empty($request->query('include'))) {
            $manager->parseIncludes($request->query('include'));
        }
        return $manager;
    }

    protected function respondWithToken($token)
    {
        $manager = $this->getFractalManager();
        $arr = [ 'token' => $token, 'token_type' => 'bearer', 'expires_in' => Auth::factory()->getTTL() * 60 ];
        $resource = new Item($arr, new TokenTransformer, 'token');
        return $manager->createData($resource)->toarray();
    }
}
