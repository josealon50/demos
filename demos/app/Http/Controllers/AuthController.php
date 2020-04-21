<?php   
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
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
