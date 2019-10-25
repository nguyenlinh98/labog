<?php


namespace App\Http\Controllers\AuthCustomer;


use App\Http\Controllers\Controller;

class ResetPasswordCustomerController extends Controller
{
    protected  $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

}