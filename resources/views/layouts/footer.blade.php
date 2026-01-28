<footer class="bg-white border-t-4 border-green-500 mt-16 md:mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <!-- Footer Content Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12 mb-12 md:mb-16">
            <!-- About Section -->
            <div class="space-y-3">
                <h3 class="text-lg md:text-xl font-bold text-green-600 mb-4">WHTECH</h3>
                <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                    Mini-Portal Akademik Kampus untuk manajemen mata kuliah dan akademik yang modern dan efisien.
                </p>
                <p class="text-gray-500 text-xs md:text-sm">© 2026 WHTECH. All rights reserved.</p>
            </div>

            <!-- Navigation Menu -->
            <div class="space-y-3">
                <h3 class="text-lg md:text-xl font-bold text-green-600 mb-4">Menu</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('courses.index') }}"
                            class="text-gray-600 hover:text-green-600 transition-colors duration-200 text-sm md:text-base font-medium inline-flex items-center group">
                            <span class="mr-2">→</span>
                            <span class="group-hover:underline">Daftar Mata Kuliah</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="text-gray-600 hover:text-green-600 transition-colors duration-200 text-sm md:text-base font-medium inline-flex items-center group">
                            <span class="mr-2">→</span>
                            <span class="group-hover:underline">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}"
                            class="text-gray-600 hover:text-green-600 transition-colors duration-200 text-sm md:text-base font-medium inline-flex items-center group">
                            <span class="mr-2">→</span>
                            <span class="group-hover:underline">Profile</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Section -->
            <div class="space-y-3">
                <h3 class="text-lg md:text-xl font-bold text-green-600 mb-4">Hubungi Kami</h3>
                <div class="space-y-2">
                    <p class="text-gray-600 text-sm md:text-base flex items-start space-x-2">
                        <span>📧</span>
                        <span>info@whtech.id</span>
                    </p>
                    <p class="text-gray-600 text-sm md:text-base flex items-start space-x-2">
                        <span>📱</span>
                        <span>+62 xxx xxx xxx</span>
                    </p>
                    <p class="text-gray-600 text-sm md:text-base flex items-start space-x-2">
                        <span>📍</span>
                        <span>Kampus Utama, Indonesia</span>
                    </p>
                </div>
            </div>

            <!-- Quick Info -->
            <div class="space-y-3">
                <h3 class="text-lg md:text-xl font-bold text-green-600 mb-4">Informasi Cepat</h3>
                <div class="space-y-2 text-sm md:text-base">
                    <p class="text-gray-600 flex items-center space-x-2">
                        <span>✓</span>
                        <span>20+ Mata Kuliah</span>
                    </p>
                    <p class="text-gray-600 flex items-center space-x-2">
                        <span>✓</span>
                        <span>Dosen Berpengalaman</span>
                    </p>
                    <p class="text-gray-600 flex items-center space-x-2">
                        <span>✓</span>
                        <span>Akreditasi Internasional</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t-2 border-green-100 pt-8 md:pt-12">
            <!-- Social & Copyright -->
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <p class="text-gray-600 text-sm md:text-base text-center md:text-left">
                    Dikembangkan dengan ❤️ untuk kemajuan akademik
                </p>
                <div class="flex space-x-4 md:space-x-6">
                    <a href="#"
                        class="text-gray-500 hover:text-green-600 transition-colors duration-200 text-sm md:text-base font-medium">
                        Privacy
                    </a>
                    <a href="#"
                        class="text-gray-500 hover:text-green-600 transition-colors duration-200 text-sm md:text-base font-medium">
                        Terms
                    </a>
                    <a href="#"
                        class="text-gray-500 hover:text-green-600 transition-colors duration-200 text-sm md:text-base font-medium">
                        Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>