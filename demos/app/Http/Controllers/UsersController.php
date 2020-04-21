<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Transformers\UsersTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;
use League\Fractal;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class UsersController extends Controller {

    /**
     * Manager variable for Fractal
     *
     */
    protected $manager;

    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->manager = $this->getFractalManager();
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }

    /**
     * Get all User.
     *
     * @return Response
     */
    public function index()
    {
        //Validate Request 
        /*
        $this->validate( $request, [ 
            'contract' => 'integer',
            'vendor' => 'integer',
            'items' => 'integer',
            'start' => 'date',
            'end' => 'date',

        ]);
         */

        $users = Users::all();
        $paginator = Users::paginate();
        $resource = new Collection($users, new UsersTransformer, 'contracts');
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        return $this->manager->createData($resource)->toArray();
    }

    /**
     * Get one user.
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $user = Users::findOrFail($id);
            $resource = new Item($user, new UsersTransformer, 'users');
            return $this->manager->createData($resource)->toarray();
        } 
        catch ( ModelNotFoundException $e ) {
            return (new Response( [ 
                'error' => [ 
                    'message' => 'User Not Found', 
                    'code' => 200 
                ] 
            ], 404 ));
        }

    }

    /**
     * Create new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            $user = new Users();
            $user->username = $request->input('username');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);
            $user->save();

            //return successful response
            return (new Response( "", 201 ));

        } catch (\Exception $e) {
            //return error message
            return (new Response( [ 
                'error' => [ 
                    'message' => 'User Not Created', 
                    'code' => 200 
                ] 
            ], 409 ));
        }

    }

}

?>
