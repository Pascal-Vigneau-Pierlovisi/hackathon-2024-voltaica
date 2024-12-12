@extends('base')
@section('content')
    <div class="flex h-screen bg-gray-100">


        <!-- Main content area -->
        <div class="flex-1 p-8">
            <!-- Dashboard -->
            <h1 class="text-3xl font-semibold">Dashboard</h1>
            <p class="mt-4 text-gray-600">Welcome to your dashboard! Here's an overview of your data.</p>

            <!-- Dashboard Cards (for metrics) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-8">
                <!-- Card 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold text-gray-800">Total Orders</h2>
                    <p class="text-3xl text-blue-600">1,245</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold text-gray-800">Revenue</h2>
                    <p class="text-3xl text-green-600">$15,600</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold text-gray-800">Active Users</h2>
                    <p class="text-3xl text-yellow-600">765</p>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white p-6 mt-8 rounded-lg shadow-md overflow-x-auto">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Recent Orders</h2>
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700">Order ID</th>
                        <th class="px-4 py-2 text-left text-gray-700">Customer</th>
                        <th class="px-4 py-2 text-left text-gray-700">Date</th>
                        <th class="px-4 py-2 text-left text-gray-700">Status</th>
                        <th class="px-4 py-2 text-left text-gray-700">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="border-t">
                        <td class="px-4 py-2">#12345</td>
                        <td class="px-4 py-2">John Doe</td>
                        <td class="px-4 py-2">12/10/2024</td>
                        <td class="px-4 py-2 text-green-600">Completed</td>
                        <td class="px-4 py-2">$250</td>
                    </tr>
                    <tr class="border-t">
                        <td class="px-4 py-2">#12346</td>
                        <td class="px-4 py-2">Jane Smith</td>
                        <td class="px-4 py-2">12/09/2024</td>
                        <td class="px-4 py-2 text-yellow-600">Pending</td>
                        <td class="px-4 py-2">$300</td>
                    </tr>
                    <tr class="border-t">
                        <td class="px-4 py-2">#12347</td>
                        <td class="px-4 py-2">Mark Wilson</td>
                        <td class="px-4 py-2">12/08/2024</td>
                        <td class="px-4 py-2 text-red-600">Canceled</td>
                        <td class="px-4 py-2">$150</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
