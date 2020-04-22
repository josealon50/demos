<?php

namespace App\Http\Controllers;

use App\Models\Contracts;
use App\Transformers\ContractsTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use League\Fractal;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Illuminate\Support\Facades\Auth;


/**
 * @group Contracts Management
 * APIs for managing Contracts
 */

class ContractsController extends Controller
{
    /**
     * Manager variable for Fractal
     *
     */
    protected $manager;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->manager = $this->getFractalManager();
    }

    /**
     * Get All Contracts paginated
     * Endpoint will return a pagination object with all Contracts 
     *
     * @urlParam id required The ID of the contract.
     *
     * @transformercollection \App\Transformers\ContractsTransformer
     * @transformerModel \App\Models\Contracts 
     */
    public function index( Request $request ){
        //Validate Request 
        $this->validate( $request, [ 
            'contract' => 'integer',
            'vendor' => 'integer',
            'items' => 'integer',
            'start' => 'date',
            'end' => 'date',

        ]);
        
        $contracts = Contracts::query();
        
        //Build where clause
        if( isset($request['contract']) && $request['contract'] != '' ){
            $contracts->where( 'contract_num', '=', $request['contract'] );
        }
        if( isset($request['vendor']) && $request['vendor'] != '' ){
            $contracts->where( 'vendor_id', '=', $request['vendor'] );
        }
        if( isset($request['item']) && $request['item'] != '' ){
            $contracts->join( 'contracts_to_items', 'contract_id', '=', 'contracts.id' )->whereIn( 'item_id', [ $request['item'] ] );
        }
        if( isset($request['start']) && $request['start'] != '' ){
            $contracts->whereDate( 'start_at', '>=', Carbon::parse($request['start'])->toDateString() );
        }
        if( isset($request['end']) && $request['end'] != '' ){
            $contracts->whereDate( 'end_at', '<=', Carbon::parse($request['end'])->toDateString() );
        }
 
        $contracts = $contracts->get();
        $paginator = Contracts::paginate();

        $resource = new Collection($contracts, new ContractsTransformer, 'contracts');
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        return $this->manager->createData($resource)->toArray();

    }

    /**
     * Get Contract by id 
     * Endpoint will return contract by url param
     *
     * @urlParam id required The ID of the contract.
     * @bodyParam contract int required The contract_num of the contract. Example: 9
     * @bodyParam vendor int required The contract_num of the contract. Example: 9
     * @bodyParam description int required The contract_num of the contract. Example: 9
     * @bodyParam budget float required The budget of the contract. Example: 23022.12
     * @bodyParam demos int required The num_demos (number of demos) of the contract. Example: 9
     * @bodyParam endcaps int required The num_endcaps (number of endcaps) of the contract. Example: 9
     * @bodyParam star date required The start_at starting date of the contract. Example: 9
     * @bodyParam end date required The end_at ending date of the contract. Example: 9
     *
     * @transformercollection \App\Transformers\ContractsTransformer
     * @transformerModel \App\Models\Contracts 
     * @response 404 {
     *      "message" : "Contract Not Found" for Model [App\Models\Contracts]
     * }
     */
    public function show($id){
        try{
            $contract = Contracts::findOrFail($id);
            $resource = new Item($contract, new ContractsTransformer, 'contracts');
            return $this->manager->createData($resource)->toarray();
        }
        catch( ModelNotFoundException $e ){
            return (new Response( [ 
                'error' => [ 
                    'message' => 'Contract Not Found', 
                    'code' => 100 
                ] 
            ], 404 ));

        }
 
    }

    /**
     * Create new Contract 
     * Enpoint will create a new contract. 
     * @bodyParam contract int required The contract_num of the contract. Example: 9
     * @bodyParam vendor int required The contract_num of the contract. Example: 9
     * @bodyParam description int required The contract_num of the contract. Example: 9
     * @bodyParam budget float required The budget of the contract. Example: 23022.12
     * @bodyParam demos int required The num_demos (number of demos) of the contract. Example: 9
     * @bodyParam endcaps int required The num_endcaps (number of endcaps) of the contract. Example: 9
     * @bodyParam star date required The start_at starting date of the contract. Example: 9
     * @bodyParam end date required The end_at ending date of the contract. Example: 9
     *
     * @transformercollection \App\Transformers\ContractsTransformer
     * @transformerModel \App\Models\Contracts 
     */
    public function create( Request $request ){
        //Validate Request 
        $this->validate( $request, [ 
            'contract' => 'required|integer',
            'vendor' => 'required|integer',
            'description' => 'required|max:255',
            'budget' => 'required|numeric',
            'demos' => 'required|integer',
            'endcaps' => 'required|integer',
            'start' => 'required|date',
            'end' => 'required|date',

        ]);

        $contract = new Contracts();

        $contract->contract_num = $request->contract;
        $contract->vendor_id = $request->vendor;
        $contract->description = $request->description;
        $contract->budget =  $request->budget;
        $contract->num_demos = $request->demos;
        $contract->num_endcaps = $request->endcaps;
        $contract->start_at = Carbon::parse($request->start)->toDateString();
        $contract->end_at = Carbon::parse($request->end)->toDateString();
        $contract->save();

        //$resource = new item($contract, new ContractsTransformer, 'contracts');
        //return $this->manager->createData($resource)->toarray();
        return (new Response( "", 201 ));

    }

    /**
     * Update existing Contract 
     * Endpoint will update a contract.
     *
     * @urlParam id required The ID of the contract.
     *
     * @bodyParam contract int required The contract_num of the contract. Example: 9
     * @bodyParam vendor int required The contract_num of the contract. Example: 9
     * @bodyParam description int required The contract_num of the contract. Example: 9
     * @bodyParam budget float required The budget of the contract. Example: 23022.12
     * @bodyParam demos int required The num_demos (number of demos) of the contract. Example: 9
     * @bodyParam endcaps int required The num_endcaps (number of endcaps) of the contract. Example: 9
     * @bodyParam star date required The start_at starting date of the contract. Example: 9
     * @bodyParam end date required The end_at ending date of the contract. Example: 9
     *
     * @transformercollection \App\Transformers\ContractsTransformer
     * @transformerModel \App\Models\Contracts 
     * @response 404 {
     *      "message" : "Contract Not Found" for Model [App\Models\Contracts]
     * }
     */
    public function update( $id, Request $request ){
        //Validate Request 
        $this->validate( $request, [ 
            'contract' => 'required|integer',
            'vendor' => 'required|integer',
            'description' => 'required|max:255',
            'budget' => 'required|numeric',
            'demos' => 'required|integer',
            'endcaps' => 'required|integer',
            'start' => 'required|date',
            'end' => 'required|date',

        ]);
        
        try{
            $contract = Contracts::findOrFail($id);

            $contract->contract_num = $request->contract;
            $contract->vendor_id = $request->vendor;
            $contract->description = $request->description;
            $contract->budget =  $request->budget;
            $contract->num_demos = $request->demos;
            $contract->num_endcaps = $request->endcaps;
            $contract->start_at = Carbon::parse($request->start)->toDateString();
            $contract->end_at = Carbon::parse($request->end)->toDateString();
            $contract->save();

            $resource = new item($contract, new ContractsTransformer, 'contracts');
            return $this->manager->createData($resource)->toarray();
        }
        catch( ModelNotFoundException $e ){
            return (new Response( [ 
                'error' => [ 
                    'message' => 'Contract Not Found', 
                    'code' => 100 
                ] 
            ], 404 ));

        }

    }

    /**
     * Delete existing Contract 
     * Endpoint will do a soft delete on contrat record.
     *
     * @urlParam id required The ID of the contract.
     *
     * @transformercollection \App\Transformers\ContractsTransformer
     * @transformerModel \App\Models\Contracts 
     *
     * @response 404 {
     *      "message" : "Contract Not Found" for Model [App\Models\Contracts]
     * }
     */
    public function delete($id){
        try{
            $contract = Contracts::findOrFail($id);
            $contract->delete();
            return (new Response( "", 201 ));
        }
        catch( ModelNotFoundException $e ){
            return (new Response( [ 
                'error' => [ 
                    'message' => 'Contract Not Found', 
                    'code' => 100 
                ] 
            ], 404 ));

        }
    }
}
