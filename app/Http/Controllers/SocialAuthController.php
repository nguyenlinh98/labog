<?php

namespace App\Http\Controllers;

use App\Http\Request;
use Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\SocialAccount;


class SocialAuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param $provider
     * @return mixed
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    /*
    * Obitan the user information from *facebook
    * @return \Illuminate\Http\Response
    */
    public function handleProviderCallback($provider)
    {

        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($provider, $user);

        Auth::login($authUser);

        return redirect()->route('profile',['user_id' => Auth::user()->id]);
    }

    /**
     * method check nếu tồn tài user có provider  thì trả về user
     * if  chưa có thì tạo tài khoản  mới
     * @param $provider
     * @param $user
     * @return mixed
     */
    private function findOrCreateUser($provider,$user)
    {
        // get auth User from provider ,
        $authUser = SocialAccount::where('provider_id',$user->id)->first();
        // check provider has set
        if($authUser) {
            //if account not active then return error
            if(!$authUser->user->status) {
                $this->message = "Login with the ".$provider.' does not success because Your email has disable' ;
//                throw ValidationException::withMessages([
//                    'email' => [$this->message],
//                ]);
            }
            return $authUser->user;
        }
        else
        {
            $social = new SocialAccount([
                'user_id' => $user->id,
                'provider' => $provider,
                'provider_id' => $user->getId(),
            ]);
            $userData = $this->user->findEmail($user->email);
            if(!$userData)
            {
                $userData = $this->user->create([
                    'name' =>$user->name,
                    'email' =>$user->email,
                    'password'=>$user->token,
                ]);
            }
            $social->user()->associate($userData);
            $social->save();
            return $userData;
        }
    }
}
