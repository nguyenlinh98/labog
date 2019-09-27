<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Exception;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('userAuth:web');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $activeUsers = User::active()->get();
       $inactiveUsers = User::inactive()->get();
       return view('users.index', compact('activeUsers','inactiveUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/users/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|min:3|max:255',
            'email'=> 'required|email|max:255|unique:users',
        ]);
        $users= new User();
        $users->name = $request->get('name');
        $users->email = $request->get('email');
        $users->password = Hash::make('123456');
        $users->save();
        return redirect('/users')->with('success', ' thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =User::find($id);
        return view('users.edit',compact('user'));

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =User::find($id);
        try{
            $user->delete();
        }catch(\Exception $e){
            abort(404,$e->getMessage());
        }

        return redirect('user')->with('success','Đã có bản ghi bị xóa');
    }

    /**
     * Phương thức vô hiệu hóa tài khoản
     * Nếu active của tài khoản bằng null thì active  bằng 1(vô hiệu hóa)
     * Ngược lại, active null(kích hoat)
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function inactive($id)
    {
        $user = User::find($id);
       if($user->active ==null)
       {
           $user->active = '1';
       }
       else
           $user->active =null;
       $user ->save();
       return redirect('/users')->with('success','Tài khoản '.$user->name.' đã được chuyển đổi');
    }


}
