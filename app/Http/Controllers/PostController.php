<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::query()->orderByDesc('id')->paginate(15);
        return view('posts.index', ['posts'=> $posts]);
        $posts->nextPageUrl();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create',compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {      
    //       $request ->validate([
    //     'name'=>'required|unique:posts',
    //     'email'=>'required',
    // ]);
    
    return 
        $post = Post::query()->create($request->only('name','email','birth_date'));
        // $post->categories()->sync($request->input('categories'));
        // return redirect()->route('posts.index');
        if ($file = $request->file('image')){
            $filename =date('YmdHis'). $file->getClientOriginalName();
            $file->move(public_path('image'),$filename);
            $post->update(['image'=>'/image'.'/'.$filename]);
        }
        return redirect()->route('posts.index');
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
      $categories = Category::all();
        $post = Post::query()->findOrFail($id);
        // dd($post->categories);
        return view('posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id ,Post $post)
    {   
         $this->validate($request,[
        'name'=>'required',
        'email'=>'unique:pots,email,'.$post->id,
    ]);
        // dd($request->input('categories'));
        $post = Post::query()->findOrFail($id);
        $post ->update($request->only('name','email'));
        $post->categories()->sync($request->input('categories'));
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
    }
    
}
