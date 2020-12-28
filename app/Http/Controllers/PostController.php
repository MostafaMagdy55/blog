<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use App\traits\images;
use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class PostController extends Controller
{
    use images;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index')->with('posts', Post::paginate(10))->with('user',User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();

        if( $categories->count()==0)
        {
            return redirect()->route('home')->with('info', 'You must have some categories before attempting to create a post.');
        }
        elseif($tags->count()==0){

            return redirect()->route('home')->with('info', 'You must have some tags before attempting to create a post.');
        }
        return view('admin.posts.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'featured' => 'required|image',
            'content' => 'required',
            'category_id' => 'required',
            'tags'=>'required'


        ]);
  $user=Auth::user();
      $photo=$this->saveimage($request->featured,'uploads/posts');
    //  $request['slug'] = strtolower(str_replace(' ', '-', $request->title));
     $post=Post::create([
        'user_id' => $user->id,
        'title' =>$request->title,
        'featured' => $photo,
        'content' => $request->content,
        'category_id' => $request->category_id,
        'slug'=>strtolower(str_replace(' ', '-', $request->title)),
      ]);

       $post->tags()->attach($request->tags);
       return redirect()->route('posts.index')->with('success', 'Post Created successfully.');
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
    public function edit(Post $post)
    {
        $tags=Tag::all();
        return view('admin.posts.edit',compact('post','tags'));
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

        $this->validate($request, [
            'title' => 'required',

            'content' => 'required',
            'category_id' => 'required',
        ]);

        $post=Post::find($id);
        if($request->hasFile('featured'))
        {
         $photo=$this->saveimage($request->featured,'uploads/posts');
         $post->featured= $photo;

        }

       $post->update([
       'title' =>$request->title,
       'content' => $request->content,
       'category_id' => $request->category_id,
       'slug'=>strtolower(str_replace(' ', '-', $request->title)),]);

       $post->tags()->sync($request->tags);
       return redirect()->route('posts.index')->with('success', 'Post Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();



        return redirect()->back();
    }


    public function trashed() {
        $posts = Post::onlyTrashed()->get();

        return view('admin.posts.trashed')->with('posts', $posts);
    }

    public function restore($id)
    {

        $post = Post::withTrashed()->where('id', $id)->first();

        $post->restore();


        return redirect()->route('posts.index')->with('success', 'Post restored successfully.');

    }


    public function kill($id)
    {


        $post = Post::withTrashed()->where('id', $id)->first();
        $photo=$post->featured;


        $post->forceDelete();





        return redirect()->route('posts.trashed')->with('success', 'Post deleted permanently.');

    }

}
