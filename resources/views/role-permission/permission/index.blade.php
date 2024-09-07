<x-app-layout>
<x-navbar />

    <div class="container mx-auto mt-5 px-4" style="background-color:#1e1e1e">
        <div class="flex justify-between mb-5">
            @can('create permission')
            <div>
                <a href="{{ url('permissions/create') }}" data-route="{{ route('permissions.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">Add Permission</a>
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
                <h4 class="text-xl font-semibold">Permissions</h4>
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
                        @foreach ($permissions as $permission)
                        <tr class="border-b">
                            <td class="py-2 px-4 text-center">{{ $permission->id }}</td>
                            <td class="py-2 px-4">{{ $permission->name }}</td>
                            <td class="py-2 px-4 space-x-2 text-center">
                                @can('update permission')
                                <a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="bg-green-500 hover:bg-green-700 text-white py-1 px-3 rounded-lg">Edit</a>
                                @endcan

                                @can('delete permission')
                                <a href="{{ url('permissions/'.$permission->id.'/delete') }}" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded-lg">Delete</a>
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
