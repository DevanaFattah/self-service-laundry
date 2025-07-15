<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Self-Service Laundry</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flowbite.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .hover-glow {
            transition: box-shadow 0.3s ease-in-out;
        }
        .hover-glow:hover {
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.5);
        }
        .navbar {
            height: calc(100vh - 2rem);
            transition: width 0.3s ease-in-out;
        }
        .navbar.collapsed {
            width: 4rem;
        }
        .navbar:not(.collapsed) {
            width: 16rem;
        }
        .nav-item {
            transition: all 0.3s ease-in-out;
        }
        .nav-item:hover {
            background-color: rgba(37, 99, 235, 0.15); /* Lighter Blue-600 with opacity */
            color: #2563EB; /* Blue-600 */
        }
        .nav-item.active {
            background-color: rgba(37, 99, 235, 0.3); /* Active state with Blue-600 */
            color: #FFFFFF; /* White for contrast */
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-900 via-purple-800 to-blue-700 font-poppins flex">
    <!-- Navbar -->
    @include('partials.sidebar')

    <!-- Main Content -->
    <div class="ml-0 md:ml-20 lg:ml-64 p-6 flex-1 transition-all duration-300" id="mainContent">
        <h1 class="text-4xl font-extrabold text-transparent bg-clip-text text-white mb-8 fade-in">Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card 1: Total Laundry Count -->
            <div class="bg-white/90 backdrop-blur-md rounded-2xl p-6 shadow-xl transform transition-all duration-300 hover:scale-102 hover-glow">
                <h3 class="text-xl font-semibold text-gray-700">Total Laundry</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">245</p>
                <p class="text-sm text-gray-600 mt-1">Completed this week</p>
            </div>
            <!-- Card 2: Revenue -->
            <div class="bg-white/90 backdrop-blur-md rounded-2xl p-6 shadow-xl transform transition-all duration-300 hover:scale-102 hover-glow">
                <h3 class="text-xl font-semibold text-gray-700">Revenue</h3>
                <p class="text-3xl font-bold text-purple-600 mt-2">$1,890</p>
                <p class="text-sm text-gray-600 mt-1">Last 30 days</p>
            </div>
            <!-- Card 3: Active Machines -->
            <div class="bg-white/90 backdrop-blur-md rounded-2xl p-6 shadow-xl transform transition-all duration-300 hover:scale-102 hover-glow">
                <h3 class="text-xl font-semibold text-gray-700">Active Machines</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">12</p>
                <p class="text-sm text-gray-600 mt-1">Currently in use</p>
            </div>
        </div>
        <div class="mt-6 bg-white/90 backdrop-blur-md rounded-2xl p-6 shadow-xl">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Usage Statistics</h3>
            <div class="h-64">
                <canvas id="usageChart"></canvas>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/flowbite.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const navbar = document.getElementById('navbar-multi-level');
        const mainContent = document.getElementById('mainContent');
        const toggleNavbar = document.querySelector('[data-drawer-toggle="navbar-multi-level"]');

        toggleNavbar.addEventListener('click', () => {
            navbar.classList.toggle('-translate-x-full');
            navbar.classList.toggle('translate-x-0');
            mainContent.classList.toggle('ml-0');
            mainContent.classList.toggle('md:ml-20');
            mainContent.classList.toggle('lg:ml-64');
        });

        const ctx = document.getElementById('usageChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Laundry Usage',
                    data: [20, 35, 45, 30, 50, 40, 60],
                    backgroundColor: 'rgba(37, 99, 235, 0.7)', // Blue-600 with opacity
                    borderColor: 'rgba(147, 51, 234, 0.7)', // Purple-600 with opacity
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>