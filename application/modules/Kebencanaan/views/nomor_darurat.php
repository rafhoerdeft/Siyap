<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>NOMOR DARURAT</h2>
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
                                <?= $this->session->userdata('alert_nom_dar'); ?>
                            </div>
                            <div class="col-md-3 col-sm-3 col-lg-3" style="float: right;">
                                <button onclick="clear_data()" data-toggle="modal" data-target="#modal_add" class="btn bg-light-blue btn-block waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 13px;">widgets</i> TAMBAH NOMOR</button>
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
                                        <th width="20%">Kategori</th>
                                        <th width="20%">Nomor Darurat</th>
                                        <th width="35%">Alamat</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($nomor as $data) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data->nama_kategori ?></td>
                                            <td><?= $data->nomor ?></td>
                                            <td><?= $data->alamat ?></td>
                                            
                                            <td>
                                                <button title="Edit" class="btn btn-sm cbtn-raised bg-green waves-effect" data-toggle="modal" data-target="#modal_edit" onclick="editNomor('<?= $data->id_nomor_darurat ?>','<?= $data->id_kategori ?>','<?= $data->nomor ?>','<?= $data->alamat ?>')" style="margin-bottom: 5px;"><i class="material-icons" style="margin-bottom: 10px;">border_color</i></button>
                                                <button title="Hapus" class="btn btn-sm cbtn-raised btn-danger waves-effect" onclick="hapusNomor('<?= $data->id_nomor_darurat ?>')" style="margin-bottom: 5px;"><i class="material-icons" style="margin-bottom: 10px;">delete</i></button>
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
                    <form name="simpanRole" id="simpanRole" method="post" action="<?= base_url().'Kebencanaan/simpanNomorDarurat'; ?>">
                        <!-- <input type="hidden" name="id_nomor_darurat" id="id_nomor_darurat"> -->
                        <div class="modal-header">
                            <center>
                                <h4 class="modal-title" id="defaultModalLabel">Tambah Nomor Darurat</h4>
                            </center>
                        </div>
                        <div class="modal-body" id="print-page">
                            
                            <!-- <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Kategori
                                    </div>
                                    <div class="col-md-8">
                                        <div style="margin-top: -17px">
                                           <select class="form-control show-tick" name="kategori" id="kategori">
                                                <?php //foreach ($kategori as $key) { ?>
                                                   <option value="<?//= $key->id_kategori ?>"><?//= $key->nama_kategori ?></option>
                                               <?php //} ?>
                                           </select>
                                        </div>
                                    </div>
                                </div>                        
                            </div> -->

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

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Alamat 
                                    </div>
                                    <div class="col-md-8">
                                        <div id="konten" class="form-line" style="margin-top: -5px;">
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
                    <form name="simpanRole" id="simpanRole" method="post" action="<?= base_url().'Kebencanaan/UpdateNomorDarurat'; ?>">
                        <input type="hidden" name="id_nomor_darurat" id="id_nomor_darurat">
                        <div class="modal-header">
                            <center>
                                <h4 class="modal-title" id="defaultModalLabel">Update Nomor Darurat</h4>
                            </center>
                        </div>
                        <div class="modal-body" id="print-page">
                            
                            <!-- <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Kategori
                                    </div>
                                    <div class="col-md-8">
                                        <div style="margin-top: -17px">
                                           <select class="form-control show-tick" name="kategori" id="kategori">
                                                <?php //foreach ($kategori as $key) { ?>
                                                   <option class="kategori" id="<?//= $key->id_kategori ?>" value="<?//= $key->id_kategori ?>"><?//= $key->nama_kategori ?></option>
                                               <?php //} ?>
                                           </select>
                                        </div>
                                    </div>
                                </div>                        
                            </div> -->

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Nomor Telepon
                                    </div>
                                    <div class="col-md-8">
                                        <div id="judul" class="form-line" style="margin-top: -5px;">
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
                                        <div id="konten" class="form-line" style="margin-top: -5px;">
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

<!-- Clear - Edit - Hapus User -->
<script type="text/javascript">
    function clear_data() {
        $('#modal_add #nomor').val('');
        $('#modal_add #alamat').val('');
    }

    function editNomor(id='', kategori='', nomor='', alamat='') {
        // $.post("<?//= base_url() ?>/Kebencanaan/showEditInfo", {id_nomor_darurat: id}, function(result){
        //     var dt = JSON.parse(result);
            $('#modal_edit #id_nomor_darurat').val(id);
            $('#modal_edit .kategori').removeAttr('selected');
            // $('#modal_edit #'+kategori).attr('selected','');
            // $('#modal_edit #kategori').selectpicker('refresh');
            $('#modal_edit #nomor').val(nomor);
            $('#modal_edit #alamat').val(alamat);
        // });
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

                    $.post("<?= base_url() ?>/Kebencanaan/hapusNomorDarurat", {id_nomor_darurat: id}, function(result){
                      // alert(result);
                        if (result == 'Success') {
                            swal("Data berhasil dihapus!");  
                            window.location.href = "<?= base_url().'Kebencanaan/nomorDarurat/' ?>";
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
        window.location.href = "<?=base_url().'Kebencanaan/historiAduan' ?>";
    }
</script>





