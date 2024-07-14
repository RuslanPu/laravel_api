<!-- resources/views/admin/users/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users and Packages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach($users as $user)
                        <div class="mb-6">
                            <h3 class="text-lg font-bold">{{ $user->name }} ({{ $user->email }})</h3>
                            <p>Type: {{ $user->type }}</p>
                            <h4 class="font-semibold mt-4">Packages:</h4>
                            <ul>
                                @foreach($user->packages as $package)
                                    <li>
                                        <strong>{{ $package->name }}</strong> - {{ $package->description }}
                                        <ul>
                                            @foreach($package->services as $service)
                                                <li>{{ $service->name }} ({{ $service->type }})</li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>

                            <form action="{{ route('admin.users.addPackage', $user) }}" method="POST" class="mt-4">
                                @csrf
                                <label for="package_id_{{ $user->id }}" class="form-label">Add Package:</label>
                                <select name="package_id" id="package_id_{{ $user->id }}" class="form-control mb-2">
                                    @foreach($packages as $package)
                                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                                    @endforeach
                                </select>
                                <x-primary-button>{{ __('Add Package') }}</x-primary-button>
                            </form>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
