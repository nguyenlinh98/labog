<?php


namespace App\Http\Controllers\AuthCustomer;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterCustomerController extends Controller
{
     use RegistersUsers;
    /**
     *  Where to redirect users after regitration
     * @var string
     */
     protected $redirectTo = '/admin';

     public function __construct()
     {
         $this->middleware('guest');
     }

}