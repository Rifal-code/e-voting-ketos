<nav class="p-3 z-50 border-b border-b-gray-300 bg-white sticky top-0 flex items-center justify-between">
    <a href="/" class="flex items-center gap-4">
        <span class="p-1 rounded-lg bg-[#DB2424] text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-vote h-6 w-6 text-primary-foreground">
                <path d="m9 12 2 2 4-4"></path>
                <path d="M5 7c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2v12H5V7Z"></path>
                <path d="M22 19H2"></path>
            </svg>
        </span>
        <span class="text-md font-bold">E-VOTING OSIS</span>
    </a>


    <div class="flex gap-6 items-center justify-center">
        <a href="{{ route('results') }}"
            class="flex gap-4 items-center hover:text-red-600 font-semibold {{ request()->is('results') ? 'text-red-600' : 'text-gray-600' }}">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-trending-up h-4 w-4 text-warning">
                    <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                    <polyline points="16 7 22 7 22 13"></polyline>
                </svg>
            </span>

            Hasil Voting
        </a>

        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ route('login') }}"
                        class="py-2 px-5 rounded-lg bg-[#DB2424] hover:bg-[#DB2424]/80 text-white font-semibold">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="py-2 px-5 rounded-lg bg-[#DB2424] hover:bg-[#DB2424]/80 text-white font-semibold">Masuk</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="py-2 px-5 rounded-lg bg-blue-400 hover:bg-blue-400/80 text-white font-semibold">Daftar</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</nav>
