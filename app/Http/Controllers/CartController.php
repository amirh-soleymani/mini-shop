<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    public function get()
    {
        $this->authorize('get', Cart::class);

        $carts = Cart::where('user_id', auth()->user()->id)
            ->get();

        return Response::successResponse('Done', CartResource::collection($carts));
    }

    public function add(CartRequest $cartAddRequest)
    {
        $this->authorize('add', Cart::class);
        $productId = $cartAddRequest->input('product_id');
        $userId = auth()->user()->id;

        $checkProduct = Product::find($productId);
        if ($checkProduct->inventory < 1) {
            return Response::errorResponse('You Cannot Add This Product to Your Cart', [], 400);
        }

        $checkUserCart = Cart::where([
            ['user_id', $userId],
            ['product_id', $productId]
        ])
            ->first();
        if (!is_null($checkUserCart)) {
            return Response::errorResponse('You Already Have This Product in your Cart', [], 400);
        }

        $cart = Cart::create([
            'user_id' => $userId,
            'product_id' => $productId
        ]);

        return Response::successResponse('Product Added To Your Cart Successfully', CartResource::make($cart));
    }

    public function remove(CartRequest $cartAddRequest)
    {
        $this->authorize('remove', Cart::class);
        $productId = $cartAddRequest->input('product_id');
        $userId = auth()->user()->id;

        $checkUserCart = Cart::where([
            ['user_id', $userId],
            ['product_id', $productId]
        ])
            ->first();
        if (is_null($checkUserCart)) {
            return Response::errorResponse('You Dont Have This Product in your Cart', [], 400);
        }

        $checkUserCart->delete();

        return Response::successResponse('Product Removed From Your Cart Successfully!', []);
    }
}
