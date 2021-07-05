<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Mail\OrderConfirmation;
use App\Order;
use App\OrderItem;
use App\OrderItemContent;
use App\User;
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

class CustomersController extends Controller
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
        $customers= User::with(['userAdditionalInformation', 'address'])->get();
        return view('concierge.customers', compact('customers'));
    }
}
