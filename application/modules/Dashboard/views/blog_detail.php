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

<!-- ======================
      Blog Single
    ========================= -->
<section class="blog blog-single pt-100 pb-40">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4">
                <aside class="sidebar mb-30">
                    <div class="widget widget-search">
                        <h5 class="widget__title">Search</h5>
                        <div class="widget__content">
                            <form class="widget__form-search" method="post" action="<?= base_url('Dashboard/berita') ?>">
                                <input type="text" class="form-control" name="keyword" placeholder="Judul berita...">
                                <button class="btn" type="submit" name="searchButton" value="true"><i class="fa fa-search"></i></button>
                            </form>
                        </div><!-- /.widget-content -->
                    </div><!-- /.widget-search -->
                    <div class="widget widget-posts">
                        <h5 class="widget__title">Berita Terbaru</h5>
                        <div class="widget__content">
                            <div class="slick-carousel" data-slick='{"slidesToShow": 1, "arrows": false, "dots": true}'>
                                <?php foreach ($recent as $key) { ?>
                                    <!-- post item #1 -->
                                    <div class="widget-post-item">
                                        <div class="widget-post__img">
                                            <a href="<?= base_url('Dashboard/detail_berita/') . encode($key->id_laporan_damkar) ?>">
                                                <?php $foto_kejadian = explode(",", $key->foto_kejadian) ?>
                                                <img class="img img-responsive" src="<?= base_url('assets/path_kejadian/') . $foto_kejadian[0] ?>" alt="thumb" style="height: 200px; object-fit: cover;" width="100%">
                                            </a>
                                        </div><!-- /.widget-post-img -->
                                        <div class="widget-post__content">
                                            <span class="widget-post__date"><?= date('d F Y', strtotime($laporan->tgl_lapor)) ?></span>
                                            <h6 class="widget-post__title"><a href="<?= base_url('Dashboard/detail_berita/') . encode($key->id_laporan_damkar) ?>"><?= $key->penyebab_kejadian ?></a>
                                            </h6>
                                        </div><!-- /.widget-post-content -->
                                    </div><!-- /.widget-post-item -->
                                <?php } ?>
                            </div><!-- /.carousel -->
                        </div><!-- /.widget-content -->
                    </div><!-- /.widget-posts -->
                </aside><!-- /.sidebar -->
            </div><!-- /.col-lg-4 -->
            <div class="col-sm-12 col-md-12 col-lg-8">
                <div class="post-item mb-0">
                    <div class="post-item__meta d-flex align-items-center">
                        <div class="post-item__meta__cat">
                            <a href="#"><?= $laporan->jenis_kejadian ?></a>
                        </div><!-- /.blog-meta-cat -->
                        <span class="post-item__meta__date"><?= date('d F Y', strtotime($laporan->tgl_lapor)) ?></span>
                    </div><!-- /.blog-meta -->
                    <h1 class="post-item__title"><?= $laporan->penyebab_kejadian ?></h1>

                    <!-- share-post-link -->
                    <div class="share-post-link mb-30">
                        <div class="sharethis-inline-share-buttons"></div>
                    </div>

                    <?php $foto_kejadian = explode(",", $laporan->foto_kejadian) ?>
                    <?php if (count($foto_kejadian) > 0) { ?>
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php for ($i = 0; $i < count($foto_kejadian); $i++) { ?>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>" <?= ($i == 0 ? 'class="active"' : '') ?>></li>
                                <?php } ?>
                            </ol>
                            <div class="carousel-inner">
                                <?php for ($i = 0; $i < count($foto_kejadian); $i++) { ?>
                                    <div class="carousel-item <?= ($i == 0 ? 'active' : '') ?>">
                                        <img class="d-block w-100" src="<?= base_url('assets/path_kejadian/') . $foto_kejadian[$i] ?>">
                                    </div>
                                <?php } ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    <?php } ?>

                    <div class="post-item__content">
                        <div class="post-item__desc">
                            <h6><span class="badge badge-secondary" style="background-color: #0e2b5c;">Kronologi :</span></h6>
                            <p><?= ucfirst($laporan->kronologi) ?></p>

                            <h6><span class="badge badge-secondary" style="background-color: #0e2b5c;">Tindakan :</span></h6>
                            <p><?= ucfirst($laporan->tindakan) ?></p>

                            <h6><span class="badge badge-secondary" style="background-color: #0e2b5c;">Keterangan :</span></h6>
                            <p><?= ucfirst($laporan->keterangan) ?></p>
                        </div><!-- /.blog-desc -->
                    </div><!-- /.entry-content -->
                </div><!-- /.post-item -->

            </div><!-- /.col-lg-8 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.blog Single -->