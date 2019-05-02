<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;

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

    public function category(Category $category)
    {
        $categoryName = $category->title;

        $posts = $category->posts()
                          ->with('author')
                          ->LatestFirst()
                          ->published()
                          ->simplePaginate($this->limit);
        return view('blog.index', compact('posts', 'categoryName'));
    }

    public function show(Post $post){
        $post->increment('view_count');
        return view('blog.show',compact('post'));
    }

    public function author(User $author){
        $authorName = $author->name;

        $posts = $author->posts()
                    ->with('category')
                    ->LatestFirst()
                    ->published()
                    ->simplePaginate($this->limit);
        return view('blog.index', compact('posts', 'authorName'));
    }
}
