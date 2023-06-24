<?php

namespace App\View\Components\Frontend;

use App\Http\Resources\MenuResource;
use App\Models\AppSetting;
use App\Models\Blog;
use App\Models\Menu;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data = [
            'appSetting' => $this->getAppSetting(),
            'headerMenu' => $this->getMenus()[0],
            'sidebar' => $this->getMenus()[0],
            'latestNews' => $this->getBlog(),

        ];
        return view('components.frontend.header', $data);
    }


    protected function getMenus()
    {
        $header = Menu::where('publish_status', '1')
            ->where('parent_id', null)
            ->with('child_menu')
            ->orderBy('position', 'ASC')
            ->where('show_on', 'like', '%header%')
            ->get()
            ->map(function ($item, $key) {
                return [
                    'title' => $item->title['en'],
                    'href' => $item->external_url ?? route('getPage', $item->slug),
                    'target' => $item->external_url ? '_blank' : null,
                    'child' => count($item->child_menu) ? $this->getChildren($item->child_menu) : [],
                ];
            });
        $sidebar = Menu::where('publish_status', '1')
            ->where('parent_id', null)
            ->with('child_menu')
            ->orderBy('position', 'ASC')
            ->where('show_on', 'like', '%sidebar%')
            ->get()
            ->map(function ($item, $key) {
                return [
                    'title' => $item->title['en'],
                    'href' => $item->external_url ?? route('getPage', $item->slug),
                    'target' => $item->external_url ? '_blank' : null,

                    'child' => count($item->child_menu) ? $this->getChildren($item->child_menu) : [],
                ];
            });




        return [$header, $sidebar];
    }

    protected function getAppSetting()
    {
        return AppSetting::latest()->first();
    }

    protected function getChildren($array)
    {
        foreach ($array as $key => $value) {
            $children[] = [
                'title' => $value->title['en'],
                'href' => ($value->external_url && !$value->external_url == '') ? $value->external_url : route('getPage', $value->slug),
                'target' =>($value->external_url && !$value->external_url == '') ? '_blank' : null,
            ];
        }
        return $children;
    }

    protected function getBlog()
    {
        return Blog::where('postType', 'news')->latest()->take(3)->get();
    }
}
