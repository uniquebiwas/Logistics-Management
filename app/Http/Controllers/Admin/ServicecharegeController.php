<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicecharegeController extends Controller
{
    const governmentTax = 20;
    public function __construct()
    {
    }
    protected function governmentTax($totalCost)
    {
        return $totalCost + (($this->governmentTax / $totalCost) * 100);
    }

    protected function totalCost()
    {
    }
}
