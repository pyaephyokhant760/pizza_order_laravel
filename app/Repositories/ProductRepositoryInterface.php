<?php
namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function getAll();
    public function store(array $data);
}
