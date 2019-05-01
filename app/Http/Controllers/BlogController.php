<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $limit = 3;
    public function index(){
        $posts = Post::with('author')->LatestFirst()->simplePaginate($this->limit);
        return view('blog.index',compact('posts'));
    }
}
