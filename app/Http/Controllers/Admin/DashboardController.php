<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent\ShipmentPackage;
use App\Models\Feature;
use App\Models\Information;
use App\Models\Blog;
use App\Models\Team;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {


        if (request()->user()->hasAnyRole(['Agent|Staff'])) {
            return redirect('/agent/agent');
        }
        $count_data['admin'] = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['Admin', 'AWB Admin']);
        })
            ->count();
        $count_data['shipment'] = ShipmentPackage::count();
        $count_data['staff'] = User::count();
        $count_data['user'] = User::count();
        $count_data['slider'] = Slider::all()->count();
        $count_data['information'] = Information::where('publish_status', '1')->count();
        $count_data['feature'] = Feature::where('publish_status', '1')->count();
        $count_data['team'] = Team::where('publish_status', '1')->count();
        $userRole = @request()->user()->roles->first()->name;
        $count_data['totalblog'] = Blog::all()->count();
        $count_data['published_blog'] = Blog::where('publish_status', '1')->count();
        $count_data['unpublished_blog'] = Blog::where('publish_status', '0')->count();

        $count_data['totaltestimonial'] = Testimonial::all()->count();
        $count_data['published_testimonial'] = Testimonial::where('publish_status', '1')->count();
        $count_data['unpublished_testimonial'] = Testimonial::where('publish_status', '0')->count();

        $count_data['totalslider'] = Slider::all()->count();
        $count_data['published_slider'] = Slider::where('publish_status', '1')->count();
        $count_data['unpublished_slider'] = Slider::where('publish_status', '0')->count();

        $count_data['totalteam'] = Team::all()->count();
        $count_data['published_team'] = Team::where('publish_status', '1')->count();
        $count_data['unpublished_team'] = Team::where('publish_status', '0')->count();

        $count_data['totalfeature'] = Feature::all()->count();
        $count_data['published_feature'] = Feature::where('publish_status', '1')->count();
        $count_data['unpublished_feature'] = Feature::where('publish_status', '0')->count();

        $count_data['agents'] =  User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['Agent']);
        })
            ->count();




        // dd(Blog::all());

        $data = [
            'count_data' => $count_data,
            "userRole" => $userRole,
        ];

        return view('admin.dashboard')->with($data);
    }
}
