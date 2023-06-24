<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function searchPage()
    {
        return view('agent.search')
            ->with('title', 'Track Your package');
    }
}
