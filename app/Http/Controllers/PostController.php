<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function __construct(Post $post, Category $category, User $user)
    {
        $this->middleware('auth');
        $this->post = $post;
        $this->user = $user;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $user  = auth()->user();

        if($user->role === 'admin' || $user->role === 'editor')
        {
            $activePosts = $this->post->getByActive(null,$search,5);

            $inactivePosts = $this->post->getByActive(1,$search,5);
        }
        else
        {
            $activePosts = $this->post->getPostByUser(null,$search,5,$user->id);

            $inactivePosts = $this->post->getPostByUser(1,$search,5,$user->id);
        }
        return view('posts.index', compact(['inactivePosts', 'activePosts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->getActiveCategory(null)->get();
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
        //  the post is validate detail

        $this->validator($request);

        $posts = new Post([
            'title' => $request->title,
            'content' => $request->content,
            'publish' => $request->publish,
            'category_id' => $request->category_id
        ]);
        $posts->user_id = auth()->user()->id;
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
//        $user = auth()->user();
//          if($user->role === 'admin')
//          {
//              $post = Post::all();
//          }
//          elseif(($user->role ==='editor')|| ($user->role === 'author'))
//          {
//              $post = Post::where('user_id','=',$user->id)->get();
//          }
//        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrfail($id);
        $categories = $this->category->getActiveCategory(null)->get();
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
        $this->validator($request);
        $post = Post::find($id);
        try{
            if($post ==null)
            {
                throw new Exception('Không có bài viết nào có id này');
            }
        }catch(Exception $e){
            abort(403,$e->getMessage());
        }
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
        $this->authorize($post,'delete-post');
        $post->delete();
        return redirect('/post')->with('success', 'Bài viết được xóa thành công!');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function inactive($id)
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
    public function validator($data)
    {
         return $data->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required',
            'publish' => 'required',
            'category_id' => 'required'
        ]);
    }

}
