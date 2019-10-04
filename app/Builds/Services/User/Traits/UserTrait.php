<?php


namespace App\Builds\Services\User\Traits;


use App\User;

trait UserTrait
{
    protected function guard(){
        return new User();
    }


}