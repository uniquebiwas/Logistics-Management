<?php

namespace App\Http\View\Composers;

use App\Models\AppSetting;
use App\Models\Menu;
use App\Models\News;
use App\Models\Team;
use App\Models\Video;
use App\Traits\SharedTrait;
use Illuminate\View\View;

class MenuComposer
{
    use SharedTrait;
    public function compose(View $view)
    {
        $website = cache()->remember('sitesetting', 60 * 6 * 24, function () {
            return AppSetting::select('*')->orderBy('created_at', 'desc')->first();
        });
        // dd($header_ads);
        // select('id', 'title', 'slug', 'show_on')
        if (!request()->is(['uploads*', 'nd-admin*'])) {
            $this->current_route = request()->route()->getName() ?? null;
        }
        $menus = $this->getMenus();
        // dd($menus);
        $header_ads = $this->getAllHeaderAndMenuAds('header');
        // dd($header_ads);
        $after_header_menu = $this->getAllHeaderAndMenuAds('menu');
        // dd($after_header_menu);
        $startup_ad = $this->getAllHeaderAndMenuAds('skip');
        // dd($startup_ad);

        // $bottom_ads = $this->getAllHeaderAndMenuAds('bottom');

        $header_menus = [];
        $sidebar = [];
        $footer_menus = [];
        foreach ($menus as $menuItem) {
            if ($menuItem->show_on) {
                if (in_array('header', $menuItem->show_on)) {
                    $header_menus[] = $menuItem;
                }
                if (in_array('sidebar', $menuItem->show_on)) {
                    $sidebar[] = $menuItem;
                }
                if (in_array('useful_links', $menuItem->show_on)) {
                    $footer_menus[] = $menuItem;
                }
            }
        }

        $footerVideo = cache()->remember('homepage_video', 60 * 60 * 24, function () {
            return Video::select("*")
                ->where('publish_status', true)
                ->where('featured', true)
                ->orderBy('created_at', 'desc')
                ->first();
        });
        // dd($footerVideo);

        $team = cache()->remember('footer_team', now()->addDays(30), function () {

            $output = Team::select('designation_id', 'full_name', 'id')
                ->with('designation:id,title,position')
                ->get()
                ->sortBy('designations.position');


            return $output
                ->map(function ($value, $key) {
                    return [
                        'name' => $value->full_name['np'],
                        'designation' => $value->designation->title['np'],
                        'position' => $value->designation->position,
                    ];
                })->sortBy('position')->unique('position')->take(3);
        });

        $view->with([
            'menus' => $menus,
            'sidebar' => $sidebar,
            'header_menus' => $header_menus,
            "header_ads" => $header_ads,
            "after_header_menu" => $after_header_menu,
            // "shared_advertise" => $shared_advertise,
            // "after_header_menu" => $after_header_menu,
            "footer_data" => $website,
            "footer_menus" => $footer_menus,
            "website" => $website,
            "footerVideo" => $footerVideo,
            "startup_ad" => $startup_ad,
            "footer_team" => $team
            // "reporters" =>$reporters

        ]);
    }
}
