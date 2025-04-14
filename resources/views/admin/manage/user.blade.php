@extends('admin.layouts.layout')
@vite('resources/css/app.css')
@section('title_admin')
Users - Admin Panel
@endsection

@section('admin_layout')
<div class="max-w-full">

    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33'
        });
    </script>
    @endif


    <h2 >
        @if($role === '0')
            Admin Users
        @elseif($role === '2')
            Customer Users
        @else
            All Users
        @endif
    </h2>

    <div class="w-full overflow-x-auto rounded-lg border border-gray-200 dark:border-neutral-700 shadow-sm">
        <table class="min-w-full table-auto divide-y divide-gray-200 dark:divide-neutral-700">
            <thead class="bg-gray-50 dark:bg-neutral-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Actions</th>
                    
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-neutral-900 dark:divide-neutral-800">
                @foreach($users as $user)
                    <tr>
                        <td class="px-5 py-2 text-sm text-black dark:text-white">
                            {{ $user->created_at->format('F d, Y - h:i A') }}
                        </td>
                        <td class="px-6 py-4 text-sm text-black dark:text-white">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-sm text-black dark:text-neutral-300">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="inline-block px-2 py-1 text-xs font-medium rounded-full 
                                {{ $user->role == 0 ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' }}">
                                {{ $user->role == 0 ? 'Admin' : ($user->role == 2 ? 'Customer' : 'Seller') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <form action="{{ route('delete.user', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 !bg-red-600">
                                    Delete
                                </button>
                            </form>
                            
                        </td>
                      
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
