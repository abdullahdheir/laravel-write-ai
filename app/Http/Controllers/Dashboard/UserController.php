<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\UserStatus;
use App\Helpers\TimeZoneHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
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

        $users = User::where('status', '=', $status)->withTrashed()->withCount('posts')->paginate(5)->withQueryString();

        $status_options = array_map(function ($status) {
            return [
                'name' => ucfirst($status->value),
                'count' => User::query()->withTrashed()->where('status', $status->value)->count(),
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
        $timezones = TimeZoneHelper::options();
        return view('dashboard.users.create', compact('roles', 'user', 'statusOptions', 'timezones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->create($request);

        return redirect()->route('dashboard.users.index')->with('status', 'User created successfully.');
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
        $statusOptions = UserStatus::options();
        $roles = Role::pluck('name', 'id')->toArray();
        $timezones = TimeZoneHelper::options();
        return view('dashboard.users.edit', compact('roles', 'user', 'statusOptions', 'timezones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        UserService::update($request, $user);
        return redirect()->route('dashboard.users.index')->with('status', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        UserService::delete($user);
        return redirect()->route('dashboard.users.index')->with('status', 'User deleted successfully.');
    }

    public function restore(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        UserService::restore($user);
        return redirect()->route('dashboard.users.index')->with('status', 'User restored successfully.');
    }

    public function forceDelete(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        UserService::forceDelete($user);
        return redirect()->route('dashboard.users.index')->with('status', 'User force deleted successfully.');
    }
}
