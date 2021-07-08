<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>KONTAK NOMOR HP SKPD</h2>
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
                                <?= $this->session->userdata('alert_nomor'); ?>
                            </div>
                            <div class="col-md-3 col-sm-3 col-lg-3" style="float: right;">
                                <button onclick="clear_data()" data-toggle="modal" data-target="#modal_add" class="btn bg-light-blue btn-block waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 13px;">widgets</i> TAMBAH KONTAK</button>
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
                                        <th width="30%">Nama Kontak</th>
                                        <th width="30%">Nomor HP</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($nomor as $data) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data->nama_no_telp ?></td>
                                            <td><?= $data->no_telp ?></td>
                                            
                                            <td>
                                                <button title="Edit" class="btn btn-sm cbtn-raised bg-green waves-effect" data-toggle="modal" data-target="#modal_edit" onclick="editNomor('<?= $data->id_no_telp ?>','<?= $data->nama_no_telp ?>','<?= $data->no_telp ?>')" style="margin-bottom: 5px;"><i class="material-icons" style="margin-bottom: 10px;">border_color</i></button>
                                                <button title="Hapus" class="btn btn-sm cbtn-raised btn-danger waves-effect" onclick="hapusNomor('<?= $data->id_no_telp ?>')" style="margin-bottom: 5px;"><i class="material-icons" style="margin-bottom: 10px;">delete</i></button>
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
                    <form name="simpanRole" id="simpanRole" method="post" action="<?= base_url().'Damkar/simpanNomor'; ?>">
                        <!-- <input type="hidden" name="id_no_telp" id="id_no_telp"> -->
                        <div class="modal-header">
                            <center>
                                <h4 class="modal-title" id="defaultModalLabel">Tambah Nomor Telepon</h4>
                            </center>
                        </div>
                        <div class="modal-body" id="print-page">
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Nama Kotak
                                    </div>
                                    <div class="col-md-8">
                                        <div id="judul" class="form-line" style="margin-top: -5px;">
                                            <input required type="text" class="form-control" name="kontak" id="kontak" style="margin-bottom: -4px;">
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
                                        <div id="judul" class="form-line" style="margin-top: -5px;">
                                            <input required type="text" onkeypress="return inputAngka(event);" maxlength="13" class="form-control" name="nomor" id="nomor" style="margin-bottom: -4px;">
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
                    <form name="simpanRole" id="simpanRole" method="post" action="<?= base_url().'Damkar/updateNomor'; ?>">
                        <input type="hidden" name="id_no_telp" id="id_no_telp">
                        <div class="modal-header">
                            <center>
                                <h4 class="modal-title" id="defaultModalLabel">Update Nomor Telepon</h4>
                            </center>
                        </div>
                        <div class="modal-body" id="print-page">
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Nama Kotak
                                    </div>
                                    <div class="col-md-8">
                                        <div id="judul" class="form-line" style="margin-top: -5px;">
                                            <input required type="text" class="form-control" name="kontak" id="kontak" style="margin-bottom: -4px;">
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
                                        <div id="judul" class="form-line" style="margin-top: -5px;">
                                            <input required type="text" onkeypress="return inputAngka(event);" maxlength="13" class="form-control" name="nomor" id="nomor" style="margin-bottom: -4px;">
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
        $('#modal_add #nomor').val('');
        $('#modal_add #kontak').val('');
    }

    function editNomor(id='', kontak='', nomor='') {
        // $.post("<?//= base_url() ?>/Damkar/showEditInfo", {id_no_telp: id}, function(result){
        //     var dt = JSON.parse(result);
            $('#modal_edit #id_no_telp').val(id);
            $('#modal_edit #nomor').val(nomor);
            $('#modal_edit #kontak').val(kontak);
        // });
    }

    function hapusNomor(id='') {
        var ids = parseInt(id);
        swal({
          title: "Hapus Data",
          text: "Apakah data nomor telepon akan dihapus?",
          type: "info",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
        }, function () {
            setTimeout(function () {

                    $.post("<?= base_url() ?>/Damkar/hapusNomor", {id_no_telp: id}, function(result){
                      // alert(result);
                        if (result == 'Success') {
                            swal("Data berhasil dihapus!");  
                            window.location.href = "<?= base_url().'Damkar/nomorTelp/' ?>";
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





