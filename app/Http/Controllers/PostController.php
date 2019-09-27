<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function __construct(Post $post,Category $category)
    {
        $this->middleware('auth');
        $this->post = $post;
        $this->category = $category;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activePosts = $this->post->getByActive(null, 5);

        $inactivePosts = $this->post->getByActive(1, 5);

        return view('posts.index', compact(['inactivePosts', 'activePosts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->getActiveCategory();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  the post is validate data
        $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required',
            'publish' => 'required',
            'category_id' => 'required'
        ]);
//        dd($request->get('category_id'));
        $posts = new Post([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
//            'status' => '1',
            'publish' => $request->get('publish'),
            'category_id' => $request->get('category_id')
//                'delete_flag' => null
        ]);
        $posts->save();
        return redirect('/post')->with('success', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = $this->category->getActiveCategory();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->status = $request->get('status');
        $post->publish = $request->get('publish');
        $post->category_id = $request->get('category_id');
        $post->save();
        return redirect('/post')->with('success', 'Sửa bài viết thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/post')->with('success', 'Bài viết được xóa thành công!');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function delete(Request $request, $id)
    {

        $post = Post::find($id);
        if ($post->active == null) {
            $post->active = 1;
        } else {
            $post->active = null;
        }
        $post->save();
//        dd($post);
        return redirect('/post');
    }

    /**
     * method get list category
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */

}
