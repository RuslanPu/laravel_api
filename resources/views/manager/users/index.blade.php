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
                    <h1>List managers</h1>
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
                                    <span class="badge text-bg-success">{{ $client->type }}</span>
                                </p>

                                <br>

                                <h6>Packages</h6>
                                <div class="m-3 flex-grow-1">
                                    @foreach($client->clientPackages as $package)
                                        <span class="mb-lg-1 badge rounded-pill text-bg-primary">{{ $package->name }}</span>
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
