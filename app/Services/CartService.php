<?php
namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function getCart()
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(['user_id' => Auth::id()]);
        } else {
            // For guests - use session ID but store in database
            return Cart::firstOrCreate(['session_id' => session()->getId()]);
        }
    }

    // app/Services/CartService.php
public function addItem($productId, $quantity, $price)
{
    $cart = $this->getCart(); // Get or create cart
    
    // Check if item already exists
    $existingItem = $cart->items()
        ->where('product_id', $productId)
        ->first();

    if ($existingItem) {
        // Update existing item
        $existingItem->update([
            'quantity' => $existingItem->quantity + $quantity,
            'price' => $price
        ]);
    } else {
        // Create new cart item
        CartItem::create([
    'cart_id' => $cart->id,
    'product_id' => $productId,
    'quantity' => $quantity,
    'price' => $price,
    'user_id' => auth()->check() ? auth()->id() : null
]);

    }
}

    public function removeItem($itemId)
    {
        CartItem::destroy($itemId);
        return $this->getCartItems();
    }

    public function updateQuantity($itemId, $quantity)
    {
        $item = CartItem::find($itemId);
        
        if ($item) {
            $item->update(['quantity' => $quantity]);
        }
        
        return $this->getCartItems();
    }

    public function getCartItems()
    {
        try {
            $cart = $this->getCart();
            return $cart->items()->with('product')->get() ?? collect();
        } catch (\Exception $e) {
            return collect();
        }
    }

   // app/Services/CartService.php

public function getCartItemsWithProducts()
{
    $cart = $this->getCart();
    return $cart->items()->with('product')->get();
}

public function getTotal()
{
    return $this->getCartItemsWithProducts()->sum(function($item) {
        return $item->price * $item->quantity;
    });
}

    public function getItemCount()
    {
        return $this->getCartItems()->count();
    }

    public function clearCart()
    {
        $cart = $this->getCart();
        $cart->items()->delete();
    }

    public function mergeGuestCartWithUserCart($user)
    {
        if (Session::has('cart')) {
            $guestCart = $this->getCart();
            
            if ($guestCart->items()->count() > 0) {
                $userCart = Cart::firstOrCreate(['user_id' => $user->id]);
                
                foreach ($guestCart->items as $item) {
                    $existingItem = $userCart->items()
                        ->where('product_id', $item->product_id)
                        ->first();
                    
                    if ($existingItem) {
                        $existingItem->update([
                            'quantity' => $existingItem->quantity + $item->quantity
                        ]);
                    } else {
                        $userCart->items()->create([
                            'product_id' => $item->product_id,
                            'quantity' => $item->quantity,
                            'price' => $item->price
                        ]);
                    }
                }
                
                $guestCart->items()->delete();
                $guestCart->delete();
            }
        }
    }
}