@extends('layouts.admin') @section('content')
    <div class="ml-5 my-5 flex flex-col gap-3">
        <span class="py-1 px-4 rounded-xl bg-red-100 text-red-500 font-semibold w-fit">Panel Admin</span>
        <h1 class="text-3xl font-bold">Dashboard Admin</h1>
        <p class="text-gray-600">Kelola pemilihan Ketua OSIS dari sini.</p>
    </div>

    <div class="flex flex-col md:flex-row items-center justify-center mx-4 gap-5 my-8">
        <div class="p-5 rounded-lg w-full flex-1 bg-white border border-gray-300 shadow-sm">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-lg text-red-600">Total Kandidat</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-users h-4 w-4 text-primary text-[#DB2424]">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold">{{ $totalCandidates }}</h1>
        </div>
        <div class="p-5 rounded-lg w-full flex-1 bg-white border border-gray-300 shadow-sm">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-lg text-blue-400">Total Siswa</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-user-plus h-4 w-4 text-accent text-blue-400">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <line x1="19" x2="19" y1="8" y2="14"></line>
                    <line x1="22" x2="16" y1="11" y2="11"></line>
                </svg>
            </div>
            <h1 class="text-3xl font-bold">{{ $totalStudents }}</h1>
        </div>
        <div class="p-5 rounded-lg w-full flex-1 bg-white border border-gray-300 shadow-sm">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-lg text-green-300">Total Suara</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-vote h-4 w-4 text-success text-green-300">
                    <path d="m9 12 2 2 4-4"></path>
                    <path d="M5 7c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2v12H5V7Z"></path>
                    <path d="M22 19H2"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold">{{ $totalVotes }}</h1>
        </div>

        <div class="p-5 rounded-lg w-full flex-1 bg-white border border-gray-300 shadow-sm">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-lg text-orange-300">Total Partisipasi</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-trending-up h-4 w-4 text-warning text-orange-300">
                    <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                    <polyline points="16 7 22 7 22 13"></polyline>
                </svg>
            </div>
            <h1 class="text-3xl font-bold">{{ $totalParticipation }}%</h1>
        </div>
    </div>

    <div class="mx-3 flex flex-col md:flex-row items-center justify-center gap-4">
        <a href="{{ route('admin.candidates') }}"
            class="flex flex-1 w-full group hover:shadow-lg transition-all items-center justify-between p-5 bg-white rounded-lg border border-gray-300">
            <div class="flex items-center gap-3">
                <span class="p-5 rounded-lg bg-[#DB2424] text-white"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users h-4 w-4 text-primary">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg></span>
                <div>
                    <h1 class="text-2xl font-bold group-hover:text-[#DB2424] transition-colors">
                        Kelola Kandidat
                    </h1>
                    <p class="text-gray-600">
                        Tambah, edit, dan hapus Kandidat Ketua OSIS
                    </p>
                </div>
            </div>

            <span class="p-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-right h-5 w-5 text-muted-foreground group-hover:text-primary group-hover:translate-x-1 transition-all">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </span>
        </a>

        <a href="{{ route('admin.classes') }}"
            class="flex flex-1 w-full group hover:shadow-lg transition-all items-center justify-between p-5 bg-white rounded-lg border border-gray-300">
            <div class="flex items-center gap-3">
                <span class="p-5 rounded-lg bg-blue-400 text-white"><svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-graduation-cap h-6 w-6 text-white">
                        <path
                            d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z">
                        </path>
                        <path d="M22 10v6"></path>
                        <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"></path>
                    </svg></span>
                <div>
                    <h1 class="text-2xl font-bold group-hover:text-blue-400 transition-colors">
                        Kelola Kelas
                    </h1>
                    <p class="text-gray-600">Tambah, edit, dan hapus Kelas</p>
                </div>
            </div>

            <span class="p-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-chevron-right h-5 w-5 text-muted-foreground group-hover:text-primary group-hover:translate-x-1 transition-all">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </span>
        </a>
    </div>

    <div class="mx-3 flex flex-col items-center justify-center md:flex-row gap-4 my-5">
        <a href="{{ route('admin.users') }}"
            class="flex flex-1 w-full group hover:shadow-lg transition-all items-center justify-between p-5 bg-white rounded-lg border border-gray-300">
            <div class="flex items-center gap-3">
                <span class="p-5 rounded-lg bg-green-400 text-white"><svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-user-plus h-4 w-4 text-accent">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <line x1="19" x2="19" y1="8" y2="14"></line>
                        <line x1="22" x2="16" y1="11" y2="11"></line>
                    </svg></span>
                <div>
                    <h1 class="text-2xl font-bold group-hover:text-green-400 transition-colors">
                        Kelola User
                    </h1>
                    <p class="text-gray-600">Tambah, edit, dan hapus User</p>
                </div>
            </div>

            <span class="p-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-chevron-right h-5 w-5 text-muted-foreground group-hover:text-primary group-hover:translate-x-1 transition-all">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </span>
        </a>

        <a href="{{ route('results') }}"
            class="flex flex-1 w-full group hover:shadow-lg transition-all items-center justify-between p-5 bg-white rounded-lg border border-gray-300">
            <div class="flex items-center gap-3">
                <span class="p-5 rounded-lg bg-orange-400 text-white"><svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-trending-up h-4 w-4 text-warning">
                        <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                        <polyline points="16 7 22 7 22 13"></polyline>
                    </svg></span>
                <div>
                    <h1 class="text-2xl font-bold group-hover:text-orange-400 transition-colors">
                        Lihat Hasil Voting
                    </h1>
                    <p class="text-gray-600">
                        Pantau Hasil pemilihan secara Real Time
                    </p>
                </div>
            </div>

            <span class="p-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-chevron-right h-5 w-5 text-muted-foreground group-hover:text-primary group-hover:translate-x-1 transition-all">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </span>
        </a>
    </div>
@endsection
