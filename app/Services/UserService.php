<?php

namespace App\Services;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function create(StoreUserRequest $request)
    {
        $clean = $request->validated();

        return DB::transaction(function () use ($clean) {
            $data = [
                'name' => $clean['name'],
                'username' => $clean['username'],
                'email' => $clean['email'],
                'status' => $clean['status'],
                'password' => Hash::make($clean['name']),
                'timezone' => $clean['timezone'],
            ];

            $user = User::create($data);

            if (!empty($clean['avatar'])) {
                if ($clean['avatar'] instanceof UploadedFile) {
                    $user->avatar  = $clean['avatar']->store('avatars', 'public');
                } else {
                    $user->avatar = Storage::disk('public')->putFile('avatars', $clean['avatar']);
                }

                $user->save();
            }

            array_map(fn($r) => $user->assignRole($r), $clean['roles']);

            return $user;
        });
    }
    public static function update(UpdateUserRequest $request, User $user)
    {
        $clean = $request->validated();

        return DB::transaction(function () use ($clean, $user) {
            $data = [
                'name' => $clean['name'],
                'username' => $clean['username'],
                'email' => $clean['email'],
                'status' => $clean['status'],
                'timezone' => $clean['timezone'],
            ];


            if (!empty($clean['password'])) {
                $data['password'] = Hash::make($clean['password']);
            }

            $user->update($data);

            if (!empty($clean['avatar'])) {
                $oldAvatar = $user->avatar;
                if ($clean['avatar'] instanceof UploadedFile) {
                    $user->avatar  = $clean['avatar']->store('avatars', 'public');
                } else {
                    $user->avatar = Storage::disk('public')->putFile('avatars', $clean['avatar']);
                }

                $user->save();

                Storage::disk('public')->delete($oldAvatar);
            }

            $user->syncRoles($clean['roles']);

            return $user;
        });
    }

    public static function delete(User $user)
    {
        $user->deleteOrFail();
    }

    public static function restore(User $user)
    {
        $user->restore();
    }

    public static function forceDelete(User $user)
    {
        $oldAvatar = $user->avatar;
        $user->forceDelete();
        Storage::disk('public')->delete($oldAvatar);
    }
}
