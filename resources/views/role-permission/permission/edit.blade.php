<x-app-layout>
<x-navbar />

    <div class="container mx-auto mt-5 px-4">
        <div class="row">
            <div class="col-md-12">

                @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                @endif

                <div class="bg-white shadow rounded-lg">
                <div class="bg-red-500 text-white p-4 rounded-t-lg">
                        <h4 class="text-xl font-semibold">Edit Permission
                            <a href="{{ url('permissions') }}" class="float-right bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('permissions/'.$permission->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Permission Name</label>
                            <input type="text" name="name" value="{{ $permission->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>