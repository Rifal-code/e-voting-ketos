@extends('layouts.admin') @section('content')
    <div class="flex items-start md:items-center flex-col md:flex-row md:justify-between my-8">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 flex items-center gap-2 font-semibold"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-left h-4 w-4">
                    <path d="m12 19-7-7 7-7"></path>
                    <path d="M19 12H5"></path>
                </svg>Kembali ke Dashboard</a>
            <h1 class="text-3xl font-bold my-2">Kelola Kandidat</h1>
        </div>

        <a href="{{ route('admin.candidates.create') }}"
            class="text-white flex items-center bg-red-600 rounded-lg font-semibold py-3 px-5 w-full md:w-fit">
            <span class="text-2xl">+</span> Tambah Kandidat</a>
    </div>

    <div
        class="my-10 flex items-stretch flex-col md:flex-row flex-wrap gap-5 p-5 rounded-lg bg-white border border-gray-200">
        @foreach ($candidates as $candidate)
            <div
                class="bg-white rounded-lg overflow-hidden border border-gray-300 shadow-sm w-full md:flex-1 md:min-w-md max-w-md">
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
                <div class="p-5 flex flex-col gap-2 justify-between">
                    <h1 class="text-xl font-semibold">{{ $candidate->name }}</h1>
                    <span class="text-red-600">Visi</span>
                    <p class="text-gray-600">{{ $candidate->visi }}</p>
                    <span class="text-red-600">Misi</span>
                    <p class="text-gray-600">{{ $candidate->misi }}</p>

                    <div class="w-full flex gap-3 mt-6">
                        <a href="{{ route('admin.candidates.edit', $candidate->id) }}"
                            class="flex items-center justify-center gap-4 w-full rounded-lg border border-gray-300 bg-blue-400 text-white font-medium py-2"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-pencil h-4 w-4 mr-2">
                                <path
                                    d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z">
                                </path>
                                <path d="m15 5 4 4"></path>
                            </svg>
                            Edit</a>
                        <form action="{{ route('admin.candidates.destroy', $candidate->id) }}" method="POST"
                            onsubmit="return confirm('Yakin hapus Kandidat ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-white bg-red-600 rounded-lg p-3 w-fit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-trash2 h-4 w-4">
                                    <path d="M3 6h18"></path>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                    <line x1="10" x2="10" y1="11" y2="17"></line>
                                    <line x1="14" x2="14" y1="11" y2="17"></line>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
