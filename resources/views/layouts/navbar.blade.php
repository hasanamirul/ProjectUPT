<nav class="bg-white border-b-2 border-green-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('courses.index') }}" class="flex items-center text-2xl font-bold text-green-600">
                    <span class="mr-2">🎓</span>
                    WHTECH
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('courses.index') }}"
                    class="text-gray-700 hover:text-green-600 hover:bg-green-50 px-3 py-2 rounded-md text-sm font-medium transition">
                    Daftar Mata Kuliah
                </a>
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="text-gray-700 hover:text-green-600 hover:bg-green-50 px-3 py-2 rounded-md text-sm font-medium transition">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-gray-700 hover:text-green-600 hover:bg-green-50 px-3 py-2 rounded-md text-sm font-medium transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="text-gray-700 hover:text-green-600 hover:bg-green-50 px-3 py-2 rounded-md text-sm font-medium transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-green-500 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-green-600 transition">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>