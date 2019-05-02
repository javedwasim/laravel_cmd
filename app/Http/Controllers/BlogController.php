<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $limit = 3;
    public function index(){
        //\DB::enableQueryLog();
        $posts = Post::with('author')
                    ->LatestFirst()
                    ->published()
                    ->simplePaginate($this->limit);
         //view('blog.index',compact('posts'))->render();
         return view('blog.index',compact('posts'));
        //dd(\DB::getQueryLog());
    }

    public function show($id){
        $post = Post::findOrFail($id);
        return view('blog.show',compact('post'));
    }
}
