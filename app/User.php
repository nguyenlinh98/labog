<?php

namespace App;

use App\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','images','active'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Method get all user active with $active
     * @param null $active
     * @return mixed
     */

    public function getPagination($active = null,$search = '', $paginate =1)
    {
        return $this->where('active','=',$active)
            ->where('name','like','%'.$search.'%')
            ->paginate($paginate);
    }

     public function getAttributeImage()
     {
         return $this->images;
     }

     public function posts()
     {
         return $this->belongsTo('App\Post','user_id','id');
     }

    public function categories()
    {
        return $this->belongsTo('App\Category','user_id','id');
    }

}
