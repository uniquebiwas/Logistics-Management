<?php

namespace App\View\Components\Frontend;

use App\Traits\SharedTrait;
use App\Models\AppSetting;
use App\Models\Feature;
use App\Models\Menu;
use Illuminate\View\Component;

class Footer extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    use SharedTrait;

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
            'usefulLinks' => $this->getFooterMenus(),
            'services'=>$this->getServices(),


        ];
        return view('components.frontend.footer',$data);
    }
    protected function getAppSetting()
    {
        return AppSetting::latest()->first();
    }
    protected function getFooterMenus(){
        $menus = $this->getMenus();
        $footer_menus = [];
        foreach ($menus as $menuItem) {
            if ($menuItem->show_on) {

                if (in_array('useful_links', $menuItem->show_on)) {
                    $footer_menus[] = $menuItem;
                }
            }
        }
        return $footer_menus;

    }
    protected function getServices(){
        return Feature::orderBy('position','asc')->where('publish_status', 1)->take(5)->get();
    }
}
