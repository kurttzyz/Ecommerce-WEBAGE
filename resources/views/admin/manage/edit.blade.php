@extends('admin.layouts.layout')
@section('title_admin', 'Create Admin/Secretary')
@section('admin_layout')
    <div class="max-w-lg mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-xl font-bold mb-4">Edit User</h2>

        <form action="{{ route('update.user', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="first_name" class="block text-sm font-medium">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" required
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label for="last_name" class="block text-sm font-medium">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" required
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="w-full border px-3 py-2 rounded">
            </div>


            <div class="mb-4">
                <label for="address" class="block text-sm font-medium">Address</label>
                <input type="address" name="address" value="{{ old('address', $user->address) }}" required
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label for="contact_number" class="block text-sm font-medium">Contact Number</label>
                <input type="text" name="contact_number" value="{{ old('contact_number', $user->contact_number) }}" required
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium">Role</label>
                <select name="role" required class="w-full border px-3 py-2 rounded">
                    <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Admin/Secretary</option>
                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Mentor</option>
                    <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Student</option>
                </select>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.users') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>

@endsection