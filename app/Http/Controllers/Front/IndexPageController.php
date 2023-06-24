<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Feature;
use App\Models\Menu;
use App\Models\Partner;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Gallery;
use App\Models\AppSetting;
use App\Models\Benifit;
use App\Models\Country;
use App\Models\Information;
use App\Models\ServiceAgent;
use Illuminate\Http\Request;

class IndexPageController extends Controller
{
    public function index()
    {

        $sliders = Slider::latest()->take(5)->get();
        $welcome = Menu::where('content_type', 'about')->first();
        $services = Feature::orderBy('position', 'asc')->where('publish_status', 1)->take(6)->get();
        $partners = Partner::latest()->where('publishStatus', 1)->get();
        $countries = Country::orderBy('name', 'ASC')->pluck('name', 'id');
        $serviceAgent = ServiceAgent::where('publishStatus', '1')->pluck('title', 'id');

        // $team = Team::with('designation')->latest()->first();
        $meta = $this->getMetaData();
        $team =  Team::select(
            'teams.designation_id',
            'teams.full_name',
            'teams.id',
            'teams.image',
            // "designations.title"
        )
            ->leftJoin('designations', 'designations.id', 'teams.designation_id')
            ->with('designation:id,title,position')
            ->orderBy('designations.position', 'ASC')
            ->where('teams.publish_status', '1')
            ->limit(2)
            ->get();

        $news = Blog::where('postType', 'news')->latest()->take(4)->get();
        $articles = Blog::where('postType', 'article')->latest()->take(3)->get();
        $galleries = Gallery::where('publish_status', '1')->latest()->take(8)->get();
        $information = Information::where('publish_status', '1')->latest()->get();
        $benefit = Benifit::latest()->first();
        return view('website.index', compact('sliders', 'countries', 'serviceAgent', 'benefit', 'welcome', 'services', 'partners', 'team', 'meta', 'news', 'articles', 'galleries', 'information'));
    }

    public function blogPage($slug)
    {

        $blog = Blog::where('slug', $slug)->firstorfail();
        return view('website.pages.detail', compact('blog'));
    }
    public function servicePage($slug)
    {
        $menu = Menu::where('slug', 'service')->first();
        if (!$menu) {
            abort(404);
        }
        $pagedata = $menu;
        $blog = Feature::where('slug', $slug)->firstorfail();
        return view('website.pages.serviceDetails', compact('blog', 'pagedata'));
    }
    public function galleryPage($slug)
    {
        $gallery = Gallery::where('slug', $slug)->firstorfail();
        return view('website.pages.galleryDetail', compact('gallery'));
    }
    protected function getMetaData()
    {
        $website = AppSetting::select('*')->orderBy('created_at', 'desc')->first();

        $meta = [
            'meta_title' => @$website->meta_title ?? 'air logistics',
            'meta_keyword' => @$website->meta_keyword ?? 'air logistics',
            'meta_description' =>  @$website->meta_description ?? 'air logistics',
            'meta_keyphrase' => @$website->meta->keyphrase ?? 'air logistic',
            'og_image' => $website->og_image ?? $website->logo_url ?? 'og_image',
        ];
        return $meta;
    }
}
