<?php

namespace App\Http\Controllers;

use App\Models\Contracts;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

class ContractsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(){
        return (new Response( Contracts::all()->take(25), 200 )); 
    }

    public function show($id){
        return (new Response( Contracts::findOrFail($id) ));
    }

    public function create( Request $request ){
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

    public function edit(){
        return (new Response( Contracts::findOrFail($id) ));
    }

    public function delete($id){
        $contract = Contracts::findOrFail($id);
        return (new Response( $contract->delete(), 204 ));
    }
}
