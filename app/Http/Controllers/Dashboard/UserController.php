<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'active');

        $users = User::where('status', '=', $status)->paginate(5)->withQueryString();

        $status_options = array_map(function ($status) {
            return [
                'name' => ucfirst($status->value),
                'count' => User::query()->where('status', $status->value)->count(),
            ];
        }, UserStatus::cases());

        return view('dashboard.users.index', compact('users', 'status_options', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        $statusOptions = UserStatus::options();
        $roles = Role::pluck('name', 'id')->toArray();
        $timezones = timezone_identifiers_list();
        return view('dashboard.users.create', compact('roles', 'user', 'statusOptions','timezones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->create($request);

        return redirect()->route('dashboard.users.create')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) {}
}
