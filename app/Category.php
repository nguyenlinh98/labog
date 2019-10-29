<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'status', 'active','user_id'];

    public function getCategory($active, $search = '', $paginate = 2)
    {
        return $this->getActiveCategory($active)
            ->where('name', 'like', '%' . $search . '%')
            ->paginate($paginate);
    }

    public function getActiveCategory($active = null)
    {
        return $this->where('active', '=', $active);
    }

    public function inactive($id,$status = null ){
        $this->where('id', $id)
            ->update(array(
                'status'=>$status,
            ));
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

}
