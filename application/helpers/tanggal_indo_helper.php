<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
if (!function_exists('tanggal_indonesia')) {
    function tanggal_indonesia($tanggal) {
        $bulan = array(
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );

        $datetime = new DateTime($tanggal);

        $tahun = $datetime->format('Y');
        $bulan_index = (int) $datetime->format('m') - 1;
        $tanggal = $datetime->format('d');
        $jam = $datetime->format('H:i A');
        
        if ($datetime->format('H:i:s') !== '00:00:00') {
            return $tanggal . '-' . $bulan[$bulan_index] . '-' . $tahun . ', Waktu: ' . $jam;
        } else {
            return $tanggal . '-' . $bulan[$bulan_index] . '-' . $tahun;
        }
    }
}

if (!function_exists('waktu_berlalu')) {
    function waktu_berlalu($waktu_upload) {
        $waktu_sekarang = new DateTime();
        $waktu_upload = new DateTime($waktu_upload);

        // Menyelisih waktu
        $selisih = $waktu_upload->diff($waktu_sekarang);

        $selisih_hari = $selisih->days;

        if ($selisih_hari == 0) {
            return 'Baru-baru ini';
        } elseif ($selisih_hari == 1) {
            return 'Kemarin';
        } elseif ($selisih_hari < 7) {
            return $selisih_hari . ' hari yang lalu';
        } elseif ($selisih_hari < 14) {
            return 'Satu minggu yang lalu';
        } elseif ($selisih_hari < 30) {
            $minggu = floor($selisih_hari / 7);
            return $minggu . ' minggu yang lalu';
        } elseif ($selisih_hari < 365) {
            $bulan = floor($selisih_hari / 30);
            return $bulan . ' bulan yang lalu';
        } else {
            $tahun = floor($selisih_hari / 365);
            return $tahun . ' tahun yang lalu';
        }
    }
}


