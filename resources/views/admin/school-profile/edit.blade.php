@extends('layouts.admin')

@section('title', 'Profil Sekolah - Lokasi & Kontak | Admin RA AN-NUUR')

@section('styles')
/* Leaflet Map Styles */
.leaflet-container { border-radius: 16px; }
.map-container { position: relative; border-radius: 16px; overflow: hidden; border: 2px solid #e5e7eb; }
.map-container::after {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 16px;
    pointer-events: none;
    box-shadow: inset 0 2px 8px rgba(0,0,0,0.06);
    z-index: 500;
}
.field-group { transition: all 0.2s ease; }
.field-group:focus-within { transform: translateY(-1px); }
.field-group:focus-within label { color: #059669; }
.field-group input:focus, .field-group textarea:focus {
    border-color: #10b981 !important;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12) !important;
}
.embed-preview iframe { width: 100% !important; height: 100% !important; border: 0 !important; border-radius: 12px; }
@endsection

@section('content')
<main class="md:ml-[280px] p-4 md:p-8 min-h-screen">
    <div class="max-w-6xl mx-auto">

        {{-- Page Header --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-emerald-600 text-2xl" style="font-variation-settings: 'FILL' 1;">location_on</span>
                </div>
                <div>
                    <h1 class="font-display text-2xl md:text-3xl font-bold text-gray-900">Profil Sekolah</h1>
                    <p class="text-sm text-gray-500 font-medium">Lokasi & Kontak</p>
                </div>
            </div>
            <p class="text-gray-500 mt-2">Kelola informasi alamat, kontak, dan titik lokasi Google Maps sekolah Anda.</p>
        </div>

        {{-- Success Alert --}}
        @if(session('success'))
        <div id="successAlert" class="mb-6 bg-emerald-50 border border-emerald-200 rounded-2xl p-4 flex items-center gap-3 animate-[fadeInDown_0.4s_ease-out]">
            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-emerald-600" style="font-variation-settings: 'FILL' 1;">check_circle</span>
            </div>
            <div class="flex-1">
                <p class="font-bold text-emerald-800 text-sm">Berhasil!</p>
                <p class="text-emerald-700 text-sm">{{ session('success') }}</p>
            </div>
            <button onclick="document.getElementById('successAlert').remove()" class="text-emerald-400 hover:text-emerald-600 p-1">
                <span class="material-symbols-outlined text-lg">close</span>
            </button>
        </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-4">
            <div class="flex items-center gap-2 mb-2">
                <span class="material-symbols-outlined text-red-500" style="font-variation-settings: 'FILL' 1;">error</span>
                <p class="font-bold text-red-800 text-sm">Terdapat kesalahan pada form:</p>
            </div>
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1 ml-7">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.school-profile.update') }}" method="POST" id="schoolProfileForm">
            @csrf
            @method('PUT')

            {{-- Section 1: Informasi Sekolah --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 md:p-8 mb-6">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                    <span class="material-symbols-outlined text-emerald-500">school</span>
                    <h2 class="font-display text-xl font-bold text-gray-900">Informasi Sekolah</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Nama Sekolah --}}
                    <div class="field-group md:col-span-2">
                        <label for="school_name" class="block text-sm font-bold text-gray-700 mb-2">
                            Nama Sekolah <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="school_name" id="school_name"
                            value="{{ old('school_name', $profile->school_name) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:outline-none transition-all text-gray-800 font-medium"
                            placeholder="Contoh: RA AN-NUUR" required>
                    </div>

                    {{-- Alamat Lengkap --}}
                    <div class="field-group md:col-span-2">
                        <label for="address" class="block text-sm font-bold text-gray-700 mb-2">
                            Alamat Lengkap <span class="text-red-400">*</span>
                        </label>
                        <textarea name="address" id="address" rows="2"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:outline-none transition-all text-gray-800 resize-none"
                            placeholder="Jalan, RT/RW, Desa/Kelurahan" required>{{ old('address', $profile->address) }}</textarea>
                    </div>

                    {{-- Kecamatan --}}
                    <div class="field-group">
                        <label for="district" class="block text-sm font-bold text-gray-700 mb-2">Kecamatan</label>
                        <input type="text" name="district" id="district"
                            value="{{ old('district', $profile->district) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:outline-none transition-all text-gray-800"
                            placeholder="Nama Kecamatan">
                    </div>

                    {{-- Kabupaten/Kota --}}
                    <div class="field-group">
                        <label for="city" class="block text-sm font-bold text-gray-700 mb-2">Kabupaten / Kota</label>
                        <input type="text" name="city" id="city"
                            value="{{ old('city', $profile->city) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:outline-none transition-all text-gray-800"
                            placeholder="Nama Kabupaten/Kota">
                    </div>

                    {{-- Provinsi --}}
                    <div class="field-group">
                        <label for="province" class="block text-sm font-bold text-gray-700 mb-2">Provinsi</label>
                        <input type="text" name="province" id="province"
                            value="{{ old('province', $profile->province) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:outline-none transition-all text-gray-800"
                            placeholder="Nama Provinsi">
                    </div>

                    {{-- Kode Pos --}}
                    <div class="field-group">
                        <label for="postal_code" class="block text-sm font-bold text-gray-700 mb-2">Kode Pos</label>
                        <input type="text" name="postal_code" id="postal_code"
                            value="{{ old('postal_code', $profile->postal_code) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:outline-none transition-all text-gray-800"
                            placeholder="12345" maxlength="10">
                    </div>
                </div>
            </div>

            {{-- Section 2: Kontak --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 md:p-8 mb-6">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                    <span class="material-symbols-outlined text-blue-500">contacts</span>
                    <h2 class="font-display text-xl font-bold text-gray-900">Informasi Kontak</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Telepon --}}
                    <div class="field-group">
                        <label for="phone" class="block text-sm font-bold text-gray-700 mb-2">
                            Nomor Telepon <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-400 text-lg">call</span>
                            <input type="text" name="phone" id="phone"
                                value="{{ old('phone', $profile->phone) }}"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:outline-none transition-all text-gray-800"
                                placeholder="081234567890" required>
                        </div>
                    </div>

                    {{-- WhatsApp --}}
                    <div class="field-group">
                        <label for="whatsapp" class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-400 text-lg">chat</span>
                            <input type="text" name="whatsapp" id="whatsapp"
                                value="{{ old('whatsapp', $profile->whatsapp) }}"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:outline-none transition-all text-gray-800"
                                placeholder="6281234567890 (dengan kode negara)">
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="field-group">
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2">
                            Email <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-400 text-lg">mail</span>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $profile->email) }}"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:outline-none transition-all text-gray-800"
                                placeholder="email@sekolah.sch.id" required>
                        </div>
                    </div>

                    {{-- Jam Operasional --}}
                    <div class="field-group">
                        <label for="operating_hours" class="block text-sm font-bold text-gray-700 mb-2">Jam Operasional</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-400 text-lg">schedule</span>
                            <input type="text" name="operating_hours" id="operating_hours"
                                value="{{ old('operating_hours', $profile->operating_hours) }}"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:outline-none transition-all text-gray-800"
                                placeholder="Senin - Sabtu, 07:00 - 14:00 WIB">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 3: Lokasi & Peta --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 md:p-8 mb-6">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                    <span class="material-symbols-outlined text-rose-500">map</span>
                    <h2 class="font-display text-xl font-bold text-gray-900">Lokasi & Peta</h2>
                </div>

                {{-- Coordinates --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                    <div class="field-group">
                        <label for="latitude" class="block text-sm font-bold text-gray-700 mb-2">
                            Latitude <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="latitude" id="latitude"
                            value="{{ old('latitude', $profile->latitude) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:outline-none transition-all text-gray-800 font-mono"
                            placeholder="-6.9175" required>
                    </div>
                    <div class="field-group">
                        <label for="longitude" class="block text-sm font-bold text-gray-700 mb-2">
                            Longitude <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="longitude" id="longitude"
                            value="{{ old('longitude', $profile->longitude) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:outline-none transition-all text-gray-800 font-mono"
                            placeholder="107.6191" required>
                    </div>
                </div>

                {{-- Info Banner --}}
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-blue-500 mt-0.5">info</span>
                        <div>
                            <p class="text-sm text-blue-800 font-medium">Klik pada peta atau geser marker untuk menentukan lokasi sekolah.</p>
                            <p class="text-xs text-blue-600 mt-1">Latitude dan Longitude akan terisi secara otomatis.</p>
                        </div>
                    </div>
                    <button type="button" id="locateBtn" class="flex-shrink-0 inline-flex items-center gap-2 px-4 py-2 bg-white border border-blue-200 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all text-sm font-bold shadow-sm active:scale-95">
                        <span class="material-symbols-outlined text-base">my_location</span>
                        Cari Lokasi Saya
                    </button>
                </div>

                {{-- Leaflet Map --}}
                <div class="map-container mb-6">
                    <div id="adminMap" style="height: 420px; width: 100%; z-index: 1;"></div>
                </div>

                {{-- Google Maps Embed & URL --}}
                <div class="grid grid-cols-1 gap-5 mt-6">
                    <div class="field-group">
                        <label for="google_maps_url" class="block text-sm font-bold text-gray-700 mb-2">Google Maps URL</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-400 text-lg">link</span>
                            <input type="url" name="google_maps_url" id="google_maps_url"
                                value="{{ old('google_maps_url', $profile->google_maps_url) }}"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:outline-none transition-all text-gray-800"
                                placeholder="https://maps.google.com/?q=...">
                        </div>
                        <p class="text-xs text-gray-400 mt-1.5">URL yang digunakan untuk tombol "Buka di Google Maps" di landing page.</p>
                    </div>

                    <div class="field-group">
                        <label for="google_maps_embed" class="block text-sm font-bold text-gray-700 mb-2">Google Maps Embed Code</label>
                        <textarea name="google_maps_embed" id="google_maps_embed" rows="4"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:outline-none transition-all text-gray-800 font-mono text-sm resize-none"
                            placeholder='<iframe src="https://www.google.com/maps/embed?pb=..." ...></iframe>'>{{ old('google_maps_embed', $profile->google_maps_embed) }}</textarea>
                        <p class="text-xs text-gray-400 mt-1.5">Paste kode embed dari Google Maps. Kode ini akan ditampilkan di landing page.</p>
                    </div>

                    {{-- Embed Preview --}}
                    @if($profile->google_maps_embed)
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Preview Embed</label>
                        <div class="embed-preview rounded-2xl overflow-hidden border border-gray-200 shadow-sm" style="height: 300px;">
                            {!! $profile->google_maps_embed !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end">
                <button type="button" id="reviewBtn"
                    class="inline-flex items-center gap-2 px-8 py-3.5 bg-emerald-500 text-white rounded-2xl font-bold hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/30 active:scale-[0.98]">
                    <span class="material-symbols-outlined text-lg">fact_check</span>
                    Review & Simpan
                </button>
            </div>
        </form>
    </div>
</main>
@endsection

@section('scripts')
{{-- Leaflet CSS & JS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get initial coordinates
    const initLat = parseFloat(document.getElementById('latitude').value) || -7.1627;
    const initLng = parseFloat(document.getElementById('longitude').value) || 107.1382;

    // Initialize map
    const map = L.map('adminMap', {
        scrollWheelZoom: true,
        zoomControl: true,
    }).setView([initLat, initLng], 15);

    // Add tile layer (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19,
    }).addTo(map);

    // Custom marker icon
    const schoolIcon = L.divIcon({
        className: 'custom-marker',
        html: `<div style="
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 50% 50% 50% 4px;
            transform: rotate(-45deg);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
            border: 3px solid white;
        ">
            <span style="transform: rotate(45deg); color: white; font-size: 20px;" class="material-symbols-outlined">school</span>
        </div>`,
        iconSize: [44, 44],
        iconAnchor: [22, 44],
        popupAnchor: [0, -44],
    });

    // Create draggable marker
    const marker = L.marker([initLat, initLng], {
        draggable: true,
        icon: schoolIcon,
    }).addTo(map);

    marker.bindPopup('<b>Lokasi Sekolah</b><br>Geser marker atau klik peta untuk memindahkan.').openPopup();

    // Function to update coordinate inputs
    function updateCoordinates(lat, lng) {
        document.getElementById('latitude').value = lat.toFixed(7);
        document.getElementById('longitude').value = lng.toFixed(7);
    }

    // Marker drag event
    marker.on('dragend', function(e) {
        const pos = e.target.getLatLng();
        updateCoordinates(pos.lat, pos.lng);
        marker.setPopupContent(`<b>Lokasi Sekolah</b><br>Lat: ${pos.lat.toFixed(7)}<br>Lng: ${pos.lng.toFixed(7)}`);
    });

    // Map click event - move marker
    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        updateCoordinates(e.latlng.lat, e.latlng.lng);
        marker.setPopupContent(`<b>Lokasi Sekolah</b><br>Lat: ${e.latlng.lat.toFixed(7)}<br>Lng: ${e.latlng.lng.toFixed(7)}`).openPopup();
    });

    // Manual coordinate input — update marker position
    function onManualInput() {
        const lat = parseFloat(document.getElementById('latitude').value);
        const lng = parseFloat(document.getElementById('longitude').value);
        if (!isNaN(lat) && !isNaN(lng) && lat >= -90 && lat <= 90 && lng >= -180 && lng <= 180) {
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], map.getZoom());
            marker.setPopupContent(`<b>Lokasi Sekolah</b><br>Lat: ${lat.toFixed(7)}<br>Lng: ${lng.toFixed(7)}`);
        }
    }

    document.getElementById('latitude').addEventListener('change', onManualInput);
    document.getElementById('longitude').addEventListener('change', onManualInput);

    // Cari Lokasi Saya
    document.getElementById('locateBtn').addEventListener('click', function() {
        if (!navigator.geolocation) {
            Swal.fire('Gagal', 'Browser Anda tidak mendukung fitur lokasi.', 'error');
            return;
        }

        const btn = this;
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<span class="material-symbols-outlined text-base animate-spin">progress_activity</span> Mencari...';
        btn.disabled = true;

        navigator.geolocation.getCurrentPosition(
            function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                
                marker.setLatLng([lat, lng]);
                map.setView([lat, lng], 17);
                updateCoordinates(lat, lng);
                marker.setPopupContent(`<b>Lokasi Saya</b><br>Lat: ${lat.toFixed(7)}<br>Lng: ${lng.toFixed(7)}`).openPopup();
                
                btn.innerHTML = originalHtml;
                btn.disabled = false;
                
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Lokasi ditemukan!',
                    showConfirmButton: false,
                    timer: 3000
                });
            },
            function(error) {
                let msg = 'Gagal mengambil lokasi.';
                if (error.code === 1) msg = 'Anda menolak akses lokasi. Izinkan di browser Anda lalu coba lagi.';
                
                Swal.fire('Gagal', msg, 'error');
                btn.innerHTML = originalHtml;
                btn.disabled = false;
            },
            { enableHighAccuracy: true, timeout: 10000 }
        );
    });

    // Fix map rendering issue when loaded in hidden containers
    setTimeout(() => map.invalidateSize(), 200);
});
</script>

