@extends('admin.layouts.layout')
@vite('resources/css/app.css')
@section('title_admin')
Admin Dashboard
@endsection

@section('admin_layout')


<div class="px-6 py-4">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-semibold text-black dark:text-white">Dashboard Overview</h1>
        <p class="text-black-500 dark:text-black-400 mt-1">Welcome back, Administrator</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-black dark:text-gray-400">Total Users</p>
                    <h3 class="text-2xl font-bold text-black dark:text-white mt-1">{{ $totalUsers }}</h3>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                <span class="text-sm text-blue-600 dark:text-blue-400 font-medium">+2.5% from last month</span>
            </div>
        </div>

        <!-- Total Admins -->
       
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-black dark:text-gray-400">Administrators</p>
                    <h3 class="text-2xl font-bold text-black dark:text-white mt-1">{{ $totalAdmins }}</h3>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                <span class="text-sm text-gray-500 dark:text-gray-400 font-medium">Last updated today</span>
            </div>
        </div>
    
        <!-- Total Sellers -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-black dark:text-black">Sellers</p>
                    <h3 class="text-2xl font-bold text-black dark:text-black mt-1">{{ $totalSellers }}</h3>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                <span class="text-sm text-green-600 dark:text-green-400 font-medium">+12 new this month</span>
            </div>
        </div>

        <!-- Total Customers -->

       
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-black dark:text-black">Customers</p>
                    <h3 class="text-2xl font-bold text-black dark:text-black mt-1">{{ $totalCustomers }}</h3>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                <span class="text-sm text-amber-600 dark:text-amber-400 font-medium">+5.2% growth</span>
            </div>
        </div>
        
    </div>
</div>
@endsection
