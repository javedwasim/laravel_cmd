<?php
namespace App\Views\Composers;
use Illuminate\View\View;
use App\Category;
use App\Post;

class NavigationComposer{

    public function compose(View $view){
        $this->composeCategories($view);
        $this->composePopularPosts($view);
    }

    public function composeCategories(View $view){
        $categories = Category::with(['posts'=>function($query){
            $query->published();
        }])->orderBy('title', 'asc')->get();
        $view->with('categories',$categories);
    }

    public function composePopularPosts(View $view){
        $popularPosts = Post::published()->popular()->take(3)->get();
        $view->with('popularPosts',$popularPosts);
    }

}