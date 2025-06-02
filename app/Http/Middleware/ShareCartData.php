<?php

// app/Http/Middleware/ShareCartData.php
namespace App\Http\Middleware;

use App\Services\CartService;
use Closure;

class ShareCartData
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function handle($request, Closure $next)
    {
        if ($request->is('admin/*')) {
            return $next($request);
        }

        $cartCount = $this->cartService->getCartItems()->count();
        view()->share('cartCount', $cartCount);

        return $next($request);
    }
}
