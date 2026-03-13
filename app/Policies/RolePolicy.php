<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;

class RolePolicy
{
   public function viewAny(User $user){
        return  $user->role->id === 1;
   }

   public function view(User $user, Role $role){
        return $user->role->id === 1;
   }

   public function create(?User $user){
        return true;
   }

   public function update(User $user, Role $role){
        return $user->role->id === 1;;
   }

   public function delete(User $user, Role $role){
        return  $user->role->id === 1;
   }
}
