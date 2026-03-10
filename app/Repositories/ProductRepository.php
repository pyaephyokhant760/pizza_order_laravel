<?php 

namespace App\Repositories;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface {
    public function getAll() {
        return Product::all();
    }
    public function store(array $data) {
        return Product::create($data);
    }
}