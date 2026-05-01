<?php
// ============================================================
//  api/handler.php — REST-like AJAX Handler
// ============================================================
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once '../includes/config.php';

$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {

    // ----------------------------------------------------------
    // Cek status ganjil genap
    // ----------------------------------------------------------
    case 'ganjil_genap':
        $gg = getGanjilGenap();
        echo json_encode(['success' => true, 'data' => $gg]);
        break;

    // ----------------------------------------------------------
    // Cek plat nomor
    // ----------------------------------------------------------
    case 'cek_plat':
        $plat = strtoupper(trim($_POST['plat'] ?? ''));
        if (!$plat) {
            echo json_encode(['success' => false, 'message' => 'Nomor plat tidak boleh kosong']);
            break;
        }
        preg_match('/\d+/', $plat, $matches);
        if (empty($matches)) {
            echo json_encode(['success' => false, 'message' => 'Tidak ditemukan angka pada plat nomor']);
            break;
        }
        $angka = (int) $matches[0];
        $isGanjil = ($angka % 2 !== 0);
        $gg = getGanjilGenap();

        $result = [];
        if ($gg['is_weekend']) {
            $result = ['status' => 'bebas', 'label' => '✅ BEBAS', 'pesan' => "Plat $plat (Angka $angka — " . ($isGanjil ? 'Ganjil' : 'Genap') . ") bebas melintas. Hari ini adalah " . $gg['hari_nama'] . " (akhir pekan).", 'color' => 'green'];
        } elseif ($isGanjil === $gg['is_ganjil']) {
            if ($gg['aktif']) {
                $result = ['status' => 'dilarang', 'label' => '🚫 DILARANG', 'pesan' => "Plat $plat (Angka $angka — " . ($isGanjil ? 'Ganjil' : 'Genap') . ") DILARANG saat ini! Hari ini " . strtoupper($gg['status']) . " dan jam ganjil-genap sedang aktif. Gunakan jalur alternatif.", 'color' => 'red'];
            } else {
                $result = ['status' => 'hati-hati', 'label' => '⚠️ HATI-HATI', 'pesan' => "Plat $plat (Angka $angka — " . ($isGanjil ? 'Ganjil' : 'Genap') . ") cocok hari ini (" . strtoupper($gg['status']) . "). Saat ini jam GG belum/sudah aktif, tapi hati-hati saat jam 06:00–10:00 atau 16:00–21:00.", 'color' => 'yellow'];
            }
        } else {
            $result = ['status' => 'boleh', 'label' => '✅ BOLEH', 'pesan' => "Plat $plat (Angka $angka — " . ($isGanjil ? 'Ganjil' : 'Genap') . ") boleh melintas. Hari ini berlaku " . strtoupper($gg['status']) . ", angka Anda tidak terpengaruh.", 'color' => 'green'];
        }
        echo json_encode(['success' => true, 'data' => array_merge($result, ['plat' => $plat, 'angka' => $angka, 'is_ganjil' => $isGanjil])]);
        break;

    // ----------------------------------------------------------
    // Hitung tarif tol
    // ----------------------------------------------------------
    case 'hitung_toll':
        $kode = $_POST['kode'] ?? '';
        $gol = (int) ($_POST['golongan'] ?? 1);
        global $toll_data;
        $found = null;
        foreach ($toll_data as $t) {
            if ($t['kode'] === $kode) { $found = $t; break; }
        }
        if (!$found) {
            echo json_encode(['success' => false, 'message' => 'Rute tol tidak ditemukan']);
            break;
        }
        $gol = max(1, min(5, $gol));
        $tarif = $found['tarif'][$gol];
        echo json_encode([
            'success' => true,
            'data' => [
                'nama' => $found['nama'],
                'tarif' => $tarif,
                'tarif_fmt' => formatRupiah($tarif),
                'jarak' => $found['jarak'],
                'waktu' => $found['waktu'],
                'golongan' => $gol,
                'rest_area' => $found['rest_area'],
                'gerbang' => $found['gerbang'],
                'status' => $found['status'],
                'lat_dari' => $found['lat_dari'],
                'lng_dari' => $found['lng_dari'],
                'lat_tujuan' => $found['lat_tujuan'],
                'lng_tujuan' => $found['lng_tujuan'],
            ]
        ]);
        break;

    // ----------------------------------------------------------
    // Ambil semua tempat (filter by kategori)
    // ----------------------------------------------------------
    case 'get_places':
        $cat = $_GET['cat'] ?? 'semua';
        global $places_data;
        $filtered = $cat === 'semua'
            ? $places_data
            : array_values(array_filter($places_data, fn($p) => in_array($cat, $p['cat'])));
        echo json_encode(['success' => true, 'data' => $filtered, 'total' => count($filtered)]);
        break;

    // ----------------------------------------------------------
    // Search tempat
    // ----------------------------------------------------------
    case 'search_places':
        $q = strtolower(trim($_GET['q'] ?? ''));
        global $places_data;
        if (strlen($q) < 2) {
            echo json_encode(['success' => true, 'data' => [], 'total' => 0]);
            break;
        }
        $results = array_values(array_filter($places_data, function($p) use ($q) {
            return str_contains(strtolower($p['nama']), $q)
                || str_contains(strtolower($p['area']), $q)
                || str_contains(strtolower($p['info']), $q);
        }));
        echo json_encode(['success' => true, 'data' => $results, 'total' => count($results)]);
        break;

    // ----------------------------------------------------------
    // Info kondisi jalan (simulasi update)
    // ----------------------------------------------------------
    case 'kondisi_jalan':
        $kondisi = [
            ['ruas' => 'Tol JKT–Ciampek (Cikarang)', 'status' => 'lancar', 'waktu' => rand(12, 25)],
            ['ruas' => 'Tol JKT–Ciampek (Gempong)', 'status' => rand(0,1) ? 'padat' : 'lancar', 'waktu' => rand(35, 70)],
            ['ruas' => 'Tol JKT–Bogor (Jagorawi)', 'status' => 'lancar', 'waktu' => rand(40, 55)],
            ['ruas' => 'Tol JKT–Bekasi', 'status' => rand(0,1) ? 'padat' : 'macet', 'waktu' => rand(40, 90)],
            ['ruas' => 'Tol JORR W2', 'status' => 'lancar', 'waktu' => rand(15, 30)],
            ['ruas' => 'Jl. Sudirman', 'status' => rand(0,2) === 0 ? 'macet' : 'padat', 'waktu' => rand(20, 60)],
            ['ruas' => 'Jl. Gatot Subroto', 'status' => rand(0,1) ? 'padat' : 'lancar', 'waktu' => rand(15, 40)],
            ['ruas' => 'Tol Sedyatmo (Bandara)', 'status' => 'lancar', 'waktu' => rand(25, 45)],
        ];
        echo json_encode(['success' => true, 'data' => $kondisi, 'updated_at' => date('H:i')]);
        break;

    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Action tidak valid']);
        break;
}

