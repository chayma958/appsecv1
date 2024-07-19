<x-app-layout>
    <div class="container mx-auto mt-5 px-4">
        <div class="flex justify-between mb-5">
            @can('create user')
            <div>
                <a href="{{ url('users/create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg">Add User</a>
            </div>
            @endcan
        </div>

        @if (session('status'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('status') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg">
            <div class="bg-blue-500 text-white p-4 rounded-t-lg">
                <h4 class="text-xl font-semibold">Users</h4>
            </div>
            <div class="p-4">
                <table class="table-auto w-full bg-white rounded-lg shadow">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="py-2 px-4">Id</th>
                            <th class="py-2 px-4">Name</th>
                            <th class="py-2 px-4">Email</th>
                            <th class="py-2 px-4">Roles</th>
                            <th class="py-2 px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="border-b">
                            <td class="py-2 px-4 text-center">{{ $user->id }}</td>
                            <td class="py-2 px-4 text-center">{{ $user->name }}</td>
                            <td class="py-2 px-4 text-center">{{ $user->email }}</td>
                            <td class="py-2 px-4 text-center">
                                @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $rolename)
                                        <label class="badge bg-primary mx-1">{{ $rolename }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td class="py-2 px-4 text-center space-x-2">
                                @can('update user')
                                <a href="{{ url('users/'.$user->id.'/edit') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-3 rounded-lg">Edit</a>
                                @endcan

                                @can('delete user')
                                <a href="{{ url('users/'.$user->id.'/delete') }}" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded-lg mx-2">Delete</a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
