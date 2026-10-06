<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Response as FacadesResponse;

class OrderPolicy
{
    
    public function view_orders(User $user)
    {
        if ($user->is_admin) {
            return Response::allow();
        }
        

        return Response::denyAsNotFound();
    }

    public function update(User $user, Order $order): bool
    {
        return false;
    }

    public function delete(User $user, Order $order): bool
    {
        return false;
    }

    
}
