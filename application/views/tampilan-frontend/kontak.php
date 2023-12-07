<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
        .container-kontak {
            /* max-width: 800px; */
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 27px rgba(0, 0, 0, 0.3);
            border-radius: 5px;
            height: fit-content;
            /* margin-top: 20px; */
        }

        h1 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            height: 150px;
        }

        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2684d9;
        }
    </style>
    <?php if ($this->session->flashdata('error')): ?>
        <script>
            Swal.fire(
                'Gagal!',
                '<?= $this->session->flashdata('error'); ?>',
                'error'
            )
        </script>
    <?php endif; ?>
    <?php if ($this->session->flashdata('success')): ?>
        <script>
            Swal.fire(
                'Berhasil!',
                '<?= $this->session->flashdata('success'); ?>',
                'success'
            )
        </script>
    <?php endif; ?>
    <div class="container-kontak col-lg-12">
        <h1 style="text-align: left;">Hai, Teman-teman semuanya :)</h1>
        <hr>
        <p>Aku cuman mau bilang teman-teman bisa membantu saya dalam pengembangan website ini, Dengan mengirimkan saran, kritikan, ataupun mengenai
            informasi lebih lanjut. Dengan tentunya mengirimkan pesan kamu melewati Email atau Form dibawah ini:
        </p>
        <div class="footer-social">
            <?php
                $data_konf = $this->db->get('konfigurasi')->row();
                $data_konf_alamat = str_replace(' ', '+', $data_konf->alamat);
                $data_konf_no_wa = preg_replace('/^0/', '+62', $data_konf->no_wa);
            ?>
            <a href="mailto:<?= $data_konf->email ?>" style="color: #ccc;">
                <i class="fa fa-envelope fa-1x"></i> <?= $data_konf->email ?> 
            </a>
            <a href="https://www.google.com/maps/search/?q=<?= $data_konf_alamat ?>" style="color: #ccc;">
                <i class="fa fa-map-marker fa-1x"></i>  <?= $data_konf->alamat ?> 
            </a>
            <a href="https://www.instagram.com/<?= $data_konf->instagram ?>" style="color: #ccc;">
                <i class="fab fa-instagram fa-1x"></i>  <?= $data_konf->instagram ?> 
            </a>
            <a href="https://wa.me/<?= $data_konf_no_wa ?>?text=Halo,%20salam%20kenal" style="color: #ccc;">
                <i class="fab fa-whatsapp fa-1x"></i>  <?= $data_konf_no_wa ?> 
            </a>
        </div>
        <hr class="my-4">
        <h1 style="text-align: left;">Berikan saya Saran</h1>
        <!-- AMBIL DATA CAPTCHA -->
        <?php
            $data['captcha'] = $this->db->order_by('RAND()')->limit(1)->get('captcha')->row();
        ?>

        <form action="<?= site_url('kontak/saran') ?>" method="post">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="saran">Saran / Kritik:</label>
            <textarea id="saran" name="saran" required></textarea>
            <p class="char-count" style="color: #666; font-size: 12px;">Sisa karakter: 1000</p>

            <label for="">Captcha</label>
            <img style="margin-bottom: 8px;" src="<?= base_url('assets/captcha/'.$data['captcha']->filename) ?>" alt="captcha" id="captcha">
            <input type="hidden" name="jawaban_captcha" value="<?= $data['captcha']->word ?>">
            <input type="text" id="captcha" maxlength="8" name="captcha" required>

            <button type="submit">Kirim Saran</button>
        </form>
        <hr>
        <center><p><strong>Kunjungi Kami disini: </strong></p></center>
        <div id="peta" style="height: 400px; box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px, rgb(51, 51, 51) 0px 0px 0px 3px; border-radius: 8px;" class="mt-2"
            data-latitude="<?= $data_konf->latitude != null ? $data_konf->latitude : '-7.59031' ?>" 
            data-longitude="<?= $data_konf->longitude != null ? $data_konf->longitude : '110.95080' ?>">
        </div>
    </div>
    <!-- <br><br> -->
    <div class="container-kontak col-lg-12" style="margin-top: 20px; background-color: #fff5; color: #333;">
        <h2>Saya senang dan sangat terbantu akan pesan maupun saran, kritik teman-teman :)</h2>
        <p>Jangan ragu untuk berbagi pandangan Kamu. Semua masukan sangat berarti bagi saya dan akan membantu meningkatkan pengalaman kami bersama. Tentunya dengan bantuan teman-teman :></p>
    </div>

    <script>
        $(document).ready(function () {
            let latitude = $('#peta').data('latitude');
            let longitude = $('#peta').data('longitude');
            console.log(latitude, longitude);
            let peta = L.map('peta').setView([latitude, longitude], 18);
            let marker = L.marker([latitude, longitude]).addTo(peta);

            marker.bindPopup("Kunjungi kami disini :).").openPopup(); 

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© '+'<a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(peta);

            let maxChars = 1000;

            $('#saran').on('input', function () {
                let ketikkan = maxChars - $(this).val().length;
                if (ketikkan < 0) {
                    $(this).val($(this).val().substr(0, maxChars));
                } else {
                    $('.char-count').text('Sisa karakter: ' + ketikkan);
                }
            });
        });
    </script>