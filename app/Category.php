<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable =['name','status','active'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getActiveCategory($active = null)
    {
        return $this->where('active' , '=', $active)->get();
    }
}
