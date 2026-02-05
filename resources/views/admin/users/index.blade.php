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
            <h1 class="text-3xl font-bold my-2">Kelola Kelas</h1>
        </div>

        <a href="{{ route('admin.classes.create') }}"
            class="text-white flex items-center bg-blue-400 rounded-lg font-semibold py-3 px-5 w-full md:w-fit">
            <span class="text-2xl">+</span> Tambah Kelas</a>
    </div>

    <div class="rounded-xl bg-white shadow-xs border border-gray-200 divide-y divide-gray-200">
        <div class="w-full flex justify-between items-center p-3 hover:bg-gray-100 transition-colors">
            <h3 class="text-md font-medium text-gray-600">Nama </h3>
            <h3 class="text-md font-medium text-gray-600">Kelas </h3>
            <h3 class="text-md font-medium text-gray-600">Role </h3>
            <h3 class="text-md font-medium text-gray-600">Status Voting </h3>
            <h3 class="text-md font-medium text-gray-600">Aksi</h3>
        </div>

        @foreach ($users as $user)
            <div class="w-full flex justify-between items-center p-3 hover:bg-gray-100 transition-colors">
                <h3 class="text-md font-medium text-gray-800">{{ $user->name }}</h3>
                <h3 class="text-md font-medium text-gray-800">{{ $user->schoolClass?->name ?? '-' }}</h3>
                <h3 class="text-md font-medium text-gray-800">{{ $user->role }}</h3>
                <h3 class="text-md font-medium text-gray-800">{{ $user->hasVoted() ? 'Sudah Memilih' : 'Belum Memilih' }}
                </h3>
                <div class="flex gap-2">

                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                        onsubmit="return confirm('Yakin hapus User ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-white bg-red-500 hover:bg-red-600 rounded-lg font-medium py-1 px-3 text-sm">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
