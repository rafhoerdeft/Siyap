<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Regu Damkar</h2>
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
                                <button onclick="addModal()" class="btn bg-light-blue btn-block btn-raised waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 13px;">widgets</i> TAMBAH REGU</button>
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
                                        <th width="20%" style="text-align: center;">Aksi</th>
                                        <th width="30%" style="text-align: center;">WMK</th>
                                        <th width="25%" style="text-align: center;">Nama Regu</th>
                                        <th width="20%" style="text-align: center;">Jml Anggota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($regu as $data) { ?>
                                        <tr>
                                            <td align="center"><?= $no++; ?></td>
                                            <td nowrap align="center">
                                                <a title="Tambah Item" href="<?= base_url('Damkar/anggotaRegu/'.encode($data->id_regu)) ?>" class="btn btn-sm btn-raised bg-orange waves-effect" style="margin-bottom: 5px; width: 5px;">
                                                    <i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">add</i>
                                                </a>

                                                <button title="Edit" class="btn btn-sm btn-raised bg-green waves-effect" onclick="editModal('<?= $data->id_regu ?>','<?= $data->id_wmk ?>','<?= $data->nama_regu ?>')" style="margin-bottom: 5px; width: 5px;">
                                                    <i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">border_color</i>
                                                </button>

                                                <button title="Hapus" class="btn btn-sm btn-raised btn-danger waves-effect" onclick="hapusData('<?= $data->id_regu ?>')" style="margin-bottom: 5px; width: 5px;"><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">delete</i></button>
                                            </td>
                                            <td nowrap><?= $data->nama_wmk ?></td>
                                            <td><?= $data->nama_regu ?></td>
                                            <td align="center"><?= $data->jml_anggota ?></td>
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
                    <form name="form_input" id="form_input" method="post" action="<?= base_url().'Damkar/simpanReguDamkar'; ?>">
                        <input type="hidden" name="id_regu" id="id_regu">
                        <div class="modal-header">
                            <center>
                                <h4 class="modal-title" id="modal_title">Tambah Regu</h4>
                            </center>
                        </div>
                        <div class="modal-body" id="print-page">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        WMK
                                    </div>
                                    <div class="col-md-8">
                                        <div style="margin-top: -17px">
                                           <select class="form-control show-tick" name="wmk" id="wmk" required>
                                                <?php foreach ($wmk as $key) { ?>
                                                   <option value="<?= $key->id_wmk ?>"><?= $key->nama_wmk ?></option>
                                               <?php } ?>
                                           </select>
                                        </div>
                                    </div>
                                </div>                        
                            </div>
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Nama Regu
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <input required type="text" class="form-control"  name="nama" id="nama" style="margin-bottom: -4px;">
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
        $('#modal_form #id_regu').val('');
        $('#modal_form #wmk').val('1').change();
        $('#modal_form #nama').val('');
    }

    function addModal() {
        clear_data();
        $('#modal_form #modal_title').html('Tambah Regu');
        $('#modal_form #form_input').attr('action', "<?= base_url().'Damkar/simpanReguDamkar'; ?>");
        $('#modal_form').modal({backdrop: 'static', keyboard: false}); 
    }

    function editModal(id='', wmk='', nama='', nomor='') {
        clear_data();
        $('#modal_form #modal_title').html('Update Regu');
        $('#modal_form #form_input').attr('action', "<?= base_url().'Damkar/updateReguDamkar'; ?>");

        $('#modal_form #id_regu').val(id);
        $('#modal_form #wmk').val(wmk).change();
        $('#modal_form #wmk').selectpicker('refresh');
        $('#modal_form #nama').val(nama);
        // $('#modal_form #'+kategori).attr('selected','');
        // $('#modal_form #kategori').selectpicker('refresh');
        $('#modal_form #nomor').val(nomor);
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

                    $.post("<?= base_url() ?>/Damkar/hapusReguDamkar", {id_regu: id}, function(result){
                      // alert(result);
                        if (result == 'Success') {
                            swal("Data berhasil dihapus!");  
                            window.location.href = "<?= base_url().'Damkar/reguDamkar' ?>";
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
        window.location.href = "<?=base_url().'Damkar/historiAduan' ?>";
    }
</script>





