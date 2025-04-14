<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-black text-white flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 min-h-screen p-6 flex flex-col">
        <div class="flex items-center gap-3 mb-6">
            <img src="https://via.placeholder.com/50" alt="User Avatar" class="w-12 h-12 rounded-full border-2 border-gray-600">
            <div>
                <h2 class="text-lg font-semibold">John Doe</h2>
                <p class="text-sm text-gray-400">johndoe@example.com</p>
            </div>
        </div>
        <nav class="flex-1">
            <ul class="space-y-3">
                <li><a href="#" class="block p-3 bg-gray-800 rounded-lg hover:bg-gray-700">🛒 Orders</a></li>
                <li><a href="#" class="block p-3 bg-gray-800 rounded-lg hover:bg-gray-700">❤️ Wishlist</a></li>
                <li><a href="#" class="block p-3 bg-gray-800 rounded-lg hover:bg-gray-700">⚙️ Settings</a></li>
                <li><a href="#" class="block p-3 bg-gray-800 rounded-lg hover:bg-gray-700">🔔 Notifications</a></li>
                <li><a href="#" class="block p-3 bg-gray-800 rounded-lg hover:bg-gray-700">💳 Cart</a></li>
                <li><a href="#" class="block p-3 bg-gray-800 rounded-lg hover:bg-gray-700">💰 Payments</a></li>
                <li><a href="#" class="block p-3 bg-gray-800 rounded-lg hover:bg-gray-700">🎁 Rewards</a></li>
                <li><a href="#" class="block p-3 bg-gray-800 rounded-lg hover:bg-gray-700">🛡 Security</a></li>
            </ul>
        </nav>
        <button class="mt-6 p-3 bg-red-600 rounded-lg hover:bg-red-500">🚪 Logout</button>
    </aside>
    
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">User Dashboard</h1>
            <button id="darkModeToggle" class="p-2 bg-gray-800 rounded-lg hover:bg-gray-700">🌙 Dark Mode</button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-r from-gray-800 to-gray-900 p-6 rounded-lg shadow-lg transform transition-transform hover:scale-105">
                <h2 class="text-xl font-semibold">Orders</h2>
                <p class="text-4xl font-bold mt-2">12</p>
            </div>
            <div class="bg-gradient-to-r from-gray-800 to-gray-900 p-6 rounded-lg shadow-lg transform transition-transform hover:scale-105">
                <h2 class="text-xl font-semibold">Wishlist</h2>
                <p class="text-4xl font-bold mt-2">5</p>
            </div>
            <div class="bg-gradient-to-r from-gray-800 to-gray-900 p-6 rounded-lg shadow-lg transform transition-transform hover:scale-105">
                <h2 class="text-xl font-semibold">Balance</h2>
                <p class="text-4xl font-bold mt-2">$250.00</p>
            </div>
        </div>
        
        <!-- Order History -->
        <div class="mt-8 p-6 bg-gray-900 rounded-lg">
            <h2 class="text-2xl font-semibold mb-4">Recent Orders</h2>
            <ul class="space-y-3">
                <li class="p-3 bg-gray-800 rounded-lg flex justify-between">
                    <span>Order #1234 - iPhone 13</span>
                    <span class="text-green-400">Delivered</span>
                </li>
                <li class="p-3 bg-gray-800 rounded-lg flex justify-between">
                    <span>Order #1235 - Gaming Laptop</span>
                    <span class="text-yellow-400">Processing</span>
                </li>
            </ul>
        </div>
        
        <!-- Saved Payment Methods -->
        <div class="mt-8 p-6 bg-gray-900 rounded-lg">
            <h2 class="text-2xl font-semibold mb-4">💳 Saved Payment Methods</h2>
            <ul class="space-y-3">
                <li class="p-3 bg-gray-800 rounded-lg flex justify-between">
                    <span>Visa **** 1234</span>
                    <button class="text-red-400 hover:underline">Remove</button>
                </li>
                <li class="p-3 bg-gray-800 rounded-lg flex justify-between">
                    <span>PayPal - johndoe@email.com</span>
                    <button class="text-red-400 hover:underline">Remove</button>
                </li>
            </ul>
            <button class="mt-4 p-3 bg-blue-600 rounded-lg hover:bg-blue-500">➕ Add Payment Method</button>
        </div>
        
        <!-- Security Settings -->
        <div class="mt-8 p-6 bg-gray-900 rounded-lg">
            <h2 class="text-2xl font-semibold mb-4">🛡 Security Settings</h2>
            <p>Enable Two-Factor Authentication (2FA) for added security.</p>
            <button class="mt-4 p-3 bg-green-600 rounded-lg hover:bg-green-500">Enable 2FA</button>
        </div>
    </main>

    <script>
        document.getElementById('darkModeToggle').addEventListener('click', function() {
            document.body.classList.toggle('bg-white');
            document.body.classList.toggle('text-black');
        });
    </script>
</body>
</html>
