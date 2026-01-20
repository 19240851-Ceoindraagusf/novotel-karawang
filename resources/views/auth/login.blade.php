<style>
    body.login-novotel-bg {
        min-height: 100vh;
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=1200&h=800&fit=crop') center/cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    .novotel-login-card {
        background: #fff;
        padding: 40px 32px 32px 32px;
        border-radius: 18px;
        box-shadow: 0 4px 16px rgba(0,53,128,0.07);
        min-width: 340px;
        max-width: 400px;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }
    .novotel-login-header {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        margin-bottom: 18px;
    }
    .novotel-login-header .novotel-logo {
        height: 48px;
    }
    .novotel-login-header .hotel-title {
        font-size: 1.3rem;
        font-weight: bold;
        color: #003580;
        letter-spacing: 1px;
    }
    .novotel-login-header .stars {
        display: flex;
        align-items: center;
        margin-left: 8px;
    }
    .novotel-login-header .stars svg {
        width: 18px;
        height: 18px;
        margin-right: 2px;
    }
    .novotel-login-card form > div {
        margin-bottom: 18px;
    }
    .novotel-login-card label {
        color: #003580;
        font-weight: 600;
        margin-bottom: 4px;
    }
    .novotel-login-card input[type="email"],
    .novotel-login-card input[type="password"] {
        border-radius: 8px;
        border: 1px solid #cfd8e3;
        padding: 10px 12px;
        font-size: 15px;
        width: 100%;
        margin-top: 2px;
        transition: border 0.2s;
    }
    .novotel-login-card input[type="email"]:focus,
    .novotel-login-card input[type="password"]:focus {
        border-color: #003580;
        outline: none;
    }
    .novotel-login-card .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 0;
    }
    .novotel-login-card .login-btn {
        background: #003580;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 10px 0;
        font-size: 1rem;
        font-weight: 600;
        width: 100%;
        margin-top: 8px;
        transition: background 0.2s;
    }
    .novotel-login-card .login-btn:hover {
        background: #00214d;
    }
    .novotel-login-card .forgot-link {
        color: #003580;
        font-size: 0.95rem;
        text-decoration: underline;
        margin-top: 8px;
        display: inline-block;
    }
</style>
<body class="login-novotel-bg">
    <div class="novotel-login-card">
        <div class="novotel-login-header">
            <svg viewBox="0 0 200 240" class="novotel-logo" xmlns="http://www.w3.org/2000/svg">
                <text x="100" y="45" font-size="48" font-weight="bold" text-anchor="middle" fill="#003580" font-family="Arial, sans-serif">NO</text>
                <text x="100" y="95" font-size="48" font-weight="bold" text-anchor="middle" fill="#003580" font-family="Arial, sans-serif">VO</text>
                <text x="100" y="145" font-size="48" font-weight="bold" text-anchor="middle" fill="#003580" font-family="Arial, sans-serif">TEL</text>
                <text x="100" y="200" font-size="32" font-weight="bold" text-anchor="middle" fill="#003580" font-family="Arial, sans-serif">KARAWANG</text>
            </svg>
            <span class="hotel-title">Novotel Karawang</span>
            <span class="stars">
                <svg viewBox="0 0 24 24" fill="#FFD700"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                <svg viewBox="0 0 24 24" fill="#FFD700"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                <svg viewBox="0 0 24 24" fill="#FFD700"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                <svg viewBox="0 0 24 24" fill="#FFD700"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
            </span>
        </div>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="remember-me">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <label for="remember_me" style="margin-bottom:0;">{{ __('Remember me') }}</label>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-top:10px;">
                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <button type="submit" class="login-btn">{{ __('Log in') }}</button>
        </form>
    </div>
</body>
