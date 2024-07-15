<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h1>Create client</h1>
                    <form action="{{ route('manager-users.store') }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="account_type">Account Type:</label>
                            <select class="form-select" name="account_type" id="account_type" onchange="toggleAccountLink()">
                                <option value="">Select Account Type</option>
                                @foreach ($accountTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name_social_network }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('account_type')" class="mt-2" />
                        </div>
                        <div class="mt-4" id="account-link-container" style="display:none;">
                            <x-input-label for="account_link" :value="__('Account Link')" />
                            <x-text-input id="account_link" class="block mt-1 w-full" type="url" name="account_link" :value="old('account_link')" />
                            <x-input-error :messages="$errors->get('account_link')" class="mt-2" />
                        </div>

                        <br>

                        <div class="mb-3">
                            <label for="packages">Packages:</label>
                            <select multiple class="form-select" name="packages[]" id="packages">
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('packages.*')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>{{ __('Create') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function toggleAccountLink() {
        var accountType = document.getElementById('account_type').value;
        var accountLinkContainer = document.getElementById('account-link-container');

        if (accountType) {
            accountLinkContainer.style.display = 'block';
        } else {
            accountLinkContainer.style.display = 'none';
        }
    }
</script>
