<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-700 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-2 border-green-200">
                <div class="p-6 text-gray-900 border-b-2 border-green-200 bg-gradient-to-r from-green-50 to-white">
                    <h3 class="text-lg font-bold text-green-700 mb-2">Selamat Datang! 👋</h3>
                    <p class="text-gray-700">{{ __("Anda telah berhasil masuk ke Mini Portal akademik Kampus") }}</p>
                </div>
                <div class="p-6">
                    <a href="{{ route('courses.index') }}" 
                        class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 active:scale-95">
                        Lihat Daftar Mata Kuliah →
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>