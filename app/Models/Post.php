<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table="Posts";
    protected $fillable = [   
        'title',  'description',  'Published' , 'image' ,'views'
    ];
}
