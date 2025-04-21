<section class="bg-white/90 shadow-xl rounded-2xl p-8 w-full max-w-3xl mx-auto mt-10 backdrop-blur-md">
    <header class="mb-6 text-center">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

        <h2 class="text-3xl font-extrabold text-indigo-700 tracking-wide drop-shadow-sm font-[Comic Neue]">
            {{ __('Profile Information') }}
        </h2>
        <p class="text-md text-gray-600 mt-1">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('patch')
        <!-- Avatar Preview -->
        @if ($user->avatar)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Current Avatar"
                        class="w-20 h-20 rounded-full shadow-md ring-2 ring-indigo-300 object-cover">
                </div>
            @endif

        <!-- Name -->
        <div>
            <x-input-label for="name">
                <span class="flex items-center gap-2">
                    <i class="fas fa-user"></i> {{ __('Name') }}
                </span>
            </x-input-label>
            <x-text-input id="name" name="name" type="text"
                class="mt-1 block w-full rounded-lg border border-indigo-300 shadow-sm focus:ring-indigo-400"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email">
                <span class="flex items-center gap-2">
                    <i class="fas fa-envelope"></i> {{ __('Email') }}
                </span>
            </x-input-label>
            <x-text-input id="email" name="email" type="email"
                class="mt-1 block w-full rounded-lg border border-indigo-300 shadow-sm focus:ring-indigo-400"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-yellow-600">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification"
                            class="underline text-sm text-blue-600 hover:text-blue-800 transition">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600">
                            {{ __('A new verification link has been sent.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Avatar Upload -->
        <div>
            <x-input-label for="avatar">
                <span class="flex items-center gap-2">
                    <i class="fas fa-image"></i> {{ __('Avatar') }}
                </span>
            </x-input-label>

            <!-- Avatar Input -->
            <input id="avatar" name="avatar" type="file"
                class="block mt-1 w-full text-sm text-gray-600 rounded-lg border border-gray-300 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200 shadow-sm transition" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <!-- Save Button -->
        <div class="flex items-center justify-between">
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 transition px-6 py-2 rounded-lg shadow">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-green-600 ml-4">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
