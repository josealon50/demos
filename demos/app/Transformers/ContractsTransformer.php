<?php
namespace App\Transformers;

use App\Models\Contracts;
use League\Fractal;

class ContractsTransformer extends Fractal\TransformerAbstract
{

    public $type = 'contracts';

    public function transform( Contracts $contract )
    {
        return [
            'id' => $contract->id,
            'contract' => $contract->contract_num,
            'vendor' => $contract->vendor_id,
            'description' => $contract->description,
            'budget' => $contract->budget,
            'demos' => $contract->num_demos,
            'endcaps' => $contract->num_endcaps,
            'start' => $contract->start_at,
            'end' => $contract->end_at
        ];
    }
}
