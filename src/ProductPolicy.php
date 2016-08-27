<?php

namespace Kajifat\SampleProducts;

use App\User;
use Kajifat\SampleProducts\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;


    /**
     *  Policy filter for admin
     *
     * @param User $user
     * @return bool
     */
    public function before(User $user){
        if (app('current_user_type') == 'admin'){
            return true;
        }
    }


    /**
     * Determine whether the user can create products.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //Only admin can create new Product
        return false;
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        if (app('current_user_type') == 'manager'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the product art
     * @param User $user
     * @return bool
     */
    public function update_art(User $user)
    {
        //Only admin can update art
        return false;
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        //Only admin can delete products
        return false;
    }
}
