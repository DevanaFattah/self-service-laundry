<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - Self-Service Laundry</title>
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
            background-color: rgba(37, 99, 235, 0.15);
            color: #2563EB;
        }
        .nav-item.active {
            background-color: rgba(37, 99, 235, 0.3);
            color: #FFFFFF;
        }
        label {
            font-size: 0.875rem;
        }
        input, select, button {
            font-size: 0.875rem;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }
        .modal-content {
            background-color: #ffffff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 0.5rem;
            width: 90%;
            max-width: 500px;
            text-align: center;
        }
        .modal-content h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
        }
        .modal-content p {
            font-size: 1rem;
            color: #4a5568;
            margin-bottom: 1.5rem;
        }
        .modal-content button {
            padding: 0.75rem 1.5rem;
            background-color: #48bb78;
            color: #ffffff;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .modal-content button:hover {
            background-color: #38a169;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-900 via-purple-800 to-blue-700 font-poppins flex">
    <!-- Navbar -->
    @include('partials.sidebar')

    <!-- Main Content -->
    <div class="ml-0 md:ml-20 lg:ml-64 p-6 flex-1 transition-all duration-300" id="mainContent">
        <h1 class="text-4xl font-extrabold text-transparent bg-clip-text text-white mb-8 fade-in">Place Your Order</h1>
        <form method="POST" action="{{ route('transaction.store') }}" class="space-y-6 bg-white/90 backdrop-blur-md rounded-2xl p-8 shadow-xl hover-glow" id="orderForm">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Rincian Pesanan</h2>
            @csrf
            <div>
                <label for="weight" class="block text-lg font-semibold text-gray-700">Berat (kg)</label>
                <input type="text" id="weight" name="weight" min="1" step="0.5" class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 text-gray-700 font-poppins" placeholder="e.g., 5.5" required>
            </div>
            <div>
                <label for="coin" class="block text-lg font-semibold text-gray-700">Jumlah Koin</label>
                <input type="number" id="coin" name="quantity" min="1" step="0.5" class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 text-gray-700 font-poppins" placeholder="e.g., 5.5" required>
            </div>
            <div>
                <label for="total" class="block text-lg font-semibold text-gray-700">Total Harga</label>
                <input type="text" id="total" class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 text-gray-700 font-poppins" placeholder="e.g., Rp 110,000.00" readonly required>
            </div>
            <div>
                <input type="text" id="total-hidden" name="total" class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 text-gray-700 font-poppins" placeholder="e.g., Rp 110,000.00" hidden readonly required>
            </div>
            <div>
                <label for="reservation_datetime" class="block text-lgdux font-semibold text-gray-700">Tanggal dan Waktu Reservasi</label>
                <input type="datetime-local" id="reservation_datetime" name="reservation_datetime" class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 text-gray-700 font-poppins" required>
            </div>
            <div>
                <label for="laundry_type" class="block text-lg font-semibold text-gray-700">Metode Pembayaran</label>
                <select id="laundry_type" name="payment_method" class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 text-gray-700 font-poppins" required>
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer</option>
                </select>
            </div>
            <button type="submit" class="flex items-center justify-center w-full bg-gradient-to-r from-green-600 to-teal-600 text-white py-3 px-6 rounded-xl hover:from-green-700 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-300 transform hover:scale-105 font-poppins">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M3 3h2l1.5 9h12l1.5-7H5M6 19a2 2 0 1 0 0 4 2 2 0 0 0 0-4m10 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-4-11v7h7V8h-7z"/>
                </svg>
                Pesan Sekarang
            </button>
        </form>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/flowbite.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const navbar = document.getElementById('navbar-multi-level');
        const mainContent = document.getElementById('mainContent');
        const toggleNavbar = document.querySelector('[data-drawer-toggle="navbar-multi-level"]');
        const orderForm = document.getElementById('orderForm');

        toggleNavbar.addEventListener('click', () => {
            navbar.classList.toggle('-translate-x-full');
            navbar.classList.toggle('translate-x-0');
            mainContent.classList.toggle('ml-0');
            mainContent.classList.toggle('md:ml-20');
            mainContent.classList.toggle('lg:ml-64');
        });

        // Calculate total and format as Rupiah
        const coinInput = document.getElementById('coin');
        const totalInput = document.getElementById('total');
        const totalInputHidden = document.getElementById('total-hidden');

        coinInput.addEventListener('input', () => {
            const coinValue = parseFloat(coinInput.value) || 0;
            const totalValue = 20000 * coinValue;
            totalInput.value = totalValue.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
            totalInputHidden.value = totalValue;
        });
    </script>
</body>
</html>