<?php
namespace App\Transformers;

use App\Models\Vendors;
use League\Fractal;
use Carbon\Carbon;

class VendorsTransformer extends Fractal\TransformerAbstract
{

    public $type = 'vendors';

    public function transform( Vendors $vendors )
    {
        return [
            'id' => $vendors->id,
            'code' => $vendors->vendor_code,
            'name' => $vendors->name,
            'created_at' => Carbon::parse($vendors->created_at)->toDateString(),
            'deleted_at' => Carbon::parse($vendors->deleted_at)->toDateString(),
            'updated_at' => Carbon::parse($vendors->updated_at)->toDateString(),
        ];
    }
}

