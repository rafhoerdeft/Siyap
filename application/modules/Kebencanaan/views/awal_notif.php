<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>AWAL NOTIF MASUK</h2>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <!-- <h2> BASIC EXAMPLE </h2> -->
                        <!-- <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more-vert"></i> </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul> -->
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12" style="margin-bottom: -35px;">
                                <?= $this->session->userdata('alert_notif'); ?>
                            </div>
                            <!-- <div class="col-md-3 col-sm-3 col-lg-3" style="float: right;">
                                <button onclick="clear_data()" data-toggle="modal" data-target="#modal_add" class="btn bg-light-blue btn-block waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 10px;">send</i> KIRIM PESAN</button>
                            </div> -->
                        </div>
                    </div>
                    <hr>
                    <div class="body">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4" id="pilih">
                                <h4>Pilih yang akan menerima notifikasi awal laporan masuk</h4>
                                <hr>
                                <form method="POST" action="<?= base_url().'Kebencanaan/simpanAwalNotif' ?>">
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5 col-sm-5">
                                                    <label>Admin</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="switch">
                                                        <label>
                                                            <?php if ($notif != null || $notif != '') { ?>
                                                                <input id="admin" value="Admin" name="notif" type="checkbox" <?= ($notif->notif_admin=='Admin'?'checked':'') ?>>
                                                            <?php }else{ ?>
                                                                <input id="admin" value="Admin" name="notif" type="checkbox" checked>
                                                            <?php } ?>
                                                            <span class="lever switch-col-red"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5 col-sm-5">
                                                    <label>Semua Petugas</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="switch">
                                                        <label>
                                                            <?php if ($notif != null || $notif != '') { ?>
                                                                <input id="semua" value="Semua" name="notif" type="checkbox" <?= ($notif->notif_admin=='Semua'?'checked':'') ?>>
                                                            <?php }else{ ?>
                                                                <input id="semua" value="Semua" name="notif" type="checkbox">
                                                            <?php } ?>
                                                            <span class="lever switch-col-light-blue"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <button type="submit" class="btn btn-block btn-primary btn-raised waves-effect">SIMPAN</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Input Angka -->
<script type="text/javascript">
    function inputAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
        return true;
    }
</script>






