<?php

namespace App\Listeners;

use App\Models\AgentCreditBalance;
use App\Models\Credit;
use App\Models\Pricing;
use App\Models\WeightPrice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SubtractCredit
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $credit =  AgentCreditBalance::where('agentId', $event->agentId)
            ->first();
        $credit->decrement('balance', $event->price);
        $credit->increment('consumedCredit', $event->price);
    }
}
