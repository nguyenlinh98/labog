<?php

namespace App\Http\Controllers;

//use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        return view('categories.index',compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('categories.create', compact('create'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        dd($request);
        $data = $request->validate([
            'name' => 'required|min:3',
            'status' => 'required'
        ]);
        $categories = new Category();
        $categories->name = $request->get('name');
        $categories->status = $request->get('status');
        $categories->save();
        return redirect('/categories')->with('success','Thêm mới bản ghi thành công!');
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
        $category = Category::find($id);
        return view('categories.edit',compact('category'));
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
        $category = Category::find($id);
        $category->name = $request->get('name');
        $category->status = $request->get('status');
        $category->save();
         return redirect('/categories')->with('success','Đã có bản ghi thay đổi!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('/categories')->with('success','Xóa bản ghi thành công');

    }

    public function delete($id)
    {
        $category = Category::find($id);
        if($category->delete_flag == null)
        {
            $category->delete_flag =1;
        }
        else{
            $category->delete_flag =null;
        }
        $category->save();
        return redirect('/categories')->with('success','Danh mục '.$category->name.' đã chuyển đổi thành công!');
    }

}
