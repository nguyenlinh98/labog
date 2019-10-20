<?php

namespace App;

use App\User;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'status', 'publish', 'active','category_id','user_id'];

    protected $table = 'posts';


    public function getByActive($active = null, $search = '', $paginate = 1)
    {
        return $this->where('active','=', $active )
            ->where('title','like','%'.$search.'%')
            ->paginate($paginate);
    }

    public function getPostByUser($active = null, $search = '', $paginate = 1, $id = null)
    {
        return $this->where('active','=', $active )
            ->where ('user_id', '=',$id)
            ->where('title','like','%'.$search.'%')
            ->paginate($paginate);

    }
    public function category()
    {
        return $this->hasOne('App\Category', 'id','category_id');
    }

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

}
