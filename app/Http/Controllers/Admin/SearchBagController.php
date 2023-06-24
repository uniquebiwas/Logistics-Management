<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NationalManifestBag;

class SearchBagController extends Controller
{
    public function index(Request $request)
    {
        $data = NationalManifestBag::when($request->startDate, function ($query) use ($request) {
            $query->whereDate('created_at', '>=', $request->startDate);
        })
            ->when($request->endDate, function ($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->endDate);
            })
            ->when($request->searchBagKeyword, function ($query) use ($request) {
                $query->where('title', 'like', "%$request->keyword%");
            })
            ->withCount('shipment')
            ->where('manifestId', null)
            ->latest()
            ->get();

        $view = view('admin.nationalManifest.bag.bagList', compact('data'))->render();

        return $view;
    }
}
