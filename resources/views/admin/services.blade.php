<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Services API') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>List Services API</h1>

                    <div>
                        <h4>Followers</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">name</th>
                                <th scope="col">type</th>
                                <th scope="col">refill</th>
                                <th scope="col">rate</th>
                                <th scope="col">min</th>
                                <th scope="col">max</th>
                                <th scope="col">drops</th>
                                <th scope="col">speed per hour</th>
                                <th scope="col">max done count day</th>
                                <th scope="col">limit</th>
                                <th scope="col">queue time minutes</th>
                                <th scope="col">cancel</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($services as $service)
                                @if($service->category == 3)

                                <tr>
                                    <td>{{isset($service->service) && $service->service != null ? $service->service : '-'}}</td>
                                    <td>{{$service->name ?? '-'}}</td>
                                    <td>{{$service->type ?? '-'}}</td>
                                    <td>{{isset($service->refill) && $service->refill != null ? $service->refill : '-'}}</td>
                                    <td>{{$service->rate ?? '-'}}</td>
                                    <td>{{$service->min ?? '-'}}</td>
                                    <td>{{$service->max ?? '-'}}</td>
                                    <td>{{$service->drops ?? '-'}}</td>
                                    <td>{{$service->speed_per_hour ?? '-'}}</td>
                                    <td>{{$service->max_done_count_day ?? '-'}}</td>
                                    <td>{{$service->limit ?? '-'}}</td>
                                    <td>{{$service->queue_time_minutes ?? '-'}}</td>
                                    <td>{{$service->cancel ?? '-'}}</td>
                                </tr>
                                @endif
                            @endforeach


                            </tbody>

                        </table>

                        <h4>Likes</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">name</th>
                                <th scope="col">type</th>
                                <th scope="col">refill</th>
                                <th scope="col">rate</th>
                                <th scope="col">min</th>
                                <th scope="col">max</th>
                                <th scope="col">drops</th>
                                <th scope="col">speed per hour</th>
                                <th scope="col">max done count day</th>
                                <th scope="col">limit</th>
                                <th scope="col">queue time minutes</th>
                                <th scope="col">cancel</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                @if($service->category == 4)

                                    <tr>
                                        <td>{{$service->service ?? '-'}}</td>
                                        <td>{{$service->name ?? '-'}}</td>
                                        <td>{{$service->type ?? '-'}}</td>
                                        <td>{{isset($service->refill) && $service->refill != null ? $service->refill : '-'}}</td>
                                        <td>{{$service->rate ?? '-'}}</td>
                                        <td>{{$service->min ?? '-'}}</td>
                                        <td>{{$service->max ?? '-'}}</td>
                                        <td>{{$service->drops ?? '-'}}</td>
                                        <td>{{$service->speed_per_hour ?? '-'}}</td>
                                        <td>{{$service->max_done_count_day ?? '-'}}</td>
                                        <td>{{$service->limit ?? '-'}}</td>
                                        <td>{{$service->queue_time_minutes ?? '-'}}</td>
                                        <td>{{$service->cancel ?? '-'}}</td>
                                    </tr>
                                @endif
                            @endforeach

                            </tbody>
                        </table>

                        <h4>Comments</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">name</th>
                                <th scope="col">type</th>
                                <th scope="col">refill</th>
                                <th scope="col">rate</th>
                                <th scope="col">min</th>
                                <th scope="col">max</th>
                                <th scope="col">drops</th>
                                <th scope="col">speed per hour</th>
                                <th scope="col">max done count day</th>
                                <th scope="col">limit</th>
                                <th scope="col">queue time minutes</th>
                                <th scope="col">cancel</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                @if($service->category == 6)

                                    <tr>
                                        <td>{{$service->service ?? '-'}}</td>
                                        <td>{{$service->name ?? '-'}}</td>
                                        <td>{{$service->type ?? '-'}}</td>
                                        <td>{{isset($service->refill) && $service->refill != null ? $service->refill : '-'}}</td>
                                        <td>{{$service->rate ?? '-'}}</td>
                                        <td>{{$service->min ?? '-'}}</td>
                                        <td>{{$service->max ?? '-'}}</td>
                                        <td>{{$service->drops ?? '-'}}</td>
                                        <td>{{$service->speed_per_hour ?? '-'}}</td>
                                        <td>{{$service->max_done_count_day ?? '-'}}</td>
                                        <td>{{$service->limit ?? '-'}}</td>
                                        <td>{{$service->queue_time_minutes ?? '-'}}</td>
                                        <td>{{$service->cancel ?? '-'}}</td>
                                    </tr>
                                @endif
                            @endforeach

                            </tbody>
                        </table>

                        <h4>Views</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">name</th>
                                <th scope="col">type</th>
                                <th scope="col">refill</th>
                                <th scope="col">rate</th>
                                <th scope="col">min</th>
                                <th scope="col">max</th>
                                <th scope="col">drops</th>
                                <th scope="col">speed per hour</th>
                                <th scope="col">max done count day</th>
                                <th scope="col">limit</th>
                                <th scope="col">queue time minutes</th>
                                <th scope="col">cancel</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                @if($service->category == 5)

                                    <tr>
                                        <td>{{$service->service ?? '-'}}</td>
                                        <td>{{$service->name ?? '-'}}</td>
                                        <td>{{$service->type ?? '-'}}</td>
                                        <td>{{isset($service->refill) && $service->refill != null ? $service->refill : '-'}}</td>
                                        <td>{{$service->rate ?? '-'}}</td>
                                        <td>{{$service->min ?? '-'}}</td>
                                        <td>{{$service->max ?? '-'}}</td>
                                        <td>{{$service->drops ?? '-'}}</td>
                                        <td>{{$service->speed_per_hour ?? '-'}}</td>
                                        <td>{{$service->max_done_count_day ?? '-'}}</td>
                                        <td>{{$service->limit ?? '-'}}</td>
                                        <td>{{$service->queue_time_minutes ?? '-'}}</td>
                                        <td>{{$service->cancel ?? '-'}}</td>
                                    </tr>
                                @endif
                            @endforeach

                            </tbody>
                        </table>

                        <h4>Statistics</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">name</th>
                                <th scope="col">type</th>
                                <th scope="col">refill</th>
                                <th scope="col">rate</th>
                                <th scope="col">min</th>
                                <th scope="col">max</th>
                                <th scope="col">drops</th>
                                <th scope="col">speed per hour</th>
                                <th scope="col">max done count day</th>
                                <th scope="col">limit</th>
                                <th scope="col">queue time minutes</th>
                                <th scope="col">cancel</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                @if($service->category == 7)

                                    <tr>
                                        <td>{{$service->service ?? '-'}}</td>
                                        <td>{{$service->name ?? '-'}}</td>
                                        <td>{{$service->type ?? '-'}}</td>
                                        <td>{{isset($service->refill) && $service->refill != null ? $service->refill : '-'}}</td>
                                        <td>{{$service->rate ?? '-'}}</td>
                                        <td>{{$service->min ?? '-'}}</td>
                                        <td>{{$service->max ?? '-'}}</td>
                                        <td>{{$service->drops ?? '-'}}</td>
                                        <td>{{$service->speed_per_hour ?? '-'}}</td>
                                        <td>{{$service->max_done_count_day ?? '-'}}</td>
                                        <td>{{$service->limit ?? '-'}}</td>
                                        <td>{{$service->queue_time_minutes ?? '-'}}</td>
                                        <td>{{$service->cancel ?? '-'}}</td>
                                    </tr>
                                @endif
                            @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
