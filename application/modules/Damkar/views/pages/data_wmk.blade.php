@layout('layouts/master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Wilayah Manajemen Kebakaran</h2>
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
                                    <?= $this->session->flashdata('alert_wmk'); ?>
                                </div>
                                <div class="col-md-3 col-sm-3 col-lg-3" style="float: right;">
                                    <button onclick="addModal()" class="btn bg-light-blue btn-block waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 13px;">widgets</i> TAMBAH WMK</button>
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
                                            <th width="20%" style="text-align: center">WMK</th>
                                            <th width="20%" style="text-align: center">Nomor Telp</th>
                                            <th width="35%" style="text-align: center">Alamat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($wmk as $data) { ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td align="center">
                                                    <button title="Edit" class="btn btn-sm btn-sm cbtn-raised bg-green waves-effect" 
                                                    data-id="<?= $data->id_wmk ?>"
                                                    data-nama="<?= $data->nama_wmk ?>"
                                                    data-nomor="<?= $data->nomor_wmk ?>"
                                                    data-alamat="<?= $data->alamat_wmk ?>"
                                                    onclick="editWmk(this)" style="margin-bottom: 5px; width: 5px;"><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">border_color</i></button>
                                                    <button title="Hapus" class="btn btn-sm btn-sm cbtn-raised btn-danger waves-effect" onclick="hapusNomor('<?= $data->id_wmk ?>')" style="margin-bottom: 5px; width: 5px;"><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">delete</i></button>
                                                </td>
                                                <td><?= $data->nama_wmk ?></td>
                                                <td align="center"><?= $data->nomor_wmk ?></td>
                                                <td><?= $data->alamat_wmk ?></td>
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
                        <form name="simpanRole" id="simpanRole" method="post" action="<?= base_url().'Damkar/simpanWmk'; ?>">
                            <!-- <input type="hidden" name="id_wmk" id="id_wmk"> -->
                            <div class="modal-header">
                                <center>
                                    <h4 class="modal-title" id="defaultModalLabel">Tambah WMK</h4>
                                </center>
                            </div>
                            <div class="modal-body" id="print-page">
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Nama WMK
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input required type="text" class="form-control"  name="nama" id="nama" style="margin-bottom: -4px;">
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Nomor Telepon
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input required type="text" onkeypress="return inputAngka(event);" maxlength="13" class="form-control" name="nomor" id="nomor" style="margin-bottom: -4px;">
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Alamat 
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <textarea rows="1" class="form-control no-resize auto-growth" name="alamat" id="alamat" style="margin-bottom: -4px;">&nbsp</textarea>
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
                        <form name="simpanRole" id="simpanRole" method="post" action="<?= base_url().'Damkar/UpdateWmk'; ?>">
                            <input type="hidden" name="id_wmk" id="id_wmk">
                            <div class="modal-header">
                                <center>
                                    <h4 class="modal-title" id="defaultModalLabel">Update WMK</h4>
                                </center>
                            </div>
                            <div class="modal-body" id="print-page">
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Nama WMK
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input required type="text" class="form-control"  name="nama" id="nama" style="margin-bottom: -4px;">
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Nomor Telepon
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input required type="text" class="form-control" onkeypress="return inputAngka(event);" maxlength="13" name="nomor" id="nomor" style="margin-bottom: -4px;">
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Alamat 
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <textarea rows="1" class="form-control no-resize auto-growth" name="alamat" id="alamat" style="margin-bottom: -4px;">&nbsp</textarea>
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

    <!-- Clear - Edit - Hapus User -->
    <script type="text/javascript">
        function addModal() {
            $('#modal_add #nomor').val('');
            $('#modal_add #alamat').val('');

            $('#modal_add').modal({backdrop: 'static', keyboard: false}); 
        }

        function editWmk(data) {
            var id = $(data).data().id;
            var nama = $(data).data().nama;
            var nomor = $(data).data().nomor;
            var alamat = $(data).data().alamat;

            $('#modal_edit #id_wmk').val(id);
            $('#modal_edit #nama').val(nama);
            // $('#modal_edit #'+kategori).attr('selected','');
            // $('#modal_edit #kategori').selectpicker('refresh');
            $('#modal_edit #nomor').val(nomor);
            $('#modal_edit #alamat').val(alamat);

            $('#modal_edit').modal({backdrop: 'static', keyboard: false}); 
        }

        function hapusNomor(id='') {
            var ids = parseInt(id);
            swal({
            title: "Hapus Data",
            text: "Apakah data nomor darurat akan dihapus?",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            }, function () {
                setTimeout(function () {

                        $.post("<?= base_url() ?>/Damkar/hapusWmk", {id_wmk: id}, function(result){
                        // alert(result);
                            if (result == 'Success') {
                                swal("Data berhasil dihapus!");  
                                window.location.href = "<?= base_url().'Damkar/dataWmk/' ?>";
                            }else{
                                swal("Gagal!");
                            }
                        });
                }, 700);
            });
        }
    </script>

@endsection




