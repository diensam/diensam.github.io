<?php
// ============================================================
//  SupirInfo — Konfigurasi Utama
//  Ganti GOOGLE_MAPS_API_KEY dengan API Key Anda
// ============================================================

define('APP_NAME', 'SupirInfo');
define('APP_VERSION', '2.0');
define('GOOGLE_MAPS_API_KEY', 'MASUKKAN_API_KEY_GOOGLE_MAPS_ANDA');

// ============================================================
//  DATA GANJIL GENAP
// ============================================================
$ganjil_genap_routes = [
    ['jalan' => 'Jl. Sudirman', 'dari' => 'Bundaran Senayan', 'sampai' => 'Jl. Ridwan Rais', 'jam' => '06:00–10:00 & 16:00–21:00', 'hari' => 'Senin–Jumat'],
    ['jalan' => 'Jl. MH Thamrin', 'dari' => 'Bundaran HI', 'sampai' => 'Jl. Medan Merdeka Barat', 'jam' => '06:00–10:00 & 16:00–21:00', 'hari' => 'Senin–Jumat'],
    ['jalan' => 'Jl. Gatot Subroto', 'dari' => 'Bundaran Slipi', 'sampai' => 'Semanggi', 'jam' => '06:00–10:00 & 16:00–21:00', 'hari' => 'Senin–Jumat'],
    ['jalan' => 'Jl. HR Rasuna Said', 'dari' => 'Kuningan', 'sampai' => 'Semanggi', 'jam' => '06:00–10:00 & 16:00–21:00', 'hari' => 'Senin–Jumat'],
    ['jalan' => 'Jl. Medan Merdeka Barat/Utara', 'dari' => 'Area Gambir', 'sampai' => 'Monas', 'jam' => '06:00–10:00 & 16:00–21:00', 'hari' => 'Senin–Jumat'],
    ['jalan' => 'Jl. Sisingamangaraja', 'dari' => 'Blok M', 'sampai' => 'Kebayoran Baru', 'jam' => '06:00–10:00 & 16:00–21:00', 'hari' => 'Senin–Jumat'],
    ['jalan' => 'Jl. Tentara Pelajar', 'dari' => 'Petamburan', 'sampai' => 'Slipi', 'jam' => '06:00–10:00 & 16:00–21:00', 'hari' => 'Senin–Jumat'],
    ['jalan' => 'Jl. Fatmawati', 'dari' => 'Cilandak', 'sampai' => 'Pondok Indah', 'jam' => '06:00–10:00 & 16:00–21:00', 'hari' => 'Senin–Jumat'],
    ['jalan' => 'Tol Dalam Kota', 'dari' => 'Slipi', 'sampai' => 'Cawang–Tanjung Priok', 'jam' => '06:00–10:00 & 16:00–21:00', 'hari' => 'Senin–Jumat'],
    ['jalan' => 'Tol Jakarta–Cikampek', 'dari' => 'Halim (Km 0)', 'sampai' => 'Bekasi Barat (Km 47)', 'jam' => '06:00–10:00 & 16:00–21:00', 'hari' => 'Senin–Jumat'],
    ['jalan' => 'Jl. Perintis Kemerdekaan', 'dari' => 'Pulogadung', 'sampai' => 'Cempaka Putih', 'jam' => '06:00–10:00 & 16:00–21:00', 'hari' => 'Senin–Jumat'],
    ['jalan' => 'Jl. MT Haryono', 'dari' => 'Cawang', 'sampai' => 'Pancoran', 'jam' => '06:00–10:00 & 16:00–21:00', 'hari' => 'Senin–Jumat'],
];

