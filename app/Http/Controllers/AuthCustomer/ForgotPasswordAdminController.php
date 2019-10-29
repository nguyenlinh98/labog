<?php


namespace App\Http\Controllers\AuthCustomer;
use App\Http\Controllers\Controller;

class ForgotPasswordAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

}