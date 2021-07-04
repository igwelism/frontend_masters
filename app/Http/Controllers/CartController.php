<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartItem;
use App\CartItemContent;
use App\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $cartId = $request->session()->get('cart_id');
        $cartContents = [];
        if ($cart = Cart::with('cartItems')->where('id', $cartId)->first()) {
            $cart->user_id = auth()->user()->id;
            $cart->customer_fullname = auth()->user()->name;
            $cart->save();
            $cartContents = CartItemContent::all()->toArray();
        }
        return view('concierge.cart', compact('cart', 'cartContents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $cartId = $request->session()->get('cart_id');
        $items = $request->get('items');
        $cart = $cartId ? Cart::firstOrCreate(['id' => $cartId]) : Cart::create();
        $cart->cartItems()->updateOrCreate(['cart_id' => $cart->id, 'name' => $request->get('service')],
            [
                'name' => $request->get('service'),
                'price' => $request->get('price')
            ]);
        $cartItem = CartItem::where("name", $request->get('service'))->where("cart_id", $cart->id)->first();
        if(count($items) > 0) {
            $cartItem->cartItemContent()->delete();
            array_walk($items, function ($item) use ($cartItem) {
                $cartItem->cartItemContent()->updateOrCreate(['cart_item_id' => $cartItem->id, 'sku' => $item['sku']],
                    ['name' => $item['name'] . ' (' . $item['category'] . ')', 'sku' => $item['sku']]);
            });
        }
        $cart->item_count = $cart->cartItems()->count();
        $subTotal = array_sum($cart->cartItems()->pluck("price")->toArray());
        $cart->total = $subTotal;
        $cart->save();
        $request->session()->put('cart_id', $cart->id);
        return response()->json($cart);
    }

    /**
     * @param Request $request
     * @param CartItem $cartItem
     * @return JsonResponse
     * @throws \Exception
     */
    public function deleteCartItem(Request $request, CartItem $cartItem): JsonResponse
    {
        $cartItem->cartItemContent()->delete();
        $cartItem->delete();
        $cartId = $request->session()->get('cart_id');
        $cart = Cart::findOrFail($cartId);
        $cart->item_count = $cart->cartItems()->count();
        $subTotal = array_sum($cart->cartItems()->pluck("price")->toArray());
        $cart->total = $subTotal;
        $cart->save();
        return response()->json([
            "message" => "deleted"
        ]);
    }
}
