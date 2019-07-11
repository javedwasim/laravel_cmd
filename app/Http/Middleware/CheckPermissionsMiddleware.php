<?php

namespace App\Http\Middleware;

use App\Post;
use Closure;

class CheckPermissionsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //get current user
        $currentUser = $request->user();

        //get current action name
        $currentActionName = $request->route()->getActionName();
        list($controller,$method) = explode('@',$currentActionName);
        $controller = str_replace(["App\\Http\\Controllers\\Backend\\","Controller"],"",$controller);

        $classesMap = [
          'Blog' => 'post',
          'Category' => 'category',
          'User' => 'user',
        ];

        $crudPermissionMap = [
          'crud'=>['create','store','edit','update','destroy','restore','forceDestroy','index','view']
        ];

        foreach ($crudPermissionMap as $permissions=>$methods){
            //if the current method exists in method list
            //we'll check the permission

            if(in_array($method,$methods) && isset($classesMap[$controller])){
                $className = $classesMap[$controller];

                if(($className == 'post') && in_array($method,['edit','update','destroy','restore','forceDestroy'])){
                    //make sure user can only update/delete his own posts
                    if(($id = $request->route('id')) && (!$currentUser->can("update-other-post") || !$currentUser->can("delete-other-post"))){
                        $id = $request->route('id');
                        $post = Post::find($id);
                        if($post->author_id !== $currentUser->id){
                            abort(403,"Forbidden Access");
                        }
                    }
                }
                //if user has not the permission don't allow next request.
                elseif(!$currentUser->can("{$permissions}-{$className}")){
                    abort(403,"Forbidden Access");
                }
                break;
            }
        }

        return $next($request);
    }
}
