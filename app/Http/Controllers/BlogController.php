<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $limit = 3;

    public function index(){

        $categories = Category::with(['posts'=>function($query){
                        $query->published();
                      }])->orderBy('title','asc')->get();
        //\DB::enableQueryLog();
        $posts = Post::with('author')
                    ->LatestFirst()
                    ->published()
                    ->simplePaginate($this->limit);
         //view('blog.index',compact('posts'))->render();
         return view('blog.index',compact('posts','categories'));
        //dd(\DB::getQueryLog());
    }

    public function category($id)
    {
        $categories = Category::with(['posts'=>function($query){
                        $query->published();
                      }])->orderBy('title', 'asc')->get();

        $posts = Post::with('author')
                    ->LatestFirst()
                    ->published()
                    ->where('category_id',$id)
                    ->simplePaginate($this->limit);
        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(Post $post){
        return view('blog.show',compact('post'));
    }
}
