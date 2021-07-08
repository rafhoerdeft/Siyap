<!-- ========================
       page title 
    =========================== -->
<section class="page-title page-title-layout8 bg-overlay bg-parallax text-center">
    <div class="bg-img"><img src="<?= base_url('assets/assets_front/images/sliders/1.jpg') ?>" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 offset-xl-3">
                <h1 class="pagetitle__heading">Berita</h1>
            </div><!-- /.col-xl-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->

<section class="contact-layout1 py-0 mt-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="widget widget-search">
                    <h5 class="widget__title">Search</h5>
                    <div class="widget__content">
                        <form class="widget__form-search" method="post">
                            <input type="text" class="form-control" placeholder="Judul berita..." name="keyword" value="<?= $keyword ?>">
                            <button class="btn" type="submit" name="searchButton" value="true"><i class="fa fa-search"></i></button>
                        </form>
                    </div><!-- /.widget-content -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- blog  -->

<!-- ======================
      Blog Grid
    ========================= -->
<section class="blog-grid">
    <div class="container">
        <div class="row">
            <?php if ($list_count > 0) { ?>
                <!-- Blog Item #1 -->
                <?php foreach ($berita as $row) { ?>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <!-- Blog Item #1 -->
                        <div class="post-item">
                            <div class="post-item__img">
                                <a href="<?= base_url('Dashboard/detail_berita/') . encode($row->id_laporan_damkar) ?>">
                                    <?php $foto_kejadian = explode(",", $row->foto_kejadian) ?>
                                    <img src="<?= base_url('assets/path_kejadian/') . ($foto_kejadian[0] != null ? $foto_kejadian[0] : 'default.jpg') ?> " alt="blog image">
                                </a>
                                <div class="post-item__meta__cat">
                                    <a href="<?= base_url('Dashboard/detail_berita/') . encode($row->id_laporan_damkar) ?>"><?= $row->jenis_kejadian ?></a>
                                </div><!-- /.blog-meta-cat -->
                            </div><!-- /.blog-img -->
                            <div class="post-item__content">
                                <span class="post-item__meta__date"><?= date('d F Y', strtotime($row->tgl_lapor)) ?></span>
                                <h4 class="post-item__title"><a href="<?= base_url('Dashboard/detail_berita/') . encode($row->id_laporan_damkar) ?>"><?= character_limiter($row->penyebab_kejadian, 30, '...') ?></a>
                                </h4>
                                <p class="post-item__desc"><?= character_limiter(ucfirst($row->kronologi), 100, '...') ?>
                                </p>
                                <a href="<?= base_url('Dashboard/detail_berita/') . encode($row->id_laporan_damkar) ?>" class="btn btn__secondary btn__link">
                                    <i class="icon-arrow-right1"></i>
                                    <span>Baca Selengkapnya</span>
                                </a>
                            </div><!-- /.blog-content -->
                        </div><!-- /.post-item -->
                    </div><!-- /.col-lg-4 -->
            <?php }
            } else {
                echo "<h3>Tidak ditemukan berita</h3>";
            }
            ?>
        </div><!-- /.row -->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                <nav class="pagination-area">
                    <?php if (!empty($paging)) {
                        echo $paging['link'];
                    }; ?>
                </nav>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.blog Grid -->