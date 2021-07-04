<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
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
        $user = User::with('userAdditionalInformation')->find(Auth::id());
        return view('concierge.profile', compact('user'));
    }

    public function store(Request $request, User $userId): JsonResponse
    {
        $userId->userAdditionalInformation()->updateOrCreate(['user_id' => $userId->id], [
            'title' => $request->get('title'),
            'mobile' => $request->get('mobile'),
        ]);

        return response()->json(User::with('userAdditionalInformation')->find($userId->id));
    }
}
