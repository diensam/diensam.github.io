# SupirInfo v2.0 — Panduan Instalasi

Aplikasi panduan lengkap driver Jabodetabek dengan integrasi Google Maps.

---

## 📦 Struktur File

```
supirinfo/
├── index.php               ← Halaman utama aplikasi
├── includes/
│   └── config.php          ← Konfigurasi & semua data
├── api/
│   └── handler.php         ← API endpoint (AJAX)
└── README.md               ← File ini
```

---

## 🚀 Cara Install di Hosting / Server

### 1. Upload ke Hosting
Upload seluruh folder `supirinfo/` ke:
- **cPanel Hosting**: folder `public_html/supirinfo/`
- **VPS**: `/var/www/html/supirinfo/`
- **XAMPP/Laragon lokal**: `htdocs/supirinfo/`

### 2. Akses Aplikasi
Buka browser ke: `http://domain-anda.com/supirinfo/`

---

## 🗺️ Setup Google Maps API (Wajib untuk Fitur Rute)

### Langkah-langkah:

**Step 1 — Buat Akun Google Cloud**
- Buka: https://console.cloud.google.com/
- Login dengan akun Google Anda
- Buat project baru (misal: "SupirInfo App")

**Step 2 — Aktifkan API yang Diperlukan**
Aktifkan API berikut di menu "APIs & Services":
- ✅ Maps JavaScript API
- ✅ Directions API
- ✅ Geocoding API
- ✅ Places API

**Step 3 — Buat API Key**
- Buka: APIs & Services → Credentials
- Klik "+ Create Credentials" → "API Key"
- Salin API Key yang dihasilkan

**Step 4 — Masukkan API Key ke Aplikasi**
Buka file `includes/config.php`, ganti baris ini:
```php
define('GOOGLE_MAPS_API_KEY', 'MASUKKAN_API_KEY_GOOGLE_MAPS_ANDA');
```
Menjadi (contoh):
```php
define('GOOGLE_MAPS_API_KEY', 'AIzaSyB_contoh_api_key_anda_disini');
```

**Step 5 — Batasi API Key (Sangat Disarankan)**
Di Google Cloud Console → Credentials → Edit API Key:
- Application restrictions: HTTP referrers
- Tambahkan: `https://domain-anda.com/*`

---

## 💡 Kuota & Biaya Google Maps

Google Maps memberikan **$200 kredit gratis/bulan** untuk akun baru.

Estimasi penggunaan untuk 1000 request/hari:
- Maps JavaScript API: GRATIS (dalam kuota)
- Directions API: ~$5/1000 request (setelah kredit habis)
- Geocoding API: ~$5/1000 request

Untuk penggunaan internal perusahaan, $200/bulan umumnya cukup.

---

## ⚙️ Requirement Server

| Kebutuhan | Minimum |
|-----------|---------|
| PHP | 7.4 atau lebih baru |
| Web Server | Apache / Nginx |
| HTTPS | Diperlukan untuk GPS/Geolocation |
| Internet | Diperlukan untuk Google Maps |

---

## 🔧 Kustomisasi Data

Semua data ada di `includes/config.php`:
- `$ganjil_genap_routes` — Ruas ganjil genap
- `$toll_data` — Data tarif dan rute tol
- `$places_data` — Tempat tujuan (golf, mall, hotel, bandara, dll)

Untuk menambah tempat baru, tambahkan array baru di `$places_data`:
```php
[
    'nama' => 'Nama Tempat',
    'area' => 'Kota/Wilayah',
    'icon' => '🏬',
    'cat'  => ['mall', 'bekasi'],     // kategori
    'lat'  => -6.1234,                // koordinat (dari Google Maps)
    'lng'  => 106.9876,
    'toll_from_jkt' => 12500,         // tarif tol dari Jakarta (Rp)
    'jarak_jkt' => '30 km',
    'parkir' => 'Luas',
    'info' => 'Deskripsi singkat',
],
```

---

## 📞 Fitur Aplikasi

| Fitur | Keterangan |
|-------|-----------|
| 🚗 Ganjil Genap | Cek status hari ini + cek plat nomor |
| 🛣️ Info Tol | Kalkulator tarif 5 golongan + detail rute |
| 🗺️ Rute & Jarak | GPS lokasi + hitung rute via Google Maps |
| 📍 Tempat Tujuan | Wisata, golf, bandara, stasiun |
| 🏬 Mall & Hotel | Filter per kota |
| 🆘 SOS | Kontak darurat + tombol langsung telpon |

---

*SupirInfo v2.0 — Dibuat untuk driver profesional Jabodetabek*
