<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class CartController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        // SQL: 
        // SELECT * FROM carts 
        // WHERE user_id = ;
        // LIMIT 1
        $cart = Cart::where('user_id', Auth::id())->first();
        $cartItemsBySeller = collect();

        if ($cart) {
            // SQL: 
            // SELECT * FROM cart_items 
            // WHERE cart_id = ?
            $items = CartItem::where('cart_id', $cart->cart_id)
                ->with(['product.seller', 'product.release.images'])
                ->get();

            $cartItemsBySeller = $items->groupBy(function ($item) {
                return $item->product->seller->seller_id;
            });
        }

        return view('sell.cart', compact('cart', 'cartItemsBySeller'));
    }

    public function removeItem($cartItemId)
    {
        // SQL: 
        // SELECT * FROM cart_items 
        // WHERE id = ? 
        // LIMIT 1
        $cartItem = CartItem::findOrFail($cartItemId);
        $productId = $cartItem->product_id;

        // SQL: 
        // DELETE FROM cart_items 
        // WHERE id = ?
        $cartItem->delete();
        
        return redirect()->route('sell.cart')
            ->with('success', 'Item removed.')
            ->with('removed_product_id', $productId);
    }

    public function removeSeller($sellerId)
    {
        $user_id = Auth::id();

        // SQL: 
        // SELECT * FROM carts 
        // WHERE user_id = ; 
        // LIMIT 1
        $cart = Cart::where('user_id', Auth::id())->firstOrFail();

        // SQL: 
        // DELETE FROM cart_items 
        // WHERE cart_id = ? 
        // AND EXISTS (
        //     SELECT * FROM products 
        //     WHERE cart_items.product_id = products.id 
        //     AND seller_id = ?
        // )
        CartItem::where('cart_id', $cart->cart_id)
            ->whereHas('product', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })->delete();

        return redirect()->route('sell.cart')->with('success', 'Seller items removed.');
    }

    public function addBack(Request $request)
    {
        // SQL: 
        // SELECT * FROM carts 
        // WHERE user_id = ; 
        // LIMIT 1
        $cart = Cart::where('user_id', Auth::id())->firstOrFail();
        
        // SQL: 
        // INSERT INTO cart_items (cart_id, product_id, quantity, created_at, updated_at) 
        // VALUES (?, ?, 1, NOW(), NOW())
        CartItem::create([
            'cart_id'    => $cart->cart_id,
            'product_id' => $request->product_id,
            'quantity'   => 1,
        ]);

        return redirect()->route('sell.cart')->with('success', 'Item added back!');
    }

    public function placeOrder(Request $request)
    {
        $request->validate(['terms' => 'accepted']);

        $user_id = Auth::id();

        // SQL: 
        // SELECT * FROM carts 
        // WHERE user_id = 1 
        // LIMIT 1
        $cart = Cart::where('user_id', Auth::id())->firstOrFail();

        // SQL: 
        // SELECT * FROM cart_items 
        // WHERE cart_id = ?
        $items = CartItem::where('cart_id', $cart->cart_id)->with('product')->get();

        if ($items->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        $totalPrice = $items->sum(fn($item) => $item->product->price * $item->quantity);

        // SQL: 
        // INSERT INTO transactions (user_id, total_price, status, created_at, updated_at) 
        // VALUES (1, ?, 'pending', NOW(), NOW())
        $transaction = Transaction::create([
            'user_id'     => $user_id,
            'total_price' => $totalPrice,
            'status'      => 'pending',
        ]);

        foreach ($items as $item) {
            // SQL : 
            // INSERT INTO transaction_details (transaction_id, product_id, quantity, price, created_at, updated_at) 
            // VALUES (?, ?, ?, ?, NOW(), NOW())
            TransactionDetail::create([
                'transaction_id' => $transaction->transaction_id,
                'product_id'     => $item->product_id,
                'quantity'       => $item->quantity,
                'price'          => $item->product->price,
            ]);
        }

        // SQL: 
        // DELETE FROM cart_items 
        // WHERE cart_id = ?
        CartItem::where('cart_id', $cart->cart_id)->delete();

        return redirect()->route('sell.cart')->with('success', 'Order placed! Transaction #' . $transaction->transaction_id);
    }

    public function addToCart(Request $request)
    {
        $user_id = Auth::id(); 

        $product = Product::findOrFail($request->product_id);

        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Product is out of stock.');
        }

        $cart = Cart::firstOrCreate(['user_id' => $user_id]);

        $existingItem = CartItem::where('cart_id', $cart->cart_id)
            ->where('product_id', $product->product_id)
            ->first();

        if ($existingItem) {
            $existingItem->increment('quantity');
        } else {
            CartItem::create([
                'cart_id'    => $cart->cart_id,
                'product_id' => $product->product_id,
                'quantity'   => 1,
            ]);
        }

        return redirect()->route('sell.cart')->with('success', 'Item added to cart!');
    }
}