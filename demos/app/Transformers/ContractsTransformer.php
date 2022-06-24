<?php
namespace App\Transformers;

use App\Models\Contracts;
use League\Fractal;
use Carbon\Carbon;

class ContractsTransformer extends Fractal\TransformerAbstract
{

    public $type = 'contracts';

    public function transform( Contracts $contract )
    {
        return [
            'id' => $contract->id,
            'contract' => $contract->contract_num,
            'vendor' => $contract->vendor,
            'description' => $contract->description,
            'budget' => $contract->budget,
            'demos' => $contract->num_demos,
            'endcaps' => $contract->num_endcaps,
            'start' => Carbon::parse($contract->start_at)->toDateString(),
            'end' => Carbon::parse($contract->end_at)->toDateString()
        ];
    }
}
