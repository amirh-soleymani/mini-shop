<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function index()
    {
        return Product::all();
    }

    public function store(array $data)
    {
        return Product::create($data);
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $bicycle = Product::findOrFail($id);
        $bicycle->update($data);
        return $bicycle;
    }

    public function destroy($id)
    {
        $bicycle = Product::findOrFail($id);
        $bicycle->delete();
    }
}
