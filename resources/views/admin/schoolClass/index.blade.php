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

    <div class="rounded-xl bg-white shadow-xs border border-gray-200 overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="border-b border-b-gray-200 hover:bg-gray-100 transition-colors">
                <tr>
                    <th class="p-3 text-gray-600 font-medium">Nama Kelas</th>
                    <th class="p-3 text-gray-600 font-medium text-right">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($classes as $class)
                    <tr class="border-b relative border-b-gray-200 hover:bg-gray-100 transition-colors">
                        <td class="p-3">{{ $class->name }}</td>
                        <td class="p-3 right-0 absolute">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.classes.edit', $class->id) }}"
                                    class="text-white bg-blue-500 hover:bg-blue-600 rounded-lg py-1 px-3 text-sm font-medium">Edit</a>

                                <form action="{{ route('admin.classes.destroy', $class->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus Kelas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-white bg-red-500 hover:bg-red-600 rounded-lg font-medium py-1 px-3 text-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
