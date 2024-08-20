<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-3 gap-4">
        <!-- Sidebar -->
        <div class="col-span-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900">Users management</h3>
                <ul class="mt-4 space-y-2">
                    <li>
                        <a href="{{ url('roles') }}" class="text-blue-500 hover:underline">Roles</a>
                    </li>
                    <li>
                        <a href="{{ url('permissions') }}" class="text-blue-500 hover:underline">Permissions</a>
                    </li>
                    <li>
                        <a href="{{ url('users') }}" class="text-blue-500 hover:underline">Users</a>
                    </li>
                </ul>
            </div>
            <div class="p-6">Firewall</h3>
            <ul class="mt-4 space-y-2">
        <li>
            <a href="{{ route('firewall.create') }}" class="text-blue-500 hover:underline">Add Firewall Rule</a>
        </li>
        
    </ul>
           
        </div>

        <!-- Main Content -->
        <div class="col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                {{ __("You're logged in!") }}
            </div>
        </div>
    </div>
    
</x-app-layout>
