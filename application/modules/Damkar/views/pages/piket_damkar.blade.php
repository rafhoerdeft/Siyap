@layout('layouts/master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Piket Damkar</h2>
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
                                <div class="col-md-9 col-sm-9 col-lg-9" style="margin-bottom: -35px;">
                                    {{{$this->session->flashdata('show_alert');}}}
                                </div>
                                <div class="col-md-3 col-sm-3 col-lg-3" style="float: right;">
                                    <button onclick="addModal()" class="btn bg-light-blue btn-block waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 13px;">widgets</i> BUAT PIKET BARU</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="data-info">
                                    <thead>
                                        <tr>
                                            <th width="5%" style="text-align: center">#</th>
                                            <th width="15%" style="text-align: center">Aksi</th>
                                            <th style="text-align: center">Tgl. Piket</th>
                                            <th style="text-align: center">WMK</th>
                                            <th style="text-align: center">Ketua Regu</th>
                                            <th style="text-align: center">Mobil</th>
                                            <th style="text-align: center">No. Plat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($piket as $data) { ?>
                                            <tr>
                                                <td align="center"><?= $no++; ?></td>
                                                <td align="center" nowrap>
                                                    <button 
                                                        title="Edit" 
                                                        class="btn btn-sm btn-sm cbtn-raised bg-green waves-effect" 
                                                        data-id="{{{$data->id_piket}}}"
                                                        data-mobil="{{{$data->id_mobil}}}"
                                                        data-user="{{{$data->id_user}}}"
                                                        data-tgl="{{{date('d-m-Y', strtotime($data->tgl_piket))}}}"
                                                        onclick="editModal(this)" 
                                                        style="margin-bottom: 5px; width: 5px;">
                                                        <i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">border_color</i>
                                                    </button>
                                                    <button 
                                                        title="Hapus" 
                                                        class="btn btn-sm btn-sm cbtn-raised btn-danger waves-effect" 
                                                        data-id="{{{$data->id_piket}}}" 
                                                        onclick="hapusData(this)" 
                                                        style="margin-bottom: 5px; width: 5px;">
                                                        <i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">delete</i>
                                                    </button>
                                                    @if ($data->id_berita_acara != null AND $data->id_mobil_item != null)
                                                        <button 
                                                            title="Cetak Laporan" 
                                                            class="btn btn-sm btn-sm cbtn-raised btn-{{{($data->lanjutan?'info':'warning')}}} waves-effect" 
                                                            data-id="{{{$data->id_piket}}}" 
                                                            data-bakar="{{{$data->jml_kebakaran}}}"
                                                            data-bencana="{{{$data->jml_bencana_lain}}}"
                                                            data-tawon="{{{$data->jml_ambil_sarang_tawon}}}"
                                                            data-ular="{{{$data->jml_ambil_ular_lain}}}"
                                                            data-konmo="{{{$data->kondisi_mobil}}}"
                                                            data-konlat="{{{$data->kondisi_peralatan_lain}}}"
                                                            data-lanjutan="{{{$data->lanjutan}}}"
                                                            data-user="{{{$data->user_lanjutan}}}"
                                                            data-wmk="{{{$data->id_wmk}}}"
                                                            data-mobil="{{{$data->id_mobil}}}"
                                                            data-tgl="{{{date('d/m/Y', strtotime($data->tgl_piket))}}}"
                                                            data-tgl2="{{{date('d-m-Y', strtotime($data->tgl_piket."+1 day"))}}}"
                                                            onclick="cetakLap(this)" 
                                                            style="margin-bottom: 5px; width: 5px;">
                                                            <i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">print</i>
                                                        </button>
                                                    @else
                                                        <button 
                                                            title="Cetak Berita Acara" 
                                                            class="btn btn-sm btn-sm cbtn-raised btn-secondary waves-effect" 
                                                            disabled
                                                            style="margin-bottom: 5px; width: 5px;">
                                                            <i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">print</i>
                                                        </button>
                                                    @endif
                                                </td>
                                                <td align="center">{{{date('d-M-Y', strtotime($data->tgl_piket))}}}</td>
                                                <td align="center">{{{$data->nama_wmk}}}</td>
                                                <td>{{{$data->ketua_regu}}}</td>
                                                <td align="center">{{{$data->nama_mobil}}}</td>
                                                <td align="center">{{{$data->no_plat_mobil}}}</td>
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

    <!-- Modal Form Piket -->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-lg-1"></div>
                    <div class="col-sm-10 col-md-10 col-lg-10">
                        <form name="form_piket" id="form_piket" method="post" action="<?= base_url().'Damkar/simpanPiketDamkar'; ?>">
                            <input type="hidden" name="id" id="id"> 
                            <div class="modal-header">
                                <center>
                                    <h4 class="modal-title" id="defaultModalLabel">Tambah Piket</h4>
                                </center>
                            </div>
                            <div class="modal-body" id="print-page">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Mobil/Armada
                                        </div>
                                        <div class="col-md-8">
                                            <div style="width: 100%">
                                                <select class="form-control select2" name="mobil" id="mobil" style="width: 100%" required>
                                                    <option value="" selected>Pilih mobil/armada</option>
                                                    <?php foreach ($mobil as $key) { ?>
                                                        <option value="<?= $key->id_mobil ?>">{{{strtoupper($key->nama_wmk)}}} - {{{strtoupper($key->nama_mobil)}}} ({{{$key->no_plat_mobil}}}) </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>                        
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Petugas (Ketua Regu)
                                        </div>
                                        <div class="col-md-8">
                                            <div style="width: 100%">
                                                <select class="form-control select2" name="user" id="user" style="width: 100%" required>
                                                    <option value="" selected>Pilih ketua regu yg akan piket</option>
                                                    <?php foreach ($user as $key) { ?>
                                                        <option value="<?= $key->id_user ?>"><?= strtoupper($key->nama) ?> <?= $key->id_regu!=null?"(". $key->wmk ." - Regu ". $key->regu .")":'' ?> <label style="float: right; color:green"></label></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Tanggal Piket
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input type="text" class="form-control date_picker" name="tgl_piket" id="tgl_piket" value="{{{date('d-m-Y')}}}" style="margin-bottom: -4px;" required readonly>
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="btn_simpan" class="btn btn-primary waves-effect">SIMPAN</button>
                                <button type="reset" id="btn_reset" class="btn btn-warning waves-effect">RESET</button>
                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">KELUAR</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


    <!-- Modal Berita Acara -->
    <div class="modal fade" id="modal_ba" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-lg-1"></div>
                    <div class="col-sm-10 col-md-10 col-lg-10">
                        <form name="form_laporan" id="form_laporan" method="post" action="<?= base_url().'Damkar/simpanLanjutan'; ?>">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="lanjutan" id="lanjutan">
                            <input type="hidden" name="mobil" id="mobil">
                            <div class="modal-header">
                                <center>
                                    <h4 class="modal-title" id="defaultModalLabel">Cetak Laporan Piket Petugas <span id="tgl_piket"></span></h4>
                                </center>
                            </div>
                            <div class="modal-body" id="print-page">

                                <h6>Data Kejadian</h6>
                                <div>
                                    <table class="table" id="data_kejadian">
                                        <tr>
                                            <td width="45%">a. Jumlah kejadian kebakaran</td>
                                            <td>:</td>
                                            <td id="jml_bakar"></td>
                                            <td>kali</td>
                                        </tr>
                                        <tr>
                                            <td>b. Jumlah kejadian bencana lain</td>
                                            <td>:</td>
                                            <td id="jml_bencana"></td>
                                            <td>kali</td>
                                        </tr>
                                        <tr>
                                            <td>c. Pengambilan sarang tawon</td>
                                            <td>:</td>
                                            <td id="jml_tawon"></td>
                                            <td>kali</td>
                                        </tr>
                                        <tr>
                                            <td>d. Pengambilan ular & lainnya</td>
                                            <td>:</td>
                                            <td id="jml_ular"></td>
                                            <td>kali</td>
                                        </tr>
                                    </table>
                                </div>

                                <hr>
                                <h6>Data Kendaraan</h6>
                                <div>
                                    <table class="table" id="data_kendaraan">
                                        <tr>
                                            <td width="45%">a. Kondisi mobil</td>
                                            <td>:</td>
                                            <td id="kondisi_mobil"></td>
                                        </tr>
                                        <tr>
                                            <td>b. Kondisi peralatan lain</td>
                                            <td>:</td>
                                            <td id="kondisi_alat"></td>
                                        </tr>
                                    </table>
                                </div>

                                <hr>
                                <h6>Piket Selanjutnya</h6>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-5">
                                            Nama Petugas (Ketua Regu)
                                        </div>
                                        <div class="col-md-7">
                                            <div style="width: 100%">
                                                <select class="form-control select2" name="user" id="user" style="width: 100%" required>
                                                    <option value="" selected>Pilih ketua regu yg melanjutkan piket</option>
                                                    <?php foreach ($user as $key) { ?>
                                                        <option value="<?= $key->id_user ?>"><?= strtoupper($key->nama) ?> <?= $key->id_regu!=null?"(". $key->wmk ." - Regu ". $key->regu .")":'' ?> <label style="float: right; color:green"></label></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-5">
                                            Tanggal Piket
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input type="text" class="form-control" name="tgl_piket" id="tgl_lhr" style="margin-bottom: -4px;" required readonly>
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="btn_simpan" class="btn btn-primary waves-effect">CETAK</button>
                                {{-- <button type="reset" id="btn_reset" class="btn btn-warning waves-effect">RESET</button> --}}
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

    <!-- Clear - Edit - Hapus User -->
    <script type="text/javascript">

        function clearForm() {
            $('#modal_form #form_piket #mobil').val('').change();
            $('#modal_form #form_piket #user').val('').change();
            $('#modal_form #form_piket #tgl_piket').val("{{{date('d-m-Y')}}}");
        }

        function addModal() {
            clearForm();
            $('#modal_form #form_piket').attr('action', "<?= base_url().'Damkar/simpanPiketDamkar'; ?>");

            $('#modal_form').modal({backdrop: 'static', keyboard: false}); 
        }

        function editModal(data) {
            var id      = $(data).data().id;
            var mobil   = $(data).data().mobil;
            var user    = $(data).data().user;
            var tgl     = $(data).data().tgl;

            clearForm();
            $('#modal_form #form_piket').attr('action', "<?= base_url().'Damkar/updatePiketDamkar'; ?>");

            $('#modal_form #form_piket #id').val(id);
            $('#modal_form #form_piket #mobil').val(mobil).change();
            $('#modal_form #form_piket #user').val(user).change();
            $('#modal_form #form_piket #tgl').val(tgl);

            $('#modal_form').modal({backdrop: 'static', keyboard: false}); 
        }

        function clearData() {
            $('#modal_ba #form_laporan #id').val('');
            $('#modal_ba #form_laporan #lanjutan').val('');
            $('#modal_ba #form_laporan #user').val('').change();
            $('#modal_ba #form_laporan #tgl_lhr').val("{{{date('d-m-Y')}}}");
            $('#modal_ba #form_laporan #mobil').val('');
            $('#modal_ba #tgl_piket').html('');
            $('#modal_ba #data_kejadian #jml_bakar').html('0');
            $('#modal_ba #data_kejadian #jml_bencana').html('0');
            $('#modal_ba #data_kejadian #jml_tawon').html('0');
            $('#modal_ba #data_kejadian #jml_ular').html('0');
            $('#modal_ba #data_kendaraan #kondisi_mobil').html('');
            $('#modal_ba #data_kendaraan #kondisi_alat').html('');

        }

        function hapusData(data) {
            var ids = $(data).data().id;
            swal({
            title: "Hapus Data",
            text: "Apakah data akan dihapus?",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            }, function () {
                setTimeout(function () {

                        $.post("{{{base_url('Damkar/hapusPiketDamkar')}}}", {id: ids}, function(result){
                        // alert(result);
                            if (result == 'Success') {
                                swal("Data berhasil dihapus!");  
                                location.reload();
                            }else{
                                swal("Gagal!");
                            }
                        });
                }, 700);
            });
        }

        function cetakLap(data) {
            var id         = $(data).data().id;
            var tgl        = $(data).data().tgl;
            var tgl2       = $(data).data().tgl2;
            var bakar      = $(data).data().bakar;
            var bencana    = $(data).data().bencana;
            var tawon      = $(data).data().tawon;
            var ular       = $(data).data().ular;
            var konmo      = $(data).data().konmo;
            var konlat     = $(data).data().konlat;
            var lanjutan   = $(data).data().lanjutan;
            var wmk        = $(data).data().wmk;
            var user       = $(data).data().user;
            var mobil      = $(data).data().mobil;

            clearData();

            $('#modal_ba #form_laporan #id').val(id);
            $('#modal_ba #form_laporan #lanjutan').val(lanjutan);
            $('#modal_ba #form_laporan #user').val(user).change();
            $('#modal_ba #form_laporan #tgl_lhr').val(tgl2);
            $('#modal_ba #form_laporan #mobil').val(mobil);
            $('#modal_ba #tgl_piket').html('('+tgl+')');
            $('#modal_ba #data_kejadian #jml_bakar').html(bakar);
            $('#modal_ba #data_kejadian #jml_bencana').html(bencana);
            $('#modal_ba #data_kejadian #jml_tawon').html(tawon);
            $('#modal_ba #data_kejadian #jml_ular').html(ular);
            $('#modal_ba #data_kendaraan #kondisi_mobil').html(konmo);
            $('#modal_ba #data_kendaraan #kondisi_alat').html(konlat);

            // if (lanjutan) {
            //     $('#modal_ba #form_laporan').attr('action', "{{{base_url('Damkar/updateLanjutan');}}}");
            // } else {
            //     $('#modal_ba #form_laporan').attr('action', "{{{base_url('Damkar/simpanLanjutan');}}}");
            // }

            $('#modal_ba').modal({backdrop: 'static', keyboard: false}); 
        }
    </script>

    <script>
        $('#form_laporan').submit(function(e){
            // e.preventDefault();
            setTimeout(function () {
                location.reload()
            }, 300);
            // $('#modal_ba').modal('hide');
        });
    </script>

@endsection




