<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Queue\Jobs\SyncJob;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only('create');
    }
    public function index()
    {   
        $blogs = Blog::where('status','draft')->orderByDesc('created_at')->get();
        return view('post.index',['blogs'=>$blogs]);
    }

    public function create()
    {   
        $categories = Category::all();
        return view('post.create',['categories'=>$categories]);
    }

    
    public function store(Request $request)
    {
        $validator = $request->validateWithBag('blogs',[
            'title'=>['bail','required','max:100','unique:blogs,title'],
            'body'=>['required','string',''],
        ]);
        
        if(!$validator){
            return  redirect('post/create')->withErrors($validator,'blogs');
        }
        
        $request['slug'] = str::slug($request->title);
        $request['feature_img'] = 'nul';
        $request['post_img'] = 'nul';
        $blogByUserWithCategory = $request->user()->blog()->create($request->input());
        if($blogByUserWithCategory){
            if($request->input('categories')){
                $blogByUserWithCategory->category()->sync($request->input('categories'));
            }
            return redirect('/');
        }
    }

    public function show(Blog $blog,$id)
    {   
        $blog = Blog::where('id',$id)->get();
        return view('post.show',['blog'=>$blog]);
    }


    public function edit(Blog $blog,$id)
    {   
        $blog = Blog::findOrFail($id);

        if($blog){
            return view('post.edit')->with('blog',$blog);
        }
    }

    public function update(Request $request, Blog $blog,$id)
    {   
        $request->validateWithBag('blogedit',[
            'title'=>'min:50',
            'body'=>'required',
        ]);

        if(Blog::findOrFail($id)){
            Blog::where('id',$id)->update(['title'=>$request->input('title'),'body'=>$request->input('body')]);
        }
    }

    public function delete(Blog $blog,$id)
    {
        if(Blog::findOrFail($id)){
            Blog::where("id",$id)->update(['status'=>'deleted_by_user']);
            return redirect('/');
        }
    }
}
