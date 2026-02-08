@extends('layouts.pages')
@section('content')
    <section class="h-screen relative w-screen bg-cover bg-center flex flex-col justify-center items-center"
        style="background-image: url('{{ asset('images/hero-bg.jpg') }}')">
        <div class="absolute inset-0 bg-white/70"></div>

        <div class="flex flex-col w-full justify-center items-center gap-6 z-10 px-5">
            <span class="bg-red-200 mx-auto py-3 px-4 rounded-full text-red-800 font-semibold">Pemilihan Ketua OSIS Periode
                2026/2027</span>
            <h1>
                <h1 class="text-5xl md:text-6xl font-bold text-center mt-5 mb-3 z-10">E-Voting <span
                        class="text-red-600">Ketua OSIS</span></h1>
            </h1>
            <p class="text-3xl  max-w-4xl text-gray-600 text-center">Sistem pemilihan Ketua OSIS berbasis web yang
                aman,
                transparan, dan
                modern.
                Suaramu menentukan masa depan
                OSIS!</p>

            <div class="flex gap-5">
                <a href="{{ route('register') }}"
                    class="bg-red-600 hover:bg-white text-white hover:text-black font-bold py-3 px-6 rounded-lg transition duration-300">
                    Daftar Sekarang</a>

                <a href="{{ route('login') }}"
                    class="bg-white hover:bg-red-600 hover:text-white font-bold py-3 px-6 rounded-lg transition duration-300">Sudah
                    Punya Akun</a>
            </div>
        </div>
    </section>

    <section>
        <h1 class="text-3xl font-bold text-center mt-10 mb-5">Kenapa Menggunakan Sistem E-Voting?</h1>
        <p class="text-center text-gray-600 text-xl">Sistem yang dirancang khusus untuk memudahkan proses pemilihan Ketua
            OSIS</p>
        <div class="my-8 flex flex-col md:flex-row justify-center items-center gap-10 px-5">
            <div class="bg-white rounded-lg shadow-lg p-6 flex-1 max-w-sm text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-shield-check h-12 w-12 mx-auto mb-4 text-red-600">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z">
                    </path>
                    <path d="m9 12 2 2 4-4"></path>
                </svg>
                <h2 class="text-xl font-semibold mb-2">Keamanan Terjamin</h2>
                <p class="text-gray-600">Sistem kami menggunakan teknologi enkripsi terbaru untuk memastikan data
                    pemilih dan hasil voting aman dari ancaman eksternal.</p>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 flex-1 max-w-sm text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-bar-chart-2 h-12 w-12 mx-auto mb-4 text-red-600">
                    <line x1="18" y1="20" x2="18" y2="10"></line>
                    <line x1="12" y1="20" x2="12" y2="4"></line>
                    <line x1="6" y1="20" x2="6" y2="14"></line>
                </svg>
                <h2 class="text-xl font-semibold mb-2">Hasil Cepat & Akurat</h2>
                <p class="text-gray-600">Dengan sistem elektronik, penghitungan suara menjadi

            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 flex-1 max-w-sm text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-thumb-up h-12 w-12 mx-auto mb-4 text-red-600">
                    <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-7A2 2 0 0 0 19.66 7H14z">
                    </path>
                    <path d="M7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
                    <h2 class="text-xl font-semibold mb-2">Mudah Digunakan</h2>
                    <p class="text-gray-600">Sistem ini dirancang untuk memudahkan pengguna dalam melakukan pemilihan,
                        dengan
                        antarmuka yang intuitif dan ramah pengguna.

            </div>


        </div>
    </section>

    <section class="my-16 bg-white shadow-lg rounded-lg border-gray-200 border ">

    </section>
@endsection
