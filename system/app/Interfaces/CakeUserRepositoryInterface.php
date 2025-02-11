<?php

namespace App\Interfaces;

interface CakeUserRepositoryInterface
{
    public function index();
    public function store(array $data);
    public function delete($id);
}