// ============================================================
//  DATA TARIF TOL
// ============================================================
$toll_data = [
    [
        'nama' => 'Jakarta–Cikampek',
        'kode' => 'jkt-ckp',
        'dari' => 'Halim / Jakarta Timur',
        'tujuan' => 'Cikampek',
        'jarak' => 73,
        'waktu' => 75,
        'status' => 'padat',
        'tarif' => [1 => 20000, 2 => 30000, 3 => 40000, 4 => 52500, 5 => 65000],
        'rest_area' => ['Km 19', 'Km 39', 'Km 57', 'Km 62'],
        'gerbang' => ['Halim', 'Cikarang Utama', 'Karawang Barat', 'Cikampek'],
        'lat_dari' => -6.2441, 'lng_dari' => 106.8902,
        'lat_tujuan' => -6.3864, 'lng_tujuan' => 107.4607,
    ],
    [
        'nama' => 'Jakarta–Bogor (Jagorawi)',
        'kode' => 'jkt-bgr',
        'dari' => 'Cawang / Jakarta Timur',
        'tujuan' => 'Bogor Kota',
        'jarak' => 50,
        'waktu' => 50,
        'status' => 'lancar',
        'tarif' => [1 => 14000, 2 => 21000, 3 => 28000, 4 => 36500, 5 => 45500],
        'rest_area' => ['Km 10', 'Km 38'],
        'gerbang' => ['Cawang', 'Cimanggis', 'Gunung Putri', 'Bogor'],
        'lat_dari' => -6.2441, 'lng_dari' => 106.8902,
        'lat_tujuan' => -6.5971, 'lng_tujuan' => 106.7960,
    ],
    [
        'nama' => 'Jakarta–Tangerang (JORR)',
        'kode' => 'jkt-tng',
        'dari' => 'Cengkareng / Jakarta Barat',
        'tujuan' => 'Tangerang Kota',
        'jarak' => 28,
        'waktu' => 35,
        'status' => 'lancar',
        'tarif' => [1 => 9000, 2 => 13500, 3 => 18000, 4 => 22500, 5 => 28000],
        'rest_area' => [],
        'gerbang' => ['Tomang', 'Kebon Jeruk', 'Tangerang'],
        'lat_dari' => -6.1751, 'lng_dari' => 106.8272,
        'lat_tujuan' => -6.1783, 'lng_tujuan' => 106.6319,
    ],
    [
        'nama' => 'Jakarta–Bekasi',
        'kode' => 'jkt-bks',
        'dari' => 'Halim / Jakarta Timur',
        'tujuan' => 'Bekasi Kota',
        'jarak' => 32,
        'waktu' => 45,
        'status' => 'padat',
        'tarif' => [1 => 12500, 2 => 18500, 3 => 25000, 4 => 32500, 5 => 40000],
        'rest_area' => [],
        'gerbang' => ['Halim', 'Bekasi Barat', 'Bekasi Timur'],
        'lat_dari' => -6.2441, 'lng_dari' => 106.8902,
        'lat_tujuan' => -6.2383, 'lng_tujuan' => 106.9756,
    ],
    [
        'nama' => 'Jakarta–Karawang',
        'kode' => 'jkt-krw',
        'dari' => 'Halim / Jakarta Timur',
        'tujuan' => 'Karawang Kota',
        'jarak' => 85,
        'waktu' => 80,
        'status' => 'lancar',
        'tarif' => [1 => 35000, 2 => 52500, 3 => 70000, 4 => 87500, 5 => 109000],
        'rest_area' => ['Km 19', 'Km 39', 'Km 57'],
        'gerbang' => ['Halim', 'Bekasi Barat', 'Cikarang', 'Karawang'],
        'lat_dari' => -6.2441, 'lng_dari' => 106.8902,
        'lat_tujuan' => -6.3011, 'lng_tujuan' => 107.3034,
    ],
    [
        'nama' => 'Bandara Soekarno-Hatta',
        'kode' => 'jkt-cgk',
        'dari' => 'Tomang / Jakarta Barat',
        'tujuan' => 'Terminal 1,2,3 CGK',
        'jarak' => 22,
        'waktu' => 35,
        'status' => 'lancar',
        'tarif' => [1 => 18500, 2 => 27500, 3 => 37000, 4 => 46000, 5 => 57500],
        'rest_area' => [],
        'gerbang' => ['Tomang', 'Cengkareng', 'Bandara'],
        'lat_dari' => -6.1751, 'lng_dari' => 106.8272,
        'lat_tujuan' => -6.1275, 'lng_tujuan' => 106.6537,
    ],
    [
        'nama' => 'Tol JORR (Lingkar Luar)',
        'kode' => 'jorr',
        'dari' => 'Ulujami / Jakarta Selatan',
        'tujuan' => 'Cilincing / Jakarta Utara',
        'jarak' => 45,
        'waktu' => 55,
        'status' => 'lancar',
        'tarif' => [1 => 15500, 2 => 23000, 3 => 31000, 4 => 39000, 5 => 48500],
        'rest_area' => [],
        'gerbang' => ['Ulujami', 'Pondok Pinang', 'Cijago', 'Cilincing'],
        'lat_dari' => -6.2441, 'lng_dari' => 106.7661,
        'lat_tujuan' => -6.1244, 'lng_tujuan' => 106.9115,
    ],
    [
        'nama' => 'Depok–Antasari (Desari)',
        'kode' => 'desari',
        'dari' => 'Antasari / Jakarta Selatan',
        'tujuan' => 'Sawangan / Depok',
        'jarak' => 21,
        'waktu' => 28,
        'status' => 'lancar',
        'tarif' => [1 => 11500, 2 => 17500, 3 => 23000, 4 => 29000, 5 => 36000],
        'rest_area' => [],
        'gerbang' => ['Antasari', 'Sawangan'],
        'lat_dari' => -6.2603, 'lng_dari' => 106.7942,
        'lat_tujuan' => -6.4014, 'lng_tujuan' => 106.7575,
    ],
];

