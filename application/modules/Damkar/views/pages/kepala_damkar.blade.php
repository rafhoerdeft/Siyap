@layout('layouts/master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Kepala Damkar</h2>
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
                                    <?= $this->session->flashdata('show_alert'); ?>
                                </div>
                                <!-- <div class="col-md-3 col-sm-3 col-lg-3" style="float: right;">
                                    <button onclick="addModal()" class="btn bg-light-blue btn-block waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 13px;">widgets</i> TAMBAH USER</button>
                                </div> -->
                            </div>
                        </div>
                        <hr>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="data-info" style="font-size: 9pt">
                                    <thead>
                                        <tr>
                                            <th width="5%" style="text-align: center">#</th>
                                            <th style="text-align: center">Aksi</th>
                                            <th style="text-align: center">Nama</th>
                                            <th style="text-align: center">Jabatan</th>
                                            <th style="text-align: center">Pangkat</th>
                                            <th style="text-align: center">NIP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($kepala as $data) { ?>
                                            <tr>
                                                <td align="center"><?= $no++; ?></td>
                                                <td align="center" nowrap>
                                                    <button title="Edit" class="btn btn-sm btn-sm cbtn-raised bg-green waves-effect" 
                                                    data-id="<?= $data->id_kepala ?>"
                                                    data-nama="<?= $data->nama_kepala ?>"
                                                    data-jabatan="<?= $data->jabatan_kepala ?>"
                                                    data-pangkat="<?= $data->pangkat_kepala ?>"
                                                    data-nip="<?= $data->nip_kepala ?>"
                                                    onclick="dataEdit(this)" style="margin-bottom: 5px; width: 5px;"><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">border_color</i></button>
                                                    {{-- <button title="Hapus" class="btn btn-sm btn-sm cbtn-raised btn-danger waves-effect" onclick="hapusData()" style="margin-bottom: 5px; width: 5px;"><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">delete</i></button> --}}
                                                </td>
                                                <td><?= $data->nama_kepala ?></td>
                                                <td><?= $data->jabatan_kepala ?></td>
                                                <td align="center"><?= $data->pangkat_kepala ?></td>
                                                <td align="center"><?= $data->nip_kepala ?></td>
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
                        <form name="simpanRole" id="simpanRole" method="post" action="<?= base_url().'Damkar/simpanKepalaDamkar'; ?>">
                            <!-- <input type="hidden" name="id_kepala" id="id_kepala"> -->
                            <div class="modal-header">
                                <center>
                                    <h4 class="modal-title" id="defaultModalLabel">Tambah WMK</h4>
                                </center>
                            </div>
                            <div class="modal-body" id="print-page">
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Nama Kepala
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
                                            Jabatan
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input required type="text" class="form-control" name="jabatan" id="jabatan" style="margin-bottom: -4px;">
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Pangkat
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input required type="text" class="form-control" name="pangkat" id="pangkat" style="margin-bottom: -4px;">
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            NIP 
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input required type="text" class="form-control" name="nip" id="nip" style="margin-bottom: -4px;">
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
                        <form name="simpanRole" id="simpanRole" method="post" action="<?= base_url().'Damkar/updateKepalaDamkar'; ?>">
                            <input type="hidden" name="id_kepala" id="id_kepala">
                            <div class="modal-header">
                                <center>
                                    <h4 class="modal-title" id="defaultModalLabel">Update WMK</h4>
                                </center>
                            </div>
                            <div class="modal-body" id="print-page">
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Nama Kepala
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
                                            Jabatan
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input required type="text" class="form-control" name="jabatan" id="jabatan" style="margin-bottom: -4px;">
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Pangkat
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input required type="text" class="form-control" name="pangkat" id="pangkat" style="margin-bottom: -4px;">
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            NIP 
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input required type="text" class="form-control" name="nip" id="nip" maxlength="21" style="margin-bottom: -4px;">
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
            $('#modal_add #nama').val('');
            $('#modal_add #jabatan').val('');
            $('#modal_add #pangkat').val('');
            $('#modal_add #nip').val('');

            $('#modal_add').modal({backdrop: 'static', keyboard: false}); 
        }

        function dataEdit(data) {
            var id      = $(data).data().id;
            var nama    = $(data).data().nama;
            var jabatan = $(data).data().jabatan;
            var pangkat = $(data).data().pangkat;
            var nip     = $(data).data().nip;

            $('#modal_edit #id_kepala').val(id);
            $('#modal_edit #nama').val(nama);
            $('#modal_edit #jabatan').val(jabatan);
            $('#modal_edit #pangkat').val(pangkat);
            $('#modal_edit #nip').val(nip);

            $('#modal_edit').modal({backdrop: 'static', keyboard: false}); 
        }

        function hapusData(id='') {
            var ids = parseInt(id);
            swal({
            title: "Hapus Data",
            text: "Apakah data kepala damkar akan dihapus?",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            }, function () {
                setTimeout(function () {

                        $.post("<?= base_url() ?>/Damkar/hapusKepalaDamkar", {id_kepala: id}, function(result){
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




