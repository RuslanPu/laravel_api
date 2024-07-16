<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>List clients</h1>
                    <a href="{{ url('manager/client/create') }}">
                        <x-primary-button>{{ __('Create') }}</x-primary-button>
                    </a>

                    <div>
                        @php
                            $can = Auth()->user()->type === 1;
                        @endphp
                        <div class="container-sm mt-5">
                            @foreach($clients as $client)
                                <div class="card mb-3">
                            <span class="card-body">
                                <h5 class="card-title">
                                    ID:
                                    <span class="badge text-bg-success">{{ $client->id }}</span>
                                </h5>

                                <p class="card-text">
                                    Name:
                                    <span class="badge text-bg-success">{{ $client->name }} </span>

                                </p>
                                <p class="card-text">
                                    Description:
                                    <span class="badge text-bg-success">{{ $client->email }}</span>
                                </p>
                                <p class="card-text">
                                    Type:
                                    <span class="badge text-bg-success">{{ $client?->type }}</span>
                                </p>

                                <p class="card-text">
                                    Account link:
                                    <span class="badge text-bg-success">{{ $client?->account?->account_link }}</span>
                                </p>

                                <p class="card-text">
                                    Account Type:
                                    <span class="badge text-bg-success">{{ $client?->account?->type?->name_social_network }}</span>
                                </p>

                                <p class="card-text">
                                    Publications links:
                                    @foreach($client?->socialAccountPublicationsLinks as $publicationsLinks)
                                        <span class="badge text-bg-success">{{ $publicationsLinks->publication_link }}</span>
                                    @endforeach
                                </p>

                                <br>

                                <h6>Packages</h6>
                                <div class="m-3 flex-grow-1">
                                    @foreach($client->activeClientPackages as $clientPackage)
                                        <div class="mb-2 badge bg-gray-100 dark:bg-gray-900 text-center p-3 w-25">
                                            <div class="w-100 text-start">
                                                <div>
                                                    <h6>Package:</h6>
                                                    <p class="mb-3 w-100 text-wrap"><strong>ID:</strong> {{ $clientPackage->id }}</p>
                                                    <p class="mb-3 w-100 text-wrap"><strong>Name:</strong> {{ $clientPackage->package->name }}</p>
                                                </div>

                                                <hr>

                                                <div>
                                                    <h6>Serveces:</h6>
                                                    @foreach($clientPackage->packageServicesApiServices as $clientService)
                                                        <div class="border-1 p-1 m-1 rounded-[10px]">
                                                            <p class="mb-3 w-100 text-wrap"><strong>ID:</strong> {{ $clientService->id }}</p>
                                                            <p class="mb-3 w-100 text-wrap"><strong>Name:</strong> {{ $clientService->service->name }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @if($clientPackage->valid)
                                                <div class="text-success m-2 p-2">
                                                    <span class="badge text-bg-success">Valid until: {{ $clientPackage->finish_date_time ?? 'Unknown' }}</span>
                                                </div>

                                                <!-- <form action="{{ url('manager/client/package/' . $clientPackage->id) . '/stop' }}" method="POST" onsubmit="return confirm('Are you sure you want to start this package for client?');">
                                                    @csrf
                                                    @method('PUT')
                                                     <button type="submit" class="w-50 m-1 btn btn-danger">Stop</button>
                                                </form> -->
                                            @else
                                                 <form action="{{ url('manager/client/package/' . $clientPackage->id) . '/start' }}"
                                                       class="flex-column"
                                                       method="POST"
                                                       onsubmit="return confirm('Are you sure you want to start this package for client?');">
                                                 @csrf
                                                 @method('PUT')
                                                     <button type="submit" class="w-50 m-1 justify-center btn btn-success">Start</button>
                                                 </form>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                @if($can)
                                    <div class="d-flex justify-content-end">

                                        <a class="btn btn-primary m-1" href="{{ url('manager/client/edit/'.$client->id) }}">Edit</a>

                                        <form action="{{ url('manager/client/delete/'.$client->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this package?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="m-1 btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
