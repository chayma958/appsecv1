    <div class="container mx-auto mt-5 px-4">
        <div class="row">
            <div class="col-md-12">

                @if ($errors->any())
                <ul class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                @endif

                <div class="bg-white shadow rounded-lg">
                    <div class="bg-blue-500 text-white p-4 rounded-t-lg">
                        <h4 class="text-xl font-semibold">Create User
                            <a href="{{ url('users') }}" class="float-right bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Back</a>
                        </h4>
                    </div>
                    <div class="p-4">
                        <form action="{{ url('users') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
                                <input type="text" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                                @error('name') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                                <input type="text" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                                @error('email') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                                <input type="text" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                                @error('password') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="roles">Roles</label>
                                <select name="roles[]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" multiple>
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
                                @error('roles') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
