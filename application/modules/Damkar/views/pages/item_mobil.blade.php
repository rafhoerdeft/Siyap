@layout('layouts/master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Item Mobil (<?= $mobil->nama_mobil ?>)</h2>
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
                                <div class="col-md-7 col-sm-7 col-lg-7" style="margin-bottom: -35px;">
                                    <?= $this->session->flashdata('alert'); ?>
                                </div>
                                <div class="col-md-2 col-sm-2 col-lg-2">
                                    <a href="<?= base_url('Damkar/mobilDamkar') ?>" class="btn bg-red btn-block btn-raised waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 10px;">arrow_back</i> KEMBALI</a>
                                </div>
                                <div class="col-md-3 col-sm-3 col-lg-3" style="float: right;">
                                    <button onclick="addModal()" class="btn bg-light-blue btn-block btn-raised waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 13px;">widgets</i> TAMBAH ITEM MOBIL</button>
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
                                            <th width="20%" style="text-align: center;">Nama Item</th>
                                            <th width="20%" style="text-align: center;">Satuan</th>
                                            <th width="20%" style="text-align: center;">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($item_mobil as $data) { ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td nowrap>
                                                    <button title="Edit" class="btn btn-raised bg-green waves-effect" 
                                                    data-id="<?= $data->id_mobil_item ?>"
                                                    data-item="<?= $data->id_item ?>"
                                                    data-jml="<?= $data->jml_item ?>"
                                                    onclick="editModal(this)" style="margin-bottom: 5px;">
                                                        <i class="material-icons" style="margin-bottom: 10px;">border_color</i>
                                                    </button>

                                                    <button title="Hapus" class="btn btn-raised btn-danger waves-effect" onclick="hapusData('<?= $data->id_mobil_item ?>')" style="margin-bottom: 5px;"><i class="material-icons" style="margin-bottom: 10px;">delete</i></button>
                                                </td>
                                                <td><?= $data->nama_item ?></td>
                                                <td><?= $data->satuan_item ?></td>
                                                <td><?= $data->jml_item ?></td>
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
                            <input type="hidden" name="id_mobil_item" id="id_mobil_item">
                            <div class="modal-header">
                                <center>
                                    <h4 class="modal-title" id="modal_title">Tambah Item</h4>
                                </center>
                            </div>
                            <div class="modal-body" id="print-page">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Item Damkar
                                        </div>
                                        <div class="col-md-8">
                                            <div style="margin-top: -17px">
                                            <select class="form-control show-tick" name="item" id="item" required>
                                                    <?php foreach ($item as $key) { ?>
                                                    <option value="<?= $key->id_item ?>"><?= $key->nama_item.' ('.$key->satuan_item.')' ?> <label style="float: right; color:green"><?= ($key->sedia!=0?'✔':'') ?></label> </option>
                                                <?php } ?>
                                            </select>
                                            </div>
                                        </div>
                                    </div>                        
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Jumlah
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-line" style="margin-top: -5px;">
                                                <input required type="text" class="form-control" name="jml" id="jml" onkeypress="return inputAngka(event);" maxlength="4" style="margin-bottom: -4px;">
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
            $('#modal_form #id_mobil_item').val('');
            $('#modal_form #item').val(1).change();
            $('#modal_form #jml').val('');
        }

        function addModal() {
            clear_data();
            $('#modal_form #modal_title').html('Tambah Item');
            $('#modal_form #form_input').attr('action', "<?= base_url().'Damkar/simpanItemMobil/'.encode($id_mobil); ?>");
            $('#modal_form').modal({backdrop: 'static', keyboard: false});  
        }

        function editModal(data) {
            clear_data();

            var id = $(data).data().id;
            var item = $(data).data().item;
            var jml = $(data).data().jml;

            $('#modal_form #modal_title').html('Edit Item');
            $('#modal_form #form_input').attr('action', "<?= base_url().'Damkar/updateItemMobil/'.encode($id_mobil); ?>");
            $('#modal_form #id_mobil_item').val(id);
            $('#modal_form #item').val(item).change();
            $('#modal_form #jml').val(jml);
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

                        $.post("<?= base_url() ?>/Damkar/hapusItemMobil", {id_mobil_item: id}, function(result){
                        // alert(result);
                            if (result == 'Success') {
                                swal("Data berhasil dihapus!");  
                                window.location.href = "<?= base_url().'Damkar/itemMobil/'.encode($id_mobil) ?>";
                            }else{
                                swal("Gagal!");
                            }
                        });
                }, 700);
            });
        }
    </script>

@endsection


