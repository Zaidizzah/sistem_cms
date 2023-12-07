<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('captcha_generator')) {
    function captcha_generator($text = '', $filename = '', $lebar = 165, $tinggi = 42) {
        $CI =& get_instance();
        // text
        $panjang = 8;
        $karakter = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomText = '';
        for ($i = 0; $i < $panjang; $i++) {
            $randomText .= $karakter[rand(0, strlen($karakter) - 1)];
        }

        if ($text == '') {
            $text = $randomText;
        } else {
            $text = $text;
        }

        // Buat gambar
        $image = imagecreatetruecolor($lebar, $tinggi);
        $backgroundColor = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 0, 0, 0); 
        $gridColor = imagecolorallocate($image, 200, 200, 200); 

        imagefilledrectangle($image, 0, 0, $lebar, $tinggi, $backgroundColor);

        imagettftext($image, 20, 4, 7, 30, $textColor, 'assets/fonts/static/RobotoSlab-Black.ttf', $text);

        for ($i = 0; $i < $lebar; $i += 10) {
            imageline($image, $i, 0, $i, $tinggi, $gridColor);
        }

        for ($i = 0; $i < $tinggi; $i += 10) {
            imageline($image, 0, $i, $lebar, $i, $gridColor);
        }

        if ($filename != '') {
            $filename = $filename.'.png';
        } else {
            $time = time();
            $filename = date('Ymd').'-'.$text.'-'.$time.'.png';
        }
        $outputPath = 'assets/captcha/'.$filename;

        imagepng($image, $outputPath);
        imagedestroy($image);

        // Simpan hasil kedatabase
        $data_captcha = array(
            'captcha_time' => $time,
            'word' => $text,
            'filename' => $filename
        );
        $CI->db->insert('captcha', $data_captcha);

        return array(
            'filename' => $filename,
            'text' => $text,
            'outputPath' => $outputPath,
            'image' => $image
        );
    }
}

