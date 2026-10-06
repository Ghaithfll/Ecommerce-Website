<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Category $category): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {

         if($user->is_admin){
            return Response::allow();
         }
         return Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Category $category): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function manage_categs(User $user)
    {
        
         if($user->is_admin){
            return Response::allow();
         }
         return Response::denyAsNotFound();
    }

    public function update_category(User $user, Category $category)
    {
         if($user->is_admin){
            return Response::allow();
         }
         return Response::denyAsNotFound();
    }

    public function delete(User $user, Category $category)
    {
        
         if($user->is_admin){
            return Response::allow();
         }
         return Response::denyAsNotFound();
    }
}
