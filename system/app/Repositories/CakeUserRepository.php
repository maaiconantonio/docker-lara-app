<?php

namespace App\Repositories;

use App\Models\CakeUser;
use App\Models\User;
use App\Models\Cake;
use App\Interfaces\CakeUserRepositoryInterface;

class CakeUserRepository implements CakeUserRepositoryInterface
{
    public function index()
    {
        return CakeUser::all();
    }

    public function verifyCakeUser($user_id, $cake_id)
    {
        $user = User::find($user_id);
        $cake = Cake::find($cake_id);
        if (
            !$user ||
            !$cake
        ) {
            return false;
        }
        return true;
    }

    public function getCakeUser($user_id, $cake_id)
    {
        $user = User::find($user_id);
        $cake = Cake::find($cake_id);
        if (
            !$user ||
            !$cake
        ) {
            return false;
        }
        return ($user->cakes()->where('cake_id', $cake->id)->exists()) ? true : false;
    }

    public function getByCake($cake_id)
    {
        return CakeUser::whereCakeId($cake_id)->get();
    }

    public function store(array $data)
    {
        return CakeUser::create($data);
    }
    
    public function delete($id)
    {
        CakeUser::destroy($id);
    }
}
