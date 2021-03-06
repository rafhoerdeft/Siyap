@layout('layouts/master')

@section('content')
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
                            <div>
                                <style>
                                    #data_histori tbody{
                                        font-size: 8pt;
                                    }
                                </style>
                                <table id="data_histori" class="table table-bordered table-striped table-hover table-responsive">
                                    <thead style="font-size: 9pt">
                                        <tr>
                                            <th>ID</th>
                                            <th>Aksi</th>
                                            <th>Pelapor</th>
                                            <th>Alamat Kejadian</th>
                                            <th>Keterangan</th>
                                            <th>Jenis Kejadian</th>
                                            <th>Waktu Lapor</th>
                                            <th>Foto</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
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
                        <form name="laporan" id="lp" method="post" action="<?= base_url().'Damkar/simpanLap'; ?>">
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
                                            Unit
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input type="text" class="form-control" name="unit" id="unit" required style="margin-bottom: -4px;">
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            Regu
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input type="text" class="form-control" name="regu" id="regu" required style="margin-bottom: -4px;">
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            Pos
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input type="text" class="form-control" name="pos" id="pos" required style="margin-bottom: -4px;">
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
                        <form name="laporan" id="lp" method="post" action="<?= base_url().'Damkar/simpanLap2'; ?>">
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
                                            Unit
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input type="text" class="form-control" name="unit" id="unit" required style="margin-bottom: -4px;">
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            Regu
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input type="text" class="form-control" name="regu" id="regu" required style="margin-bottom: -4px;">
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            Pos
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input type="text" class="form-control" name="pos" id="pos" required style="margin-bottom: -4px;">
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

@endsection

