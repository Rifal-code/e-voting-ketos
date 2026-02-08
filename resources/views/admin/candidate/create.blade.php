@extends('layouts.admin')
@section('content')
    <div class="w-sm flex flex-col p-5 mx-3 gap-5 lg:mx-auto lg:w-lg">
        <div class="mx-auto text-center">
            <div class="p-5 rounded-lg bg-[#DB2424] mx-auto text-white w-fit">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-vote h-8 w-8 text-primary-foreground">
                    <path d="m9 12 2 2 4-4"></path>
                    <path d="M5 7c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2v12H5V7Z"></path>
                    <path d="M22 19H2"></path>
                </svg>
            </div>
            <h1 class="font-black text-2xl my-2">Tambah</h1>
            <p class="text-gray-600">Tambah Kandidat Ketua OSIS</p>
        </div>

        <form action="{{ route('admin.candidates.store') }}" method="POST"
            class="p-5 rounded-xl shadow-xl bg-white flex flex-col gap-5">
            @csrf
            <div>
                <h1 class="font-black text-xl my-2">Tambah Kandidat</h1>
                <p class="text-gray-600">Masukkan data kandidat baru</p>
            </div>

            <div>
                <label class="text-sm" for="name">Nama Lengkap</label>
                <input type="text" name="name" placeholder="Nama Lengkap" required
                    class="w-full bg-[#FAFAFA] p-2 border border-gray-200 rounded-md" />
            </div>


            <div>
                <label class="text-sm" for="nomor">Nomor Kandidat</label>
                <input type="number" name="nomor" placeholder="Nomor Kandidat" required
                    class="w-full bg-[#FAFAFA] p-2 border border-gray-200 rounded-md" />
            </div>

            <div>
                <label class="text-sm" for="visi">Visi</label>
                <input type="text" name="visi" placeholder="Visi Kandidat" required
                    class="w-full bg-[#FAFAFA] p-2 border border-gray-200 rounded-md" />
            </div>

            <div>
                <label class="text-sm" for="misi">Misi </label>
                <textarea name="misi" placeholder="Misi Kandidat" required
                    class="w-full bg-[#FAFAFA] p-2 border border-gray-200 rounded-md" cols="30" rows="5"></textarea>
            </div>


            <button type="submit"
                class="py-3 w-full rounded-xl bg-[#DB2424] hover:bg-[#DB2424]/80 transition-colors text-white flex items-center font-semibold justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-right mr-2 h-4 w-4">
                    <path d="M5 12h14"></path>
                    <path d="m12 5 7 7-7 7"></path>
                </svg>
                Tambah Kandidat
            </button>


        </form>
    </div>
@endsection
