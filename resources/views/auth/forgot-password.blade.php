<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-yellow-100 via-blue-100 to-green-100 px-4 py-8">

        <!-- ✅ Custom Logo (Optional) -->
        <div class="mb-6">
            <img src="{{ asset('images/Tech.png') }}" alt="TechKicks Logo" class="h-20 w-auto drop-shadow-lg">
        </div>

        <!-- 💳 Reset Password Card -->
        <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-xl">
            <h2 class="text-2xl font-sans font-bold text-center text-blue-700 mb-4">Wachtwoord vergeten?</h2>

            <p class="text-sm text-center font-sans text-gray-600 mb-6">
                Geen probleem. Vul je emailadres in en we sturen je een link om je wachtwoord te resetten.
            </p>

            <!-- ✅ Session Status -->
            @if (session('status'))
                <div class="mb-4 text-green-600 text-sm text-center font-semibold">
                    {{ session('status') }}
                </div>
            @endif

            <!-- ✅ Form Start -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-sans text-gray-700">Emailadres</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">

                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="buttonpro w-full mt-2 font-sans">
                    <span>Verzend Reset Link</span>
                </button>
            </form>
        </div>
    </div>

    <!-- 🌟 Button Style (same as login page) -->
    <style>
    .buttonpro {
      --btn-default-bg: #1e3a8a;
      --btn-padding: 15px 20px;
      --btn-hover-bg: #22c55e;
      --btn-transition: 0.3s;
      --btn-letter-spacing: 0.1rem;
      --btn-animation-duration: 1.2s;
      --btn-shadow-color: #3b82f6;
      --hover-btn-color: #ffffff;
      --default-btn-color: #fff;
      --font-size: 16px;
      --font-weight: 600;
      --font font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
      border-radius: 6em;
    }

    .buttonpro {
        
      box-sizing: border-box;
      padding: var(--btn-padding);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--default-btn-color);
      font: var(--font-weight) var(--font-size) var(--font-family);
      background: var(--btn-default-bg);
      cursor: pointer;
      transition: var(--btn-transition);
      overflow: hidden;
      box-shadow: 0 2px 10px 0 var(--btn-shadow-color);
      border-radius: 6em;
      border: 2px solid #1e40af;
    }

    .buttonpro span {
      letter-spacing: var(--btn-letter-spacing);
      transition: var(--btn-transition);
      box-sizing: border-box;
      position: relative;
      background: inherit;
    }

    .buttonpro span::before {
      box-sizing: border-box;
      position: absolute;
      content: "";
      background: inherit;
    }

    .buttonpro:focus {
      scale: 1.09;
    }

    .buttonpro:hover,
    .buttonpro:focus {
      background: var(--btn-hover-bg);
      box-shadow: 0px 0px 10px 0px rgba(34, 197, 94, 0.7);
      border: 2px solid #22c55e;
    }

    .buttonpro:hover span,
    .buttonpro:focus span {
      color: var(--hover-btn-color);
    }
    </style>
</x-guest-layout>
