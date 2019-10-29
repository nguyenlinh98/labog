<?php


namespace App\Http\Controllers\AuthCustomer;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    /*
   |--------------------------------------------------------------------------
   | Login Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles authenticating users for the application and
   | redirecting them to your home screen. The controller uses a trait
   | to conveniently provide its functionality to your applications.
   |
         use AuthenticatesUsers;
   */
    protected  $redirectTo = '/user';
    protected $message = '';
    /**
     * LoginAdminController constructor.
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
        $this->middleware('guest:admin')->except('logout');

    }

    /**
     * @param Request $request
     */
    protected  function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function showLoginForm()
    {
        return view('customer.auth.login');
    }

    /**
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('customer');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function logout(Request $request)
    {
        $this->guard('customer')->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request)?: redirect('/');
    }
}