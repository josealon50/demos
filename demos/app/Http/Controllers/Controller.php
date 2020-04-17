<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;


class Controller extends BaseController
{
    //
    public function getFractalManager(){
        $request = app(Request::class);
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());
        if (!empty($request->query('include'))) {
            $manager->parseIncludes($request->query('include'));
        }
        return $manager;
    }
}
