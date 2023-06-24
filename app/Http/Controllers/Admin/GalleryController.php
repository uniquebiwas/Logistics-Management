<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function __construct(Gallery $gallery, GalleryImage $image)
    {
        $this->middleware(['permission:gallery-list|gallery-create|gallery-edit|gallery-delete'], ['only' => ['index','store']]);
        $this->middleware(['permission:gallery-create'], ['only' => ['create','store']]);
        $this->middleware(['permission:gallery-edit'], ['only' => ['edit','update']]);
        $this->middleware(['permission:gallery-delete'], ['only' => ['destroy']]);
        $this->gallery = $gallery;
        $this->image = $image;
    }

    protected function getInfo($request)
    {
        $query = $this->gallery->orderBy('id','DESC');
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title',$keyword);
        }
        return $query->paginate(20);
    }
    public function index(Request $request)
    {
        $data = $this->getInfo($request);
        // dd($data);
        return view('admin/gallery/list', compact('data'));
    }

    public function create(Request $request)
    {
        $gallery_info = null;
        $title = 'Add New Gallery';
        return view('admin/gallery/form', compact('gallery_info', 'title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|min:3|max:190',
            'publish_status' => 'required|numeric|in:1,0'
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'publish_status' => $request->publish_status,
            'created_by' => Auth::user()->id,
        ];
        if ( $request->featured_img && !empty( $request->featured_img ) ) {
            $data['featured_img'] = $request->featured_img;
        }

        try {
            $this->gallery->fill($data)->save();
            if ( $request->gallery && !empty( $request->gallery ) ) {
                $images = explode( ',', $request->gallery );
                foreach ( $images as $image ) {
                    $data = [
                        'galleryId' => $this->gallery->id,
                        'image' => $image,
                    ];
                    GalleryImage::create( $data );
                }
            }
            $request->session()->flash('success', 'Gallery created successfully.');
            return redirect()->route('gallery.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        $gallery_info = $this->gallery->find($id);
        if (!$gallery_info) {
            abort(404);
        }
        $title = 'Update Gallery';
        return view('admin/gallery/form', compact('gallery_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $gallery_info = $this->gallery->find($id);
        if (!$gallery_info) {
            abort(404);
        }
        $this->validate($request, [
            'title' => 'required|string|min:3|max:190',
            'publish_status' => 'required|numeric|in:1,0'
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'publish_status' => $request->publish_status,
            'created_by' => Auth::user()->id,
        ];
        if ( $request->featured_img && !empty( $request->featured_img ) ) {
            $data['featured_img'] = $request->featured_img;
        }
        

        try {
            $gallery_info->fill($data)->save();
            if ( $request->gallery && !empty( $request->gallery ) ) {
                $images = explode( ',', $request->gallery );
                foreach ( $images as $image ) {
                    $data = [
                        'galleryId' => $gallery_info->id,
                        'image' => $image,
                    ];
                    GalleryImage::create( $data );
                }
            }
            $request->session()->flash('success', 'Gallery updated successfully.');
            return redirect()->route('gallery.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $gallery_info = $this->gallery->find($id);
        if (!$gallery_info) {
            abort(404);
        }
        try {
            $gallery_info->delete();
            $data['updated_by'] = Auth::user()->id;
            $request->session()->flash('success', 'Gallery deleted successfully.');
            return redirect()->route('gallery.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }
    public function removeGalleryImage( Request $request, $id )
    {
           $gallery = $this->image->find( $id );
           if ( !$gallery ) {
               abort( 404 );
           }
           try {
               $gallery->delete();
               $request->session()->flash( 'success', ' Gallery Image  deleted successfully.' );
               return redirect()->back();
           } catch ( \Exception $error ) {
               $request->session()->flash( 'error', $error->getMessage() );
               return redirect()->back();
           }
       }
}
