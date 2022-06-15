<x-guest-layout>
    <x-auth-card>
        <script>
            function checkEmail(input) {
                const emailFail = document.querySelector('#invalidEmail');
                if(emailFail !== null) emailFail.remove();
                if(input.includes('@') && input.includes('.', input.length - 4) && !input.includes(' ')) return;
                const emailDiv = document.querySelector('#emailDiv');
                const emailFailDiv = document.createElement('div');
                emailFailDiv.setAttribute('id', 'invalidEmail')
                emailFailDiv.innerHTML = '<p class="block font-medium text-sm text-red-600">Please enter a valid Email address.</p>'
                emailDiv.appendChild(emailFailDiv);
            }
        </script>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div id="emailDiv" class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" onchange="checkEmail(this.value)" required title="Please enter a valid email address"></x-input>
{{--                <p id="invalidEmail" class="block font-medium text-sm text-red-600">Please enter a valid Email address.</p>--}}
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{12,}"
                                title="Must contain at least one number and one uppercase and lowercase letter, and at least 12 or more characters"
                                required
                                autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