// ============================================================
//  DATA TEMPAT TUJUAN (dengan Koordinat untuk Maps)
// ============================================================
$places_data = [
    // WISATA
    ['nama' => 'Taman Mini Indonesia Indah (TMII)', 'area' => 'Jakarta Timur', 'icon' => '🏛️', 'cat' => ['wisata','jakarta'], 'lat' => -6.3024, 'lng' => 106.8951, 'toll_from_jkt' => 5000, 'jarak_jkt' => '15 km', 'parkir' => 'Sangat Luas', 'info' => 'Wisata budaya & rekreasi keluarga'],
    ['nama' => 'Ancol Dreamland', 'area' => 'Jakarta Utara', 'icon' => '🎡', 'cat' => ['wisata','jakarta'], 'lat' => -6.1248, 'lng' => 106.8347, 'toll_from_jkt' => 0, 'jarak_jkt' => '12 km', 'parkir' => 'Sangat Luas', 'info' => 'Taman hiburan pantai terbesar'],
    ['nama' => 'Monas (Monumen Nasional)', 'area' => 'Jakarta Pusat', 'icon' => '🗽', 'cat' => ['wisata','jakarta'], 'lat' => -6.1754, 'lng' => 106.8272, 'toll_from_jkt' => 0, 'jarak_jkt' => '0 km (Pusat)', 'parkir' => 'Terbatas (⚠️ GG)', 'info' => 'Landmark ikonik Jakarta'],
    ['nama' => 'Kota Tua Jakarta', 'area' => 'Jakarta Barat', 'icon' => '🏚️', 'cat' => ['wisata','jakarta'], 'lat' => -6.1352, 'lng' => 106.8133, 'toll_from_jkt' => 0, 'jarak_jkt' => '8 km', 'parkir' => 'Terbatas', 'info' => 'Wisata sejarah kolonial Belanda'],
    ['nama' => 'Kebun Binatang Ragunan', 'area' => 'Jakarta Selatan', 'icon' => '🦁', 'cat' => ['wisata','jakarta'], 'lat' => -6.3123, 'lng' => 106.8200, 'toll_from_jkt' => 0, 'jarak_jkt' => '18 km', 'parkir' => 'Sangat Luas', 'info' => 'Kebun binatang terbesar Jakarta'],
    ['nama' => 'Pantai Indah Kapuk (PIK)', 'area' => 'Jakarta Utara', 'icon' => '🌴', 'cat' => ['wisata','jakarta'], 'lat' => -6.0985, 'lng' => 106.7312, 'toll_from_jkt' => 15500, 'jarak_jkt' => '25 km', 'parkir' => 'Luas', 'info' => 'Kawasan wisata & kuliner premium'],
    ['nama' => 'Kebun Raya Bogor', 'area' => 'Bogor Kota', 'icon' => '🌿', 'cat' => ['wisata','bogor'], 'lat' => -6.5966, 'lng' => 106.7981, 'toll_from_jkt' => 14000, 'jarak_jkt' => '50 km', 'parkir' => 'Terbatas', 'info' => 'Kebun botani bersejarah kelas dunia'],
    ['nama' => 'Puncak / Cisarua', 'area' => 'Bogor', 'icon' => '🏔️', 'cat' => ['wisata','bogor'], 'lat' => -6.7079, 'lng' => 106.9278, 'toll_from_jkt' => 14000, 'jarak_jkt' => '70 km', 'parkir' => 'Tergantung destinasi', 'info' => 'Wisata alam pegunungan, ramai weekend'],
    ['nama' => 'Waterboom Lippo Cikarang', 'area' => 'Cikarang, Bekasi', 'icon' => '🏊', 'cat' => ['wisata','bekasi'], 'lat' => -6.3400, 'lng' => 107.1446, 'toll_from_jkt' => 20000, 'jarak_jkt' => '45 km', 'parkir' => 'Luas', 'info' => 'Taman air keluarga'],
    // GOLF
    ['nama' => 'Pondok Indah Golf', 'area' => 'Jakarta Selatan', 'icon' => '⛳', 'cat' => ['golf','jakarta'], 'lat' => -6.2903, 'lng' => 106.7857, 'toll_from_jkt' => 0, 'jarak_jkt' => '12 km', 'parkir' => 'Luas', 'info' => '27 Hole · Ruang Tunggu Supir ✅'],
    ['nama' => 'Jabotabek Golf & Country Club', 'area' => 'Cikarang', 'icon' => '⛳', 'cat' => ['golf','bekasi'], 'lat' => -6.3593, 'lng' => 107.1507, 'toll_from_jkt' => 20000, 'jarak_jkt' => '45 km', 'parkir' => 'Teduh & Luas', 'info' => '18 Hole · Ruang Tunggu Supir ✅'],
    ['nama' => 'Royale Jakarta Golf Club', 'area' => 'Jakarta Timur', 'icon' => '⛳', 'cat' => ['golf','jakarta'], 'lat' => -6.2824, 'lng' => 106.9265, 'toll_from_jkt' => 8500, 'jarak_jkt' => '18 km', 'parkir' => 'Teduh', 'info' => '18 Hole · Ruang Tunggu Supir ✅'],
    ['nama' => 'Sentul Highlands Golf Club', 'area' => 'Sentul, Bogor', 'icon' => '⛳', 'cat' => ['golf','bogor'], 'lat' => -6.5564, 'lng' => 106.8405, 'toll_from_jkt' => 14000, 'jarak_jkt' => '40 km', 'parkir' => 'Teduh & Luas', 'info' => '18 Hole · View pegunungan · Supir ✅'],
    ['nama' => 'Karawang Golf & Country Club', 'area' => 'Karawang', 'icon' => '⛳', 'cat' => ['golf','karawang'], 'lat' => -6.3252, 'lng' => 107.3389, 'toll_from_jkt' => 35000, 'jarak_jkt' => '85 km', 'parkir' => 'Luas', 'info' => '18 Hole · Parkir supir tersedia'],
    ['nama' => 'BSD Golf & Country Club', 'area' => 'BSD, Tangerang', 'icon' => '⛳', 'cat' => ['golf','tangerang'], 'lat' => -6.2975, 'lng' => 106.6528, 'toll_from_jkt' => 9000, 'jarak_jkt' => '28 km', 'parkir' => 'Luas', 'info' => '18 Hole · Ruang tunggu supir ✅'],
    ['nama' => 'Damai Indah Golf (PIK)', 'area' => 'Jakarta Utara', 'icon' => '⛳', 'cat' => ['golf','jakarta'], 'lat' => -6.1038, 'lng' => 106.7278, 'toll_from_jkt' => 15500, 'jarak_jkt' => '25 km', 'parkir' => 'Luas', 'info' => '2 Lapangan · Dekat Pantai'],
    // BANDARA
    ['nama' => 'Bandara Soekarno-Hatta (CGK)', 'area' => 'Cengkareng, Tangerang', 'icon' => '✈️', 'cat' => ['bandara'], 'lat' => -6.1275, 'lng' => 106.6537, 'toll_from_jkt' => 18500, 'jarak_jkt' => '22 km', 'parkir' => 'Gedung Parkir T1/T2/T3', 'info' => 'Terminal 1 (Garuda), 2 (Garuda Int), 3 (Lion/Batik/AirAsia)'],
    ['nama' => 'Bandara Halim Perdanakusuma (HLP)', 'area' => 'Jakarta Timur', 'icon' => '✈️', 'cat' => ['bandara'], 'lat' => -6.2662, 'lng' => 106.8894, 'toll_from_jkt' => 0, 'jarak_jkt' => '12 km', 'parkir' => 'Terbatas', 'info' => 'Penerbangan domestik premium'],
    // STASIUN
    ['nama' => 'Stasiun Gambir', 'area' => 'Jakarta Pusat', 'icon' => '🚆', 'cat' => ['stasiun'], 'lat' => -6.1766, 'lng' => 106.8306, 'toll_from_jkt' => 0, 'jarak_jkt' => '0 km (Pusat)', 'parkir' => 'Terbatas (⚠️ GG)', 'info' => 'KA Jarak Jauh · Drop-off: Sisi Barat'],
    ['nama' => 'Stasiun Pasar Senen', 'area' => 'Jakarta Pusat', 'icon' => '🚆', 'cat' => ['stasiun'], 'lat' => -6.1665, 'lng' => 106.8450, 'toll_from_jkt' => 0, 'jarak_jkt' => '2 km', 'parkir' => 'Terbatas', 'info' => 'KA Ekonomi · Drop-off: Jl. Senen Raya'],
    ['nama' => 'Stasiun Bekasi', 'area' => 'Bekasi Kota', 'icon' => '🚆', 'cat' => ['stasiun'], 'lat' => -6.2383, 'lng' => 106.9918, 'toll_from_jkt' => 12500, 'jarak_jkt' => '32 km', 'parkir' => 'Ada', 'info' => 'KRL + KA Jarak Jauh'],
    ['nama' => 'Stasiun Bogor', 'area' => 'Kota Bogor', 'icon' => '🚆', 'cat' => ['stasiun'], 'lat' => -6.5963, 'lng' => 106.7897, 'toll_from_jkt' => 14000, 'jarak_jkt' => '50 km', 'parkir' => 'Terbatas', 'info' => 'KRL Terminus Bogor'],
    ['nama' => 'Stasiun Karawang', 'area' => 'Karawang Kota', 'icon' => '🚆', 'cat' => ['stasiun'], 'lat' => -6.3218, 'lng' => 107.3041, 'toll_from_jkt' => 35000, 'jarak_jkt' => '85 km', 'parkir' => 'Luas', 'info' => 'KA Jarak Jauh'],
    ['nama' => 'Stasiun Tangerang', 'area' => 'Kota Tangerang', 'icon' => '🚆', 'cat' => ['stasiun'], 'lat' => -6.1783, 'lng' => 106.6315, 'toll_from_jkt' => 9000, 'jarak_jkt' => '28 km', 'parkir' => 'Ada', 'info' => 'KRL Line Tangerang'],
    // MALL
    ['nama' => 'Grand Indonesia', 'area' => 'Jakarta Pusat', 'icon' => '🏬', 'cat' => ['mall','jakarta'], 'lat' => -6.1934, 'lng' => 106.8214, 'toll_from_jkt' => 0, 'jarak_jkt' => '0 km (Pusat)', 'parkir' => 'Basement 5 lantai · Valet', 'info' => 'Mall premium · ⚠️ Ganjil Genap'],
    ['nama' => 'Plaza Indonesia', 'area' => 'Jakarta Pusat', 'icon' => '🏬', 'cat' => ['mall','jakarta'], 'lat' => -6.1930, 'lng' => 106.8232, 'toll_from_jkt' => 0, 'jarak_jkt' => '0 km (Pusat)', 'parkir' => 'Basement · Valet', 'info' => 'Luxury mall · ⚠️ Ganjil Genap'],
    ['nama' => 'Summarecon Mall Bekasi', 'area' => 'Bekasi', 'icon' => '🏬', 'cat' => ['mall','bekasi'], 'lat' => -6.2244, 'lng' => 106.9927, 'toll_from_jkt' => 12500, 'jarak_jkt' => '32 km', 'parkir' => 'Sangat Luas', 'info' => 'Mall terbesar Bekasi · Bioskop'],
    ['nama' => 'Botani Square', 'area' => 'Bogor', 'icon' => '🏬', 'cat' => ['mall','bogor'], 'lat' => -6.5876, 'lng' => 106.8140, 'toll_from_jkt' => 14000, 'jarak_jkt' => '50 km', 'parkir' => 'Luas', 'info' => 'Mall utama Kota Bogor'],
    ['nama' => 'Tangcity Mall', 'area' => 'Tangerang', 'icon' => '🏬', 'cat' => ['mall','tangerang'], 'lat' => -6.1783, 'lng' => 106.6319, 'toll_from_jkt' => 9000, 'jarak_jkt' => '28 km', 'parkir' => 'Luas', 'info' => 'Dekat Stasiun Tangerang'],
    ['nama' => 'Galuh Mas Karawang', 'area' => 'Karawang', 'icon' => '🏬', 'cat' => ['mall','karawang'], 'lat' => -6.3011, 'lng' => 107.3034, 'toll_from_jkt' => 35000, 'jarak_jkt' => '85 km', 'parkir' => 'Luas', 'info' => 'Pusat perbelanjaan Karawang'],
    // HOTEL
    ['nama' => 'Hotel Mulia Jakarta', 'area' => 'Jakarta Selatan', 'icon' => '🏨', 'cat' => ['hotel','jakarta'], 'lat' => -6.2098, 'lng' => 106.8218, 'toll_from_jkt' => 0, 'jarak_jkt' => '5 km', 'parkir' => 'Valet & Umum', 'info' => 'Bintang 5 · Area GG Senayan'],
    ['nama' => 'Grand Hyatt Jakarta', 'area' => 'Jakarta Pusat', 'icon' => '🏨', 'cat' => ['hotel','jakarta'], 'lat' => -6.1937, 'lng' => 106.8226, 'toll_from_jkt' => 0, 'jarak_jkt' => '0 km (Pusat)', 'parkir' => 'Basement · Valet', 'info' => 'Bintang 5 · ⚠️ Ganjil Genap'],
    ['nama' => 'The Ritz-Carlton SCBD', 'area' => 'Jakarta Selatan', 'icon' => '🏨', 'cat' => ['hotel','jakarta'], 'lat' => -6.2246, 'lng' => 106.8079, 'toll_from_jkt' => 0, 'jarak_jkt' => '8 km', 'parkir' => 'Valet', 'info' => 'Bintang 5 · SCBD Area'],
    ['nama' => 'Aston Karawang', 'area' => 'Karawang', 'icon' => '🏨', 'cat' => ['hotel','karawang'], 'lat' => -6.3225, 'lng' => 107.3077, 'toll_from_jkt' => 35000, 'jarak_jkt' => '85 km', 'parkir' => 'Luas', 'info' => 'Bintang 4 · Bisnis'],
    ['nama' => 'Hotel Salak Heritage Bogor', 'area' => 'Bogor', 'icon' => '🏨', 'cat' => ['hotel','bogor'], 'lat' => -6.5960, 'lng' => 106.7949, 'toll_from_jkt' => 14000, 'jarak_jkt' => '50 km', 'parkir' => 'Ada', 'info' => 'Bintang 4 · Heritage · Dekat Istana'],
    ['nama' => 'Novotel Tangerang', 'area' => 'Tangerang', 'icon' => '🏨', 'cat' => ['hotel','tangerang'], 'lat' => -6.1700, 'lng' => 106.6400, 'toll_from_jkt' => 9000, 'jarak_jkt' => '28 km', 'parkir' => 'Ada', 'info' => 'Bintang 4 · Bisnis'],
];

// Helper: format rupiah
function formatRupiah($amount) {
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

// Helper: hari ini ganjil/genap
function getGanjilGenap() {
    $tanggal = (int) date('j');
    $hari = (int) date('N'); // 1=Mon ... 7=Sun
    $jam = (int) date('H');
    $isWeekend = ($hari >= 6);
    $isGanjil = ($tanggal % 2 !== 0);
    $isAktif = !$isWeekend && (($jam >= 6 && $jam < 10) || ($jam >= 16 && $jam < 21));
    return [
        'tanggal' => $tanggal,
        'hari_nama' => ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'][$hari],
        'is_weekend' => $isWeekend,
        'is_ganjil' => $isGanjil,
        'status' => $isWeekend ? 'bebas' : ($isGanjil ? 'ganjil' : 'genap'),
        'aktif' => $isAktif,
        'tanggal_full' => date('d F Y'),
    ];
}