@section('footer')
    <!-- Jquery DataTable Plugin Js --> 
    <script src="<?php echo base_url().'assets/assets/bundles/datatablescripts.bundle.js'; ?>"></script>
    <!-- <script src="<?php //echo base_url().'assets/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js'; ?>"></script>
    <script src="<?php //echo base_url().'assets/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js'; ?>"></script>
    <script src="<?php //echo base_url().'assets/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js'; ?>"></script>
    <script src="<?php //echo base_url().'assets/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js'; ?>"></script>
    <script src="<?php //echo base_url().'assets/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js'; ?>"></script>
    <script src="<?php //echo base_url().'assets/assets/plugins/jquery-datatable/buttons/buttons.print.min.js'; ?>"></script> -->
    
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

                            $.post("<?= base_url() ?>/Damkar/lapBatal", {id_lap: id, ket: ket}, function(result){
                            // alert(result);
                                if (result == 'Success') {

                                // var remove = firebase.database().ref('Damkar/'+key).remove();
                                    var removes = 0;
                                    var ref = firebase.database().ref().child('/Damkar');
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

                            $.post("<?= base_url() ?>/Damkar/lapSelesai", {id_lap: id, key: key}, function(result){
                            // alert(result);
                                if (result == 'Success') {

                                // var remove = firebase.database().ref('Damkar/'+key).remove();
                                    var removes = 0;
                                    var ref = firebase.database().ref().child('/Damkar');
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
            $('#modal_lapor #id_lapor').val('');
            $('#modal_lapor #pelapor').val('');
            $('#modal_lapor #tgl_kejadian').val('');
            $('#modal_lapor #waktu_awal').val('');
            $('#modal_lapor #waktu_akhir').val('');
            $('#modal_lapor #tgl_selesai').val('');
            $('#modal_lapor #no_hp_pelapor').val('');
            $('#modal_lapor #almt_kejadian').val('');
            $('#modal_lapor #keterangan').val('');
            $('#modal_lapor #jenis_kejadian').val('');            
            $('#modal_lapor #penyebab_kejadian').val('');
            $('#modal_lapor #nama_korban').val('');
            $('#modal_lapor #almt_korban').val('');
            $('#modal_lapor #saksi').val('');
            $('#modal_lapor #kerugian').val('');
            $('#modal_lapor #kronologi').val('');
            $('#modal_lapor #tindakan').val('');
            $('#modal_lapor #unit').val('');
            $('#modal_lapor #regu').val('');
            $('#modal_lapor #pos').val('');
            $('#modal_lapor #kronologi').val('');

            $.post("<?= base_url() ?>/Damkar/showLap", {id_lap: id}, function(result){
                var dt = JSON.parse(result);       

                var tgl_lapor = new Date(dt.lapor.tgl_lapor);
                var waktu_awal = new Date(dt.lapor.tgl_lapor);
                
                $('#modal_lapor #id_lapor').val(id);
                $('#modal_lapor #pelapor').val(pelapor);
                $('#modal_lapor #tgl_kejadian').val(addZero(tgl_lapor.getDate())+'-'+addZero(tgl_lapor.getMonth()+1)+'-'+tgl_lapor.getFullYear());
                $('#modal_lapor #waktu_awal').val(addZero(waktu_awal.getHours())+':'+addZero(waktu_awal.getMinutes()));

                if (dt.lapor.waktu_selesai === null) {
                    
                    if (dt.waktu[0].waktu_selesai === '' || dt.waktu[0].waktu_selesai === null || dt.waktu[0].waktu_selesai === 'null') {
                        $('#modal_lapor #waktu_akhir').val('');
                        $('#modal_lapor #tgl_selesai').val('');
                    }else{
                        var wkt_akhr = new Date(dt.waktu[0].waktu_selesai);
                        // alert(addZero(wkt_akhr.getDate())+'-'+addZero(wkt_akhr.getMonth()+1)+'-'+wkt_akhr.getFullYear());  
                        $('#modal_lapor #waktu_akhir').val(addZero(wkt_akhr.getHours())+':'+addZero(wkt_akhr.getMinutes()));
                        $('#modal_lapor #tgl_selesai').val(addZero(wkt_akhr.getDate())+'-'+addZero(wkt_akhr.getMonth()+1)+'-'+wkt_akhr.getFullYear());
                    }
                }else{
                    var waktu_akhir = new Date(dt.lapor.waktu_selesai);

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
                $('#modal_lapor #unit').val(dt.lapor.unit);
                $('#modal_lapor #regu').val(dt.lapor.regu);
                $('#modal_lapor #pos').val(dt.lapor.pos);
                $('#modal_lapor #btn_cetak').attr("href","<?= base_url().'Damkar/cetakLap/' ?>"+id);

                // =======================================================================================

                var ket_kejadian = '';
                for (var x = 0; x < dt.kronologi.length; x++) {
                    ket_kejadian += dt.kronologi[x].keterangan+'\n\n';
                }

                if (dt.lapor.kronologi === '' || dt.lapor.kronologi === null || dt.lapor.kronologi === 'null') {
                    $('#modal_lapor #kronologi').val(ket_kejadian);
                }else{
                    $('#modal_lapor #kronologi').val(dt.lapor.kronologi);
                }
                // alert(ket_kejadian);

                // ======================================================================================

                $('#modal_lapor #photo').html('');

                var pic;
                pic = "<div class ='col-sm-4 col-md-4 col-lg-4'>"+
                            "<a class='file_photo' rel='kejadian' href='<?= base_url()."assets/path_laporan/"?>"+dt.lapor.image_lapor+"'>"+
                            "<img onclick='fancy()' src='<?= base_url()."assets/path_laporan/" ?>"+dt.lapor.image_lapor+"' width='100%' style='margin-bottom: 20px;'>"+
                            "</a>"+
                        "</div>";
                $('#modal_lapor #photo').append(pic);

                var file;
                var file_photo = [];
                for (var i = 0; i < dt.foto.length; i++) {
                    // alert(dt.foto[i].foto_kejadian);
                    var photo = dt.foto[i].foto_kejadian;
                    if (photo != '-' && photo != '' && photo != null) {
                        file = photo.split(",");

                        for (var x = 0; x < file.length; x++) {
                            if (file[x] != "") {
                                file_photo.push(file[x]);
                            }
                        }
                    }
                    
                }

                for (var j = 0; j < file_photo.length; j++) {
                    // alert(file_photo[j]);
                    pic = "<div class ='col-sm-4 col-md-4 col-lg-4'>"+
                            "<a class='file_photo' rel='kejadian' href='<?= base_url()."assets/path_kejadian/"?>"+file_photo[j]+"'>"+
                            "<img onclick='fancy()' src='<?= base_url()."assets/path_kejadian/" ?>"+file_photo[j]+"' width='100%' style='margin-bottom: 20px;'>"+
                            "</a>"+
                        "</div>";
                    $('#modal_lapor #photo').append(pic);
                }

                $('#modal_lapor').modal('show');

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
            $('#modal_lapor2 #no_hp_pelapor').val('');
            $('#modal_lapor2 #almt_kejadian').val('');
            $('#modal_lapor2 #keterangan').val('');           
            $('#modal_lapor2 #ket_kejadian').val('');           
            $('#modal_lapor2 #obyek_terbakar').val('');
            $('#modal_lapor2 #asal_api').val('');
            $('#modal_lapor2 #nama_pemilik').val('');
            $('#modal_lapor2 #kerugian').val('');
            $('#modal_lapor2 #kronologi').val('');
            $('#modal_lapor2 #unit').val('');
            $('#modal_lapor2 #regu').val('');
            $('#modal_lapor2 #pos').val('');
            $('#modal_lapor2 #id_lapor').val('');
            $('#modal_lapor2 #pelapor').val('');
            $('#modal_lapor2 #tgl_kejadian2').val('');
            $('#modal_lapor2 #waktu_awal2').val('');
            $('#modal_lapor2 #waktu_akhir2').val('');
            $('#modal_lapor2 #tgl_selesai2').val('');
            $('#modal_lapor2 #kronologi').val('');

            $.post("<?= base_url() ?>/Damkar/showLap", {id_lap: id}, function(result){
                var dt = JSON.parse(result);
                // alert(dt.waktu[0].waktu_selesai);            

                var tgl_lapor = new Date(dt.lapor.tgl_lapor);
                var waktu_awal = new Date(dt.lapor.tgl_lapor);
                
                $('#modal_lapor2 #id_lapor').val(id);
                $('#modal_lapor2 #pelapor').val(pelapor);
                $('#modal_lapor2 #tgl_kejadian2').val(addZero(tgl_lapor.getDate())+'-'+addZero(tgl_lapor.getMonth()+1)+'-'+tgl_lapor.getFullYear());
                $('#modal_lapor2 #waktu_awal2').val(addZero(waktu_awal.getHours())+':'+addZero(waktu_awal.getMinutes()));

                if (dt.lapor.waktu_selesai === null) {
                    
                    if (dt.waktu[0].waktu_selesai === '' || dt.waktu[0].waktu_selesai === null || dt.waktu[0].waktu_selesai === 'null') {
                        $('#modal_lapor2 #waktu_akhir2').val('');
                        $('#modal_lapor2 #tgl_selesai2').val('');
                    }else{
                        var wkt_akhr = new Date(dt.waktu[0].waktu_selesai);
                        $('#modal_lapor2 #waktu_akhir2').val(addZero(wkt_akhr.getHours())+':'+addZero(wkt_akhr.getMinutes()));
                        $('#modal_lapor2 #tgl_selesai2').val(addZero(wkt_akhr.getDate())+'-'+addZero(wkt_akhr.getMonth()+1)+'-'+wkt_akhr.getFullYear());
                    }
                }else{
                    var waktu_akhir = new Date(dt.lapor.waktu_selesai);

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
                $('#modal_lapor2 #unit').val(dt.lapor.unit);
                $('#modal_lapor2 #regu').val(dt.lapor.regu);
                $('#modal_lapor2 #pos').val(dt.lapor.pos);
                $('#modal_lapor2 #btn_cetak').attr("href","<?= base_url().'Damkar/cetakLap2/' ?>"+id);

                // =======================================================================================

                var ket_kejadian = '';
                for (var x = 0; x < dt.kronologi.length; x++) {
                    ket_kejadian += dt.kronologi[x].keterangan+'\n\n';
                }

                if (dt.lapor.kronologi === '' || dt.lapor.kronologi === null || dt.lapor.kronologi === 'null') {
                    $('#modal_lapor2 #kronologi').val(ket_kejadian);
                }else{
                    $('#modal_lapor2 #kronologi').val(dt.lapor.kronologi);
                }

                // alert(ket_kejadian);

                // ======================================================================================

                $('#modal_lapor2 #photo').html('');

                var pic;
                pic = "<div class ='col-sm-4 col-md-4 col-lg-4'>"+
                            "<a class='file_photo' rel='kejadian' href='<?= base_url()."assets/path_laporan/"?>"+dt.lapor.image_lapor+"'>"+
                            "<img onclick='fancy()' src='<?= base_url()."assets/path_laporan/" ?>"+dt.lapor.image_lapor+"' width='100%' style='margin-bottom: 20px;'>"+
                            "</a>"+
                        "</div>";
                $('#modal_lapor2 #photo').append(pic);

                var file;
                var file_photo = [];
                for (var i = 0; i < dt.foto.length; i++) {
                    // alert(dt.foto[i].foto_kejadian);
                    var photo = dt.foto[i].foto_kejadian;
                    if (photo != '-' && photo != '' && photo != null) {
                        file = photo.split(",");

                        for (var x = 0; x < file.length; x++) {
                            if (file[x] != "") {
                                file_photo.push(file[x]);
                            }
                        }
                    }
                    
                }

                for (var j = 0; j < file_photo.length; j++) {
                    // alert(file_photo[j]);
                    pic = "<div class ='col-sm-4 col-md-4 col-lg-4'>"+
                            "<a class='file_photo' rel='kejadian' href='<?= base_url()."assets/path_kejadian/"?>"+file_photo[j]+"'>"+
                            "<img onclick='fancy()' src='<?= base_url()."assets/path_kejadian/" ?>"+file_photo[j]+"' width='100%' style='margin-bottom: 20px;'>"+
                            "</a>"+
                        "</div>";
                    $('#modal_lapor2 #photo').append(pic);
                }

                $('#modal_lapor2').modal('show');

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
            window.location.href = "<?=base_url().'Damkar/historiAduan' ?>";
        }
    </script>

    <script>
        $("#data_histori").DataTable({
            "processing": true,
            "serverSide": true,
            "searching": true,
            "scrollX": true,
            "order":[],  
            "ajax":{  
                "url": "<?= base_url('Damkar/getDataHistori') ?>",  
                "type": "POST",
                // "success":function(data){
                //     console.log(data);
                // },
                // "beforeSend": function () {
                //     $(".loading-page").show();
                // },
                // "complete": function () {
                //     $(".loading-page").hide();
                // },
            },  
            "columnDefs":[  
                {  
                    "targets":0,  
                    "width": "10",
                    "orderable":false,  
                    "class":"text-center" 
                },
                {  
                    "targets":1,  
                    "width": "100",
                    "orderable":false,  
                    "class":"text-center" 
                }
                // {  
                //     "targets":2,  
                //     "width": "10",
                //     "orderable":false,  
                //     "class":"text-center" 
                // }
                // {  
                //     "targets":3,  
                //     "width": "50",
                //     "class":"text-center" 
                // },
                // {  
                //     "targets":4,  
                //     "width": "100"
                // },
                // {  
                //     "targets":5,  
                //     "width": "70"
                // },
            ],  
            "pageLength": 10
        }).on('draw.dt', function () {
            $('.foto_kejadian').fancybox({});
        });
    </script>
@endsection





