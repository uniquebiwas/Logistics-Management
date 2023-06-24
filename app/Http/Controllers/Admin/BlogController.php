<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Tag;
use App\Models\Blog;
use App\Http\Controllers\Controller;
use App\Models\BlogTag;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class BlogController extends Controller
{
    public function __construct(Blog $blog)
    {
        $this->middleware(['permission:blog-list|blog-create|blog-edit|blog-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:blog-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:blog-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:blog-delete'], ['only' => ['destroy']]);
        $this->blog = $blog;
    }

    protected function getQuery($request)
    {
        $userRole = request()->user()->roles->first()->name;
        $query = $this->blog->orderBy('id', 'DESC');
        if ($request->status) {
            $query = $query->where('publish_status', $request->status);
        }
        $query = $query->where(function ($qr) use ($userRole) {
            if ($userRole != 'Super Admin' && $userRole != 'Admin') {
                return $qr->where('created_by', auth()->user()->id);
            }
        });
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title', 'LIKE', '%' . $keyword . '%');
        }
        return $query->paginate(20);
    }
    public function index(Request $request)
    {
        $data = $this->getQuery($request);
        return view('admin/blogs/blog-list', compact('data'));
    }
    protected function getTags()
    {
        return Tag::select('id', 'title->np as np_title', 'title->en as en_title')
            ->pluck(app()->getLocale() . '_title', 'id');
    }
    public function create(Request $request)
    {
        $blog_info = null;
        $title = 'Add Blog';
        // $tags = $this->getTags();
        return view('admin/blogs/blog-form', compact('blog_info', 'title'));
    }
    protected function blogValidate($newsInfo = null)
    {
        if ($this->_website == 'Both') {
            $data = [
                "np_title" => "required|string|max:200",
                "en_title" => "required|string|max:200",
                "np_description" => "required|string",
                "en_description" => "required|string",
            ];
        } else if ($this->_website == 'Nepali') {
            $data = [
                "np_title" => "required|string|max:200",
                "np_description" => "required|string",
            ];
        } else if ($this->_website == 'English') {
            $data = [
                "en_title" => "required|string|max:200",
                "en_description" => "nullable|string",
            ];
        }
        $data['publish_status'] = "required|in:0,1";
        $data['meta_title'] = "nullable|string|max:300";
        $data['meta_keyword'] = "nullable|string|max:300";
        $data['meta_keyphrase'] = "nullable|string|max:300";
        return $data;
    }
    protected function mapBlogData($request, $newsInfo = null)
    {
        $data = [
            "title" => [
                "np" => $request->np_title ?? $request->en_title,
                "en" => $request->en_title ?? $request->np_title,
            ],
            "description" => [
                'np' => htmlentities($request->np_description) ?? htmlentities($request->en_description),
                'en' => htmlentities($request->en_description) ?? htmlentities($request->np_description),
            ],
            "summary" => [
                'en' => htmlentities($request->en_summary) ?? htmlentities($request->np_summary),
                'np' => htmlentities($request->np_summary) ?? htmlentities($request->en_summary),
            ],

            "publish_status" => $request->publish_status ?? '0',
            "meta_title" => htmlentities($request->meta_title) ?? null,
            "meta_description" => htmlentities($request->meta_description) ?? null,
            "meta_keyword" => htmlentities($request->meta_keyword) ?? null,
            "external_url" => htmlentities($request->external_url) ?? null,
            "meta_keyphrase" => htmlentities($request->meta_keyphrase) ?? null,
            "slug" => $this->getSlug($request->en_title ?? $request->np_title),
            'postType' => $request->postType,
            // 'tags' => $request->tags,
        ];
        if($request->featured_img){
            $data['featured_img'] = $request->featured_img;
        }
        if($request->parallex_img){
            $data['parallex_img'] = $request->parallex_img;
        }
        return $data;
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, $this->blogValidate());
        try {
            DB::beginTransaction();
            $data = $this->mapBlogData($request);
            $data['created_by'] = auth()->user()->id;
            $blog = Blog::create($data);
            // $blog->tags()->sync($request->tag);
            $request->session()->flash('success', 'Blog created successfully.');
            DB::commit();
            return redirect()->route('blog.index');
        } catch (\Exception $error) {
            DB::rollBack();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->to(url()->previous());
        }
    }

    public function edit(Request $request, $id)
    {
        $blog_info = $this->blog->find($id);
        if (!$blog_info) {
            abort(404);
        }
        $title = 'Update Blog';
        // $tags = $this->getTags();
        $blogtags = BlogTag::where('blog_id', $id)->get();
        // dd($blogtags);
        // if($blogtags){
        //     $selectedtags = $blogtags->pluck('tag_id');
        // }
        // else{
        //     $selectedtags = [];
        // }
        // dd($selectedtags);
        return view('admin/blogs/blog-form', compact('blog_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $blog_info = $this->blog->find($id);
        if (!$blog_info) {
            abort(404);
        }
        $this->validate($request, $this->blogValidate());

        try {
            $data = $this->mapBlogData($request);
            $blog_info->fill($data)->save();
            // $blog_info->tags()->sync($request->tag);
            $request->session()->flash('success', 'Blog updated successfully.');
            return redirect()->route('blog.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $blog_info = $this->blog->find($id);
        if (!$blog_info) {
            abort(404);
        }
        try {
            $blog_info->delete();
            $data['updated_by'] = Auth::user()->id;
            $request->session()->flash('success', 'Blog deleted successfully.');
            return redirect()->route('blog.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }
    protected function getSlug($title)
    {
        $slug = Str::slug($title);
        $find = $this->blog->where('slug', $slug)->first();
        if ($find) {
            $slug = $slug . '-' . rand(1111, 9999);
        }
        return $slug;
    }
}
