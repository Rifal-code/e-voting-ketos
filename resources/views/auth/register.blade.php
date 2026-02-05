@extends('layouts.pages') @section('content')
    <div class="w-lg flex flex-col gap-5 p-5 mx-auto">
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
            <h1 class="font-black text-2xl my-2">Daftar</h1>
            <p class="text-gray-600">
                Buat akun untuk berpartisipasi dalam pemilihan
            </p>
        </div>

        <form action="{{ route('register.store') }}" method="POST"
            class="p-5 rounded-xl shadow-xl bg-white flex flex-col gap-5">
            @csrf
            <div>
                <h1 class="font-black text-xl my-2">Buat Akun Baru</h1>
                <p class="text-gray-600">Isi data diri Anda untuk mendaftar</p>
            </div>

            <div>
                <label class="text-sm" for="name">Nama Lengkap</label>
                <input type="text" name="name" placeholder="Nama Lengkap"
                    class="w-full bg-[#FAFAFA] p-2 border border-gray-200 rounded-md" />
            </div>

            <div>
                <label class="text-sm" for="email">Email</label>
                <input type="email" name="email" placeholder="nama@gmail.com"
                    class="w-full bg-[#FAFAFA] p-2 border border-gray-200 rounded-md" />
            </div>

            <div>
                <label class="text-sm font-semibold" for="class_id">Kelas</label>
                <select name="class_id"
                    class="w-full bg-[#FAFAFA] p-2 border border-gray-200 rounded-md @error('class_id') @enderror">
                    <option value="" disabled selected>Pilih Kelas</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
                @error('class_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="text-sm" for="password">Password</label>
                <input type="password" name="password" placeholder="••••••••"
                    class="w-full bg-[#FAFAFA] p-2 border border-gray-200 rounded-md" />
            </div>

            <div>
                <label class="text-sm" for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="••••••••"
                    class="w-full bg-[#FAFAFA] p-2 border border-gray-200 rounded-md" />
            </div>

            <button type="submit"
                class="py-3 w-full rounded-xl bg-[#DB2424] hover:bg-[#DB2424]/80 transition-colors text-white flex items-center font-semibold justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-right mr-2 h-4 w-4">
                    <path d="M5 12h14"></path>
                    <path d="m12 5 7 7-7 7"></path>
                </svg>
                Daftar
            </button>

            <a href="{{ route('login') }}" class="text-center text-gray-600">Sudah punya akun?
                <span class="text-[#DB2424] hover:underline">Masuk Sekarang</span></a>
        </form>
    </div>
@endsection
