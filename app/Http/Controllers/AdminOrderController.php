<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Mail\OrderConfirmation;
use App\Order;
use App\OrderItem;
use App\OrderItemContent;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $order = Order::with('orderItems')->get();
        return view('concierge.admin_subscription', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(Request $request, $orderNo): JsonResponse
    {
        $order = Order::where('order_no', $orderNo)->first();
        $status = $request->get('status');
        if($order->payment_status != $status) {
            $startDate = Carbon::now();
            $endDate = Carbon::now()->addMonth();
            $serviceStatus = 'Active';
            $confirmedOrder = $order->updateOrCreate(['order_no' => $orderNo], [
                'payment_status' => $status,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'service_status' => $serviceStatus
            ]);
            Mail::to($order->user->email)->send(new OrderConfirmation($confirmedOrder));
        }
        $updatesOrders = Order::with('orderItems')->get();
        return response()->json($updatesOrders);
    }
}
