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
                    <h1>Statistic</h1>

                    @if ($ApiAvailability)
                        <table class="table table-dark table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Order ID</th>
                                <!-- <th scope="col">Charge</th> -->
                                <th scope="col">Remains</th>
                                <th scope="col">Status</th>
                                <th scope="col">Start Count</th>
                                <!-- <th scope="col">Currency</th> -->
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $orderId => $order)
                                <tr>
                                    <th scope="row">{{ $orderId }}</th>
                                    <!-- <td>{{ $order['charge'] }}</td> -->
                                    <td>{{ $order['remains'] }}</td>
                                    <td>{{ $order['status'] }}</td>
                                    <td>{{ $order['start_count'] }}</td>
                                    <!-- <td>{{ $order['currency'] }}</td> -->
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <a href="{{ route('client.statistic.index') }}" class="btn btn-primary mt-3">Refresh</a>
                    @else
                        <div class="alert alert-warning" role="alert">
                            At the moment the API service is unavailable or overloaded with requests, please try again your request after some time
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
