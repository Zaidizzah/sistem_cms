<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <link rel="stylesheet" href="<?= base_url() ?>assets/quote.css">
    <style>
        .kata-kata{
            background-color: lightskyblue;
            padding: 25px;
            /* width: 800px; */
            text-align: left;
            border-radius: 5px;
            margin-bottom: 10px;
            /* display: flex;
            align-items: flex-start; */
        }
        .paragraph {
            font-size: 18px;
            line-height: 1.5;
            color:  #333;
        }
        span.highlight {
            background-color: lightblue;
            padding: 5px;
            border-radius: 5px;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            margin-top: 32px;
            margin-bottom: 24px;
            border: 3px solid black;
            box-shadow: 0 0 37px rgba(0, 0, 0, 0.5);
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .social-icon a:hover{
            color: #333;
        }

        a {
            text-decoration: none;
            color: #fff;
        }

        .icons_foot {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .social-icon {
            text-align: center;
            margin-right: 20px;
        }

        .social-icon a {
            text-decoration: none;
            color: #fff;
        }

        .social-icon i {
            font-size: 2rem;
        }

        .social-icon span {
            display: block;
            font-size: 1rem;
            margin-top: 10px;
            color: #fff0f0;
        }
    </style>

    <div class="col-lg-12">
        <h1>Selamat Datang ditautan Tentang,</h1>
        <hr>
        <fieldset>
            <div class="kata-kata" data-aos="fade-up" data-aos-duration="3000">
                <p class="paragraph"><i class="fa fa-quote-left"></i> <i>"Tidak ada yang lebih bagus dari sekarang daripada yang lama."</i></p>
            </div>
        </fieldset>
        <div class="container-perkenalan" data-aos="fade-up" data-aos-duration="3000">
            <?php $profile_web = $this->db->get('konfigurasi')->row(); ?>
            <?php if (isset($profile_web) && $profile_web->profile_website != null) {echo $profile_web->profile_website;} ?>
        </div>
        <div class="kata-kata" data-aos="fade-up" data-aos-duration="3000">
            <p class="paragraph"><i class="fa fa-quote-left"></i> <i>"Keberhasilan bukanlah akhir dari perjalanan, tetapi langkah awal menuju tujuan yang lebih besar."</i></p>
        </div>
        <div class="kata-kata" data-aos="fade-up" data-aos-duration="3000">
            <p class="paragraph"><i class="fa fa-quote-left"></i> <i>"Kita adalah penulis cerita dari hidup kita sendiri, pastikan itu menjadi cerita yang luar biasa."</i></p>
        </div>
        <div class="kata-kata" data-aos="fade-up" data-aos-duration="3000">
            <p class="paragraph"><i class="fa fa-quote-left"></i> <i>"Ingat setiap hari adalah kesempatan baru untuk meraih impian dan ingat juga bahwa <span style="background-color: lightblue;">Kreativitas</span> adalah kekuatan untuk menciptakan dunia yang lebih baik."</i></p>
        </div>
        <div class="kata-kata" data-aos="fade-up" data-aos-duration="3000">
            <p class="paragraph"><i class="fa fa-quote-left"></i> <i>"Hati manusia sangat mirip dengan Laut, Ada badainya, Ada pasang surutnya, Dan dikedalamannya juga terdapat Mutiaranya."</i><br><span style="color: tomato;"><strong>-Van Gogh</strong></span><br>
            <i>"Nah oleh karenanya, hati kita seperti Lautan, Mengalami berbagai situasi dan perubahan. Namun jangan lupa, Bahwa didalamnya tersimpan keindahan dan kebijaksanaan yang menanti untuk ditemukan 💖"</i><br>
            <span style="color: tomato;"><strong>-Me.</strong></span></p>
        </div>

        <?php
        
        $quotes = [
            ['quote' => 'Satu-satunya cara untuk melakukan pekerjaan besar adalah mencintai apa yang kamu lakukan.', 'author' => 'Steve Jobs, pendiri Apple Inc.'],
            ['quote' => 'Kesuksesan tidak akhir; kegagalan tidak fatal: keberanian untuk terus maju yang menghitung.', 'author' => 'Winston Churchill,'],
            ['quote' => 'Jangan mengukur kehidupan kita dengan banyaknya napas yang kita hirup, tetapi dengan momen-momen yang membuat napas kita terhentak.', 'author' => 'Muhammad Ali, legenda tinju.'],
            ['quote' => 'Kerja keras adalah kunci kesuksesan. Jangan pernah menyerah pada mimpimu. Orang-orang yang sukses adalah orang-orang yang tetap bergerak meskipun sulit.', 'author' => 'Elon Musk, pendiri SpaceX dan Tesla.'],
            ['quote' => 'Kegagalan adalah kemenangan jika kita belajar darinya.', 'author' => 'Malcolm S. Forbes, mantan pemilik majalah Forbes.'],
            ['quote' => 'Untuk berubah adalah langkah pertama. Untuk meningkat adalah langkah yang diperlukan. Untuk berhasil adalah langkah yang wajib diambil.', 'author' => 'John C. Maxwell, penulis dan pembicara motivasi.'],
            ['quote' => 'Ketika satu pintu tertutup, yang lain terbuka.', 'author' => 'Alexander Graham Bell, penemu telepon.'],
            ['quote' => 'Kebahagiaan bukan akibat dari memilikinya semua, tetapi dari menghargai apa yang kita miliki.', 'author' => 'Roy T. Bennett, penulis.'],
            ['quote' => 'Pendidikan adalah senjata paling kuat yang dapat kita gunakan untuk mengubah dunia', 'author' => 'Nelson Mandela, mantan Presiden Afrika Selatan.'],
            ['quote' => 'Hidup adalah apa yang terjadi saat kita sibuk membuat rencana lain.', 'author' => 'John Lennon, penyanyi dan penulis lagu.'],
        ];
        $inspirasi = $quotes[array_rand($quotes)];
        ?>

        <div class="kata-kata" data-aos="fade-up" data-aos-duration="3000">
            <p class="paragraph"><i class="fa fa-quote-left"></i> <i>"<?php echo $inspirasi['quote'] ?>"</i><br>
            <span style="color: tomato;"><strong>_<?php echo $inspirasi['author'] ?></strong></span></p>
        </div>

        <center data-aos="fade-up" data-aos-duration="3000"><p><strong>Follow Us:</strong></p></center>
        <div class="social-icons icons_foot justify-content-center" data-aos="fade-up" data-aos-duration="3000" style="padding: 5px; padding-left: 5px;">
            <div class="social-icon">
                <a href="#">
                    <i class="fab fa-facebook fa-2x"></i>
                </a>
            </div>
            <div class="social-icon">
                <a href="#">
                    <i class="fab fa-twitter fa-2x"></i>
                </a>
            </div>
            <div class="social-icon">
                <a href="#">
                    <i class="fab fa-instagram fa-2x"></i>
                </a>
            </div>
            <div class="social-icon">
                <a href="#">
                    <i class="fab fa-whatsapp fa-2x"></i>
                </a>
            </div>
            <div class="social-icon">
                <a href="https://www.linkedin.com/in/zaid-izzah-nurbaain-42330b242/">
                    <i class="fab fa-linkedin fa-2x"></i>
                </a>
            </div>
        </div>

    <script>
        AOS.init();
    </script>

