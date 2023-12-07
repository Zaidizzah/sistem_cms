<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['email_must_be_array'] = "Metode validasi email harus diberikan dalam bentuk array.";
$lang['email_invalid_address'] = "Alamat email tidak valid: %s";
$lang['email_attachment_missing'] = "Tidak dapat menemukan lampiran email berikut: %s";
$lang['email_attachment_unreadable'] = "Tidak dapat membuka lampiran ini: %s";
$lang['email_no_recipients'] = "Anda harus mencantumkan penerima: To, Cc, atau Bcc";
$lang['email_send_failure'] = "Tidak dapat mengirim email menggunakan PHP mail(). Server Anda mungkin tidak dikonfigurasi untuk mengirim email menggunakan metode ini.";
$lang['email_sent'] = "Pesan Anda telah berhasil dikirim menggunakan protokol berikut: %s";
$lang['email_no_socket'] = "Tidak dapat membuka socket ke Sendmail. Harap periksa pengaturan.";
$lang['email_no_hostname'] = "Anda tidak menentukan nama host SMTP.";
$lang['email_smtp_error'] = "Terjadi kesalahan SMTP berikut: %s";
$lang['email_no_smtp_unpw'] = "Kesalahan: Anda harus menentukan nama pengguna dan kata sandi SMTP.";
$lang['email_failed_smtp_login'] = "Gagal mengirim perintah AUTH LOGIN. Kesalahan: %s";
$lang['email_smtp_auth_un'] = "Gagal mengautentikasi nama pengguna. Kesalahan: %s";
$lang['email_smtp_auth_pw'] = "Gagal mengautentikasi kata sandi. Kesalahan: %s";
$lang['email_smtp_data_failure'] = "Tidak dapat mengirim data: %s";
$lang['email_exit_status'] = "Kode status keluar: %s";
