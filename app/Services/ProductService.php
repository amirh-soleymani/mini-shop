<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;

class ProductService
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {
    }

    public function index()
    {
        return $this->productRepository->index();
    }

    public function store(array $data)
    {
        return $this->productRepository->store($data);
    }

    public function show($id)
    {
        return $this->productRepository->show($id);
    }

    public function update(array $data, $id)
    {
        return $this->productRepository->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->productRepository->destroy($id);
    }
}
