<button data-drawer-target="navbar-multi-level" data-drawer-toggle="navbar-multi-level" aria-controls="navbar-multi-level" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-gray-300 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:hidden">
        <span class="sr-only">Open navbar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside id="navbar-multi-level" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Navbar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-white/90 backdrop-blur-md rounded-r-2xl shadow-xl">
            <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 mb-6 px-2">Laundry Hub</h2>
            <ul class="space-y-2">
                @if (Auth::user()->is_admin)
                <li>
                    <a href="{{ route('dashboard') }}" class="nav-item flex items-center p-3 text-gray-700 rounded-lg {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg class="w-6 h-6 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                        </svg>
                        <span class="text-base">Dashboard</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ route('transaction.store') }}" class="nav-item flex items-center p-3 text-gray-700 rounded-lg">
                        <svg class="w-6 h-6 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
                        </svg>
                        <span class="text-base">Products</span>
                        <span class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-blue-100 bg-blue-600 rounded-full">3</span>
                    </a>
                </li>
                <li>
                {{-- <form action="{{ route('logout'}}" method="POST" style="display: inline;"> --}}
                        @csrf
                        <a href="{{ route('logout') }}" class="nav-item flex items-center p-3 text-gray-700 rounded-lg w-full text-left">
                            <svg class="w-6 h-6 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                            </svg>
                            <span class="text-base">Sign Out</span>
                        </a>
                    {{-- </form> --}}
                </li>
            </ul>
        </div>
    </aside>
