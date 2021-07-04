<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AddressController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $user = User::with('address')->find(Auth::id());
        return view('concierge.address', compact('user'));
    }

    public function store(Request $request, User $userId): JsonResponse
    {
        $userId->address()->updateOrCreate(['user_id' => $userId->id], [
            'house_no' => $request->get('house_no'),
            'street_name' => $request->get('street_name'),
            'city' => $request->get('city'),
            'post_code' => $request->get('post_code')
        ]);

        return response()->json(User::with('address')->find($userId->id));
    }
}
