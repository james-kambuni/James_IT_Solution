<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        try {
            $cartItems = $this->cartService->getCartItemsWithProducts();
            $subtotal = $this->cartService->getTotal();
            $shipping = 200.00;
            $total = $subtotal + $shipping;

            return view('cart', compact('cartItems', 'subtotal', 'shipping', 'total'));
        } catch (\Exception $e) {
            \Log::error('Cart Error: ' . $e->getMessage());
            return view('cart', [
                'cartItems' => collect(),
                'subtotal' => 0,
                'shipping' => 0,
                'total' => 0
            ]);
        }
    }

    public function show($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return view('product_detail', compact('product'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
            'quantity' => 'required|integer|min:1'
        ]);

        try {
            $this->cartService->addItem(
                $validated['product_id'],
                $validated['quantity'],
                $validated['price'],
                $validated['product_name'],
                $validated['image'] ?? null
            );

            $cartCount = $this->cartService->getItemCount();
            $total = $this->cartService->getTotal();

            return response()->json([
                'success' => true,
                'cart_count' => $cartCount,
                'total' => $total,
                'message' => $validated['product_name'] . ' added to cart!',
                'items' => $this->cartService->getCartItems()
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Cart Add Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to add item to cart. Please try again.'
            ], 500);
        }
    }

    public function remove(Request $request, $id)
    {
        $this->cartService->removeItem($id);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'cart_count' => $this->cartService->getCartItems()->count(),
                'total' => $this->cartService->getTotal()
            ]);
        }

        return redirect()->route('cart');
    }

    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $this->cartService->updateQuantity($id, $request->quantity);

        return response()->json([
            'success' => true,
            'cart_count' => $this->cartService->getCartItems()->count(),
            'total' => $this->cartService->getTotal()
        ]);
    }

    public function clear()
    {
        $this->cartService->clearCart();
        return redirect()->route('cart');
    }

    public function getCartData()
    {
        $cartItems = $this->cartService->getCartItems();
        $total = $this->cartService->getTotal();
        $itemCount = $this->cartService->getItemCount();

        return response()->json([
            'success' => true,
            'items' => $cartItems->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->product->name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'image' => $item->product->image ?? '/images/default-product.jpg'
                ];
            }),
            'total' => number_format($total, 2),
            'item_count' => $itemCount
        ]);
    }
    public function cartData(CartService $cartService)
{
    $items = $cartService->getCartItemsWithProducts();

    $formattedItems = $items->map(function ($item) {
        return [
            'id' => $item->id,
            'name' => $item->product->name,
            'price' => $item->price,
            'quantity' => $item->quantity,
            'image' => $item->product->image ?? 'default.jpg', // Ensure fallback
        ];
    });

    return response()->json([
        'success' => true,
        'items' => $formattedItems,
        'total' => $cartService->getTotal(),
        'item_count' => $cartService->getItemCount(),
    ]);
}
}
