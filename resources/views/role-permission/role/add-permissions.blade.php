<x-app-layout>
    <div class="container mx-auto mt-5 px-4">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="bg-white shadow rounded-lg">
                    <div class="bg-red-500 text-white p-4 rounded-t-lg">
                        <h4 class="text-xl font-semibold">Role: {{ $role->name }}
                            <a href="{{ url('roles') }}" class="float-right bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Back</a>
                        </h4>
                    </div>
                    <div class="p-4">
                        <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                @error('permission')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                @enderror

                                <label class="block text-gray-700 text-sm font-bold mb-2">Permissions</label>

                                <div class="grid grid-cols-2 gap-4">
                                    @foreach ($permissions as $permission)
                                    <div>
                                        <label class="flex items-center">
                                            <input
                                                type="checkbox"
                                                name="permission[]"
                                                value="{{ $permission->name }}"
                                                {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                                class="form-checkbox h-4 w-4 text-blue-600"
                                            />
                                            <span class="ml-2">{{ $permission->name }}</span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                            <div class="mb-4">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
