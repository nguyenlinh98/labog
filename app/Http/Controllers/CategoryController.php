<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->middleware('auth');
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
        $activeCategories = $this->category->getCategory(null,$search,5);
        $inactiveCategories = $this->category->getCategory('1',$search,5);
        return view('categories.index',compact('activeCategories','inactiveCategories'));
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

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required'
        ]);
        $categories = new Category();
        if ($request->has(['name', 'email'])) {

            $categories->name = $request->get('name');
            $categories->status = $request->get('status');
        }
        $categories->user_id = auth()->user()->id;
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
        $category = Category::findOrFail($id);
        $this->authorize('create',Category::class);
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
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $data = $request->only(['name']);
        $category = Category::find($id);
        try{
            if($category == null){
                throw new \Exception('Không tồn tại thể loại này');
            }
        }
        catch(    \Exception $e){
            abort(404,$e->getMessage());
        }
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();
         return redirect('/categories')->with('success','Đã có bản ghi thay đổi!');

    }

    /**
     *  Remove the specified resource from muti record storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        $id = $request->get('option');
        $category = $this->category->whereIn('id',$id)->delete();
        return redirect('/categories')->with('success','Xóa bản ghi thành công');

    }

    /**
     *  Change active record of record
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function inactive($id)
    {
        $category = Category::find($id);
        if($category->active == null)
        {
            $category->active =1;
        }
        else{
            $category->active =null;
        }
        $category->save();
        return redirect('/categories')->with('success','Danh mục '.$category->name.' đã chuyển đổi thành công!');
    }

    /**
     * Changle acvtive of Record with id selected
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function inactiveAll(Request $request)
    {
        $id = $request->get('option');
        $category = $this->category->whereIn('id',$id)->update(['active'=> 1]);
        return redirect('/categories');
    }


}
