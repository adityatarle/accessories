<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $isLogin ? 'Login' : 'Sign Up' }} - {{ config('app.name', 'StyleStore') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-pink-50 via-purple-50 to-indigo-50 min-h-screen">
    <div x-data="authToggle()" class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 auth-float"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 auth-float" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-60 h-60 bg-indigo-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 auth-float" style="animation-delay: 2s;"></div>
        </div>

        <div class="max-w-md w-full space-y-8 relative z-10">
            <!-- Header -->
            <div class="text-center auth-bounce-in">
                <div class="mx-auto h-16 w-16 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full flex items-center justify-center mb-4 auth-glow hover:scale-110 transition-transform duration-300">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    <span class="text-gradient">Style</span><span class="text-gray-900">Store</span>
                </h2>
                <p class="text-gray-600">Welcome to your fashion destination</p>
            </div>

            <!-- Toggle Tabs -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden auth-slide-in">
                <div class="flex">
                    <button @click="setMode('login')" 
                            :class="mode === 'login' ? 'bg-pink-600 text-white' : 'text-gray-500 hover:text-gray-700'"
                            class="flex-1 py-4 px-6 text-center font-semibold transition-all duration-300 relative hover:bg-pink-50">
                        <span class="flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Login</span>
                        </span>
                        <div x-show="mode === 'login'" 
                             class="absolute bottom-0 left-0 right-0 h-1 bg-pink-600 transition-all duration-300"></div>
                    </button>
                    <button @click="setMode('register')" 
                            :class="mode === 'register' ? 'bg-pink-600 text-white' : 'text-gray-500 hover:text-gray-700'"
                            class="flex-1 py-4 px-6 text-center font-semibold transition-all duration-300 relative hover:bg-pink-50">
                        <span class="flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            <span>Sign Up</span>
                        </span>
                        <div x-show="mode === 'register'" 
                             class="absolute bottom-0 left-0 right-0 h-1 bg-pink-600 transition-all duration-300"></div>
                    </button>
                </div>

                <!-- Forms Container -->
                <div class="p-8">
                    <!-- Login Form -->
                    <div x-show="mode === 'login'" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-x-4"
                         x-transition:enter-end="opacity-100 transform translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform translate-x-0"
                         x-transition:leave-end="opacity-0 transform -translate-x-4">
                        
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf

                            <!-- Email Address -->
                            <div class="space-y-2">
                                <label for="login_email" class="block text-sm font-medium text-gray-700">
                                    Email Address
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg>
                                    </div>
                                    <input id="login_email" 
                                           name="email" 
                                           type="email" 
                                           value="{{ old('email') }}"
                                           required 
                                           autofocus 
                                           autocomplete="username"
                                           class="input-field pl-10 @error('email') border-red-500 @enderror transition-all duration-300 focus:auth-input-focus"
                                           @focus="focusedField = 'email'"
                                           @blur="focusedField = null">
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-1" />
                            </div>

                            <!-- Password -->
                            <div class="space-y-2">
                                <label for="login_password" class="block text-sm font-medium text-gray-700">
                                    Password
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <input id="login_password" 
                                           name="password" 
                                           type="password" 
                                           required 
                                           autocomplete="current-password"
                                           class="input-field pl-10 @error('password') border-red-500 @enderror">
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                            </div>

                            <!-- Remember Me -->
                            <div class="flex items-center justify-between">
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           name="remember" 
                                           class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                                </label>
                                
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" 
                                   class="text-sm text-pink-600 hover:text-pink-500 transition-colors">
                                    Forgot password?
                                </a>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" 
                                    :disabled="isLoading"
                                    @click="submitForm($event.target.closest('form'))"
                                    class="w-full btn-primary flex items-center justify-center space-x-2 py-3 disabled:opacity-50 disabled:cursor-not-allowed">
                                <span x-show="!isLoading">Sign In</span>
                                <span x-show="isLoading" class="flex items-center space-x-2">
                                    <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>Signing In...</span>
                                </span>
                                <svg x-show="!isLoading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                            </button>
                        </form>
                    </div>

                    <!-- Register Form -->
                    <div x-show="mode === 'register'" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-x-4"
                         x-transition:enter-end="opacity-100 transform translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform translate-x-0"
                         x-transition:leave-end="opacity-0 transform -translate-x-4">
                        
                        <form method="POST" action="{{ route('register') }}" class="space-y-6">
                            @csrf

                            <!-- Name -->
                            <div class="space-y-2">
                                <label for="register_name" class="block text-sm font-medium text-gray-700">
                                    Full Name
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <input id="register_name" 
                                           name="name" 
                                           type="text" 
                                           value="{{ old('name') }}"
                                           required 
                                           autofocus 
                                           autocomplete="name"
                                           class="input-field pl-10 @error('name') border-red-500 @enderror">
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-1" />
                            </div>

                            <!-- Email Address -->
                            <div class="space-y-2">
                                <label for="register_email" class="block text-sm font-medium text-gray-700">
                                    Email Address
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg>
                                    </div>
                                    <input id="register_email" 
                                           name="email" 
                                           type="email" 
                                           value="{{ old('email') }}"
                                           required 
                                           autocomplete="username"
                                           class="input-field pl-10 @error('email') border-red-500 @enderror">
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-1" />
                            </div>

                            <!-- Password -->
                            <div class="space-y-2">
                                <label for="register_password" class="block text-sm font-medium text-gray-700">
                                    Password
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <input id="register_password" 
                                           name="password" 
                                           type="password" 
                                           required 
                                           autocomplete="new-password"
                                           x-model="password"
                                           @input="checkPasswordStrength()"
                                           class="input-field pl-10 @error('password') border-red-500 @enderror transition-all duration-300 focus:auth-input-focus">
                                </div>
                                
                                <!-- Password Strength Indicator -->
                                <div x-show="password && password.length > 0" class="space-y-2">
                                    <div class="flex space-x-1">
                                        <div class="h-1 flex-1 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-full transition-all duration-300" 
                                                 :class="passwordStrength >= 1 ? 'bg-red-500' : ''"
                                                 :style="`width: ${passwordStrength >= 1 ? '25%' : '0%'}`"></div>
                                        </div>
                                        <div class="h-1 flex-1 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-full transition-all duration-300" 
                                                 :class="passwordStrength >= 2 ? 'bg-yellow-500' : ''"
                                                 :style="`width: ${passwordStrength >= 2 ? '25%' : '0%'}`"></div>
                                        </div>
                                        <div class="h-1 flex-1 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-full transition-all duration-300" 
                                                 :class="passwordStrength >= 3 ? 'bg-blue-500' : ''"
                                                 :style="`width: ${passwordStrength >= 3 ? '25%' : '0%'}`"></div>
                                        </div>
                                        <div class="h-1 flex-1 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-full transition-all duration-300" 
                                                 :class="passwordStrength >= 4 ? 'bg-green-500' : ''"
                                                 :style="`width: ${passwordStrength >= 4 ? '25%' : '0%'}`"></div>
                                        </div>
                                    </div>
                                    <p class="text-xs" 
                                       :class="passwordStrength === 0 ? 'text-gray-500' : passwordStrength === 1 ? 'text-red-500' : passwordStrength === 2 ? 'text-yellow-500' : passwordStrength === 3 ? 'text-blue-500' : 'text-green-500'"
                                       x-text="passwordStrength === 0 ? 'Enter a password' : passwordStrength === 1 ? 'Weak' : passwordStrength === 2 ? 'Fair' : passwordStrength === 3 ? 'Good' : 'Strong'"></p>
                                </div>
                                
                                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="space-y-2">
                                <label for="register_password_confirmation" class="block text-sm font-medium text-gray-700">
                                    Confirm Password
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <input id="register_password_confirmation" 
                                           name="password_confirmation" 
                                           type="password" 
                                           required 
                                           autocomplete="new-password"
                                           class="input-field pl-10 @error('password_confirmation') border-red-500 @enderror">
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="flex items-start">
                                <input type="checkbox" 
                                       name="terms" 
                                       required
                                       class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded mt-1">
                                <label class="ml-2 text-sm text-gray-600">
                                    I agree to the 
                                    <a href="#" class="text-pink-600 hover:text-pink-500">Terms of Service</a> 
                                    and 
                                    <a href="#" class="text-pink-600 hover:text-pink-500">Privacy Policy</a>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" 
                                    :disabled="isLoading"
                                    @click="submitForm($event.target.closest('form'))"
                                    class="w-full btn-primary flex items-center justify-center space-x-2 py-3 disabled:opacity-50 disabled:cursor-not-allowed">
                                <span x-show="!isLoading">Create Account</span>
                                <span x-show="isLoading" class="flex items-center space-x-2">
                                    <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>Creating Account...</span>
                                </span>
                                <svg x-show="!isLoading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    By continuing, you agree to our 
                    <a href="#" class="text-pink-600 hover:text-pink-500">Terms of Service</a> 
                    and 
                    <a href="#" class="text-pink-600 hover:text-pink-500">Privacy Policy</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function authToggle() {
            return {
                mode: '{{ $isLogin ? "login" : "register" }}',
                focusedField: null,
                isLoading: false,
                password: '',
                passwordStrength: 0,
                
                setMode(newMode) {
                    this.mode = newMode;
                    this.isLoading = false;
                    this.password = '';
                    this.passwordStrength = 0;
                    // Clear form errors when switching modes
                    this.clearErrors();
                },
                
                clearErrors() {
                    // Remove error styling from all inputs
                    const inputs = document.querySelectorAll('.border-red-500');
                    inputs.forEach(input => {
                        input.classList.remove('border-red-500');
                        input.classList.add('border-gray-300');
                    });
                },
                
                checkPasswordStrength() {
                    const password = this.password;
                    let strength = 0;
                    
                    if (password.length >= 8) strength++;
                    if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
                    if (password.match(/\d/)) strength++;
                    if (password.match(/[^a-zA-Z\d]/)) strength++;
                    
                    this.passwordStrength = strength;
                },
                
                async submitForm(form) {
                    this.isLoading = true;
                    // Add a small delay to show loading state
                    await new Promise(resolve => setTimeout(resolve, 500));
                    form.submit();
                }
            }
        }
    </script>
</body>
</html>
