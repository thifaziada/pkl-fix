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
						Sign Up
					</span>
				</div>

				<form method="POST" action="{{ route('register') }}" class="login100-form validate-form">
                    @csrf
                        <!-- Name -->
                        <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
                            <span class="label-input100">Name</span>
                            <x-text-input id="name" class="block mt-1 w-full" type="name" name="name"  :value="old('name')" />
                            <span class="focus-input100"></span>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <!-- Email Address -->
                        <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
                            <span class="label-input100">Email</span>
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"  :value="old('email')" />
                            <span class="focus-input100"></span>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="wrap-input100 validate-input m-b-26" data-validate = "Password is required">
                            <span class="label-input100">Password</span>

                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            {{-- placeholder="Enter password" --}}
                                            required autocomplete="current-password" />
                                            
                            <span class="focus-input100"></span>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <!-- Password -->
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                            <span class="label-input100">Confirm Password</span>

                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation"
                                            
                                            required autocomplete="new-password" />
                                            
                            <span class="focus-input100"></span>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>


                    @csrf

                    <div class="container-login100-form-btn mt-3">
                        <button class="login100-form-btn">
                            Sign Up 
                        </button>

                        <a href="/auth/google" class="google-login-link">
                            <i class='bx bx-google nav_icon'></i> 
                            <span class="text-xs font-bold">Sign Up with Google</span>
                        </a>
                    </div>
                    
                    <div class="mt-4">
                        <label class="label-signup" for="ckb1">
                            Already have an account?
                        </label>
                        <a href="{{ route('login') }}" class="p1">
                            Sign In
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
