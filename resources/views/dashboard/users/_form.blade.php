<form action="{{ $action ?? route('dashboard.users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method ?? 'POST')

    <main class="pt-24 pb-32 flex flex-col md:flex-row max-w-container-max mx-auto px-gutter gap-12">

        <!-- Editor Canvas -->
        <div class="flex-1 max-w-article-max mx-auto w-full distraction-free-focus">
            <div class="editor-container">
                @if ($errors->any())
                    <div class="text-red-800 mb-4 border border-red-900 bg-red-300">
                        @foreach ($errors->all() as $message)
                            <p>{{ $message }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            <section class="grid grid-cols-12 gap-8">
                <div class="col-span-12 lg:col-span-6">
                    <x-ui.input-group label="Name" name="name" type="text" placeholder="Enter name"
                        value="{{ old('name', $user->name) }}" />
                    <x-ui.input-group label="Username" name="username" type="text" placeholder="Enter name"
                        value="{{ old('username', $user->username) }}" />
                    <x-ui.input-group label="Email Address" name="email" type="email" placeholder="name@example.com"
                        value="{{ old('email', $user->email) }}" />
                    <x-ui.select-group label="Timezone" name="timezone" :options="$timezones"
                        value="{{ old('timezone', $user->status?->value) }}" />
                </div>
                <div class="col-span-12 lg:col-span-6">
                    <x-ui.select-group label="Status" name="status" :options="$statusOptions"
                        value="{{ old('status', $user->status?->value) }}" />
                    <x-ui.select-group label="Roles" name="roles[]" multiple :options="$roles" />
                    <x-ui.input-group label="Password" name="password" type="password" placeholder="••••••••" />
                    <x-ui.input-group label="Confirm Password" name="password_confirmation" type="password"
                        placeholder="••••••••" />
                </div>
            </section>
        </div>
        <!-- Sidebar: Publishing Settings -->
        <aside
            class="hidden lg:block w-80 shrink-0 h-fit sticky top-24 sidebar-overlay transition-opacity duration-500">
            <div class="space-y-8 border-l border-outline-variant pl-8">
                <!-- Cover Image -->
                <section>
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-4 uppercase tracking-wider">Cover Image
                    </h3>

                    <input type="file" value="{{ old('avatar') }}" name="avatar" id="avatar-input" class="hidden"
                        accept="image/*">

                    <div id="drop-zone"
                        class="aspect-video w-full rounded-lg bg-surface-container border-2 border-dashed border-outline-variant flex flex-col items-center justify-center gap-2 cursor-pointer hover:bg-surface-container-high transition-all group overflow-hidden relative">

                        <div id="drop-zone-prompt"
                            class="flex flex-col items-center justify-center gap-2 pointer-events-none">
                            <span
                                class="material-symbols-outlined text-secondary group-hover:text-primary transition-colors">add_a_photo</span>
                            <span class="font-metadata text-metadata text-secondary">Upload or drag photo</span>
                        </div>

                        <img id="cover-preview" class="hidden absolute inset-0 w-full h-full object-cover" />
                    </div>
                </section>
                @error('avatar')
                    <p class="text-red-800">{{ $message }}</p>
                @enderror
                <button type="submit"
                    class="bg-primary w-full text-on-primary px-6 py-3 rounded-lg font-ui-label text-ui-label hover:bg-primary-hover transition-colors">
                    Save
                </button>
            </div>
        </aside>

    </main>
</form>

<x-slot:footer-scripts>
    <script>
        // --- 1. منطق الـ Drag & Drop للـ Cover Image ---
        const dropZone = document.getElementById('drop-zone');
        const coverInput = document.getElementById('avatar-input');
        const dropZonePrompt = document.getElementById('drop-zone-prompt');
        const coverPreview = document.getElementById('cover-preview');

        dropZone.addEventListener('click', () => coverInput.click());

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                dropZone.classList.add('border-primary', 'bg-surface-container-high');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                dropZone.classList.remove('border-primary', 'bg-surface-container-high');
            }, false);
        });

        dropZone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files.length) {
                coverInput.files = files;
                handleCoverPreview(files[0]);
            }
        });

        coverInput.addEventListener('change', (e) => {
            if (e.target.files.length) handleCoverPreview(e.target.files[0]);
        });

        function handleCoverPreview(file) {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    coverPreview.src = e.target.result;
                    coverPreview.classList.remove('hidden');
                    dropZonePrompt.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-slot:footer-scripts>
