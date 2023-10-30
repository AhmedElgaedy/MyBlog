<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table="posts";
    protected $fillable = [  

        'title',  'description',  'Published' , 'image' ,'views','author_id','category_id'
    ];
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function authers(){
        return $this->belongsToMany(Auther::class,'author_id');
    }
}
