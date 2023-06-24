<?php

namespace Database\Seeders;

use App\Models\AdvertisementPosition;
use Illuminate\Database\Seeder;

class AdvertisementPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                "id" => 1,
                "title" => "All page skip advertisement",
                "key" => "SKIP",
                "section" => null,
                "page" => "all",
                "quantity" => 1,
                "publish_status" => "1"
            ],
            [
                "id" => 2,
                "title" => "Startup, popup, Roadblock Advertisement",
                "key" => "ROAD_BLOCK",
                "section" => 2,
                "page" => "homepage",
                "quantity" => 1,
                "publish_status" => "1"
            ],
            [
                "id" => 3,
                "title" => "Header Advertisement",
                "key" => "ALL_HEADER",
                "section" => null,
                "page" => "all",
                "quantity" => 1,
                "publish_status" => "1",

            ],
            [
                "id" => 4,
                "title" => "All page menu section",
                "key" => "AFTER_ALL_HEADER",
                "section" => null,
                "page" => "all",
                "quantity" => 2,
                "publish_status" => "1",
            ],
            [
                "id" => 5,
                "title" => "Homepage Header",
                "key" => "HOMEPAGE_HEADER",
                "section" => 2,
                "page" => "homepage",
                "quantity" => 1,
                "publish_status" => "1",
            ],
            [
                "id" => 6,
                "title" => "News Detail page Header",
                "key" => "CONTENT_HEADER",
                "section" => null,
                "page" => "news_detail",
                "quantity" => 1,
                "publish_status" => "1",
            ],
            [
                "id" => 7,
                "title" => "News detail page menu",
                "key" => "NEWS_MENU",
                "section" => null,
                "page" => "news_detail",
                "quantity" => 2,
                "publish_status" => "1",
            ],
            [
                "id" => 8,
                "title" => "Category page Header",
                "key" => "CATEGORY_HEADER",
                "section" => null,
                "page" => "category",
                "quantity" => 1,
                "publish_status" => "1",
            ],
            [
                "id" => 9,
                "title" => "Category page menu section",
                "key" => "CATEGORY_MENU",
                "section" => null,
                "page" => "category",
                "quantity" => 2,
                "publish_status" => "1",
            ],
            [
                "id" => 10,
                "title" => "Homepage menu section",
                "key" => "AFTER_HOMEPAGE_HEADER",
                "section" => 2,
                "page" => "homepage",
                "quantity" => 2,
                "publish_status" => "1",
            ],
            [
                "id" => 11,
                "title" => "Category Page Startup, Popup  Advertisement",
                "key" => "CATEGORY_BLOCK",
                "section" => null,
                "page" => "category",
                "quantity" => 1,
                "publish_status" => "1",
            ],
            [
                "id" => 12,
                "title" => "News detail page startup , popup advertisement",
                "key" => "CONTENT_BLOCK",
                "section" => null,
                "page" => "news_detail",
                "quantity" => 1,
                "publish_status" => "1",
            ],
            [
                "id" => 13,
                "title" => "News detail page after content",
                "key" => "AFTER_NEWS_DETAIL",
                "section" => null,
                "page" => "news_detail",
                "quantity" => 3,
                "publish_status" => "1",
            ],
            [
                "id" => 14,
                "title" => "Sampadakiya section",
                "key" => "sampadakiya",
                "section" => 2,
                "page" => "homepage",
                "quantity" => 2,
                "publish_status" => "1",
            ],
            [
                "id" => 15,
                "title" => "Mukhya Samachar Section",
                "key" => "Mukhya-samachar",
                "section" => 3,
                "page" => "homepage",
                "quantity" => 2,
                "publish_status" => "1",
            ],
            [
                "id" => 16,
                "title" => "inside news",
                "key" => "INSIDE_CONTENT",
                "section" => null,
                "page" => "news_detail",
                "quantity" => 3,
                "publish_status" => "1",
            ],


        ];
        foreach ($data as $position_item) {
            $position = new AdvertisementPosition();
            if ($position->where('id', $position_item['id'])->count() > 0) {
                $position = $position->where('id', $position_item['id'])->first();
            }
            $position->fill($position_item)->save();
        }
    }
}
