<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    
    
    public function view(User $user, Product $product): bool
    {
        return true;
    }

    
    
    public function create(User $user): bool
    {
        // only admin can create products
        return $user->is_admin;
    }

    public function update(User $user, Product $product): bool
    {
        return $user->is_admin;
    }


    public function delete(User $user, Product $product): bool
    {// DONT DELETE PRODUCTS!! ONLY DE-ACTIVATE THEM, OR ELSE ALL THE PREVIOUS ORDERS FOREIGN PRODUCT ID WILL CORRUPT
        return $user->is_admin;
    }

}