{{-- SweetAlert for form submission review --}}
<script>
document.getElementById('reviewBtn').addEventListener('click', function(e) {
    const form = document.getElementById('schoolProfileForm');
    
    // Validasi HTML5 bawaan form (required email, max length dll)
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const name = document.getElementById('school_name').value;
    const address = document.getElementById('address').value;
    const lat = document.getElementById('latitude').value;
    const lng = document.getElementById('longitude').value;

    Swal.fire({
        title: 'Review Data Lokasi',
        html: `
            <div class="text-left space-y-4">
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <p class="text-xs text-gray-400 uppercase tracking-wider font-bold mb-1">Nama Sekolah</p>
                    <p class="font-medium text-gray-900">${name}</p>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <p class="text-xs text-gray-400 uppercase tracking-wider font-bold mb-1">Alamat Lengkap</p>
                    <p class="font-medium text-gray-900">${address}</p>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <p class="text-xs text-gray-400 uppercase tracking-wider font-bold mb-1">Titik Peta</p>
                    <p class="font-mono text-sm text-primary mb-2">${lat}, ${lng}</p>
                    <div class="bg-amber-50 text-amber-800 p-3 rounded-lg border border-amber-200 text-xs leading-relaxed flex gap-2">
                        <span class="material-symbols-outlined text-base">warning</span>
                        <p>Pastikan koordinat lokasi pada peta sudah tepat agar fitur <b>Buka di Google Maps</b> pada Landing Page berfungsi dengan akurat.</p>
                    </div>
                </div>
            </div>
        `,
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#10b981',
        cancelButtonColor: '#9ca3af',
        confirmButtonText: '<div class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">save</span> Ya, Simpan Sekarang</div>',
        cancelButtonText: 'Kembali Edit',
        reverseButtons: true,
        customClass: {
            confirmButton: 'rounded-xl',
            cancelButton: 'rounded-xl'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const btn = document.getElementById('reviewBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="material-symbols-outlined text-lg animate-spin">progress_activity</span> Menyimpan...';
            form.submit();
        }
    });
});
</script>

<style>
@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endsection
