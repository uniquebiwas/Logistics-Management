<?php

namespace App\Traits\Shared;

use App\Models\Pricing;
use App\Models\WeightPrice;
use Illuminate\Support\Facades\DB;

/**
 *
 */

trait AdminSharedTrait
{
    protected $frameworkType = [
        'laravel' => "Laravel",
        "PHP" => "PHP",
        "wordpress" => "Wordpress",
        "ci" => "CI",
    ];
    protected $website_available_content = [
        [
            'value' => "news",
            'title' => "News",
        ],
        [
            'value' => "blogs",
            'title' => "Blogs",
        ],
        [
            'value' => "slider",
            'title' => "Slider",
        ],
        [
            'value' => "information",
            'title' => "Information",
        ],
        [
            'value' => "features",
            'title' => "Features",
        ],
        [
            'value' => "faq",
            'title' => "Faqs",
        ],
        [
            'value' => "testimonial",
            'title' => "Testimonial",
        ],
        [
            'value' => "user",
            'title' => "User",
        ],
        [
            'value' => "reporter",
            'title' => "Reporter",
        ],
        [
            'value' => "advertisement",
            'title' => "Advertisement",
        ],
        [
            'value' => "environment",
            'title' => ".Env File",
        ],
        [
            'value' => "fetchtable",
            'title' => "Fetch Table",
        ],
        [
            'value' => "migrateOldDatabase",
            'title' => "Migrate Old DB",
        ],
        [
            'value' => "menu",
            'title' => "Menu",
        ],
        [
            'value' => "team",
            'title' => "Team",
        ],
        [
            'value' => 'video',
            'title' => 'Video',
        ],
        [
            'value' => 'subscriber',
            'title' => 'subscriber',
        ],
        [
            'value' => "mediaLibrary",
            'title' => "Media Library",
        ],

    ];

    protected function getPrice(int $serviceAgentId, $zone_id, float $weight, $agentId = null)
    {
        $price = DB::table('pricings')
            ->when($agentId, function ($query) use ($agentId) {
                $query->where('pricings.agent_id', $agentId);
            })
            ->select('weight_prices.price')
            ->where('serviceAgentId', $serviceAgentId)
            ->where('zone_id', $zone_id)
            ->where('weight_prices.weight', '>=', $weight)
            ->join('weight_prices', 'weight_prices.pricing_id', 'pricings.id')
            ->orderBy('pricings.effectiveDate', 'desc')
            ->orderBy('weight_prices.weight', 'asc')
            ->orderBy('weight_prices.id', 'desc')
            ->first();

        return optional($price)->price;
    }
    protected function websiteFormat()
    {
        return [
            'laravel' => "Laravel",
            "PHP" => "PHP",
            "wordpress" => "Wordpress",
            "ci" => "CI",
        ];
    }
    protected function resetAppsetting()
    {
        cache()->forget('sitesetting');
    }
}
