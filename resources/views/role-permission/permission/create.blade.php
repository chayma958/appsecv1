<x-app-layout>
<x-navbar />

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
                    <div class="bg-red-500 text-white p-4 rounded-t-lg">
                        <h4 class="text-xl font-semibold">Create Permission
                            <a href="{{ url('permissions') }}" class="float-right bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Back</a>
                        </h4>
                    </div>
                    <div class="p-4">
                        <form action="{{ url('permissions') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="block text-sm font-medium text-gray-700">Permission Name</label>
                                <input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
