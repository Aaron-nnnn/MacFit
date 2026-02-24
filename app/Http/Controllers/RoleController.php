<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function createRole(Request $request){
        $validated = $request->validate([
            'name'=>'required|string|unique:roles,name',
            'description'=>'nullable|string|max:1000',
        ]);

        $role = new Role();
        $role->name = $validated['name'];
        $role->description = $validated['description'];

        try{
            $role->save();
            return response()->json($role);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Save Role',
                'message'=>$exception->getMessage()
            ],200);
        }
    }

    public function readAllRoles(){
        try{
            $roles = Role::all();
            return response()->json($roles);
        }
        catch(\Exception $exception){
            return response()->json([
               'error'=>'Failed to fetch Roles.',
               'message'=>$exception->getMessage() 
            ], 200);
        }
    }

    public function readRole($id){
        try{
            $role = Role::findOrFail($id);
            return response()->json($role);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch the role.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }

    public function updateRole(Request $request, $id){
         $validated = $request->validate([
            'name'=>'required|string',
            'description'=>'nullable|string|max:1000'
            ]);

        try{
            $role = Role::findOrFail($id);
            $role->name = $validated['name'];
            $role->description = $validated['description'];
            $role->save();
            return response()->json($role);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to save the role.',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function deleteRole($id){
         try{
            $role = Role::findOrFail($id);
            $role->delete();
            return response("Role deleted successfully!");
        }
         catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to delete the role.',
                'message'=>$exception->getMessage()
            ]);
         }
    }
}
