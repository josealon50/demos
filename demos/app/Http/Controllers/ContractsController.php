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
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class ContractsController extends Controller
{
    protected $manager;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->manager = $this->getFractalManager();
    }

    public function index(){
        $contract = Contracts::all();
        $resource = new Collection($contract, new ContractsTransformer, 'contracts');
        return $this->manager->createData($resource)->toArray();
    }

    public function show($id){
        $contract = Contracts::find($id);
        $resource = new Item($contract, new ContractsTransformer, 'contracts');
        return $this->manager->createData($resource)->toArray();
 
    }

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

        return ( new Response( $contract, 201 ) ); 

    }

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

        return (new Response( "", 204 ));
    }

    public function delete($id){
        $contract = Contracts::findOrFail($id);
        return (new Response( $contract->delete(), 204 ));
    }
}
