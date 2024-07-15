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

                        <h3>Managers</h3>

                        <div class="mb-3">
                            <label for="managers">Change managers for this package:</label>
                            <select multiple class="form-select" name="managers[]" id="managers">
                                @foreach ($managers as $manager)
                                    <option value="{{ $manager->id }}" {{ in_array($manager->id, $package->managers->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $manager->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <h3>Services</h3>
                        <div id="service-form-group">
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" id="category" onchange="updateServices()">
                                    <option value="">Select Category</option>
                                    @foreach ($servicesByCategory as $category => $services)
                                        <option value="{{ $category }}">{{ $category }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="service" class="form-label">Service</label>
                                <select class="form-select" id="service" onchange="updateServiceFields()">
                                    <option value="">Select Service</option>
                                </select>
                            </div>

                            <div id="service-fields"></div>

                            <button type="button" class="btn btn-secondary" onclick="addService()">Add Service</button>
                        </div>

                        <div id="services-container" class="mt-4">
                            <!-- Динамически добавляемые услуги будут появляться здесь -->
                            @foreach($packageServices as $packageService)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">Name: {{$packageService->service->name}}</h5>
                                        <p class="card-text text-muted">Type: {{$packageService->service->type}}</p>
                                        @if($quantity = $packageService->quantity)
                                            <div class="mb-3">
                                                <label for="quantities" class="form-label">Quantity:</label>
                                                <input type="number" class="form-control" name="quantities[{{$packageService->id}}]" value="{{$quantity}}">
                                            </div>
                                        @endif
                                        @if ($comments = $packageService->comments)
                                            <div class="mb-3">
                                                <label for="comments" class="form-label">Comments:</label>
                                                <input type="text" class="form-control" name="comments[{{$packageService->id}}]" value="{{$comments}}">
                                            </div>
                                        @endif
                                        <input type="hidden" name="services[]" value="{{$packageService->id}}">

                                        <button type="button" class="btn btn-danger" onclick="removeService(this)">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const servicesByCategory = @json($servicesByCategory);

        function updateServices() {
            const category = document.getElementById('category').value;
            const serviceSelect = document.getElementById('service');
            serviceSelect.innerHTML = '<option value="">Select Service</option>';

            if (category && servicesByCategory[category]) {
                servicesByCategory[category].forEach(service => {
                    serviceSelect.innerHTML += `<option value="${service.id}" data-type="${service.type}">${service.name}</option>`;
                });
            }
        }

        function updateServiceFields() {
            const serviceSelect = document.getElementById('service');
            const selectedService = serviceSelect.options[serviceSelect.selectedIndex];
            const serviceType = selectedService.getAttribute('data-type');
            const serviceFields = document.getElementById('service-fields');
            serviceFields.innerHTML = '';

            if (serviceType === 'Default') {
                serviceFields.innerHTML = `
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity">
                    </div>
                `;
            } else if (serviceType === 'Custom Comments') {
                serviceFields.innerHTML = `
                    <div class="mb-3">
                        <label for="comments" class="form-label">Comments</label>
                        <textarea class="form-control" id="comments"></textarea>
                    </div>
                `;
            }
        }

        function addService() {
            const serviceSelect = document.getElementById('service');
            const selectedService = serviceSelect.options[serviceSelect.selectedIndex];
            const serviceId = selectedService.value;
            const serviceName = selectedService.text;
            const serviceType = selectedService.getAttribute('data-type');
            const quantity = document.getElementById('quantity') ? document.getElementById('quantity').value : '';
            const comments = document.getElementById('comments') ? document.getElementById('comments').value : '';

            if (serviceId) {
                const servicesContainer = document.getElementById('services-container');
                const serviceBlock = document.createElement('div');
                serviceBlock.className = 'card mb-3';
                serviceBlock.innerHTML = `
                    <div class="card-body">
                        <h5 class="card-title text-primary">Name: ${serviceName}</h5>
                        <p class="card-text text-muted">Type: ${serviceType}</p>
                        ${quantity ? `
                        <div class="mb-3">
                            <label for="quantities" class="form-label">Quantity:</label>
                            <input type="number" class="form-control" name="quantities[${serviceId}]" value="${quantity}">
                        </div>` : ''}
                        ${comments ? `
                        <div class="mb-3">
                            <label for="comments" class="form-label">Comments:</label>
                            <input type="text" class="form-control" name="comments[${serviceId}]" value="${comments}">
                        </div>` : ''}
                        <input type="hidden" name="services[]" value="${serviceId}">
                        <button type="button" class="btn btn-danger" onclick="removeService(this)">Remove</button>
                    </div>
                `;
                servicesContainer.appendChild(serviceBlock);
            }
        }

        function removeService(button) {
            button.parentElement.parentElement.remove();
        }
    </script>
</x-app-layout>
