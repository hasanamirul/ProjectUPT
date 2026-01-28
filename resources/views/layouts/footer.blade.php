<footer class="bg-white border-t-2 border-green-100 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-semibold mb-4 text-green-600">WHTECH</h3>
                <p class="text-gray-600">Mini-Portal Akademik Kampus untuk manajemen mata kuliah dan akademik.</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4 text-green-600">Menu</h3>
                <ul class="text-gray-600 space-y-2">
                    <li><a href="{{ route('courses.index') }}" class="hover:text-green-600 transition">Daftar Mata
                            Kuliah</a></li>
                    <li><a href="{{ route('dashboard') }}" class="hover:text-green-600 transition">Dashboard</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4 text-green-600">Kontak</h3>
                <p class="text-gray-600">Email: info@whtech.id</p>
                <p class="text-gray-600">Telepon: +62 xxx xxx xxx</p>
            </div>
        </div>
        <div class="border-t border-green-100 mt-8 pt-8 text-center text-gray-600">
            <p>&copy; 2026 WHTECH. All rights reserved.</p>
        </div>
    </div>
</footer>