<?php

namespace App\Http\Controllers;

use App\Models\Vendors;
use App\Transformers\VendorsTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use League\Fractal;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

/**
 * @group Vendors Management
 * APIs for managing Vendors
 */

class VendorsController extends Controller
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
     * Get All Vendors paginated
     * Endpoint will return a pagination object with all Vendors 
     *
     * @transformercollection \App\Transformers\VendorsTransformer
     * @transformerModel \App\Models\Vendors 
     */
    public function index(){
        $paginator = Vendors::paginate();
        $vendors = $paginator->getCollection();

        $resource = new Collection($vendors, new VendorsTransformer, 'vendors');
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        return $this->manager->createData($resource)->toArray();
    }

    /**
     * Get Vendor by id 
     * Endpoint will return vendor by url param
     *
     * @urlParam id required The ID of the vendors.
     * @bodyParam code int required 
     * @bodyParam name text required
     * @bodyParam created_at date shows the date when vendor was created
     * @bodyParam deleted_at date shows the date when vendor was delete
     * @bodyParam updated_at date shows the date when vendor was updated
     *
     * @transformercollection \App\Transformers\VendorsTranformers
     * @transformerModel \App\Models\Vendors 
     * @response 404 {
     *      "message" : "Vendor Not Found" for Model [App\Models\Vendors]
     * }
     */
    public function show($id){
        try{
            $vendors = Vendors::findOrFail($id);
            $resource = new item($vendors, new VendorsTransformer, 'vendors');
            return $this->manager->createData($resource)->toarray();
        }
        catch( ModelNotFoundException $e ){
            return (new Response( [ 
                'error' => [ 
                    'message' => 'Vendor Not Found', 
                    'code' => 100 
                ] 
            ], 404 ));
        }
    }
    
    /**
     * Create new Vendor 
     * Endpoint will create a new vendor. 
     * @bodyParam vendor_code int required.
     * @bodyParam name of the vendor required.
     *
     * @transformercollection \App\Transformers\VendorsTransformer
     * @transformerModel \App\Models\Vendors 
     */
    public function create( Request $request ){
        //Validate Request 
        $this->validate( $request, [ 
            'code' => 'required|integer',
            'name' => 'required|max:255'
        ]);

        $vendors = new Vendors();

        $vendors->vendor_code = $request->code;
        $vendors->name = $request->name;
        $vendors->save();

        $resource = new item($vendors, new VendorsTransformer, 'vendors');
        return $this->manager->createData($resource)->toarray();
    }
    
    /**
     * Update a Vendor 
     * Endpoint will update a vendor. 
     * @bodyParam vendor_code int required.
     * @bodyParam name of the vendor required.
     *
     * @transformercollection \App\Transformers\VendorsTransformer
     * @transformerModel \App\Models\Vendors 
     */
    public function update( $id, Request $request ){
        //Validate Request 
        $this->validate( $request, [ 
            'code' => 'required|integer',
            'name' => 'required|max:255'
        ]);

        try{
            $vendor = Vendors::findOrFail($id);

            $vendor->vendor_code = $request->code;
            $vendor->name = $request->name;
            $vendor->save();

            $resource = new item($vendor, new VendorsTransformer, 'vendors');
            return $this->manager->createData($resource)->toarray();
        }
        catch( ModelNotFoundException $e ){
            return (new Response( [ 
                'error' => [ 
                    'message' => 'Vendor Not Found', 
                    'code' => 100 
                ] 
            ], 404 ));
        }
    }

    /**
     * Delete existing Vendor 
     * Endpoint will do a soft delete on vendor record.
     *
     * @urlParam id required The ID of the vendor.
     *
     * @transformercollection \App\Transformers\VendorTransformer
     * @transformerModel \App\Models\Vendors 
     *
     * @response 404 {
     *      "message" : "Vendor Not Found" for Model [App\Models\Vendors]
     * }
     */
    public function delete($id){
        try{
            $vendor = Vendors::findOrFail($id);
            $resource = new item($vendor, new VendorsTransformer, 'vendors');
            return $this->manager->createData($resource)->toarray();
        }
        catch( ModelNotFoundException $e ){
            return (new Response( [ 
                'error' => [ 
                    'message' => 'Vendor Not Found', 
                    'code' => 100 
                ] 
            ], 404 ));
        }
    }
}
?>
