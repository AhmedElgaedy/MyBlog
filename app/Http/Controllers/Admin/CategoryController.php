<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){

        try{

            $categories = Category::orderBy('id','desc')->get();
            if($categories){
            return response()->json([
                'success' => true,
                'categories' => $categories
            ]);
            };
            }
            catch(Exception $e){

               return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            
          }
    }
    


    public function store (Request $request){
        
        try{   

            $validation = Validator::make($request->all(),[

            'name'=> ['required','string','max:20','min:10','unique:categories'],

            ]); 
            if($validation->fails()){
                return response()->json([
                    'success'=>false,
                    'message'=> $validation->errors(),
                ]);
            }else{
                $result = Category::create([
                    'name'=> $request->name,
                ]);
                if($result){
                    return response()->json([
                        'success'=>true,
                        'message'=>'category added successfuly',
                    ]);
                }else{
                    return response()->json([
                        'success'=>false,
                        'message'=>' a problem happened ',
                    ]);
                }
            }
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e ->getMessage(),
            ]);
        
        }
    }

    public function edit($id){
        try {

            $categories = Category::findOrFail($id);
            if ($categories) {
                return response()->json(
                    [
                        'success' => true,
                        'categories' => $categories
                    ]
                );
            }
        } catch (Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'categories' => $e->getMessage()
                ]
            );
        }
    }


    public function update(Request $request, $id){
        try{
            $categories = Category::findOrFail($id);
        $validation= Validator::make($request->all(), [
            'name'=> ['required','string','max:20','min:10','unique:categories'],
        ]);

        if($validation->fails()){
            return response()->json([
                'success'=> false,
                'message'=> $validation->errors()->all(),
            ]);
        }else{
            $categories->name = $request->name;
            $result = $categories->save();
            if($result){
                return response()->json([
                    'success'=> true,
                    'message'=> 'category updated successfully'
                ]);
            }else{
                return response()->json([
                    'success'=> false,
                    'message'=> 'a problem happened',
                ]);
            }
            }
        }catch (Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'categories' => $e->getMessage()
                ]
            );
        }
    }

    public function delete($id)
    {
        try {
            $result = Category::findOrFail($id)->delete();
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Category Delete Successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'a problem happened',
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function search($search)
    {
        try {
            $categories = Category::where('category_name', 'LIKE', '%' . $search . '%')->orderBy('id', 'desc')->get();
            if ($categories) {
                return response()->json([
                    'success' => true,
                    'categories' => $categories
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

}

