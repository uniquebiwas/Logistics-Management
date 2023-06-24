<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Traits\Shared\AdminSharedTrait;
use Illuminate\Http\Request;

class RateController extends Controller
{
    use AdminSharedTrait;
    public function getRate(Request $request)
    {
        $data =    $this->validate($request, [
            'to' => 'required',
            'integrator' => ['required', 'exists:service_agents,id'],
            'weight' => ['required'],
        ]);


    }

   


}
