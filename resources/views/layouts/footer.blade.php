<footer class="bg-gradient-to-r from-green-600 to-green-500 text-white mt-8 pt-8 pb-6 rounded-t-xl shadow-inner">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Main Footer Row -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-10">

            <!-- About -->
            <div class="space-y-4">
                <h3 class="text-xl font-bold">Mini Portal akademik Kampus</h3>
                <p class="text-green-50 text-sm leading-relaxed">
                    Portal akademik digital untuk manajemen mata kuliah dan akademik
                    yang modern dan efisien.
                </p>
                <p class="text-green-100 text-sm">
                    Kami berkomitmen menyediakan layanan akademik yang mudah diakses untuk mahasiswa, dosen, dan staf kampus.
                </p>
                <p class="text-green-100 text-xs">
                    © 2026 WHTECH
                </p>
            </div>

            <!-- Menu -->
            <div class="space-y-4">
                <h3 class="text-xl font-bold">Menu</h3>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="{{ route('courses.index') }}"
                            class="text-green-50 hover:text-white transition font-medium flex items-center group">
                            <span class="mr-2 group-hover:translate-x-1 transition">›</span>
                            Daftar Mata Kuliah
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="text-green-50 hover:text-white transition font-medium flex items-center group">
                            <span class="mr-2 group-hover:translate-x-1 transition">›</span>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}"
                            class="text-green-50 hover:text-white transition font-medium flex items-center group">
                            <span class="mr-2 group-hover:translate-x-1 transition">›</span>
                            Profil
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="space-y-4">
                <h3 class="text-xl font-bold">Hubungi Kami</h3>
                <div class="space-y-2 text-green-50 text-sm">
                    <p><span class="font-semibold">Email:</span> info@whtech.id</p>
                    <p><span class="font-semibold">Telp:</span> +62 xxx xxx xxx</p>
                    <p><span class="font-semibold">Alamat:</span> Indonesia</p>
                </div>
            </div>

            <!-- Quick Info -->
            <div class="space-y-4">
                <h3 class="text-xl font-bold">Informasi</h3>
                <ul class="space-y-2 text-green-50 text-sm">
                    <li>• 15+ Mata Kuliah</li>
                    <li>• Dosen Profesional</li>
                    <li>• Akreditasi Baik</li>
                </ul>
            </div>

        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-green-400 pt-4 pb-4 flex flex-col md:flex-row justify-between items-center">

            <p class="text-green-100 text-sm">
                Dikembangkan untuk kemajuan akademik. Hubungi kami di support@whtech.id untuk bantuan.
            </p>

            <div class="flex gap-6 text-sm font-medium mt-4 md:mt-0">
                <a href="#" class="text-green-50 hover:text-white transition">Privacy</a>
                <a href="#" class="text-green-50 hover:text-white transition">Terms</a>
                <a href="#" class="text-green-50 hover:text-white transition">Support</a>
            </div>

        </div>

    </div>
</footer>