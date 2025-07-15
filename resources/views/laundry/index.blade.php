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
        .table-container {
            backdrop-filter: blur(10px);
            border-radius: 0.35rem;
            overflow-x: auto;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            background-color: #FFFFFF;
            max-width: 100%;
        }
        .table-container table {
            width: 100%;
            min-width: 600px;
            border-collapse: separate;
            border-spacing: 0;
            table-layout: fixed;
        }
        .table-container th,
        .table-container td {
            padding: 1rem; /* Increased padding for better spacing */
            text-align: left;
            font-size: 0.95rem; /* Increased from 0.875rem to 0.95rem for better readability */
            line-height: 1.5; /* Added for better text flow */
            letter-spacing: 0.01em; /* Slight letter-spacing for clarity */
        }
        .table-container th {
            background-color: #F3F4F6; /* Slightly darker for contrast */
            font-weight: 700; /* Bolder for emphasis */
            color: #1F2937; /* Darker gray for better contrast */
            border-bottom-width: 1px;
            border-color: #D1D5DB;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .table-container td {
            border-bottom-width: 1px;
            border-color: #D1D5DB;
            vertical-align: middle;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #1F2937; /* Darker text for better readability */
        }
        .table-container tr:last-child td {
            border-bottom: none;
        }
        .action-btn {
            transition: transform 0.2s ease-in-out, color 0.2s ease-in-out, background-color 0.2s ease-in-out;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.75rem; /* Slightly increased for readability */
            white-space: nowrap;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        }
        .action-btn:hover {
            transform: scale(1.05);
            color: #FFFFFF;
        }
        .action-btn.edit {
            background-color: rgba(37, 99, 235, 0.1);
        }
        .action-btn.edit:hover {
            background-color: rgba(37, 99, 235, 0.3);
        }
        .action-btn.delete {
            background-color: rgba(239, 68, 68, 0.1);
        }
        .action-btn.delete:hover {
            background-color: rgba(239, 68, 68, 0.3);
        }
        .status-approved {
            color: #10B981;
            font-weight: 600; /* Bolder for emphasis */
        }
        .status-pending {
            color: #F59E0B;
            font-weight: 600;
        }
        .status-rejected {
            color: #ff2121ff;
            font-weight: 600;
        }
        .status-blue {
            color: #2659f3ff;
            font-weight: 600;
        }
        .button-container {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 1.5rem; /* Increased spacing */
        }
        /* Dark mode styles for table */
        .dark .table-container {
            background: linear-gradient(135deg, rgba(55, 65, 81, 0.9), rgba(75, 85, 99, 0.9)); /* Slightly lighter for contrast */
            color: #E5E7EB; /* Light gray for better readability */
        }
        .dark .table-container th {
            background-color: #374151; /* Darker header background */
            border-color: #4B5563;
            color: #F3F4F6; /* Light text for contrast */
        }
        .dark .table-container td {
            border-color: #4B5563;
            color: #E5E7EB; /* Light text for readability */
        }
        .dark .table-container .text-blue-600 {
            color: #93C5FD; /* Lighter blue for dark mode */
        }
        .dark-mode-toggle {
            position: fixed;
            top: 1rem;
            right: 1rem;
            padding: 0.75rem 1.25rem; /* Slightly larger for better clickability */
            background-color: rgba(255, 255, 255, 0.15); /* Increased opacity for visibility */
            color: #FFFFFF;
            border: none;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            z-index: 1000;
            font-size: 0.9rem; /* Increased for readability */
            font-weight: 500;
        }
        .dark-mode-toggle:hover {
            background-color: rgba(255, 255, 255, 0.25);
        }
        .dark .dark-mode-toggle {
            background-color: rgba(0, 0, 0, 0.15);
        }
        .dark .dark-mode-toggle:hover {
            background-color: rgba(0, 0, 0, 0.25);
        }
        .table-container td:last-child {
            padding-left: 0.25rem;
        }
        /* Improved heading styles */
        h1 {
            font-size: 2.5rem; /* Slightly larger for prominence */
            font-weight: 800; /* Extra bold */
            letter-spacing: 0.02em; /* Slight letter-spacing */
            line-height: 1.3; /* Better line height */
        }
        /* Search input styling */
        #table-search {
            font-size: 0.95rem; /* Increased for readability */
            color: #1F2937; /* Darker text */
            background-color: #F9FAFB; /* Lighter background */
        }
        .dark #table-search {
            color: #E5E7EB;
            background-color: #4B5563;
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
                <h3 class="text-xl font-semibold text-gray-700">Total Pesanan Per Minggu</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $transactions->count() }}</p>
                {{-- @dd($transactions); --}}
                <p class="text-sm text-gray-600 mt-1">Ordered this week</p>
            </div>
            <!-- Card 2: Revenue -->
            <div class="bg-white/90 backdrop-blur-md rounded-2xl p-6 shadow-xl transform transition-all duration-300 hover:scale-102 hover-glow">
                <h3 class="text-xl font-semibold text-gray-700">Revenue</h3>
                <p class="text-3xl font-bold text-purple-600 mt-2">Rp. {{ number_format($revenue, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-600 mt-1">Didapat dari Transaksi 1 Minggu Terakhir</p>
            </div>
            <!-- Card 3: Active Machines -->
            <div class="bg-white/90 backdrop-blur-md rounded-2xl p-6 shadow-xl transform transition-all duration-300 hover:scale-102 hover-glow">
                <h3 class="text-xl font-semibold text-gray-700">Active Member</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $users->count() }}</p>
            </div>
        </div>
        <div class="overflow-x-auto table-container mt-8">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase">
                        <tr>
                            <th scope="col" class="text-center px-6 py-3 w-1/4 min-w-[80px]">Nama</th>
                            <th scope="col" class="px-6 py-3 w-1/4 min-w-[120px]">Jumlah Pemesanan</th>
                            <th scope="col" class="px-6 py-3 w-1/4 min-w-[150px]">Tanggal Bergabung</th>
                            <th scope="col" class="px-6 py-3 w-1/4 min-w-[140px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="border-b">
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->transactions->count() }} Pesanan</td>
                            <td class="px-6 py-4">{{ $user->created_at }}</td>
                            <td class="px-6 py-4 pl-2 flex space-x-1">
                                <a class="action-btn edit text-blue-600" href="{{ route('transaction.edit', $user->id) }}">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                    </svg>
                                </a>
                                <a class="action-btn edit text-green-600" href="{{ route('transaction.user-order', $user->id) }}">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 3h2l1.5 9h12l1.5-7H5M6 19a2 2 0 1 0 0 4 2 2 0 0 0 0-4m10 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-4-11v7h7V8h-7z" fill="currentColor"/>
                                    </svg>
                                </a>
                                <button class="action-btn delete text-red-600" onclick="deleteOrder(this)">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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