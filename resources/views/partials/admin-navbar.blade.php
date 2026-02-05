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

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="py-2 px-5 rounded-lg bg-[#DB2424] hover:bg-[#DB2424]/80 text-white font-semibold">Keluar</button>
    </form>
</nav>
