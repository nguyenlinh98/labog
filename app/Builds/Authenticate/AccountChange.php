<?php

namespace App\Builds\Authenticate;

use    App\User;
use    Exception;

trait AccountChange
{

    protected function changePass($password, $id)
    {
        $result = true;
        try {
            //If access was defined , The works will allow
            if (!$this->accessed()) {
                throw new Exception("Access not defined", 1);
            }
            $user = $this->find($id);
            $result = $user->update(['password' => Hash::make($password)]);
        } catch (\Exception $e) {
            $result = false;
        }
        return $result;
    }

    protected function guard()
    {
        return new User();
    }

    protected function access($roles)
    {
        $this->access = true;
        return true;
    }

    protected function accessed()
    {
        return $this->access;
    }

}