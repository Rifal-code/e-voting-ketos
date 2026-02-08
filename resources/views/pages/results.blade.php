@extends('layouts.pages')
@section('content')
    <div class="ml-5 my-5 mx-auto text-center flex flex-col items-center justify-center gap-3">
        <span class="py-1 px-4 rounded-xl bg-red-100 text-red-500 font-semibold w-fit">Hasil Pemilihan Ketua OSIS</span>
        <h1 class="text-3xl font-bold">Hasil Voting Kandidat Ketua OSIS</h1>
        <p class="text-gray-600">Berikut adalah hasil pemilihan Ketua OSIS berdasarkan suara yang telah diberikan oleh para
            pemilih.</p>
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


    <div class="mx-5 rounded-lg border border-gray-200 bg-white shadow-xs p-10">
        <h1 class="text-2xl font-bold">Perolehan Suara</h1>
        <div class="w-full h-auto min-h-96">
            <canvas id="barChart"></canvas>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script>
        const data = @json($chartData);

        const labels = data.map(d => d.label);
        const votes = data.map(d => d.votes);
        const percentages = data.map(d => d.percentage);

        const colors = ['#dc2626', '#2563eb', '#16a34a', '#ca8a04'];


        // BAR CHART
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Suara',
                    data: votes,
                    backgroundColor: colors
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, 
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
