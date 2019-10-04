<?php

namespace App;

use App\User;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'status', 'publish', 'active','category_id'];

    protected $table = 'posts';

    public function category()
    {
        return $this->hasOne('App\Category', 'id','category_id');
    }

    public function getByActive($active = null)
    {
        return $this->where('active','=', $active)
                    ->get();
    }





//    public  function user()
//    {
//        return $this->hasOne(User::class,'id','user_id');
//    }


}
