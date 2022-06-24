<?php   

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

/**
 * @group Auth Management
 * APIs for managing Log Ins
 **/
class AuthController extends Controller
{
    /**
     * Login Endpoint
     * Endpoint will return a JWT token if credentials are correct
     *
     * @bodyParam username string required Username tyring to log in. Example: username
     * @bodyParam password string required password for user.  Example: password
     *
     * @transformercollection \App\Transformers\TokenTransformer
     * @transformerModel \App\Models\Users 
     * @response 409 {
     *      "message" : "Unauthorized" for Model [App\Models\Users]
     * }
     */
    public function login(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['username', 'password']);

        if ( !$token = Auth::attempt($credentials) ) {
            return (new Response( [ 
                'error' => [ 
                    'message' => 'Username or Password Incorrect', 
                    'code' => 200 
                ] 
            ], 404 ));
        }

        return $this->respondWithToken($token);
    }
}

?>
