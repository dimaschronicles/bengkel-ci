<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Bengkel App</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('assets'); ?>/home/assets/img/favicon.png" rel="icon">
    <link href="<?= base_url('assets'); ?>/home/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets'); ?>/home/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/home/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/home/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/home/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/home/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?= base_url('assets'); ?>/home/assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
                <h1 class="sitename">BENGKEL</h1>
                <span>.</span>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#menu">Produk</a></li>
                    <li><a href="#gallery">Galeri</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <?php if ($user == null) : ?>
                <a class="btn-getstarted" href="<?= base_url('auth'); ?>">Login</a>
            <?php else : ?>
                <a class="btn-getstarted" href="<?= base_url('dashboard'); ?>">Dashboard</a>
            <?php endif; ?>

        </div>
    </header>

    <main class="main">

        <!-- Menu Section -->
        <section id="menu" class="menu section">

            <div class="container section-title" data-aos="fade-up">
                <h2>Produk</h2>
                <p><span>Cek </span> <span class="description-title">Produk Kami</span></p>
            </div>

            <div class="container">
                <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
                    <div class="tab-pane fade active show" id="menu-starters">
                        <div class="row gy-5">

                            <?php foreach ($sparepart as $s) : ?>
                                <div class="col-lg-4 menu-item">
                                    <?php if ($s['foto'] == null) : ?>
                                        <a href="<?= base_url('assets'); ?>/home/assets/img/piston.png" class="glightbox"><img src="<?= base_url('assets'); ?>/home/assets/img/piston.png" class="menu-img img-fluid" alt=""></a>
                                    <?php else : ?>
                                        <a href="<?= base_url('assets'); ?>/upload/<?= $s['foto']; ?>" class="glightbox"><img src="<?= base_url('assets'); ?>/upload/<?= $s['foto']; ?>" class="menu-img img-fluid" alt=""></a>
                                    <?php endif; ?>
                                    <h4><?= $s['nama_produk']; ?></h4>
                                    <p class="ingredients">
                                        <?= $s['deskripsi']; ?>
                                    </p>
                                    <p class="price">
                                        Rp <?= number_format($s['harga'], 0, ",", "."); ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>

                        </div>
                        <div class="row gy-5 mt-2">
                            <div class="col-lg-12 text-center">
                                <a class="btn btn-primary" href="<?= base_url('produk/list'); ?>">
                                    Lihat Selengkapnya
                                    <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Menu Section -->

        <!-- Gallery Section -->
        <section id="gallery" class="gallery section">

            <div class="container section-title" data-aos="fade-up">
                <h2>Galeri</h2>
                <p><span>Cek</span> <span class="description-title">Galeri Kami</span></p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper">
                    <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
                            "autoplay": {
                                "delay": 5000
                            },
                            "slidesPerView": "auto",
                            "centeredSlides": true,
                            "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                            },
                            "breakpoints": {
                                "320": {
                                    "slidesPerView": 1,
                                    "spaceBetween": 0
                                },
                                "768": {
                                    "slidesPerView": 3,
                                    "spaceBetween": 20
                                },
                                "1200": {
                                    "slidesPerView": 5,
                                    "spaceBetween": 20
                                }
                            }
                        }
                    </script>
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="<?= base_url('assets'); ?>/home/assets/img/gallery/foto_bengkel_1.jpg"><img src="<?= base_url('assets'); ?>/home/assets/img/gallery/foto_bengkel_1.jpg" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="<?= base_url('assets'); ?>/home/assets/img/gallery/foto_bengkel_2.jpg"><img src="<?= base_url('assets'); ?>/home/assets/img/gallery/foto_bengkel_2.jpg" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="<?= base_url('assets'); ?>/home/assets/img/gallery/foto_bengkel_3.jpg"><img src="<?= base_url('assets'); ?>/home/assets/img/gallery/foto_bengkel_3.jpg" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="<?= base_url('assets'); ?>/home/assets/img/gallery/foto_bengkel_4.jpg"><img src="<?= base_url('assets'); ?>/home/assets/img/gallery/foto_bengkel_4.jpg" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="<?= base_url('assets'); ?>/home/assets/img/gallery/foto_bengkel_5.jpg"><img src="<?= base_url('assets'); ?>/home/assets/img/gallery/foto_bengkel_5.jpg" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="<?= base_url('assets'); ?>/home/assets/img/gallery/foto_bengkel_6.jpg"><img src="<?= base_url('assets'); ?>/home/assets/img/gallery/foto_bengkel_6.jpg" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="<?= base_url('assets'); ?>/home/assets/img/gallery/foto_bengkel_7.jpg"><img src="<?= base_url('assets'); ?>/home/assets/img/gallery/foto_bengkel_7.jpg" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="<?= base_url('assets'); ?>/home/assets/img/gallery/foto_bengkel_8.jpg"><img src="<?= base_url('assets'); ?>/home/assets/img/gallery/foto_bengkel_8.jpg" class="img-fluid" alt=""></a></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section>
        <!-- /Gallery Section -->

    </main>

    <footer id="footer" class="footer">

        <div class="container">
            <div class="row gy-3">
                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-geo-alt icon"></i>
                    <div class="address">
                        <h4>Alamat</h4>
                        <p>Jl. Jendral Soedirman</p>
                        <p>Purwokerto, 53132</p>
                        <p></p>
                    </div>

                </div>

                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-telephone icon"></i>
                    <div>
                        <h4>Kontak</h4>
                        <p>
                            <strong>Telepon:</strong> <span>+62 0829 9403 3401</span><br>
                            <strong>Email:</strong> <span>mybengkel@gmail.com</span><br>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-clock icon"></i>
                    <div>
                        <h4>Jam Kerja</h4>
                        <p>
                            <strong>Senin-Sabtu:</strong> <span>08:00 - 19:00 WIB</span><br>
                            <strong>Minggu</strong>: <span>Tutup</span>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h4>Ikuti Kami</h4>
                    <div class="social-links d-flex">
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p><span>Copyright</span> &copy; <?= date('Y'); ?> <strong class="px-1 sitename">Bengkel.</strong> <span>All Rights Reserved</span></p>
            <!-- <div class="credits">
                Designed by it.
            </div> -->
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('assets'); ?>/home/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets'); ?>/home/assets/vendor/php-email-form/validate.js"></script>
    <script src="<?= base_url('assets'); ?>/home/assets/vendor/aos/aos.js"></script>
    <script src="<?= base_url('assets'); ?>/home/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url('assets'); ?>/home/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?= base_url('assets'); ?>/home/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="<?= base_url('assets'); ?>/home/assets/js/main.js"></script>

</body>

</html>