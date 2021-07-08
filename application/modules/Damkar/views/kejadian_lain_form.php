<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>TAMBAH LAPORAN</h2>
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
                    </div>
                    <div class="body">
                        <?= show_alert() ?>
                        <form name="laporan" id="lp" method="post" action="<?= base_url().'Damkar/'.($form == 'add'?'simpanKejadianLain':'updateKejadianLain'); ?>" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="hidden" name="id_lapor" id="id_lapor" value="<?= (isset($id_lapor) ? $id_lapor : '') ?>">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Tanggal Kejadian</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="tgl_kejadian"
                                                    id="tgl_kejadian2" value="<?= (isset($laporan['tgl_lapor']) ? date('d-m-Y', strtotime($laporan['tgl_lapor'])) : '') ?>" required readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Waktu Kejadian</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="waktu_awal"
                                                    id="waktu_awal2" value="<?= (isset($laporan['tgl_lapor']) ? date('H:i', strtotime($laporan['tgl_lapor'])) : '') ?>" required readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Tanggal Selesai</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="tgl_selesai"
                                                    id="tgl_selesai2" value="<?= (isset($laporan['waktu_selesai']) ? date('d-m-Y', strtotime($laporan['waktu_selesai'])) : '') ?>" readonly required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Waktu Selesai</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="waktu_akhir"
                                                    id="waktu_akhir2" value="<?= (isset($laporan['waktu_selesai']) ? date('H:i', strtotime($laporan['waktu_selesai'])) : '') ?>" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Jenis Kejadian</label>
                                            <div style="margin-top: -13px; margin-bottom: 10px;">
                                                <select class="form-control show-tick" name="jenis_kejadian"
                                                    id="jenis_kejadian">
                                                    <?php foreach ($jenis_kejadian as $val) { ?>
                                                        <option <?= (isset($laporan['id_jenis_lap']) ? (($laporan['id_jenis_lap'] == $val->id_jenis_lap) ? 'selected' : '') : '') ?> value="<?= $val->id_jenis_lap ?>">
                                                            <?= $val->nama_jenis_lap ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Lokasi</label>
                                            <div class="form-line">
                                                <!-- <input type="text" class="form-control" name="almt_kejadian" id="almt_kejadian" required> -->
                                                <textarea rows="1" class="form-control no-resize auto-growth"
                                                    name="almt_kejadian" id="almt_kejadian" required><?= (isset($laporan['alamat']) ? $laporan['alamat'] : '') ?></textarea>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Keterangan Pelapor</label>
                                            <div class="form-line">
                                                <!-- <input type="text" class="form-control" name="almt_kejadian" id="almt_kejadian" required> -->
                                                <textarea rows="1" class="form-control no-resize auto-growth"
                                                    name="keterangan" id="keterangan" required><?= (isset($laporan['keterangan']) ? $laporan['keterangan'] : '') ?></textarea>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Penyebab</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="penyebab_kejadian"
                                                    id="penyebab_kejadian" value="<?= (isset($laporan['penyebab_kejadian']) ? $laporan['penyebab_kejadian'] : '') ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Nama Korban</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nama_korban" id="nama_korban" value="<?= (isset($laporan['nama_korban']) ? $laporan['nama_korban'] : '') ?>"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Alamat Korban</label>
                                            <div class="form-line">
                                                <!-- <input type="text" class="form-control" name="almt_kejadian" id="almt_kejadian" required> -->
                                                <textarea rows="1" class="form-control no-resize auto-growth"
                                                    name="almt_korban" id="almt_korban" required><?= (isset($laporan['alamat_korban']) ? $laporan['alamat_korban'] : '') ?></textarea>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Saksi</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="saksi"
                                                    id="saksi" value="<?= (isset($laporan['saksi']) ? $laporan['saksi'] : '') ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Tindakan</label>
                                            <div class="form-line">
                                                <textarea rows="1" class="form-control no-resize auto-growth"
                                                    name="tindakan" id="tindakan" required><?= (isset($laporan['tindakan']) ? $laporan['tindakan'] : '') ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Pelapor</label>
                                            <div class="form-line">
                                                <textarea rows="1" class="form-control no-resize auto-growth"
                                                    name="pelapor" id="pelapor" required><?= (isset($laporan['nama_pelapor']) ? $laporan['nama_pelapor'] : '') ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">No. HP Pelapor</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="no_hp_pelapor"
                                                    id="no_hp_pelapor" value="<?= (isset($laporan['no_hp_pelapor']) ? $laporan['no_hp_pelapor'] : '') ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Unit</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="unit" id="unit" value="<?= (isset($laporan['unit']) ? $laporan['unit'] : '') ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Regu</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="regu" id="regu" value="<?= (isset($laporan['regu']) ? $laporan['regu'] : '') ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Pos</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="pos" id="pos" value="<?= (isset($laporan['pos']) ? $laporan['pos'] : '') ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Kerugian</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="kerugian" id="kerugian" value="<?= (isset($laporan['kerugian']) ? $laporan['kerugian'] : '') ?>"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: -30px;">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Kronologi Kejadian</label>
                                            <div class="form-line">
                                                <!-- <input type="text" class="form-control" name="kronologi" id="kronologi" required> -->
                                                <textarea rows="1" class="form-control no-resize auto-growth"
                                                    name="kronologi" id="kronologi" required><?= (isset($laporan['kronologi']) ? $laporan['kronologi'] : '') ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php 
                                    if (isset($laporan['foto_kejadian'])) {
                                        $file_photo = explode(",", $laporan['foto_kejadian']);
                                    }
                                ?>

                                <?php for ($i = 0; $i < 4; $i++) {  ?>

                                    <div id="<?= 'upload_' . $i ?>">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <label for="<?= 'foto_kejadian_' . $i ?>">Foto Kejadian - <?= $i + 1 ?> :</label>
                                                <div class="controls">
                                                    <input type="file"
                                                        data-validation-required-message="Upload foto"
                                                        name="foto_kejadian[]" id="<?= 'foto_kejadian_' . $i ?>"
                                                        class="dropify" data-height="150" data-max-file-size="5120K"
                                                        accept="image/*" data-min-width="300" data-min-height="250"
                                                        data-allowed-file-extensions="jpg jpeg"
                                                        data-default-file="<?= (isset($file_photo[$i]) ? (($file_photo[$i] != NULL) ? base_url() . 'assets/path_kejadian/' . $file_photo[$i] : '') : '') ?>"
                                                        onchange="cekUpload(this)" />
                                                </div>
                                                <input type="hidden" id="<?= 'foto_kejadian_old_'.$i ?>" name="foto_kejadian_old[]" value="<?= (isset($file_photo[$i])?(($file_photo[$i] != NULL) ? $file_photo[$i] : '') : '') ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                <?php
                                } ?>


                            </div>
                            <div class="modal-footer">
                                <a href="<?= base_url('Damkar/kejadianLain') ?>" type="button"
                                    class="btn btn-danger waves-effect" data-dismiss="modal">KEMBALI</a>
                                <button type="submit" id="btn_simpan"
                                    class="btn btn-primary waves-effect">SIMPAN</button>
                                <!-- <a href="" class="btn btn-warning waves-effect" id="btn_cetak">CETAK</a> -->
                                <!-- <button class="btn btn-warning waves-effect" onclick="printLaporan('print-page')">CETAK</button> -->
                                <!-- <button type="reset" id="btn_simpan" class="btn btn-warning waves-effect">RESET</button> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url().'assets/'; ?>assets/plugins/dropify/dist/js/dropify.min.js"></script>

<script type="text/javascript">
    var drEvent = $('.dropify').dropify({
        messages: {
            default: '<center>Upload foto disini (<b>.jpg, .jpeg</b>).</center>',
            error: '<center>Maksimal ukuran file 5 MB.<br> Resolusi minimal 300x250 px </center>',
        },
        error: {
            fileSize: '<center>Maksimal ukuran file 5 MB.</center>',
            minWidth: '<center>Minimal resolusi gambar 300 x 250.</center>',
            // maxWidth: 'The image width is too big ({{ value }}px max).',
            minHeight: '<center>Minimal resolusi gambar 300 x 250.</center>',
            // maxHeight: 'The image height is too big ({{ value }}px max).',
            imageFormat: 'The image format is not allowed ({{ value }} only).'
        }
    });

    drEvent.on('dropify.beforeClear', function(event, element) {
        var id = element.element.id;
        var ids = id.split("_");
        var num = ids[2];

        $("#foto_kejadian_old_" + num).val('');
    });

    drEvent.on('dropify.errors', function(event, element) {
        var id = element.element.attributes.id.nodeValue;
        var ids = id.split("_");
        var num = ids[2];

        $("#foto_kejadian_old_" + num).val('');
    });
</script>

<script>
    function cekUpload(data) {
        var isVal = $(data).val();
        if (isVal != '' && isVal != null) {
            var id = $(data).attr('id');
            var ids = id.split("_");
            var num = ids[2];

            $("#foto_kejadian_old_" + num).val('');
        }
    }
</script>


<!-- Show Laporan Lain-Lain -->
<script type="text/javascript">
function addZero(n) {
    if (n <= 9) {
        return "0" + n;
    }
    return n
}
</script>