<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/login/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/login/css/main.css">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(assets/img/bgelitery.png);">
					<span class="login100-form-title-1">
						Sign In
					</span>
				</div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

				<form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                    @csrf

                    <!-- Email Address -->
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
                        <span class="label-input100">Email</span>
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Enter email" :value="old('email')" />
                        <span class="focus-input100"></span>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                        <span class="label-input100">Password</span>

                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        placeholder="Enter password"
                                        required autocomplete="current-password" />
                                        
                        <span class="focus-input100"></span>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    </div>



					{{-- <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Enter email">
						<span class="focus-input100"></span>
					</div> --}}

					{{-- <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div> --}}
                    

					<div class="flex-sb-m w-full p-b-30">
						{{-- <div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div> --}}

                        <div class="contact100-form-checkbox">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="input-checkbox100" name="remember">
                                <span class="label-checkbox100">{{ __('Remember me') }}</span>
                            </label>
                        </div>

						{{-- <div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>

						</div> --}}

                        @if (Route::has('password.request'))
                                <a class="txt1" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                        @endif
					</div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Log In
                        </button>

                        <a href="/auth/google" class="google-login-link">
                            <span class="google-icon"><i class="fab fa-google"></i></span>
                            Log In with Google
                        </a>
                    </div>

                    
                    <div class="mt-4">
                        <label class="label-signup" for="ckb1">
                            Don't have an account?
                        </label>
                        <a href="{{ route('register') }}" class="txt1">
                            Sign Up
                        </a>
                    </div>
                    
				</form>
			</div>
		</div>
	</div>

	<script src="assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="assets/login/js/main.js"></script>

</body>
</html>
{{-- <x-guest-layout >
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-center mt-4">

            <a href="/auth/google" class="mr-2 inline-block items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Login  Google
            </a>
            <br>
            <a href="/auth/github" class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500">
                Login  GitHub
            </a>
        </div>

    </form>
</x-guest-layout> --}}
