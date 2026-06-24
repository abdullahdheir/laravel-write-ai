<x-layout title="Edit User">
    @include('dashboard.users._form',[
    'user' => $user,
    'action' => route('dashboard.users.update', $user->id),
    'method' => 'PUT',
    'title' => 'Edit User',
    ])
</x-layout>
