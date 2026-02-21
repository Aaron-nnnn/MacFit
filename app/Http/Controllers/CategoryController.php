<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Category as ModelsCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     public function createCategory(Request $request){
        $validated = $request->validate([
            'name'=>'required|string|unique:categories,name',
            'description'=>'nullable|string|max:1000',
        ]);

        $category = new Category();
        $category->name = $validated['name'];
        $category->description = $validated['description'];

        try{
            $category->save();
            return response()->json($category);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Save Category',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function readAllCategories(){
        try{
            $category = Category::all();
            return response()->json($category);
        }
        catch(\Exception $exception){
            return response()->json([
               'error'=>'Failed to fetch Category.',
               'message'=>$exception->getMessage() 
            ]);
        }
    }

    public function readCategory($id){
        try{
            $category = Category::findOrFail($id);
            return response()->json($category);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch the category.',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function updateCategory(Request $request, $id){
         $validated = $request->validate([
            'name'=>'required|string',
            'description'=>'nullable|string|max:1000'
            ]);

        try{
            $category = Category::findOrFail($id);
            $category->name = $validated['name'];
            $category->description = $validated['description'];
            $category->save();
            return response()->json($category);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to save the category.',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function deleteCategory($id){
         try{
            $category = category::findOrFail($id);
            $category->delete();
            return response("Category deleted successfully!");
        }
         catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to delete the category.',
                'message'=>$exception->getMessage()
            ]);
         }
    }
}
