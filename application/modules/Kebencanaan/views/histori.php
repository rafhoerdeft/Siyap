<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>HISTORI KEJADIAN</h2>
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
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="data-histori">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="15%">Pelapor</th>
                                        <th width="24%">Alamat Kejadian</th>
                                        <th width="15%">Keterangan</th>
                                        <th width="15%">Jenis Kejadian</th>
                                        <th width="15%">Waktu Lapor</th>
                                        <th width="5%">Foto</th>
                                        <th width="5%">Status</th>
                                        <th width="16%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 9pt">
                                    <?php $no=1; foreach ($histori as $data) { ?>
                                        <tr>
                                            <td><?= $data->id_lapor ?></td>
                                            <td><?= $data->nama_user ?></td>
                                            <td><?= $data->alamat ?></td>
                                            <td><?= $data->keterangan ?></td>
                                            <td><?= $data->nama_jenis_lap ?></td>
                                            <td><?= date('d-m-Y (H:i)', strtotime($data->tgl_lapor)) ?></td>
                                            <td>
                                                <a class="foto_kejadian" href="<?= base_url().'assets/path_laporan/'.$data->image_lapor ?>"><button class="btn btn-primary waves-effect" style="width: 65px; margin-bottom: 5px;">Kejadian</button></a><br>
                                                <a class="foto_kejadian" href="<?= base_url().'assets/path_selfie/'.$data->image_selfie ?>"><button class="btn bg-pink waves-effect" style="width: 65px">Pelapor</button></a>
                                            </td>
                                            <td><?= ucfirst($data->status) ?></td>
                                            <td>
                                                <?php if ($data->status == 'selesai' || $data->status == 'batal') { 
                                                        if ($data->status == 'batal') {
                                                ?>
                                                            <!-- <button title="Laporan Kejadian Lain-Lain" class="btn bg-link waves-effect" style="margin-bottom: 5px; width: 15px" disabled><i class="material-icons" style="font-size: 18pt; margin-top: -5px; margin-left: -4px">assignment</i></button>

                                                            <button title="Laporan Kebakaran" class="btn bg-link waves-effect" style="margin-bottom: 5px; width: 15px" disabled><i class="material-icons" style="font-size: 18pt; margin-top: -5px; margin-left: -4px">assignment</i></button> -->
                                                    <?php }else{ ?>
                                                            <!-- <button title="Laporan Kejadian Lain-Lain" class="btn bg-green waves-effect" data-toggle="modal" data-target="#modal_lapor" onclick="addLap('<?= $data->id_lapor ?>', '<?= $data->nama_user ?>')" style="margin-bottom: 5px; width: 15px"><i class="material-icons" style="font-size: 18pt; margin-top: -5px; margin-left: -4px">assignment</i></button>

                                                            <button title="Laporan Kebakaran" class="btn bg-purple waves-effect" data-toggle="modal" data-target="#modal_lapor2" onclick="addLapKebakaran('<?= $data->id_lapor ?>', '<?= $data->nama_user ?>')" style="margin-bottom: 5px; width: 15px"><i class="material-icons" style="font-size: 18pt; margin-top: -5px; margin-left: -4px">assignment</i></button> -->
                                                    <?php } ?>
                                                        <button title="Selesai" class="btn bg-link waves-effect" disabled style="margin-bottom: 5px; width: 15px"><i class="material-icons" style="font-size: 18pt; margin-top: -5px; margin-left: -4px">check_circle</i></button>

                                                        <button title="Batal" class="btn bg-link waves-effect" disabled style="margin-bottom: 5px; width: 15px"><i class="material-icons" style="font-size: 18pt; margin-top: -5px; margin-left: -4px">cancel</i></button>
                                                <?php }else{ ?>
                                                        <!-- <button title="Laporan Kejadian Lain-Lain" class="btn bg-link waves-effect" style="margin-bottom: 5px; width: 15px" disabled><i class="material-icons" style="font-size: 18pt; margin-top: -5px; margin-left: -4px">assignment</i></button>

                                                        <button title="Laporan Kebakaran" class="btn bg-link waves-effect" style="margin-bottom: 5px; width: 15px" disabled><i class="material-icons" style="font-size: 18pt; margin-top: -5px; margin-left: -4px">assignment</i></button> -->

                                                        <button title="Selesai" class="btn bg-orange waves-effect" style="margin-bottom: 5px; width: 15px" onclick="lapSelesai('<?= $data->id_lapor ?>')"><i class="material-icons" style="font-size: 18pt; margin-top: -5px; margin-left: -4px">check_circle</i></button>

                                                        <?php if ($data->status == 'proses') { ?>
                                                            <button title="Batal" class="btn bg-link waves-effect" disabled style="margin-bottom: 5px; width: 15px"><i class="material-icons" style="font-size: 18pt; margin-top: -5px; margin-left: -4px">cancel</i></button>
                                                        <?php }else{ ?>
                                                        <button title="Batal" class="btn bg-red waves-effect" style="margin-bottom: 5px; width: 15px" data-toggle="modal" data-target="#modal_batal" onclick="lapBatal('<?= $data->id_lapor ?>')"><i class="material-icons" style="font-size: 18pt; margin-top: -5px; margin-left: -4px">cancel</i></button>
                                                <?php }} ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Laporan Kejadian Lain-Lain -->
<div class="modal fade" id="modal_lapor" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <form name="laporan" id="lp" method="post" action="<?= base_url().'Kebencanaan/simpanLap'; ?>">
                        <input type="hidden" name="id_lapor" id="id_lapor">
                        <!-- <div class="modal-header"> -->
                            
                        <!-- </div> -->
                        <div class="modal-body" id="print-page">
                            <center>
                                <h4 class="modal-title" id="defaultModalLabel">Laporan Kegiatan/Kejadian</h4>
                            </center>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Jenis Kejadian
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="jenis_kejadian" id="jenis_kejadian" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Tanggal Kejadian
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="tgl_kejadian" id="tgl_kejadian" required style="margin-bottom: -4px;" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        Waktu Kejadian
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="waktu_awal" id="waktu_awal" required style="margin-bottom: -4px;" readonly>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Tanggal Selesai
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="tgl_selesai" id="tgl_selesai" style="margin-bottom: -4px;" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        Waktu Selesai
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="waktu_akhir" id="waktu_akhir" style="margin-bottom: -4px;" readonly required>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Alamat Kejadian
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <!-- <input type="text" class="form-control" name="almt_kejadian" id="almt_kejadian" required style="margin-bottom: -4px;"> -->
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="almt_kejadian" id="almt_kejadian" required style="margin-bottom: -4px;">&nbsp</textarea>

                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Ket. Pelapor
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <!-- <input type="text" class="form-control" name="almt_korban" id="almt_korban" required style="margin-bottom: -4px;"> -->
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="keterangan" id="keterangan" required style="margin-bottom: -4px;"></textarea>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Penyebab
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="penyebab_kejadian" id="penyebab_kejadian" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Nama Korban
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="nama_korban" id="nama_korban" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Alamat Korban
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <!-- <input type="text" class="form-control" name="almt_korban" id="almt_korban" required style="margin-bottom: -4px;"> -->
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="almt_korban" id="almt_korban" required style="margin-bottom: -4px;"></textarea>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Saksi
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="saksi" id="saksi" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Kerugian
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="kerugian" id="kerugian" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Kronologi Kejadian
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <!-- <input type="text" class="form-control" name="kronologi" id="kronologi" required style="margin-bottom: -4px;"> -->
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="kronologi" id="kronologi" required style="margin-bottom: -4px;"></textarea>

                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Tindakan
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <!-- <input type="text" class="form-control" name="tindakan" id="tindakan" required style="margin-bottom: -4px;"> -->
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="tindakan" id="tindakan" required style="margin-bottom: -4px;"></textarea>

                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Pelapor
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <!-- <input type="text" class="form-control" name="pelapor" id="pelapor" required style="margin-bottom: -4px;"> -->
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="pelapor" id="pelapor" required style="margin-bottom: -4px;"></textarea>

                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        No. HP Pelapor
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="no_hp_pelapor" id="no_hp_pelapor" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Foto Kejadian
                                    </div>
                                    <div class="col-md-9 col-lg-9 col-sm-9">
                                        <div id="photo" style="margin-top: -5px;" class="row">

                                        </div>
                                    </div>
                                </div>                        
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btn_simpan" class="btn btn-primary waves-effect">SIMPAN</button>
                            <a href="" class="btn btn-warning waves-effect" id="btn_cetak">CETAK</a>
                            <!-- <button class="btn btn-warning waves-effect" onclick="printLaporan('print-page')">CETAK</button> -->
                            <!-- <button type="reset" id="btn_simpan" class="btn btn-warning waves-effect">RESET</button> -->
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">KELUAR</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Modal Laporan Kebakaran -->
<div class="modal fade" id="modal_lapor2" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <form name="laporan" id="lp" method="post" action="<?= base_url().'Kebencanaan/simpanLap2'; ?>">
                        <input type="hidden" name="id_lapor" id="id_lapor">
                        <!-- <div class="modal-header"> -->
                            
                        <!-- </div> -->
                        <div class="modal-body" id="print-page">
                            <center>
                                <h4 class="modal-title" id="defaultModalLabel">Laporan Kejadian Kebakaran</h4>
                            </center>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Tanggal Kejadian
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="tgl_kejadian" id="tgl_kejadian2" required style="margin-bottom: -4px;" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        Waktu Kejadian
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="waktu_awal" id="waktu_awal2" required style="margin-bottom: -4px;" readonly>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Tanggal Selesai
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="tgl_selesai" id="tgl_selesai2" style="margin-bottom: -4px;" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        Waktu Selesai
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="waktu_akhir" id="waktu_akhir2" style="margin-bottom: -4px;" readonly required>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Lokasi
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <!-- <input type="text" class="form-control" name="almt_kejadian" id="almt_kejadian" required style="margin-bottom: -4px;"> -->
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="almt_kejadian" id="almt_kejadian" required style="margin-bottom: -4px;">&nbsp</textarea>

                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Ket. Pelapor
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <!-- <input type="text" class="form-control" name="almt_kejadian" id="almt_kejadian" required style="margin-bottom: -4px;"> -->
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="keterangan" id="keterangan" required style="margin-bottom: -4px;">&nbsp</textarea>

                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Obyek Terbakar
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="obyek_terbakar" id="obyek_terbakar" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Asal Api
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="asal_api" id="asal_api" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Nama Pemilik
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="nama_pemilik" id="nama_pemilik" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Kerugian
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="kerugian" id="kerugian" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Kronologi Kejadian
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <!-- <input type="text" class="form-control" name="kronologi" id="kronologi" required style="margin-bottom: -4px;"> -->
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="kronologi" id="kronologi" required style="margin-bottom: -4px;"></textarea>

                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Ket. Kejadian
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="ket_kejadian" id="ket_kejadian" required style="margin-bottom: -4px;"></textarea>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Pelapor
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="pelapor" id="pelapor" required style="margin-bottom: -4px;"></textarea>

                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        No. HP Pelapor
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="no_hp_pelapor" id="no_hp_pelapor" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Foto Kejadian
                                    </div>
                                    <div class="col-md-9 col-lg-9 col-sm-9">
                                        <div id="photo" style="margin-top: -5px;" class="row">

                                        </div>
                                    </div>
                                </div>                        
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btn_simpan" class="btn btn-primary waves-effect">SIMPAN</button>
                            <a href="" class="btn btn-warning waves-effect" id="btn_cetak">CETAK</a>
                            <!-- <button class="btn btn-warning waves-effect" onclick="printLaporan('print-page')">CETAK</button> -->
                            <!-- <button type="reset" id="btn_simpan" class="btn btn-warning waves-effect">RESET</button> -->
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">KELUAR</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Modal Batalkan Laporan -->
<div class="modal fade" id="modal_batal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <form name="laporan" id="lp" method="post" action="">
                        <input type="hidden" name="id_lapor" id="id_lapor">
                        <!-- <div class="modal-header"> -->
                            
                        <!-- </div> -->
                        <div class="modal-body" id="print-page">
                            <center>
                                <h4 class="modal-title" id="defaultModalLabel">Batalkan Laporan</h4>
                            </center>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <!-- <input type="text" class="form-control" name="almt_korban" id="almt_korban" required style="margin-bottom: -4px;"> -->
                                            Keterangan Batal
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="ket_batal" id="ket_batal" required style="margin-bottom: -4px;" placeholder="Masukkan Keterangan"></textarea>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="batalkanLap()" id="btn_simpan" class="btn btn-primary waves-effect">BATALKAN</button>
                            <button type="reset" id="btn_simpan" class="btn btn-warning waves-effect">RESET</button>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">KELUAR</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Initialize Firebase -->
<script src="https://www.gstatic.com/firebasejs/5.9.4/firebase.js"></script>
<script type="text/javascript">
    var config = {
        apiKey: "AIzaSyAPkOj6yMUHNvvcVRiAjntLd8Y5Rb5UQs8",
        authDomain: "panicbutton-1554857641771.firebaseapp.com",
        databaseURL: "https://panicbutton-1554857641771.firebaseio.com",
        projectId: "panicbutton-1554857641771",
        storageBucket: "panicbutton-1554857641771.appspot.com",
        messagingSenderId: "306651005669",
        appId: "1:306651005669:web:6a599479b6308d48"
    };

    firebase.initializeApp(config);
</script>

<!-- Event Batalkan Laporan -->
<script type="text/javascript">
    function lapBatal(id='') {
        // alert(id);
        $('#modal_batal #id_lapor').val(id);
        $('#modal_batal #ket_batal').val('');
    }

    function batalkanLap() {
        var id = $('#modal_batal #id_lapor').val();
        var ket = $('#modal_batal #ket_batal').val();

        var ids = parseInt(id);
          swal({
              title: "Batalkan Laporan",
              text: "Apakah laporan ini akan dibatalkan?",
              type: "info",
              showCancelButton: true,
              closeOnConfirm: false,
              showLoaderOnConfirm: true,
          }, function () {
                setTimeout(function () {

                        $.post("<?= base_url() ?>/Kebencanaan/lapBatal", {id_lap: id, ket: ket}, function(result){
                          // alert(result);
                            if (result == 'Success') {

                              // var remove = firebase.database().ref('Kebencanaan/'+key).remove();
                                var removes = 0;
                                var ref = firebase.database().ref().child('/Kebencanaan');
                                var query = ref.orderByChild("id_lapor").equalTo(ids);
                                query.once("value", function(snapshot) {
                                  snapshot.forEach(function(child) {
                                    removes++;
                                    // alert(child.key);
                                    child.ref.remove();
                                  });
                                  // alert(removes);
                                  if (removes > 0) {
                                    swal("Laporan sudah dibatalkan!"); 
                                    location.reload();
                                  }else{
                                    swal("Gagal!");
                                  }
                                });  

                            }else{
                              swal("Gagal!");
                            }
                        });
                }, 700);
          });
    }
</script>

<!-- Event Laporan Selesai -->
<script type="text/javascript">
  function lapSelesai(id='', key='') {
      // alert(id+' - '+key);
      var ids = parseInt(id);
      swal({
          title: "Akhiri Aduan",
          text: "Apakah aduan ini sudah selesai?",
          type: "info",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
      }, function () {
            setTimeout(function () {

                    $.post("<?= base_url() ?>/Kebencanaan/lapSelesai", {id_lap: id, key: key}, function(result){
                      // alert(result);
                        if (result == 'Success') {

                          // var remove = firebase.database().ref('Kebencanaan/'+key).remove();
                            var removes = 0;
                            var ref = firebase.database().ref().child('/Kebencanaan');
                            var query = ref.orderByChild("id_lapor").equalTo(ids);
                            query.once("value", function(snapshot) {
                              snapshot.forEach(function(child) {
                                removes++;
                                // alert(child.key);
                                child.ref.remove();
                              });
                              // alert(removes);
                              if (removes > 0) {
                                swal("Aduan sudah selesai!"); 
                                location.reload();
                              }else{
                                swal("Gagal!");
                              }
                            });  

                        }else{
                          swal("Gagal!");
                        }
                    });
            }, 700);
      });
  }
</script>

<!-- Show Laporan Lain-Lain -->
<script type="text/javascript">
    function addZero(n){
      if(n <= 9){
        return "0" + n;
      }
      return n
    }

    function addLap(id, pelapor) {
        $.post("<?= base_url() ?>/Kebencanaan/showLap", {id_lap: id}, function(result){
            var dt = JSON.parse(result);            

            var tgl_lapor = new Date(dt.lapor.tgl_lapor);
            var waktu_awal = new Date(dt.lapor.tgl_lapor);
            var waktu_akhir = new Date(dt.lapor.waktu_selesai);
            
            $('#modal_lapor #id_lapor').val(id);
            $('#modal_lapor #pelapor').val(pelapor);
            $('#modal_lapor #tgl_kejadian').val(addZero(tgl_lapor.getDate())+'-'+addZero(tgl_lapor.getMonth()+1)+'-'+tgl_lapor.getFullYear());
            $('#modal_lapor #waktu_awal').val(addZero(waktu_awal.getHours())+':'+addZero(waktu_awal.getMinutes()));

            if (dt.lapor.waktu_selesai === '' || dt.lapor.waktu_selesai === null || dt.lapor.waktu_selesai === 'null') {
                $('#modal_lapor #waktu_akhir').val('');
                $('#modal_lapor #tgl_selesai').val('');
            }else{
                $('#modal_lapor #tgl_selesai').val(addZero(waktu_akhir.getDate())+'-'+addZero(waktu_akhir.getMonth()+1)+'-'+waktu_akhir.getFullYear());
                $('#modal_lapor #waktu_akhir').val(addZero(waktu_akhir.getHours())+':'+addZero(waktu_akhir.getMinutes()));
            }

            $('#modal_lapor #no_hp_pelapor').val(dt.lapor.no_hp);
            $('#modal_lapor #almt_kejadian').val(dt.lapor.alamat);
            $('#modal_lapor #keterangan').val(dt.lapor.keterangan);
            $('#modal_lapor #jenis_kejadian').val(dt.lapor.jenis_kejadian);            
            $('#modal_lapor #penyebab_kejadian').val(dt.lapor.penyebab_kejadian);
            $('#modal_lapor #nama_korban').val(dt.lapor.nama_korban);
            $('#modal_lapor #almt_korban').val(dt.lapor.alamat_korban);
            $('#modal_lapor #saksi').val(dt.lapor.saksi);
            $('#modal_lapor #kerugian').val(dt.lapor.kerugian);
            $('#modal_lapor #kronologi').val(dt.lapor.kronologi);
            $('#modal_lapor #tindakan').val(dt.lapor.tindakan);
            $('#modal_lapor #btn_cetak').attr("href","<?= base_url().'Kebencanaan/cetakLap/' ?>"+id);

            $('#modal_lapor #photo').html('');

            var file;
            var file_photo = [];
            for (var i = 0; i < dt.foto.length; i++) {
                // alert(dt.foto[i].foto_kejadian);
                var photo = dt.foto[i].foto_kejadian;
                file = photo.split(",");

                for (var x = 0; x < file.length; x++) {
                    if (file[x] != "") {
                        file_photo.push(file[x]);
                    }
                }
            }

            var pic;
            for (var j = 0; j < file_photo.length; j++) {
                // alert(file_photo[j]);
                pic = "<div class ='col-sm-4 col-md-4 col-lg-4'>"+
                        "<a class='file_photo' rel='kejadian' href='<?= base_url()."assets/path_kejadian/"?>"+file_photo[j]+"'>"+
                          "<img onclick='fancy()' src='<?= base_url()."assets/path_kejadian/" ?>"+file_photo[j]+"' width='100%' style='margin-bottom: 20px;'>"+
                        "</a>"+
                      "</div>";
                $('#modal_lapor #photo').append(pic);
            }

        });
        
    }
</script>

<!-- Show Laporan Kebakaran -->
<script type="text/javascript">
    // function addZero(n){
    //   if(n <= 9){
    //     return "0" + n;
    //   }
    //   return n
    // }

    function addLapKebakaran(id, pelapor) {
        $.post("<?= base_url() ?>/Kebencanaan/showLap", {id_lap: id}, function(result){
            var dt = JSON.parse(result);            

            var tgl_lapor = new Date(dt.lapor.tgl_lapor);
            var waktu_awal = new Date(dt.lapor.tgl_lapor);
            var waktu_akhir = new Date(dt.lapor.waktu_selesai);
            
            $('#modal_lapor2 #id_lapor').val(id);
            $('#modal_lapor2 #pelapor').val(pelapor);
            $('#modal_lapor2 #tgl_kejadian2').val(addZero(tgl_lapor.getDate())+'-'+addZero(tgl_lapor.getMonth()+1)+'-'+tgl_lapor.getFullYear());
            $('#modal_lapor2 #waktu_awal2').val(addZero(waktu_awal.getHours())+':'+addZero(waktu_awal.getMinutes()));

            if (dt.lapor.waktu_selesai === '' || dt.lapor.waktu_selesai === null || dt.lapor.waktu_selesai === 'null') {
                $('#modal_lapor2 #waktu_akhir2').val('');
                $('#modal_lapor2 #tgl_selesai2').val('');
            }else{
                $('#modal_lapor2 #tgl_selesai2').val(addZero(waktu_akhir.getDate())+'-'+addZero(waktu_akhir.getMonth()+1)+'-'+waktu_akhir.getFullYear());
                $('#modal_lapor2 #waktu_akhir2').val(addZero(waktu_akhir.getHours())+':'+addZero(waktu_akhir.getMinutes()));
            }

            $('#modal_lapor2 #no_hp_pelapor').val(dt.lapor.no_hp);
            $('#modal_lapor2 #almt_kejadian').val(dt.lapor.alamat);
            $('#modal_lapor2 #keterangan').val(dt.lapor.keterangan);           
            $('#modal_lapor2 #ket_kejadian').val(dt.lapor.ket_laporan);           
            $('#modal_lapor2 #obyek_terbakar').val(dt.lapor.obyek_terbakar);
            $('#modal_lapor2 #asal_api').val(dt.lapor.asal_api);
            $('#modal_lapor2 #nama_pemilik').val(dt.lapor.nama_korban);
            $('#modal_lapor2 #kerugian').val(dt.lapor.kerugian);
            $('#modal_lapor2 #kronologi').val(dt.lapor.kronologi);
            $('#modal_lapor2 #btn_cetak').attr("href","<?= base_url().'Kebencanaan/cetakLap2/' ?>"+id);

            $('#modal_lapor2 #photo').html('');

            var file;
            var file_photo = [];
            for (var i = 0; i < dt.foto.length; i++) {
                // alert(dt.foto[i].foto_kejadian);
                var photo = dt.foto[i].foto_kejadian;
                file = photo.split(",");

                for (var x = 0; x < file.length; x++) {
                    if (file[x] != "") {
                        file_photo.push(file[x]);
                    }
                }
            }

            var pic;
            for (var j = 0; j < file_photo.length; j++) {
                // alert(file_photo[j]);
                pic = "<div class ='col-sm-4 col-md-4 col-lg-4'>"+
                        "<a class='file_photo' rel='kejadian' href='<?= base_url()."assets/path_kejadian/"?>"+file_photo[j]+"'>"+
                          "<img onclick='fancy()' src='<?= base_url()."assets/path_kejadian/" ?>"+file_photo[j]+"' width='100%' style='margin-bottom: 20px;'>"+
                        "</a>"+
                      "</div>";
                $('#modal_lapor2 #photo').append(pic);
            }

        });
        
    }
</script>

<script type="text/javascript">
    function printLaporan(n){
        // var button = $('#buttonPrintInvoice').hide();
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(n).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        // document.body.innerHTML = restorepage;
        // $('#detailInvoice').modal('hide');
        window.location.href = "<?=base_url().'Kebencanaan/historiAduan' ?>";
    }
</script>







