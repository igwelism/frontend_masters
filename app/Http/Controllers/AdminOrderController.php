<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartItemContent;
use App\Cleaning;
use App\Employee;
use App\Food;
use App\Laundry;
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
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

    public function upload()
    {
        $foods = Food::paginate(5, ['*'], 'food');
        $laundries = Laundry::paginate(5, ['*'], 'laundry');
        $cleaning = Cleaning::paginate(5, ['*'], 'cleaning');
        return view('concierge.upload', compact('foods', 'laundries', 'cleaning'));
    }

    public function saveService(Request $request)
    {
        $request->validate([
            'image' => 'file|dimensions:max_width=200,max_height=200',
            "sku" => 'required|string',
            "name" => 'required|string',
            "status" => 'required|string',
            "category" => 'required|string',
            "quantity" => 'integer|min:1'
        ]);
        $data = [];
        $model = '';
        if($request->has('image') && !is_null($request->image)) {
            $imageName =  Str::slug($request->name) . '.jpg';
            $request->image->storeAs('images', $imageName, 'public');
            $data['img'] = $imageName;
        }
        $foods = Food::all()->pluck('category')->toArray();
        $laundries = Laundry::all()->pluck('category')->toArray();
        $cleaning = Cleaning::all()->pluck('category')->toArray();
        $data["name"] = $request->name;
        $data["sku"] = $request->sku;
        $data["status"] = $request->status;
        $data["category"] = $request->category;

        if(in_array($request->category, $foods)) {
            $request->image->storeAs('images/food', $imageName, 'public');
            $data['img'] = $imageName;
            $model = Food::create($data);
        } elseif(in_array($request->category, $laundries)){
            $data['quantity'] = $request->quantity;
            $request->image->storeAs('images/laundry', $imageName, 'public');
            $data['img'] = $imageName;
            $model = Laundry::create($data);
        } elseif (in_array($request->category, $cleaning)) {
            $data['quantity'] = $request->quantity;
            $request->image->storeAs('images/cleaning', $imageName, 'public');
            $data['img'] = $imageName;
            $model = Cleaning::create($data);
        }
        return response()->json($model);
    }

    public function getCategories(): JsonResponse
    {
        $categories = [];
        $foods = Food::all()->pluck('category');
        array_push($categories, $foods);
        $laundries = Laundry::all()->pluck('category');
        array_push($categories, $laundries);
        $cleaning = Cleaning::all()->pluck('category');
        array_push($categories, $cleaning);
        return response()->json([
            "categories" => array_unique(Arr::collapse($categories)),
            "food" => array_unique($foods->toArray())
        ]);
    }

    public function showRegisterForm()
    {
        $adminUsers = Employee::paginate(5, ['*'], 'employee');
        return view('concierge.register', compact('adminUsers'));
    }
}
