<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\AgentService;
use App\Models\Service;
// use App\Traits\Api\ServiceTrait;



class HomeController extends Controller
{
    // use ServiceTrait;
    public function __construct(Slider $slider, ServiceCategory $serviceCategory, Service $service){
        $this->slider = $slider;
        $this->serviceCategory = $serviceCategory;
        $this->service = $service;
    }
    public function homepage(Request $request){
        try {
            $sliders = $this->getSliders();
            $categories = $this->getCategories();
            $services = $this->getServices($request);
            $data = [
                'sliders' => $sliders,
                'categories' => $categories,
                'services' => $services
            ];
            return response()->json([
                'status' => true,
                'status_code' => 200,
                "data" => $data,
                'message' => 'Homepage Data fetched successfully',
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'status' => false,
                'status_code' => 501,
                'message' => [$error->getMessage()],
            ], 501);
        }
    }
    public function getSliders()
    {

            $sliders = $this->slider->select('id','title','image','external_url')
            ->where('publish_status','1')
            ->limit(5)
            ->orderBy('id','DESC')
            ->get();

            if($sliders->count()){
                foreach($sliders as $slider){
                    $slider->title = $slider->title['en'] ?? $slider->title['np'];
                    $slider->image = create_image_url($slider->image,'sameimage');
                }
                if($slider->image && !empty($slider->image) && file_exists(public_path('uploads/sliders/'.@$slider->image))){

                }
                else{
                    unset($slider);
                }
            }
            return $sliders;

    }
    public function getCategories(){
        $categories = $this->serviceCategory->select(
            'id',
            'title',
            'description',
            'image',
            'parentId'
        )
        ->where('parentId',null)
        ->with(['sub_category' => function ($qr) {
            return $qr->select('id', 'title','description','image','parentId');
        }])
        ->where('publishStatus',true)
        ->orderBy('id','DESC')
        ->get();
        // dd($categories);
        if ($categories->count()) {
            foreach ($categories as $category) {
                $category->title = $category->title['en'] ?? $category->title['np'];
                $category->description = html_entity_decode($category->description['en']) ?? html_entity_decode($category->title['np']);
                $category->image = (isset($category->image)) ? create_image_url($category->image, 'sameimage') : null;

                if(!empty($category->sub_category) && $category->sub_category->count()){
                    foreach($category->sub_category as $subcategory){
                    $subcategory->title = $subcategory->title['en'] ?? $subcategory->title['np'];
                    $subcategory->description = html_entity_decode($subcategory->description['en']) ?? html_entity_decode($subcategory->description['np']);
                    $subcategory->image = (isset($subcategory->image)) ? create_image_url($subcategory->image, 'sameimage') : null;

                    }
                }
            }
        }
        return $categories;
    }
    protected function getServices($request)
    {
        $limit = 10;
        if($request->liimit && $request->limit > 0 && $request->limit < 20){
            $limit = $request->limit;
        }
        $services = $this->service->select('id','title','image','description','price','originalPrice')->orderBy('id','DESC')
        ->where('publishStatus',true)
        ->limit($limit)->get();
        if($services->count()){
            foreach ($services as $key => $service) {
                $service->title = $service->title['en'] ?? $service->title['np'];
                $service->image = (isset($service->image)) ? create_image_url($service->image, 'feature') : null;
                $service->description = html_entity_decode($service->description['en']) ?? html_entity_decode($service->title['np']);
                $service->price = $service->price ?? '0';
            }
        }
        return $services;
    }

}
