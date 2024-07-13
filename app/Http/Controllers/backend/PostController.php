<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.post.index')->with('posts', Post::paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();

        $request->validate([
            'title' => 'required|max:100',
            'sub_title' => 'required|max:80',
            'description' => 'required|max:800'
        ]);

        Post::create(['title' => $request->title, 'sub_title' => $request->sub_title, 'description' => $request->description, 'slug' => Str::slug($request->title)]);
        Session::flash('success', 'Saved Successfully');
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('backend.post.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:100',
            'sub_title' => 'required|max:80',
            'description' => 'required|max:800'
        ]);

        $post->title = $request->title;
        $post->sub_title = $request->sub_title;
        $post->description = $request->description;
        $post->slug = Str::slug($request->title);
        $post->save();
        Session::flash('success', 'Updated Successfully');
        return redirect()->route('post.index');
    }


    //To delete a post permanently from website Only not from database
    public function destroy(Post $post)
    {
        $post->delete();
        Session::flash('success', 'Deleted Successfully');
        return;
    }


    // All Trashed Posts that are delete from website but still exist in the database
    public function trash()
    {
        return view('backend.post.trash')
            ->with('posts', Post::onlyTrashed()->paginate(15));
    }


    //To delete a post permanently from website and database
    public function delete($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        if ($post) {
            $post->forceDelete();
            Session::flash('success', 'permanently deleted');
            return redirect()->route('post.index');
        } else {
            return redirect()->route('post.force-delete');
        }
    }



    //To restore the deleted posts back to the site and database
    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();
        Session::flash('success', 'Post Restored Successfully.');
        return redirect()->route('post.index');
    }
}
