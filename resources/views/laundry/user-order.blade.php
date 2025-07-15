<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - Self-Service Laundry</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flowbite.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .hover-glow {
            transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
        }
        .hover-glow:hover {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.6);
            transform: translateY(-2px);
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
            background-color: rgba(37, 99, 235, 0.15);
            color: #2563EB;
        }
        .nav-item.active {
            background-color: rgba(37, 99, 235, 0.3);
            color: #FFFFFF;
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
            padding: 1rem;
            text-align: left;
            font-size: 0.95rem;
            line-height: 1.5;
            letter-spacing: 0.01em;
        }
        .table-container th {
            background-color: #F3F4F6;
            font-weight: 700;
            color: #1F2937;
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
            color: #1F2937;
        }
        .table-container tr:last-child td {
            border-bottom: none;
        }
        .action-btn {
            transition: transform 0.2s ease-in-out, color 0.2s ease-in-out, background-color 0.2s ease-in-out;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
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
            background-color: rgba(9, 228, 137, 0.1);
        }
        .action-btn.edit:hover {
            background-color: rgba(11, 127, 79, 0);
        }
        .action-btn.delete {
            background-color: rgba(239, 68, 68, 0.1);
        }
        .action-btn.delete:hover {
            background-color: rgba(239, 68, 68, 0.3);
        }
        .status-approved {
            color: #10B981;
            font-weight: 600;
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
            margin-bottom: 1.5rem;
        }
        .dark .table-container {
            background: linear-gradient(135deg, rgba(55, 65, 81, 0.9), rgba(75, 85, 99, 0.9));
            color: #E5E7EB;
        }
        .dark .table-container th {
            background-color: #374151;
            border-color: #4B5563;
            color: #F3F4F6;
        }
        .dark .table-container td {
            border-color: #4B5563;
            color: #E5E7EB;
        }
        .dark .table-container .text-blue-600 {
            color: #93C5FD;
        }
        .dark-mode-toggle {
            position: fixed;
            top: 1rem;
            right: 1rem;
            padding: 0.75rem 1.25rem;
            background-color: rgba(255, 255, 255, 0.15);
            color: #FFFFFF;
            border: none;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            z-index: 1000;
            font-size: 0.9rem;
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
        h1 {
            font-size: 2.5rem;
            font-weight: 800;
            letter-spacing: 0.02em;
            line-height: 1.3;
        }
        #table-search {
            font-size: 0.95rem;
            color: #1F2937;
            background-color: #F9FAFB;
        }
        .dark #table-search {
            color: #E5E7EB;
            background-color: #4B5563;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-900 via-purple-800 to-blue-700 font-poppins flex">
    <!-- Dark Mode Toggle Button -->
    <button class="dark-mode-toggle" onclick="toggleDarkMode()">Toggle Dark Mode</button>

    <!-- Navbar -->
    <button data-drawer-target="navbar-multi-level" data-drawer-toggle="navbar-multi-level" aria-controls="navbar-multi-level" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-gray-300 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:hidden">
        <span class="sr-only">Open navbar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    @include('partials.sidebar')

    <!-- Main Content -->
    <div class="ml-0 md:ml-20 lg:ml-64 p-6 flex-1 transition-all duration-300" id="mainContent">
        <h1 class="text-4xl font-extrabold text-transparent bg-clip-text text-white mb-8 fade-in">Semua Pesanan Pelanggan {{ $user->name }}</h1>
        <div class="p-6">
            <!-- Button Container -->
            <div class="button-container">
                <a href="{{ route('order') }}" class="flex items-center justify-center bg-gradient-to-r from-green-600 to-teal-600 text-white py-3 px-6 rounded-xl hover:from-green-700 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-300 transform hover:scale-105 hover-glow font-poppins text-lg">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 3h2l1.5 9h12l1.5-7H5M6 19a2 2 0 1 0 0 4 2 2 0 0 0 0-4m10 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-4-11v7h7V8h-7z"/>
                    </svg>
                    Pesan Sekarang
                </a>
            </div>
            <!-- Search Input -->
            <div class="mb-4">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="table-search" class="block p-3 pl-12 text-base text-gray-900 border border-gray-300 rounded-lg w-96 bg-white/90 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for orders" onkeyup="searchTable()">
                </div>
                @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="overflow-x-auto table-container">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase">
                        <tr>
                            <th scope="col" class="text-center px-6 py-3 w-1/10 min-w-[80px]">Berat</th>
                            <th scope="col" class="px-6 py-3 w-1/12 min-w-[100px]">Jumlah Koin</th>
                            <th scope="col" class="px-6 py-3 w-1/6 min-w-[120px]">Total</th>
                            <th scope="col" class="px-6 py-3 w-1/6 min-w-[120px]">Metode Pembayaran</th>
                            <th scope="col" class="px-6 py-3 w-1/6 min-w-[120px]">Status Pembayaran</th>
                            <th scope="col" class="px-6 py-3 w-1/6 min-w-[120px]">Status Pesanan</th>
                            <th scope="col" class="px-6 py-3 w-1/6 min-w-[150px]">Tanggal Reservasi</th>
                            <th scope="col" class="px-6 py-3 w-1/8 min-w-[140px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                        <tr class="border-b">
                            <td class="px-6 py-4">{{ $transaction->weight }} kg </td>
                            <td class="px-6 py-4">{{ $transaction->quantity }} Koin</td>
                            <td class="px-6 py-4">Rp. {{ number_format($transaction->total, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">{!! $transaction->payment_method == 'cash' ? '<span class="status-blue">Cash</span>' : '<span class="status-pending">Transfer</span>' !!}</td>
                            <td class="px-6 py-4">{!! $transaction->approval ? '<span class="status-approved">Lunas</span>' : '<span class="status-rejected">Belum Dibayar</span>' !!}</td>
                            <td class="px-6 py-4">{!! $transaction->status == 'ok' ? '<span class="status-approved">Berjalan</span>' : '<span class="status-rejected">Dibatalkan</span>' !!}</td>
                            <td class="px-6 py-4">{{ $transaction->reservation_date->format('d M Y') }}</td>
                            <td class="px-6 py-4 pl-2 flex space-x-1">
                                <form action="{{ route('transaction.confirmOrder', $transaction->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <button class="action-btn edit text-green-600" onclick="return confirm('Apakah yakin akan mengonfirmasi pesanan?')">
                                        <span class="payment-status-icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                                                <path d="M7 12L10 15L17 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                    </buttton>
                                </form>
                                {{-- <form action="{{ route('transaction.cancelOrder', $transaction->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="action-btn delete text-red-600" onclick="return confirm('Are you sure you want to cancel this order?')">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/flowbite.js') }}" defer></script>
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

        function editOrder(button) {
            const row = button.closest('tr');
            const cells = row.getElementsByTagName('td');
            alert(`Edit Order: Berat=${cells[0].textContent}, Koin=${cells[1].textContent}, Total=${cells[2].textContent}, Metode=${cells[3].textContent}, Status=${cells[4].textContent}, Tanggal=${cells[5].textContent}`);
        }

        function searchTable() {
            const input = document.getElementById('table-search');
            const filter = input.value.toLowerCase();
            const table = document.querySelector('tbody');
            const tr = table.getElementsByTagName('tr');

            for (let i = 0; i < tr.length; i++) {
                let found = false;
                const td = tr[i].getElementsByTagName('td');
                for (let j = 0; j < td.length; j++) {
                    const text = td[j].textContent || td[j].innerText;
                    if (text.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
                tr[i].style.display = found ? '' : 'none';
            }
        }

        function toggleDarkMode() {
            document.body.classList.toggle('dark');
        }
    </script>
</body>
</html>