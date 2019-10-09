<?php

namespace App\Http\Controllers;


use App\Post;
use Illuminate\Http\Request;
use Exception;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Traits\UploadTrait;


class UserController extends Controller
{
    use UploadTrait;

    public function __construct(User $user)
    {
        $this->middleware('userAuth:web');
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $search_content = $request->search;
        $user  = auth()->user()->role;
//        $this->authorize($user,'viewAny');

        $activeUsers = $this->user->getPagination(null, $search_content,'5');
        $inactiveUsers = $this->user->getPagination('1', $search_content,'5');

        return view('users.index', compact(['activeUsers', 'inactiveUsers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $this->validator($request->all());
        $user  = auth()->user()->role;
        $this->authorize($user,'store');
        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make('123456');
        $users->role = $request->role;
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
        $role  = auth()->user()->role;
        $this->authorize($role,'viewAny');
        try{
            if($role == null) {
                throw new Exception("Không tồn tại tài khoản với id này");
            }
            $user = User::find($id);
        }catch(   Exception $e)
        {
            abort('404', $e->getMessage());
        }

        return view('users.edit', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|string|max:255|email'
        ]);
        $data = $request->only(['name','email']);
        try {
            // Lay ra user hien tai
            $user = User::findOrFail($id);

            if ($user == null)
            {
                throw new Exception("Tài khoản không tồn tại");
            }

        } catch (\Exception $e)
        {
            abort('404', $e->getMessage());
        }

        if ($request->password != null)
        {
            $data['password'] = Hash::make( $request->password );
        }

        if ( $request->has('images') ) {
            $request->validate(['images' => 'image']);
            $data['images'] = Storage::disk('public')->put('avatar', $request->images);
        }

        // Thay dổi name bằng  value trong input[name]
        $user->update($data);
        return redirect('/users')->with(['status' => 'Profile được cập nhật thành công!']);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        try {
            $user->delete();
        } catch (\Exception $e) {
            abort(404, $e->getMessage());
        }

        return redirect('users')->with('success', 'Đã có bản ghi bị xóa');
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
        if ($user->active == null) {
            $user->active = '1';
        } else
            $user->active = null;
        $user->save();
        return redirect('/users')->with('success', 'Tài khoản ' . $user->name . ' đã được chuyển đổi');
    }

    public function profile()
    {
        return view('users.profile');
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::guard()->user()->id;
        // Validate form
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|max:255|email'
        ]);
        $data = $request->only(['name','email']);
        try {
            // Lay ra user hien tai
            $user = User::findOrFail($id);

            if ($user == null)
            {
                throw new Exception("Tài khoản không tồn tại");
            }

        } catch (\Exception $e)
        {
            abort('404', $e->getMessage());
        }

        if ($request->password != null)
        {
            $data['password'] = Hash::make( $request->password );
        }

        if ( $request->has('images') ) {
            $request->validate(['images' => 'image']);
            $data['images'] = Storage::disk('public')->put('avatar', $request->images);
        }

        // Thay dổi name bằng  value trong input[name]
        $user->update($data);
        return redirect()->back()->with(['status' => 'Profile được cập nhật thành công!']);
    }

    protected function validator($data)
    {
        return Validator::make($data, $this->roles(), $this->messegers());
    }

    protected function roles()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:email'],
            'roles'=> ['requied'],

        ];
    }

    protected function messegers()
    {
        return [
            'name.required' => 'Không để trống vị trí này!',
            'email.required' => 'Không để trống vị trí này',
            'email.email' => 'Yêu cầu điền đúng định dạng  email!',
            'roles.required' => 'Không để trống vị trí này!',
        ];
    }


}
