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
    public function index()
    {
        $posts = Post::latest()->with('category','author')->paginate($this->limit);
        $postCount = Post::count();
        return view('admin.blog.index',compact('posts','postCount'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
}
