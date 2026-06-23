<x-layout title="Users Management">
    <main class="grow pt-24 w-full max-w-container-max mx-auto px-gutter py-12">
        <!-- Header Section -->
        @if (session()->has('status'))
            <div class="p-2 bg-green-300 text-green-800">
                {{ session()->get('status') }}
            </div>
        @endif
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <h1 class="font-display-lg text-display-lg text-on-background mb-2">Users Management</h1>
                <p class="text-on-surface-variant max-w-lg font-ui-label text-ui-label">Manage your users.</p>
            </div>
            @can('users.create')
                <a href="{{ route('dashboard.users.create') }}"
                    class="bg-primary-container text-on-primary px-6 py-3 rounded-lg font-ui-button text-ui-button flex items-center gap-2 hover:opacity-90 active:scale-95 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[20px]" data-icon="group_add">group_add</span>
                    Create User
                </a>
            @endcan
        </div>
        <!-- Dashboard Layout Grid -->
        <div class="grid grid-cols-12 gap-8">

            <!-- Main Content Area -->
            <div class="col-span-12 space-y-6">
                <!-- Tabs & Search Filter -->
                <div
                    class="flex flex-col md:flex-row md:items-center justify-between border-b border-outline-variant gap-4">
                    <div class="flex gap-8 overflow-x-auto no-scrollbar">
                        @foreach ($status_options as $option)
                            <a href="{{ route('dashboard.users.index', ['status' => strtolower($option['name'])]) }}"
                                class="{{ $status == strtolower($option['name']) ? 'border-b-2 border-primary text-primary' : '' }} pb-4 text-ui-label font-bold whitespace-nowrap">
                                {{ $option['name'] }}
                                ({{ $option['count'] }})
                            </a>
                        @endforeach

                    </div>
                    <div class="flex items-center gap-2 pb-2">
                        <button
                            class="p-2 text-on-surface-variant hover:bg-surface-container rounded-lg transition-all">
                            <span class="material-symbols-outlined" data-icon="filter_list">filter_list</span>
                        </button>
                        <button
                            class="p-2 text-on-surface-variant hover:bg-surface-container rounded-lg transition-all">
                            <span class="material-symbols-outlined" data-icon="sort">sort</span>
                        </button>
                    </div>
                </div>
                <!-- Bulk Actions Bar (Sticky-ish) -->
                <div
                    class="bg-surface-container-low px-4 py-3 rounded-lg flex items-center justify-between border border-outline-variant">
                    <div class="flex items-center gap-4">
                        <input class="w-4 h-4 rounded border-outline text-primary focus:ring-primary" type="checkbox" />
                        <span class="text-metadata font-ui-label font-medium text-on-surface-variant">2 users
                            selected</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <button
                            class="text-metadata font-ui-label font-semibold text-secondary hover:text-on-surface transition-all">Unpublish</button>
                        <span class="w-px h-4 bg-outline-variant"></span>
                        <button
                            class="text-metadata font-ui-label font-semibold text-error hover:text-on-error-container transition-all">Delete</button>
                    </div>
                </div>
                <!-- User Table/List -->
                <div class="space-y-4">
                    @foreach ($users as $user)
                        <div
                            class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant hover:border-primary transition-all group">
                            <div class="flex items-start gap-4">
                                <input class="mt-2 w-4 h-4 rounded border-outline text-primary focus:ring-primary"
                                    type="checkbox" />
                                <div class="grow grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                                    <div class="md:col-span-6">
                                        <span class="text-metadata font-metadata text-primary mb-1 block">
                                            <h3
                                                class="font-headline-md text-[20px] leading-snug group-hover:text-primary transition-colors">
                                                {{ $user->name }}</h3>
                                            <p class="text-metadata font-metadata text-on-surface-variant mt-1">
                                                Joined At
                                                {{ $user->created_at->format('M j, Y H:i') }}</p>
                                    </div>
                                    <div class="md:col-span-2 flex flex-col">

                                    </div>
                                    <div class="md:col-span-2">
                                        @if ($user->trashed())
                                            <span
                                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-200 text-red-50 text-green-700 text-[12px] font-bold border border-green-200">
                                                <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                                Deleted
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-{{ $user->status->getColor() }}-200 text-{{ $user->status->getColor() }}-50 text-green-700 text-[12px] font-bold border border-green-200">
                                                <span
                                                    class="h-1.5 w-1.5 rounded-full bg-{{ $user->status->getColor() }}-600"></span>
                                                {{ $user->status->getLabel() }}
                                            </span>
                                        @endif
                                    </div>
                                    <div
                                        class="md:col-span-2 flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        @if ($user->trashed())
                                            <button
                                                onclick="confirm('Are you sure you want to restore this user?')? document.getElementById('restoreuser{{ $user->id }}').submit() : null;"
                                                class="p-2 text-on-surface-variant hover:bg-surface-container rounded-lg transition-all"
                                                title="More">
                                                <span class="material-symbols-outlined"
                                                    data-icon="refresh">refresh</span>
                                            </button>
                                            <form style="display: none;" id="restoreuser{{ $user->id }}"
                                                action="{{ route('dashboard.users.restore', $user->id) }}"
                                                method="user">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                        @else
                                            <a href="{{ route('dashboard.users.edit', $user->id) }}"
                                                class="p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary rounded-lg transition-all"
                                                title="Edit">
                                                <span class="material-symbols-outlined" data-icon="edit">edit</span>
                                            </a>
                                        @endif
                                        <button
                                            class="p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary rounded-lg transition-all"
                                            title="Analytics">
                                            <span class="material-symbols-outlined"
                                                data-icon="bar_chart">bar_chart</span>
                                        </button>
                                        <button
                                            onclick="confirm('Are you sure you want to delete this user?')? document.getElementById('deleteuser{{ $user->id }}').submit() : null;"
                                            class="p-2 text-on-surface-variant hover:bg-surface-container rounded-lg transition-all"
                                            title="More">
                                            <span class="material-symbols-outlined" data-icon="delete">delete</span>
                                        </button>
                                        <form style="display: none;" id="deleteuser{{ $user->id }}"
                                            action="{{ route('dashboard.users.' . ($user->trashed() ? 'force-delete' : 'destroy'), $user->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                {{ $users->links() }}

                {{--
                <div class="flex items-center justify-between pt-8">
                    <span class="text-metadata font-metadata text-on-surface-variant">Showing 1 to 10 of 42
                        users</span>
                    <div class="flex gap-2">
                        <button
                            class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container-low disabled:opacity-30"
                            disabled="">
                            <span class="material-symbols-outlined" data-icon="chevron_left">chevron_left</span>
                        </button>
                        <button
                            class="h-10 w-10 border border-primary bg-primary text-on-primary rounded-lg font-ui-label">1</button>
                        <button
                            class="h-10 w-10 border border-outline-variant hover:bg-surface-container-low rounded-lg font-ui-label">2</button>
                        <button
                            class="h-10 w-10 border border-outline-variant hover:bg-surface-container-low rounded-lg font-ui-label">3</button>
                        <button class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container-low">
                            <span class="material-symbols-outlined" data-icon="chevron_right">chevron_right</span>
                        </button>
                    </div>
                </div>
                --}}
            </div>
        </div>
    </main>

</x-layout>
