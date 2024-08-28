<?php

namespace App\Http\Controllers;

use App\Events\ProductCreated;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ){
    }

    public function index()
    {
        $products = $this->productService->index();

        return Response::successResponse('Done', ProductResource::collection($products));
    }

    public function store(ProductRequest $productRequest)
    {
        $this->authorize('store', Product::class);

        $productData = [
            'name' => $productRequest->input('name'),
            'admin_id' => auth()->user()->id,
            'inventory' => $productRequest->input('inventory'),
            'price' => $productRequest->input('price'),
        ];

        $product = $this->productService->store($productData);

        event(new ProductCreated($product));

        return Response::successResponse('Product Created Successfully.', ProductResource::make($product));
    }

    public function show($id)
    {
        $product = $this->productService->show($id);

        return Response::successResponse('Done', ProductResource::make($product));
    }

    public function update(ProductUpdateRequest $productUpdateRequest, $id)
    {
        $product = $this->productService->show($id);

        $this->authorize('update', [Product::class, $product]);

        $product = $this->productService->update($productUpdateRequest->all(), $id);

        return Response::successResponse('Product Updated Successfully!', ProductResource::make($product));
    }

    public function destroy($id)
    {
        $this->authorize('destroy', Product::class);

        $this->productService->destroy($id);

        return Response::successResponse('Product Deleted Successfully', []);
    }
}
