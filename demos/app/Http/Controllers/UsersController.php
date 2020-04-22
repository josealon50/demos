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
use Illuminate\Support\Facades\Auth;

/**
 * @group Users Management
 * APIs for managing Users
 */
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
        $this->manager = $this->getFractalManager();
    }

    /**
     * Get the authenticated user 
     * Endpoint will return the authorized  
     *
     * @transformercollection \App\Transformers\UsersTransformer
     * @transformerModel \App\Models\Users 
     */
    public function profile()
    {
        $resource = new Item(Auth::user(), new UsersTransformer, 'users');
        return $this->manager->createData($resource)->toarray();
    }

    /**
     * Get the authenticated user 
     * Endpoint will return the authorized  
     *
     * @transformercollection \App\Transformers\UsersTransformer
     * @transformerModel \App\Models\Users 
     * @response 200 {
     *      "
     * }
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
     * Get User by id
     *
     *
     * @urlParam id required The ID of the user.
     *
     * @transformercollection \App\Transformers\ContractsTransformer
     * @transformerModel \App\Models\Contracts 
     * @response 404 {
     *      "message" : "Contract Not Found" for Model [App\Models\Contracts]
     * }
     **/
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
     * Create new User 
     * Enpoint will create a new user. 
     * @bodyParam username string required username Example: crodriguez
     * @bodyParam password string required password  Example: password
     *
     * @transformercollection \App\Transformers\ContractsTransformer
     * @transformerModel \App\Models\Contracts 
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
