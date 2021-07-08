@layout('layouts/master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Item Damkar</h2>
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
                                    <?= $this->session->flashdata('alert'); ?>
                                </div>
                                <div class="col-md-3 col-sm-3 col-lg-3" style="float: right;">
                                    <button onclick="addModal()" class="btn bg-light-blue btn-block btn-raised waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 13px;">widgets</i> TAMBAH ITEM</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="data-info">
                                    <thead>
                                        <tr>
                                            <th width="5%" style="text-align: center;">#</th>
                                            <th width="15%" style="text-align: center;">Aksi</th>
                                            <th width="40%" style="text-align: center;">Nama Item</th>
                                            <th width="40%" style="text-align: center;">Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($alat as $data) { ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td align="center" nowrap>
                                                    <button title="Edit" class="btn btn-sm btn-raised bg-green waves-effect" 
                                                    data-id="<?= $data->id_item ?>" 
                                                    data-nama="<?= $data->nama_item ?>"
                                                    data-satuan="<?= $data->satuan_item ?>" 
                                                    onclick="editModal(this)" style="margin-bottom: 5px; width: 5px;">
                                                        <i class="material-icons"  style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">border_color</i>
                                                    </button>

                                                    <button title="Hapus" class="btn btn-sm btn-raised btn-danger waves-effect" onclick="hapusData('<?= $data->id_item ?>')" style="margin-bottom: 5px; width: 5px;"><i class="material-icons"  style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">delete</i></button>
                                                </td>
                                                <td><?= $data->nama_item ?></td>
                                                <td><?= $data->satuan_item ?></td>
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
    <div class="modal fade" id="modal_form" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-lg-1"></div>
                    <div class="col-sm-10 col-md-10 col-lg-10">
                        <form name="form_input" id="form_input" method="post" action="">
                            <input type="hidden" name="id_item" id="id_item">
                            <div class="modal-header">
                                <center>
                                    <h4 class="modal-title" id="modal_title">Tambah Item</h4>
                                </center>
                            </div>
                            <div class="modal-body" id="print-page">
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Nama Item
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
                                            Satuan 
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input required type="text" class="form-control" name="satuan" id="satuan" style="margin-bottom: -4px;">
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

        function clear_data() {
            $('#modal_form #id_item').val('');
            $('#modal_form #nama').val('');
            $('#modal_form #satuan').val('');
        }

        function addModal() {
            clear_data();
            $('#modal_form #modal_title').html('Tambah Item');
            $('#modal_form #form_input').attr('action', "<?= base_url().'Damkar/simpanAlatDamkar'; ?>");
            $('#modal_form').modal({backdrop: 'static', keyboard: false});  
        }

        function editModal(data) {
            clear_data();
            var id = $(data).data().id;
            var nama = $(data).data().nama;
            var satuan = $(data).data().satuan;
            $('#modal_form #modal_title').html('Edit Item');
            $('#modal_form #form_input').attr('action', "<?= base_url().'Damkar/updateAlatDamkar'; ?>");
            $('#modal_form #id_item').val(id);
            $('#modal_form #nama').val(nama);
            $('#modal_form #satuan').val(satuan);
            $('#modal_form').modal({backdrop: 'static', keyboard: false});  
        }

        function hapusData(id='') {
            var ids = parseInt(id);
            swal({
            title: "Hapus Data",
            text: "Apakah data akan dihapus?",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            }, function () {
                setTimeout(function () {

                        $.post("<?= base_url() ?>/Damkar/hapusAlatDamkar", {id_item: id}, function(result){
                        // alert(result);
                            if (result == 'Success') {
                                swal("Data berhasil dihapus!");  
                                window.location.href = "<?= base_url().'Damkar/alatDamkar' ?>";
                            }else{
                                swal("Gagal!");
                            }
                        });
                }, 700);
            });
        }
    </script>

@endsection

