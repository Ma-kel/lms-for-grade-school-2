<x-guest-layout>

    <x-auth-card>
        
        <x-slot name="logo">
            <a href="/">
               <x-application-logo class="w-full fill-current text-gray-500" />
            </a>
        </x-slot>
            
        <div class="">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
            
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('login') }}">
                @csrf
    
                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" />
    
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>
    
                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />
    
                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                </div>
    
                <div class="w-full py-4 text-center">
                    <x-button class="my-2">
                        {{ __('Login') }}
                    </x-button>
                    @if (Route::has('password.request'))
                        <a class="underline text-md" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Remember Me -->
                <!-- <div class="block">
                    <label for="remember_me" class="inline-flex items-center justify-between w-full">
                        <div> 
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </div>
                        
                        @if (Route::has('login'))
                            <div class="w-full text-center">
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-sm text-gray-700 hover:underline">Create an account</a>
                                @endif
                            </div>
                        @endif
                    </label>
                </div> -->

            </form>
        </div>

    </x-auth-card>
</x-guest-layout>
