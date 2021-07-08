<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <!-- ==== Document Meta ==== -->
    <meta name="author" content="siyap.magelangkab.go.id">
    <meta name="description" content="<?= (isset($meta) ? $meta['title'] : 'SIYAP Kabupaten Magelang - Pemadam Kebakaran') ?>">
    <meta property="og:url" content="<?= $full_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" />
    <meta name="keywords" content="<?= (isset($meta) ? $meta['title'] : 'SIYAP Kabupaten Magelang - Pemadam Kebakaran') ?>">
    <meta property="og:title" content="<?= (isset($meta) ? $meta['title'] : 'SIYAP Kabupaten Magelang - Pemadam Kebakaran') ?>" />

    <?php if (isset($meta)) { ?>
        <meta property="og:image" content="<?= base_url('assets/path_kejadian/') . ($meta['image'] != null ? $meta['image'] : 'siyapma.png') ?>" />
    <?php } else { ?>
        <meta property="og:image" content="<?= base_url('assets/assets_front/images/siyapma.png') ?>" />
    <?php } ?>

    <link href="<?= base_url('assets/assets_front/images/siyapma.png') ?>" rel="icon">
    <title>SIYAP</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Barlow:400,500,600,700%7cHeebo:400,500,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?= base_url('assets/assets_front/css/libraries.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/assets_front/css/style.css') ?>">

    <?php if (isset($lightbox)) { ?>
        <link rel="stylesheet" href="<?= base_url('assets/assets_front/css/lightbox.min.css') ?>">
    <?php } ?>

    <?php if (isset($fancybox)) { ?>
        <!-- Fancybox -->
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>assets/plugins/fancybox/jquery.fancybox.css">
    <?php } ?>

    <?php if (isset($map)) { ?>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

        <!-- Leafleat Plugin CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />

        <!-- Cluster Marker CSS-->
        <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />

        <style>
            .ol-popup {
                position: absolute;
                background-color: white;
                -webkit-filter: drop-shadow(0 1px 4px rgba(0, 0, 0, 0.2));
                filter: drop-shadow(0 1px 4px rgba(0, 0, 0, 0.2));
                padding: 15px;
                border-radius: 10px;
                border: 1px solid #cccccc;
                bottom: 12px;
                left: -50px;
                min-width: 280px;
            }

            .ol-popup:after,
            .ol-popup:before {
                top: 100%;
                border: solid transparent;
                content: " ";
                height: 0;
                width: 0;
                position: absolute;
                pointer-events: none;
            }

            .ol-popup:after {
                border-top-color: white;
                border-width: 10px;
                left: 48px;
                margin-left: -10px;
            }

            .ol-popup:before {
                border-top-color: #cccccc;
                border-width: 11px;
                left: 48px;
                margin-left: -11px;
            }

            .ol-popup-closer {
                text-decoration: none;
                position: absolute;
                top: 2px;
                right: 8px;
            }

            .ol-popup-closer:after {
                content: "✖";
            }
        </style>

        <!-- Style Flash Button -->
        <style type="text/css">
            .buttonFlashOn {
                background-color: #004A7F;
                -webkit-border-radius: 1px;
                border-radius: 1px;
                border: none;
                color: #FFFFFF;
                cursor: pointer;
                display: inline-block;
                font-family: Arial;
                font-size: 13px;
                padding: 5px 15px;
                text-align: center;
                text-decoration: none;
                -webkit-animation: glowing 1500ms infinite;
                -moz-animation: glowing 1500ms infinite;
                -o-animation: glowing 1500ms infinite;
                animation: glowing 1500ms infinite;
            }

            @-webkit-keyframes glowing {
                0% {
                    background-color: #B20000;
                    -webkit-box-shadow: 0 0 3px #B20000;
                }

                50% {
                    background-color: #FF0000;
                    -webkit-box-shadow: 0 0 40px #FF0000;
                }

                100% {
                    background-color: #B20000;
                    -webkit-box-shadow: 0 0 3px #B20000;
                }
            }

            @-moz-keyframes glowing {
                0% {
                    background-color: #B20000;
                    -moz-box-shadow: 0 0 3px #B20000;
                }

                50% {
                    background-color: #FF0000;
                    -moz-box-shadow: 0 0 40px #FF0000;
                }

                100% {
                    background-color: #B20000;
                    -moz-box-shadow: 0 0 3px #B20000;
                }
            }

            @-o-keyframes glowing {
                0% {
                    background-color: #B20000;
                    box-shadow: 0 0 3px #B20000;
                }

                50% {
                    background-color: #FF0000;
                    box-shadow: 0 0 40px #FF0000;
                }

                100% {
                    background-color: #B20000;
                    box-shadow: 0 0 3px #B20000;
                }
            }

            @keyframes glowing {
                0% {
                    background-color: #B20000;
                    box-shadow: 0 0 3px #B20000;
                }

                50% {
                    background-color: #FF0000;
                    box-shadow: 0 0 40px #FF0000;
                }

                100% {
                    background-color: #B20000;
                    box-shadow: 0 0 3px #B20000;
                }
            }

            .buttonFlashOff {
                background-color: #004A7F;
                -webkit-border-radius: 1px;
                border-radius: 1px;
                border: none;
                color: #FFFFFF;
                cursor: pointer;
                display: inline-block;
                font-family: Arial;
                font-size: 13px;
                padding: 5px 15px;
                text-align: center;
                text-decoration: none;
            }
        </style>

        <!-- Style Frame Map -->
        <style type="text/css">
            .outerMap {
                border: 5px solid #6284bc;
            }

            .outerMapFlash {
                /*width: 100%; 
            height: 100%; */
                border: 5px solid #004A7F;
                -webkit-animation: glow 1500ms infinite;
                -moz-animation: glow 1500ms infinite;
                -o-animation: glow 1500ms infinite;
                animation: glow 1500ms infinite;
            }

            @-webkit-keyframes glow {
                0% {
                    border-color: #B20000;
                    -webkit-box-shadow: 0 0 3px #B20000;
                }

                50% {
                    border-color: #FF0000;
                    -webkit-box-shadow: 0 0 40px #FF0000;
                }

                100% {
                    border-color: #B20000;
                    -webkit-box-shadow: 0 0 3px #B20000;
                }
            }

            @-moz-keyframes glow {
                0% {
                    border-color: #B20000;
                    -moz-box-shadow: 0 0 3px #B20000;
                }

                50% {
                    border-color: #FF0000;
                    -moz-box-shadow: 0 0 40px #FF0000;
                }

                100% {
                    border-color: #B20000;
                    -moz-box-shadow: 0 0 3px #B20000;
                }
            }

            @-o-keyframes glow {
                0% {
                    border-color: #B20000;
                    box-shadow: 0 0 3px #B20000;
                }

                50% {
                    border-color: #FF0000;
                    box-shadow: 0 0 40px #FF0000;
                }

                100% {
                    border-color: #B20000;
                    box-shadow: 0 0 3px #B20000;
                }
            }

            @keyframes glow {
                0% {
                    border-color: #B20000;
                    box-shadow: 0 0 3px #B20000;
                }

                50% {
                    border-color: #FF0000;
                    box-shadow: 0 0 40px #FF0000;
                }

                100% {
                    border-color: #B20000;
                    box-shadow: 0 0 3px #B20000;
                }
            }
        </style>
    <?php } ?>

    <script src="<?= base_url('assets/assets_front/js/jquery-3.5.1.min.js') ?>"></script>
