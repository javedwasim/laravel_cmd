<?php

namespace App\Http\Controllers\Backend;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Intervention\Image\Facades\Image;


class BlogController extends Controller
{
    protected $limit = 10;
    protected $uploadPath;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->uploadPath = base_path()."/assets/".config('cms.image.directory').'/';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(($status = $request->get('status')) && ($status=='trash')){
            $posts = Post::onlyTrashed()->latest()->with('category','author')->paginate($this->limit);
            $postCount = Post::onlyTrashed()->count();
            $onlyTrashed = true;
        }else{
            $posts = Post::latest()->with('category','author')->paginate($this->limit);
            $postCount = Post::count();
            $onlyTrashed=false;
        }

        return view('admin.blog.index',compact('posts','postCount','onlyTrashed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('admin.blog.create',compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $this->handleRequest($request);
        $request->user()->posts()->create($data);

        return redirect('admin/posts')->with('message','Your post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.blog.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function  update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $data = $this->handleRequest($request);
        $post->update($data);

        return redirect('admin/posts')->with('message','Your post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect('admin/posts')->with('trash-message',['Your post move to trash',$id]);
    }

    public function handleRequest($request){
       $data = $request->all();

       if($request->hasFile('image')){

           $image = $request->file('image');
           $fileName = $image->getClientOriginalName();
           $destination = $this->uploadPath;

           $successUploaded = $image->move($destination,$fileName);
           if($successUploaded){
               $extension = $image->getClientOriginalExtension();
               $thumbnail = str_replace(".{$extension}","_thumb.{$extension}",$fileName);
               $width = config('cms.image.thumbnail.width');
               $height = config('cms.image.thumbnail.height');

               Image::make($destination.'/'.$fileName)
                   ->resize($width,$height)
                   ->save($destination.'/'.$thumbnail);
           }
           $data['image'] = $fileName;
       }

       return $data;


    }

    public function restore($id){
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect('admin/posts')->with('trash-message',['Your post has been moved from trash',false]);
    }

    public function forceDestroy($id){
        POST::withTrashed()->findOrFail($id)->forceDelete();
        return redirect('admin/posts?status=trash')->with('trash-message',['Your post has been deleted successfully',false]);
    }

}
