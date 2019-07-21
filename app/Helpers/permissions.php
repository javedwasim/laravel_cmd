<?php

function check_user_permissions($request,$actionName = NULL, $id = NULL){
    //get current user
    $currentUser = $request->user();
    //get current action name
    if($actionName){
        $currentActionName = $actionName;
    }else{
        $currentActionName = $request->route()->getActionName();
    }

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
            $id = !is_null($id) ? $id:$request->route('id');
            if(($className == 'post') && in_array($method,['edit','update','destroy','restore','forceDestroy'])){
                //make sure user can only update/delete his own posts
                if($id && (!$currentUser->can("update-other-post") || !$currentUser->can("delete-other-post"))){
                    $post = \App\Post::withTrashed()->find($id);
                    if($post->author_id !== $currentUser->id){
                        return false;
                    }
                }
            }
            //if user has not the permission don't allow next request.
            elseif(!$currentUser->can("{$permissions}-{$className}")){
                return false;
            }
            break;
        }
    }

    return true;
}