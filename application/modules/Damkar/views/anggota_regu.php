<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2><?= $regu->nama_wmk ?> (Regu <?= $regu->nama_regu ?>)</h2>
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
                                <a href="<?= base_url('Damkar/reguDamkar') ?>" class="btn bg-red btn-block btn-raised waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 10px;">arrow_back</i> KEMBALI</a>
                            </div>
                            <div class="col-md-3 col-sm-3 col-lg-3" style="float: right;">
                                <button onclick="addModal()" class="btn bg-light-blue btn-block btn-raised waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 13px;">widgets</i> TAMBAH ANGGOTA</button>
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
                                        <th width="10%">Aksi</th>
                                        <th width="15%">Nama</th>
                                        <th width="25%">Alamat</th>
                                        <th width="15%">Jenis Kelamin</th>
                                        <th width="15%">No. HP</th>
                                        <th width="15%">Jabatan</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 9pt;">
                                    <?php $no=1; foreach ($anggota as $data) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td nowrap align="center">
                                                <button title="Edit" class="btn btn-sm btn-raised bg-green waves-effect"
                                                data-id="<?= $data->id_user ?>"
                                                data-jabatan="<?= $data->jabatan ?>"
                                                onclick="editModal(this)" style="margin-bottom: 5px; width: 5px;">
                                                    <i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">border_color</i>
                                                </button>

                                                <button title="Hapus" class="btn btn-sm btn-raised btn-danger waves-effect" data-id="<?= encode($data->id_user) ?>" onclick="hapusData(this)" style="margin-bottom: 5px; width: 5px;"><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">delete</i></button>
                                            </td>
                                            <td><?= $data->nama ?></td>
                                            <td><?= $data->alamat ?></td>
                                            <td><?= $data->jenis_kelamin ?></td>
                                            <td><?= $data->no_hp ?></td>
                                            <td><?= $data->jabatan ?></td>
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
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="col-md-1 col-sm-1 col-lg-1"></div>
                <div class="col-sm-10 col-md-10 col-lg-10">
                    <form name="form_input" id="form_input" method="post" action="">
                        <!-- <input type="hidden" name="id_user" id="id_user"> -->
                        <div class="modal-header">
                            <center>
                                <h4 class="modal-title" id="modal_title">Tambah Anggota</h4>
                            </center>
                        </div>
                        <div class="modal-body" id="print-page">

                            <div class="form-group" id="select_user">
                                <div class="row">
                                    <div class="col-md-4">
                                        Nama Petugas
                                    </div>
                                    <div class="col-md-8">
                                        <div style="width: 100%">
                                           <select class="form-control select2" name="user" id="user" style="width: 100%" required>
                                            <option value="" selected>Pilih user petugas</option>
                                                <?php foreach ($user as $key) { ?>
                                                   <option value="<?= $key->id_user ?>"><?= strtoupper($key->nama) ?> <?= $key->id_regu!=null?"(". $key->wmk ." - Regu ". $key->regu .")":'' ?> <label style="float: right; color:green"><?= ($key->id_regu!=null?'✔':'') ?></label></option>
                                               <?php } ?>
                                           </select>
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

<!-- Clear - Edit - Hapus User -->
<script type="text/javascript">

    function clear_data() {
        // $('#modal_form #id_user').val('');
        $('#modal_form #user').val('').change();
        $('#modal_form #jabatan').val('');
    }

    function addModal() {
        clear_data();
        $('#select_user').show();
        $('#modal_form #modal_title').html('Tambah Anggota');
        $('#modal_form #form_input').attr('action', "<?= base_url().'Damkar/simpanAnggotaRegu/'.encode($id_regu); ?>");
        $('#modal_form').modal({backdrop: 'static', keyboard: false});  
    }

    function editModal(data) {
        clear_data();
        var id = $(data).data().id;
        var jabatan = $(data).data().jabatan;
        $('#select_user').hide();
        $('#modal_form #modal_title').html('Edit Anggota');
        $('#modal_form #form_input').attr('action', "<?= base_url().'Damkar/updateAnggotaRegu/'.encode($id_regu); ?>");
        $('#modal_form #user').val(id).change();
        $('#modal_form #jabatan').val(jabatan);
        $('#modal_form').modal({backdrop: 'static', keyboard: false});  
    }

    function hapusData(data) {
        var id = $(data).data().id;
        swal({
          title: "Hapus Data",
          text: "Apakah data akan dihapus?",
          type: "info",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
        }, function () {
            setTimeout(function () {

                    $.post("<?= base_url() ?>/Damkar/hapusAnggotaRegu", {id_user: id}, function(result){
                      // alert(result);
                        if (result == 'Success') {
                            swal("Data berhasil dihapus!");  
                            location.reload();
                        }else{
                            swal("Gagal!");
                            // location.reload();
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
        window.location.href = "<?=base_url().'Damkar/historiAduan' ?>";
    }
</script>





