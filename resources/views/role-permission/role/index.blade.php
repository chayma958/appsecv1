<x-app-layout>
    <div class="container mx-auto mt-5 px-4">
        <div class="flex justify-between mb-5">
            
            @can('create role')
            <div>
                <a href="{{ url('roles/create') }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">Add Role</a>
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
                <h4 class="text-xl font-semibold">Roles</h4>
            </div>
            <div class="p-4">
                <table class="table-auto w-full bg-white rounded-lg shadow">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="py-2 px-4">Id</th>
                            <th class="py-2 px-4">Name</th>
                            <th class="py-2 px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr class="border-b">
                            <td class="py-2 px-4 text-center">{{ $role->id }}</td>
                            <td class="py-2 px-4">{{ $role->name }}</td>
                            <td class="py-2 px-4 space-x-2">
                                <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-3 rounded-lg">Add / Edit Role Permission</a>

                                @can('update role')
                                <a href="{{ url('roles/'.$role->id.'/edit') }}" class="bg-green-500 hover:bg-green-700 text-white py-1 px-3 rounded-lg">Edit</a>
                                @endcan

                                @can('delete role')
                                <a href="{{ url('roles/'.$role->id.'/delete') }}" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded-lg">Delete</a>
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
