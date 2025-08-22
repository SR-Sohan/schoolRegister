<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

      <form method="POST" action="{{ route('login') }}" id="loginForm">
          @csrf

                <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <input type="email" name="email" class="form-input" :value="old('email')" placeholder="Enter your email" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="form-group">
                    <x-input-label for="password" :value="__('Password')" />
                    <input type="password" name="password" class="form-input" placeholder="Enter your password" autocomplete="current-password" required>
                     <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <button type="submit" class="login-button" id="loginButton">
            <span id="buttonText">Sign In</span>
            <div id="loadingSpinner" class="loading-spinner" style="display: none;">
                <div class="spinner"></div>
            </div>
        </button>
         </form>



</x-guest-layout>
