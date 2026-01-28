<nav class="bg-gradient-to-r from-green-600 to-green-500 border-b border-green-200 shadow-sm rounded-b-xl py-3">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('courses.index') }}" class="flex items-center text-2xl font-bold text-white">
                    <span class="mr-2">🎓</span>
                    Mini Portal akademik Kampus
                </a>
                <p class="hidden md:block text-sm text-green-100">Manajemen mata kuliah, jadwal, dan informasi akademik terintegrasi.</p>
            </div>

            <div class="flex items-center space-x-3">
                <a href="{{ route('courses.index') }}" class="text-white bg-white/10 hover:bg-white/20 px-3 py-2 rounded-lg text-sm font-medium transition duration-200">
                    Daftar Mata Kuliah
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-white bg-white/10 hover:bg-white/20 px-3 py-2 rounded-lg text-sm font-medium transition duration-200">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-white bg-white/10 hover:bg-white/20 px-3 py-2 rounded-lg text-sm font-medium transition duration-200">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-white bg-white/10 hover:bg-white/20 px-3 py-2 rounded-lg text-sm font-medium transition duration-200">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-white text-green-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-white/90 transition duration-200">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>