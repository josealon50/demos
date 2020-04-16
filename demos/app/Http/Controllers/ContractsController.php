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
        $this->manager = $this->getFractalManager();
    }

    /**
     * Get All Contracts paginated
     *
     * @return Paginator Contracts
     */
    public function index(){
        $paginator = Contracts::paginate();
        $contracts = $paginator->getCollection();

        $resource = new Collection($contracts, new ContractsTransformer, 'contracts');
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        return $this->manager->createData($resource)->toArray();
    }

    /**
     * Get Contract by id 
     *
     * @return Paginator Contracts
     */
    public function show($id){
        try{
            $contract = Contracts::findOrFail($id);
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
     * Create new Contract 
     *
     * @return Contract 
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

        $resource = new item($contract, new ContractsTransformer, 'contracts');
        return $this->manager->createData($resource)->toarray();

    }

    /**
     * Update existing Contract 
     *
     * @return Contract
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
     *
     * @return Contract
     */
    public function delete($id){
        try{
            $contract = Contracts::findOrFail($id);
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
}
