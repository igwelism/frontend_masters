<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartItemContent;
use App\Cleaning;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CleaningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $cleaning = Cleaning::where('status', 'active')->get();
        $cartContents = [];
        if(!$cartId = $request->session()->get('cart_id')) {
            $cartId = Cart::create();
            $request->session()->put('cart_id', $cartId->id);
        } else {
            $cart = Cart::findOrFail($cartId);
            $cartItemIds = $cart->cartItems()->pluck('id')->toArray();
            $cartContents = CartItemContent::whereIn('cart_item_id',$cartItemIds)->pluck('sku');
            return view('concierge.cleaning.index', compact('cleaning', 'cartContents'));
        }
    }

    public function destroy(Cleaning $cleaning)
    {
        $cleaning->delete();
        return redirect('/uploads')->with('success', "cleaning has been deleted");
    }
}
