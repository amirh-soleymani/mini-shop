<?php

namespace App\Providers;

use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Services\ProductService;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductService::class, function ($app) {
            return new ProductService($app->make(ProductRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('successResponse', function ($message, $data) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $data
            ]);
        });

        Response::macro('errorResponse', function ($message, $data, $statusCode) {
            return response()->json([
                'status' => 'error',
                'message' => $message,
                'data' => $data
            ], $statusCode);
        });
    }
}
