<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Mail\OrderConfirmation;
use App\Order;
use App\OrderItem;
use App\OrderItemContent;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $order = Order::with('orderItems')->where('user_id', Auth::id())->get();
        return view('concierge.subscription', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(Request $request): JsonResponse
    {
        $cartId = $request->session()->get('cart_id');
        if($cart = Cart::findOrFail($cartId)) {
            $order = Order::create([
                'order_no' => strtoupper(substr(uniqid('CO', true), 0, 12)),
                'payment_status' => 'Pending',
                'user_id' => $cart->user_id,
                'customer_fullname' => $cart->customer_fullname,
                'service_status' => 'Inactive'
            ]);
            $cart->cartItems()->each(function ($item) use ($order) {
                $orderItem = $order->orderItems()->updateOrCreate(['order_no' =>$order->order_no, 'name' => $item->name],
                ['name' => $item->name, 'price' => $item->price]);
                $item->cartItemContent()->each(function ($item) use($orderItem) {
                   OrderItemContent::create([
                       'name' => $item->name,
                       'sku' => $item->sku,
                       'order_item_id' => $orderItem->id,
                   ]);
                });
            });

            $order->item_count = $order->orderItems()->count();
            $order->subtotal = array_sum($order->orderItems()->pluck("price")->toArray());
            $order->total = ceil($order->subtotal + ($order->subtotal * 0.125));
            $order->save();

            Mail::to($order->user->email)->send(new OrderConfirmation($order));
            $this->deleteCartAndContent($cart, $request);
            return response()->json($order);
        }
        throw new Exception('An Error Occurred while checking out');
    }

    private function deleteCartAndContent($cart, $request)
    {
        $cart->cartItems()->each(function ($item) {
            $item->cartItemContent()->delete();
        });
        $cart->cartItems()->delete();
        $cart->delete();
        $newCart = Cart::create();
        $request->session()->put('cart_id', $newCart->id);
    }

    public function postcheckout(Request $request, $orderNumber)
    {
        $order = Order::where('order_no', $orderNumber)->first();
        return view('concierge.postcheckout', compact('order'));
    }
}
