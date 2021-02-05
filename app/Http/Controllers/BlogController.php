<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\Category;
use Illuminate\Queue\Jobs\SyncJob;

class BlogController extends Controller
{
    public function __construct()
    {
        // $this->middleware('admin')->only('edit');
        // $this->middleware('subscriber')->only(['edit','delete','update']);
    }
    
    public function index(Request $request)
    {   
        $user = $request->user();
        $blogs = Blog::orderByDesc('created_at')->where('status','published')->get();
        return view('post.index',['blogs'=>$blogs,'user'=>$user]);
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

    public function show(Blog $blog,$id,Request $request)
    {   
        $user = $request->user();
        $blog = Blog::where('id',$id)->get();
        return view('post.show',['blog'=>$blog,'user'=>$user]);
    }


    public function edit(Blog $blog,$id)
    {   
        $categories = Category::all();
        $blog = Blog::findOrFail($id);
        $bc = array();
        foreach($blog->category as $cat){
            $bc[] = $cat;
        }
        $bck = array_keys($bc);
        $unused = Arr::except($categories,$bck);
        if($blog){
            return view('post.edit')->with(['blog'=>$blog,'used'=>$bc,"unused"=>$unused]);
        }
    }

    public function update(Request $request, Blog $blog,$id)
    {   
        $validator = $request->validateWithBag('blogs',[
            'title'=>['bail','required','max:100','unique:blogs,title'],
            'body'=>['required'],
        ]);
        if(!$validator){
            return  redirect("post/edit/".$id)->withErrors($validator,'blogs');
        }

        $blog=Blog::findOrFail($id);
        if($blog){
            Blog::where('id',$id)->update(['title'=>$request->input('title'),'body'=>$request->input('body')]);
            $blog->category()->sync($request->input('categories'));
            return redirect('/');
        }
    }

    public function delete(Blog $blog,$id)
    {
        if(Blog::findOrFail($id)){
            Blog::where("id",$id)->update(['status'=>'deleted_by_user']);
            return redirect('/');
        }
    }

    public function adminIndex(Request $request)
    {
        $user = $request->user();
        $blogs = Blog::orderByDesc('created_at')->get();
        return view('admin.index',['blogs'=>$blogs,'user'=>$user]);
    }

    public function adminPublish($id){
        if(Blog::findOrFail($id)){
            Blog::where('id',$id)->update(['status'=>'published']);
            return redirect('/');
        }
    }

    public function adminDelete($id){
        if(Blog::findOrFail($id)){
            Blog::where('id',$id)->update(['status'=>'removed_by_Admin']);
            return redirect('/');
        }
    }

    public function adminDraft($id){
        if(Blog::findOrFail($id)){
            Blog::where('id',$id)->update(['status'=>'draft']);
            return redirect('/');
        }
    }
}
