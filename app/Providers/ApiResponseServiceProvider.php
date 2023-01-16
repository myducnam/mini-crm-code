<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ApiResponseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Response::macro('success', function ($data = []) {
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        });

        Response::macro('error', function (string $message, int $status) {
            return response()->json([
                'status' => false,
                'message' => $message
            ], $status);
        });

        Response::macro('unauthenticated', function (string $message) {
            return response()->json([
                'status' => false,
                'message' => $message
            ], 401);
        });
    }
}
