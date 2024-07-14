<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Package') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ url('admin/packages/update', ['package' => $package->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Package Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $package->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3" required>{{ $package->description }}</textarea>
                        </div>

                        <br>

                        <h6>Managers</h6>

                        <div class="mb-3">
                            <label for="managers">Change managers for this package:</label>
                            <select multiple class="form-select" name="managers[]" id="managers">
                                @foreach ($managers as $manager)
                                    <option value="{{ $manager->id }}" {{ in_array($manager->id, $package->managers->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $manager->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>

                        <h6>Services</h6>

                        @foreach ($servicesByType as $type => $services)
                            <div class="mb-3">
                                <label for="services-{{ $type }}" class="form-label">{{ $type }}:</label>
                                <select multiple class="form-select" name="services[{{ $type }}][]" id="services-{{ $type }}">
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}" {{ in_array($service->id, $package->services->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
