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
            <h1 class="text-3xl font-bold my-2">Kelola User</h1>
        </div>

        <a href="{{ route('admin.users.create') }}"
            class="text-white flex items-center bg-green-400 rounded-lg font-semibold py-2 px-5 w-full md:w-fit">
            <span class="text-2xl">+</span> Tambah User</a>
    </div>

    <div class="rounded-xl bg-white shadow-xs border border-gray-200 overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="border-b border-b-gray-200 hover:bg-gray-100 transition-colors">
                <tr>
                    <th class="p-3 text-gray-600 font-medium">Nama</th>
                    <th class="p-3 text-gray-600 font-medium">Kelas</th>
                    <th class="p-3 text-gray-600 font-medium">Email</th>
                    <th class="p-3 text-gray-600 font-medium">Role</th>
                    <th class="p-3 text-gray-600 font-medium">Status Voting</th>
                    <th class="p-3 text-gray-600 font-medium">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr class="border-b border-b-gray-200 hover:bg-gray-100 transition-colors">
                        <td class="p-3">{{ $user->name }}</td>
                        <td class="p-3">{{ $user->schoolClass?->name ?? '-' }}</td>
                        <td class="p-3">{{ $user->email }}</td>
                        <td class="p-3">{{ $user->role }}</td>
                        <td class="p-3">{{ $user->hasVoted() ? 'Sudah Voting' : 'Belum Voting' }}</td>
                        <td class="p-3">
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