</head>

<body>
    <div class="wrapper">
        <div class="preloader">
            <div class="loading">
                <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
            </div>
        </div>
        <!-- /.preloader -->

        <!-- =========================
        Header

        
    =========================== -->
        <?php if (isset($map)) { ?>
            <style>
                @media (min-width: 769px) {

                    .fixed-navbar .nav__item .nav__item-link,
                    .fixed-navbar .stik-icon>a {
                        color: #0e2b5c !important;
                    }

                    .nav__item .nav__item-link,
                    .stik-icon>a {
                        color: white !important;
                    }

                    .map-height {
                        height: 80vh;
                    }
                }

                @media (min-width: 320px) and (max-width: 768px) {
                    .navbar {
                        background-color: white !important;
                    }

                    .map-height {
                        height: 86vh;
                    }
                }
            </style>
            <!-- =========================
        Header
    =========================== -->
            <header class="header header-transparent">
                <nav class="navbar navbar-expand-lg sticky-navbar" style="background-color: #0e2b5c;">
                    <!-- <div class="navbar__bottom"> -->
                    <div class="container">
                        <a class="navbar-brand" href="<?= base_url('Dashboard/home') ?>">
                            <img src="<?= base_url('assets/assets_front/images/siyapma.png') ?>" class="logo-light" alt="logo">
                            <img src="<?= base_url('assets/path_logo/ICON-SIYAP-SM.png') ?>" class="logo-dark" alt="logo">
                        </a>
                        <button class="navbar-toggler" type="button">
                            <span class="menu-lines"><span></span></span>
                        </button>
                        <div class="collapse navbar-collapse" id="mainNavigation">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav__item">
                                    <a href="<?= base_url('Dashboard/home') ?>" class="nav__item-link <?= ($active_menu == 1) ? 'active' : '' ?>">Home</a>
                                </li><!-- /.nav-item -->
                                <li class="nav__item">
                                    <a href="<?= base_url('Dashboard/berita') ?>" class="nav__item-link <?= ($active_menu == 2) ? 'active' : '' ?>">Berita</a>
                                </li><!-- /.nav-item -->
                                <li class="nav__item">
                                    <a href="<?= base_url('Dashboard/peta') ?>" class="nav__item-link <?= ($active_menu == 3) ? 'active' : '' ?>">Peta</a>
                                </li><!-- /.nav-item -->
                                <li class="nav__item">
                                    <a href="<?= base_url('Dashboard/statistik') ?>" class="nav__item-link <?= ($active_menu == 4) ? 'active' : '' ?>">Statistik</a>
                                </li><!-- /.nav-item -->
                            </ul><!-- /.navbar-nav -->
                        </div><!-- /.navbar-collapse -->
                        <ul class="header-actions__list list-unstyled d-flex align-items-center mb-0">
                            <li>
                                <ul class="social__icons list-unstyled justify-content-end mb-0 ml-20">
                                    <li class="stik-icon"><a href="<?= base_url('Login') ?>"><i class="fa fa-user-lock"></i></a></li>
                                </ul>
                            </li>
                        </ul><!-- /.actions__list -->
                    </div><!-- /.container -->
                    <!-- </div> -->
                </nav><!-- /.navabr -->
            </header><!-- /.Header -->
        <?php } else { ?>
            <header class="header header-transparent">
                <nav class="navbar navbar-expand-lg sticky-navbar">
                    <div class="container">
                        <a class="navbar-brand" href="<?= base_url('Dashboard/home') ?>">
                            <img src="<?= base_url('assets/assets_front/images/siyapma.png') ?>" class="logo-light" alt="logo">
                            <img src="<?= base_url('assets/assets_front/images/siyapma.png') ?>" class="logo-dark" alt="logo">
                        </a>
                        <button class="navbar-toggler" type="button">
                            <span class="menu-lines"><span></span></span>
                        </button>
                        <div class="collapse navbar-collapse" id="mainNavigation">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav__item">
                                    <a href="<?= base_url('Dashboard/home') ?>" class="nav__item-link <?= ($active_menu == 1) ? 'active' : '' ?>">Home</a>
                                </li><!-- /.nav-item -->
                                <li class="nav__item">
                                    <a href="<?= base_url('Dashboard/berita') ?>" class="nav__item-link <?= ($active_menu == 2) ? 'active' : '' ?>">Berita</a>
                                </li><!-- /.nav-item -->
                                <li class="nav__item">
                                    <a href="<?= base_url('Dashboard/peta') ?>" class="nav__item-link <?= ($active_menu == 3) ? 'active' : '' ?>">Peta</a>
                                </li><!-- /.nav-item -->
                                <li class="nav__item">
                                    <a href="<?= base_url('Dashboard/statistik') ?>" class="nav__item-link <?= ($active_menu == 4) ? 'active' : '' ?>">Statistik</a>
                                </li><!-- /.nav-item -->
                            </ul><!-- /.navbar-nav -->
                        </div><!-- /.navbar-collapse -->
                        <ul class="header-actions__list list-unstyled d-flex align-items-center mb-0">
                            <li>
                                <ul class="social__icons list-unstyled justify-content-end mb-0 ml-20">
                                    <li><a href="<?= base_url('Login') ?>"><i class="fa fa-user-lock"></i></a></li>
                                </ul>
                            </li>
                        </ul><!-- /.actions__list -->
                    </div><!-- /.container -->
                </nav><!-- /.navabr -->
            </header>
        <?php } ?>

        <!-- ================================================== CONTENT ============================================================================= -->
        <?= (isset($content) ? $this->load->view($content) : '') ?>
        <!-- ================================================== CONTENT ============================================================================= -->

        <!-- ========================
      Footer
    ========================== -->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="heading-layout2 mb-20">
                            <h2 class="heading__subtitle">Hubungi kami di :</h2>
                            <h3 class="heading__title">Nomor Darurat</h3>
                        </div><!-- /heading -->
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-8 d-flex flex-wrap justify-content-between">
                        <div class="footer-contact__item d-flex align-items-center">
                            <div class="footer-contact__icon">
                                <i class="fas fa-headphones-alt"></i>
                            </div><!-- /.footer-contact__icon -->
                            <div class="footer-contact__text">
                                <span>Call Center</span>
                                <strong><a href="tel:112">112</a></strong>
                            </div><!-- /.footer-contact__text -->
                        </div><!-- /.footer-contact__item -->
                        <div class="footer-contact__item d-flex align-items-center">
                            <div class="footer-contact__icon">
                                <i class="icon-phone1"></i>
                            </div><!-- /.footer-contact__icon -->
                            <div class="footer-contact__text">
                                <span>Telepon</span>
                                <strong><a href="tel:0293788213">0293 - 788213</a></strong>
                            </div><!-- /.footer-contact__text -->
                        </div><!-- /.footer-contact__item -->
                        <div class="footer-contact__item d-flex align-items-center">
                            <div class="footer-contact__icon">
                                <i class="icon-clock1"></i>
                            </div><!-- /.footer-contact__icon -->
                            <div class="footer-contact__text">
                                <span>Jam Operasional:</span>
                                <strong>24 Jam / 7 Hari</strong>
                            </div><!-- /.footer-contact__text -->
                        </div><!-- /.footer-contact__item -->
                    </div><!-- /.col-lg-8 -->
                </div><!-- /.row -->
            </div>
            <div class="footer-secondary">
                <div class="container">
                    <div class="row align-items-center mt--50">
                        <div class="col-sm-12 col-md-12 col-lg-4 d-flex flex-wrap align-items-center">
                            <img src="<?= base_url('assets/assets_front/images/siyapma.png') ?>" alt="logo" class="mr-20" style="max-width: 50px;">
                            <nav>
                                <ul class="footer__copyright-links list-unstyled d-flex flex-wrap mb-0">
                                    <li><a href="<?= base_url('Dashboard/home') ?>">Home </a></li>
                                    <li><a href="<?= base_url('Dashboard/berita') ?>">Berita</a></li>
                                    <li><a href="<?= base_url('Dashboard/peta') ?>">Peta</a></li>
                                    <li><a href="<?= base_url('Dashboard/statistik') ?>">Statistik</a></li>
                                </ul>
                                <p class="mb-0">Diskominfo Kabupaten Magelang &copy; <?= date('Y') ?></p>
                                <!-- <p class="mb-0"> &copy; 2020 Eteon. With Love by
                                    <a class="color-secondary" href="http://themeforest.net/user/7oroof">7oroof.com</a>
                                </p> -->
                            </nav>
                        </div><!-- /.col-lg-8 -->
                        <div class="col-sm-12 col-md-12 col-lg-4 d-flex justify-content-center mt-2">
                            <table style="font-size: 14px; color:white; width:70%">
                                <tr>
                                    <td colspan="3" style="font-weight:bold">Pengunjung</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Hari ini</td>
                                    <td>:</td>
                                    <td><span class="float-right" style="color:#fdb900; font-weight:bold"><?= $visitor->today ?></span></td>
                                </tr>
                                <tr>
                                    <td>Bulan ini</td>
                                    <td>:</td>
                                    <td><span class="float-right" style="color:#fdb900; font-weight:bold"><?= $visitor->bulan ?></span></td>
                                </tr>
                                <tr>
                                    <td>Tahun ini</td>
                                    <td>:</td>
                                    <td><span class="float-right" style="color:#fdb900; font-weight:bold"><?= $visitor->tahun ?></span></td>
                                </tr>
                            </table>
                        </div><!-- /.col-lg-4 -->
                        <div class="col-sm-12 col-md-12 col-lg-4 d-flex justify-content-center mt-2">
                            <a href="https://play.google.com/store/apps/details?id=com.kominfo.panicapp" target="_blank"><img src="<?= base_url() ?>assets/assets_front/images/google-play-icon.png" class="img img-responsive" style="max-width: 300px;" alt=""></a>
                        </div><!-- /.col-lg-4 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.footer-secondary -->
        </footer><!-- /.Footer -->
        <button id="scrollTopBtn"><i class="fas fa-long-arrow-alt-up"></i></button>
    </div><!-- /.wrapper -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js" integrity="sha512-UwcC/iaz5ziHX7V6LjSKaXgCuRRqbTp1QHpbOJ4l1nw2/boCfZ2KlFIqBUA/uRVF0onbREnY9do8rM/uT/ilqw==" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/assets_front/js/plugins.js') ?>"></script>
    <script src="<?= base_url('assets/assets_front/js/main.js') ?>"></script>

    <script>
        $(document).ready(function() {
            var isPaused = false;

            var t = window.setInterval(function() {
                if (!isPaused) {
                    next_slick();
                }
            }, 3000);

            $('.slide__content').hover(function() {
                isPaused = true;
            }, function() {
                isPaused = false;
            });
        });

        function next_slick() {
            document.querySelector('.slick-next.slick-arrow').click();
        }
    </script>

    <?php if (isset($fancybox)) { ?>
        <!-- Fancybox -->
        <script type="text/javascript" src="<?php echo base_url() . 'assets/'; ?>assets/plugins/fancybox/jquery.fancybox.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/'; ?>assets/plugins/fancybox/jquery.fancybox.pack.js"></script>

        <script type="text/javascript">
            $('.foto_kejadian').fancybox({});
        </script>
    <?php } ?>

    <?php if (isset($lightbox)) { ?>
        <script src="<?= base_url('assets/assets_front/js/lightbox.min.js') ?>"></script>
    <?php } ?>

    <script>
        $('.carousel').carousel({
            interval: 3000
        });
    </script>

    <?php if (isset($meta)) { ?>
        <!-- js link share -->
        <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5c1d0e8ab56cdb0011e86fe3&product=inline-share-buttons' async='async'></script>
    <?php } ?>



    <!--                           ______               -------------------------
                                  / ( )  \             | may the force be with us | 
                                _|________|_            -------------------------
                               | | ====== | |
                               |_|   0    |_|
                                ||   0    ||
                                ||___*____||
                               |~ \______/ ~|
                               /=\   /=\  /=\ 
    ___________________________[_]___[_]__[_}________________________________________________ -->


</body>

</html>