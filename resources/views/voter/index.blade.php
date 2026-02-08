@extends('layouts.voter')
@section('content')
    <div class="ml-5 my-5 mx-auto text-center flex flex-col items-center justify-center gap-3">
        <span class="py-1 px-4 rounded-xl bg-red-100 text-red-500 font-semibold w-fit">Pemilihan Ketua OSIS</span>
        <h1 class="text-3xl font-bold">Pilih Calon Ketua OSIS</h1>
        <p class="text-gray-600">Klik pada kandidat pilihan Anda untuk memberikan suara. Ingat, Anda hanya dapat memilih satu
            kali.</p>
    </div>



    <div
        class="my-10 flex flex-col md:flex-row flex-wrap items-stretch gap-5 p-5 rounded-lg bg-white border border-gray-200">
        @foreach ($candidates as $candidate)
            @php
                $isVoted = $myVote && $myVote->candidate_id === $candidate->id;
                $hasVoted = $myVote != null;
            @endphp

            <div
                class="rounded-lg overflow-hidden shadow-sm w-full md:flex-1 md:min-w-md max-w-md {{ $isVoted ? 'ring-2 ring-red-600 bg-white hover:shadow-lg' : '' }} {{ $hasVoted && !$isVoted ? 'border border-gray-200 bg-gray-100 opacity-70 cursor-not-allowed' : 'border border-gray-200 bg-white' }}">
                <div class="w-full relative bg-gray-200 h-60 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-users h-30 w-30 text-primary text-gray-400">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>

                    <span
                        class="h-10 w-10 absolute top-3 left-3 text-2xl flex items-center justify-center font-semibold text-white bg-red-600 rounded-full">{{ $candidate->nomor }}</span>
                </div>
                <div class="p-5 flex flex-col justify-between gap-2">
                    <h1 class="text-xl font-semibold">{{ $candidate->name }}</h1>
                    <span class="text-red-600">Visi</span>
                    <p class="text-gray-600">{{ $candidate->visi }}</p>
                    <span class="text-red-600">Misi</span>
                    <p class="text-gray-600">{{ $candidate->misi }}</p>



                    <form action="{{ route('voter.store', $candidate->id) }}" method="POST"
                        onsubmit="return confirm('Yakin pilih Kandidat ini?')">
                        @csrf
                        <button
                            class="w-full rounded-lg p-3 mt-6 flex items-center justify-center font-medium transition-colors gap-4 {{ $isVoted ? 'bg-red-600 text-white hover:bg-red-700 cursor-not-allowed' : '' }} {{ $hasVoted && !$isVoted ? 'bg-gray-400 text-white cursor-not-allowed' : 'bg-red-600 text-white hover:bg-red-700 cursor-pointer' }}"
                            {{ $hasVoted ? 'disabled' : '' }}>

                            {{ $isVoted ? 'Sudah Memilih' : 'Pilih Kandidat Ini' }}
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
