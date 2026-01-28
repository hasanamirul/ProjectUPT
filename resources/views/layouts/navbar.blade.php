<nav class="bg-gradient-to-r from-green-600 to-green-500 border-b border-green-200 shadow-sm rounded-b-xl py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('courses.index') }}" class="flex items-center text-3xl font-bold">
                    <span class="mr-3 text-2xl">🎓</span>
                    Mini-Portal Akademik Kampus
                </a>
                <p class="hidden md:block text-sm text-green-100">Manajemen mata kuliah, jadwal, dan informasi akademik
                    terintegrasi.</p>
            </div>

            <div class="flex items-center space-x-3">
                <a href="{{ route('courses.index') }}"
                    class=" bg-white/10 hover:bg-white/20 px-4 py-3 rounded-lg text-sm font-medium transition duration-200">
                    Daftar Mata Kuliah
                </a>
                @auth
                <a href="{{ route('dashboard') }}"
                    class=" bg-white/10 hover:bg-white/20 px-4 py-3 rounded-lg text-sm font-medium transition duration-200">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class=" bg-white/10 hover:bg-white/20 px-4 py-3 rounded-lg text-sm font-medium transition duration-200">
                        Logout
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}"
                    class=" bg-white/10 hover:bg-white/20 px-4 py-3 rounded-lg text-sm font-medium transition duration-200">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="bg-white text-green-600 px-5 py-3 rounded-lg text-sm font-medium hover:bg-white/90 transition duration-200">
                    Register
                </a>
                @endauth
            </div>
        </div>
    </div>
</nav>