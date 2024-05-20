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
                    <h1>Create user</h1>
                    <form action="{{ url('admin/users/' . $user->id ) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" value="{{$user->email}}">
                        </div>
                        <mb-3>
                            <label for="type" class="form-label">Type users</label>
                            <select class="form-select" name="type">
                                <option value="0" {{$user->type == '0' ? 'selected' : ''}}>Client</option>
                                <option value="1" {{$user->type == '1' ? 'selected' : ''}}>Manager</option>
                                <option value="2" {{$user->type == '2' ? 'selected' : ''}}>Admin</option>
                            </select>
                        </mb-3>
                        <br>
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
