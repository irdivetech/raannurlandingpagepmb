<!-- Footer -->
<footer class="bg-surface-container-lowest border-t border-outline-variant mt-auto">
    <div class="max-w-container-max mx-auto px-gutter py-xl">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-xl">
            <!-- Brand Column -->
            <div class="md:col-span-1">
                <a href="{{ route('pmb.landing') }}" class="font-headline-sm font-bold text-primary flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">child_care</span>
                    <span>RA AN-NUUR</span>
                </a>
                <p class="font-body-sm text-on-surface-variant leading-relaxed">
                    Membangun generasi qur'ani yang cerdas, ceria, dan berakhlak mulia sejak usia dini.
                </p>
                <div class="flex gap-4 mt-6">
                    <a href="https://www.facebook.com/share/198wgDDjZs/" target="_blank" class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center text-on-surface hover:bg-primary hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-lg">facebook</span>
                    </a>
                    <a href="https://www.instagram.com/ra.an_nuur.takokak?igsh=cGVwcWppY3AwcWg=" target="_blank" class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center text-on-surface hover:bg-primary hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-lg">photo_camera</span>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="font-label-md font-bold text-on-surface mb-4 uppercase tracking-wider">Informasi</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="font-body-sm text-on-surface-variant hover:text-primary transition-colors">Tentang Kami</a></li>
                    <li><a href="#" class="font-body-sm text-on-surface-variant hover:text-primary transition-colors">Program Belajar</a></li>
                    <li><a href="#" class="font-body-sm text-on-surface-variant hover:text-primary transition-colors">Fasilitas</a></li>
                    <li><a href="#" class="font-body-sm text-on-surface-variant hover:text-primary transition-colors">Testimoni</a></li>
                </ul>
            </div>
            
            <!-- PMB Links -->
            <div>
                <h3 class="font-label-md font-bold text-on-surface mb-4 uppercase tracking-wider">Pendaftaran</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('pmb.register') }}" class="font-body-sm text-on-surface-variant hover:text-primary transition-colors">Panduan Daftar</a></li>
                    <li><a href="#" class="font-body-sm text-on-surface-variant hover:text-primary transition-colors">Rincian Biaya</a></li>
                    <li><a href="{{ route('pmb.tracking') }}" class="font-body-sm text-on-surface-variant hover:text-primary transition-colors">Cek Status</a></li>
                    <li><a href="#" class="font-body-sm text-on-surface-variant hover:text-primary transition-colors">FAQ PMB</a></li>
                </ul>
            </div>
            
            <!-- Contact -->
            <div>
                <h3 class="font-label-md font-bold text-on-surface mb-4 uppercase tracking-wider">Hubungi Kami</h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary mt-1">location_on</span>
                        <span class="font-body-sm text-on-surface-variant">KP. CIJERUK RT.04 RW.02, Desa Waringinsari, Kec. Takokak, Kab. Cianjur, Jawa Barat 43265</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">call</span>
                        <span class="font-body-sm text-on-surface-variant">0813-9549-6112 (Kepala RA)</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">mail</span>
                        <span class="font-body-sm text-on-surface-variant">raannurtakokak@gmail.com</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="mt-xl pt-lg border-t border-outline-variant flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="font-body-sm text-on-surface-variant">© 2024 RA AN-NUUR. All rights reserved.</p>
            <div class="flex gap-6">
                <a href="#" class="font-body-sm text-on-surface-variant hover:text-primary">Kebijakan Privasi</a>
                <a href="#" class="font-body-sm text-on-surface-variant hover:text-primary">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>
