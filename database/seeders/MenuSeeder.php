<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            [
                "id" => 1,
                "title" =>  [
                    'en' => 'Home',
                    'np' => 'होमपेज',
                ],
                "slug" => "/",
                "position" => 1,
                "side_position" => 1,
                "show_on" => ['sidebar', 'header', 'homepage'],
                "publish_status" => '1',
                "content_type" => "homepage",
                "parent_id" => null,
            ],

            // DONT DELETE (FOR FAQ PAGE AND DESCRIPTION)
            [
                "id" => 2,
                "title" =>  [
                    'en' => 'About',
                    'np' => 'हाम्रोबारे',
                ],
                "slug" => "about",
                "position" => 2,
                "short_description" => 'Change it from Menu Management',
                "description" =>
                [
                    'en' => 'Change it from Menu Management  Lorem ipsum dolor sit, amet consectetur adipisicing elit. In id accusantium laborum minima, quibusdam, molestias provident accusamus neque temporibus, officia repudiandae adipisci quos aliquam deleniti esse hic fugit consequatur commodi?',
                    'np' => '',
                ],
                "featured_img_url" => 'https://www.nectardigit.com/uploads/slider/22b163690b2a416f73e5b1f66a8987c7sldier1.jpg',
                "side_position" => 2,
                "show_on" => ['sidebar', 'header'],
                "publish_status" => '1',
                "content_type" => "about",
                "parent_id" => null,
            ],
            [
                "id" => 3,
                "title" =>  [
                    'en' => 'Team',
                    'np' => 'हाम्रो समूह',
                ],
                "slug" => "team",
                "position" => 3,
                "short_description" => ' Blog Title Change it from Menu Management',
                "description" =>
                [
                    'en' => 'Change it from Menu Management  Lorem ipsum dolor sit, amet consectetur adipisicing elit. In id accusantium laborum minima, quibusdam, molestias provident accusamus neque temporibus, officia repudiandae adipisci quos aliquam deleniti esse hic fugit consequatur commodi?',
                    'np' => '',
                ],
                "featured_img_url" => 'https://www.nectardigit.com/uploads/slider/22b163690b2a416f73e5b1f66a8987c7sldier1.jpg',
                "side_position" => 3,
                "show_on" => ['header', 'footer','useful_links'],
                "publish_status" => '1',
                "content_type" => "team",
                "parent_id" => null,
            ],
            [
                "id" => 4,
                "title" =>  [
                    'en' => 'Contact',
                    'np' => 'सम्पर्क',
                ],
                "slug" => "contact",
                "position" => 4,
                "short_description" => ' Contact Title Change it from Menu Management',
                "description" =>
                [
                    'en' => 'Change it from Menu Management  Lorem ipsum dolor sit, amet consectetur adipisicing elit. In id accusantium laborum minima, quibusdam, molestias provident accusamus neque temporibus, officia repudiandae adipisci quos aliquam deleniti esse hic fugit consequatur commodi?',
                    'np' => '',
                ],
                 "featured_img_url" => 'https://www.nectardigit.com/uploads/slider/22b163690b2a416f73e5b1f66a8987c7sldier1.jpg',
                "parallex_img_url" => 'https://www.nectardigit.com/uploads/slider/22b163690b2a416f73e5b1f66a8987c7sldier1.jpg',
                "external_url" => null,
                "side_position" => 4,
                "show_on" =>['sidebar', 'header'],
                "publish_status" => '1',
                "content_type" => "contact",
                "parent_id" => null,
            ],
            [
                "id" => 5,
                "title" =>  [
                    'en' => 'Services',
                    'np' => 'सेवाहरू',
                ],
                "slug" => "service",
                "position" => 5,
                "short_description" => 'Change it from Menu Management (Admin Panel)',
                "description" =>
                [
                    'en' => 'Change it from Menu Management  Lorem ipsum dolor sit, amet consectetur adipisicing elit. In id accusantium laborum minima, quibusdam, molestias provident accusamus neque temporibus, officia repudiandae adipisci quos aliquam deleniti esse hic fugit consequatur commodi?',
                    'np' => '',
                ],
                "side_position" => 5,
                "show_on" =>['sidebar', 'header','useful_links'],
                "publish_status" => '1',
                "content_type" => "service",
                "parent_id" => null,
            ],






        ];

        foreach ($menus as $menuItem) {
            $menu = new Menu();
            if ($menu->where('id', $menuItem['id'])->count() > 0) {
                $menu = $menu->where('id', $menuItem['id'])->first();
            }
            $menu->fill($menuItem);
            $menu->save();
        }
    }
}
