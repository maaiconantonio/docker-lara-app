<?php

namespace App\Repositories;

use App\Models\Cake;
use App\Interfaces\CakeRepositoryInterface;

class CakeRepository implements CakeRepositoryInterface
{
    public function index()
    {
        return Cake::all();
    }

    public function getById($id)
    {
       return Cake::findOrFail($id);
    }

    public function store(array $data)
    {
       return Cake::create($data);
    }

    public function update(array $data, $id)
    {
       return Cake::whereId($id)->update($data);
    }
    
    public function delete($id)
    {
       Cake::destroy($id);
    }
}
