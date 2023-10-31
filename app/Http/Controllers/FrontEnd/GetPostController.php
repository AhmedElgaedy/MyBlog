<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class GetPostController extends Controller
{

    //show all posts
    public function index(){
        $posts = Post::orderBy("id","desc")->get();

       try{
        return response()->json([
            "success"=> true,
            "posts"=> $posts,
        ]);
       }
       catch(\Exception $e){
        return response()->json([
            "success"=> false,
            "message"=> $e->getMessage(),
        ]);

       }
    
    }



         // most view posts

         public function viewposts(){
            $posts = Post::where("views", '>' ,"0")->get();
            try{
                return response()->json([
                    "success"=> true,
                    "posts"=> $posts
                ]);
            }catch(\Exception $e){
                return response()->json([
                    "success"=> false,
                    "message"=> $e->getMessage(),
                ]);
            }
     }


     // get post by id
     public function getPostById($id)
     {
         try {
             $posts = Post::with('categories')->findOrFail($id);
             $posts->views = $posts->views + 1;
             $posts->save();
             return response()->json([
                 'success' => true,
                 'posts' => $posts
             ]);
         } catch (\Exception $e) {
             return response()->json([
                 'success' => false,
                 'message' => $e->getMessage(),
             ]);
         }
     }
 


      // get Post By Category
     public function getPostByCategory($id)
     {
         try {
             $posts = Post::with('categories')->where('id', $id)->orderBy('id', 'desc')->get();
             return response()->json([
                 'success' => true,
                 'posts' => $posts
             ]);
         } catch (\Exception $e) {
             return response()->json([
                 'success' => false,
                 'message' => $e->getMessage(),
             ]);
         }
     }
 
     public function searchPost($search)
     {
         try {
             $posts = Post::with('categories')->where('title', 'LIKE', '%' . $search . '%')->orderBy('id', 'desc')->get();
             return response()->json([
                 'success' => true,
                 'posts' => $posts
             ]);
         } catch (\Exception $e) {
             return response()->json([
                 'success' => false,
                 'message' => $e->getMessage(),
             ]);
         }
     }

}