@layout('layouts/master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>INFORMASI APLIKASI</h2>
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
                                    <?= $this->session->userdata('alert_info'); ?>
                                </div>
                                <div class="col-md-3 col-sm-3 col-lg-3" style="float: right;">
                                    <button onclick="clear_data()" data-toggle="modal" data-target="#modal_add" class="btn bg-light-blue btn-block waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 13px;">widgets</i> TAMBAH INFORMASI</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="data-info">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="10%">Kategori</th>
                                            <th width="15%">Judul</th>
                                            <th width="35%">Konten</th>
                                            <th width="15%">Tanggal</th>
                                            <th width="5%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($informasi as $data) { ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $data->kategori_info ?></td>
                                                <td><?= $data->judul_info ?></td>
                                                <td><?= $data->isi_konten ?></td>
                                                <td><?= date('d-m-Y', strtotime($data->tanggal_info)) ?></td>
                                                
                                                <td>
                                                    <button title="Edit" class="btn btn-sm cbtn-raised bg-green waves-effect" data-toggle="modal" data-target="#modal_edit" onclick="editInfo('<?= $data->id_info ?>','<?= date('d-m-Y', strtotime($data->tanggal_info)) ?>')" style="margin-bottom: 5px;"><i class="material-icons" style="margin-bottom: 10px;">border_color</i></button><br>
                                                    <button title="Hapus" class="btn btn-sm cbtn-raised btn-danger waves-effect" onclick="hapusInfo('<?= $data->id_info ?>')" style="margin-bottom: 5px;"><i class="material-icons" style="margin-bottom: 10px;">delete</i></button>
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

    <!-- Modal Tambah Info -->
    <div class="modal fade" id="modal_add" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-lg-1"></div>
                    <div class="col-sm-10 col-md-10 col-lg-10">
                        <form name="simpanInfo" id="simpanInfo" method="post" action="<?= base_url().'Admin/simpanInfo'; ?>">
                            <!-- <input type="hidden" name="id_info" id="id_info"> -->
                            <div class="modal-header">
                                <center>
                                    <h4 class="modal-title" id="defaultModalLabel">Tambah Informasi</h4>
                                </center>
                            </div>
                            <div class="modal-body" id="print-page">
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Kategori
                                        </div>
                                        <div class="col-md-8">
                                            <div style="margin-top: -17px">
                                            <select class="form-control show-tick" name="kategori_info" id="kategori_info">
                                                <option value="Info">Info</option>
                                                <option value="Update">Update</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Judul 
                                        </div>
                                        <div class="col-md-8">
                                            <div id="judul" class="form-line" style="margin-top: -5px;">
                                                <input required type="text" class="form-control" name="judul_info" id="judul_info" style="margin-bottom: -4px;">
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Konten 
                                        </div>
                                        <div class="col-md-8">
                                            <div id="konten" class="form-line" style="margin-top: -5px;">
                                                <textarea rows="1" class="form-control no-resize auto-growth" name="isi_konten" id="isi_konten" style="margin-bottom: -4px;">&nbsp</textarea>
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Tanggal Rilis
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input type="text" class="form-control" name="tanggal_info" id="tgl_info" style="margin-bottom: -4px;" readonly>
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

    <!-- Modal Edit Info -->
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-lg-1"></div>
                    <div class="col-sm-10 col-md-10 col-lg-10">
                        <form name="simpanInfo" id="simpanInfo" method="post" action="<?= base_url().'Admin/updateInfo'; ?>">
                            <input type="hidden" name="id_info" id="id_info">
                            <div class="modal-header">
                                <center>
                                    <h4 class="modal-title" id="defaultModalLabel">Update Informasi</h4>
                                </center>
                            </div>
                            <div class="modal-body" id="print-page">
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Kategori
                                        </div>
                                        <div class="col-md-8">
                                            <div style="margin-top: -17px">
                                            <select class="form-control show-tick" name="kategori_info" id="kategori_info">
                                                <option id="Info" value="Info">Info</option>
                                                <option id="Update" value="Update">Update</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Judul 
                                        </div>
                                        <div class="col-md-8">
                                            <div id="judul" class="form-line" style="margin-top: -5px;">
                                                <input required type="text" class="form-control" name="judul_info" id="judul_info" style="margin-bottom: -4px;">
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Konten 
                                        </div>
                                        <div class="col-md-8">
                                            <div id="konten" class="form-line" style="margin-top: -5px;">
                                                <textarea rows="1" class="form-control no-resize auto-growth" name="isi_konten" id="isi_konten" style="margin-bottom: -4px;">&nbsp</textarea>
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Tanggal Rilis
                                        </div>
                                        <div class="col-md-8">
                                            <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                                <input type="text" class="form-control" name="tanggal_info" id="tgl_info2" style="margin-bottom: -4px;" readonly>
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
@endsection

@section('footer')
    <!-- Jquery DataTable Plugin Js --> 
    <script src="<?php echo base_url().'assets/assets/bundles/datatablescripts.bundle.js'; ?>"></script>

    <script type="text/javascript">
       $('#tgl_info').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy',
            autoclose: true,
            language: 'id'
        })

        $('#tgl_info2').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy',
            autoclose: true,
            language: 'id'
        })
   </script>

    <!-- Clear - Edit - Hapus User -->
    <script type="text/javascript">
        function clear_data() {
            $('#modal_add #judul_info').val('');
            $('#modal_add #isi_konten').val('');
            $('#modal_add #tgl_info').val('');
        }

        function editInfo(id='', tgl='') {
            $.post("<?= base_url() ?>/Admin/showEditInfo", {id_info: id}, function(result){
                var dt = JSON.parse(result);
                $('#modal_edit #id_info').val(id);
                $('#modal_edit #'+dt.kategori_info).removeAttr('selected');
                $('#modal_edit #'+dt.kategori_info).attr('selected','');
                $('#modal_edit #kategori_info').selectpicker('refresh');
                $('#modal_edit #judul_info').val(dt.judul_info);
                $('#modal_edit #isi_konten').val(dt.isi_konten);
                $('#modal_edit #tgl_info2').val(tgl);
            });
        }

        function hapusInfo(id='') {
            var ids = parseInt(id);
            swal({
            title: "Hapus Data",
            text: "Apakah data informasi akan dihapus?",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            }, function () {
                setTimeout(function () {

                        $.post("<?= base_url() ?>/Admin/hapusInfo", {id_info: id}, function(result){
                        // alert(result);
                            if (result == 'Success') {
                                swal("Data berhasil dihapus!");  
                                window.location.href = "<?= base_url().'Admin/infoApp/' ?>";
                            }else{
                                swal("Gagal!");
                            }
                        });
                }, 700);
            });
        }
    </script>

    <!-- Input Angka -->
    <script type="text/javascript">
        function inputAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
            return true;
        }
    </script>

    <!-- Print Page  -->
    <script type="text/javascript">
        function printLaporan(n){
            // var button = $('#buttonPrintInvoice').hide();
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(n).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            // document.body.innerHTML = restorepage;
            // $('#detailInvoice').modal('hide');
            window.location.href = "<?=base_url().'Admin/historiAduan' ?>";
        }
    </script>
@endsection







