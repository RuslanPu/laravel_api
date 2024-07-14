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
                    <h1>Packages List</h1>
                </div>
            </div>

            <br>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <a href="{{ url('admin/package/create') }}">
                            <x-primary-button>{{ __('Create') }}</x-primary-button>
                        </a>
                        <div>
                            <div class="container-sm mt-5">
                                @foreach($packages as $package)
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                ID:
                                                <span class="badge text-bg-success">{{ $package->id }}</span>
                                            </h5>

                                            <p class="card-text">
                                                Name:
                                                <span class="badge text-bg-success">{{ $package->name }} </span>

                                            </p>
                                            <p class="card-text">
                                                Description:
                                                <div class="alert alert-dark">{{ $package->description }}</div>
                                            </p>

                                            <br>

                                            <h6>Services</h6>
                                            <div class="m-3 flex-grow-1">
                                                @foreach($package->services as $service)
                                                    <span class="mb-lg-1 badge rounded-pill text-bg-primary">{{$service->name}}</span>
                                                @endforeach
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <a class="btn btn-primary m-1" href="{{ url('admin/users/'.$package->id.'/edit') }}">Edit</a>

                                                <form action="{{ url('admin/packages/'.$package->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="m-1 btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
