<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>PESAN</h2>
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
                                <?= $this->session->userdata('alert_pesan'); ?>
                            </div>
                            <div class="col-md-3 col-sm-3 col-lg-3" style="float: right;">
                                <button onclick="clear_data()" data-toggle="modal" data-target="#modal_add" class="btn bg-light-blue btn-block waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 10px;">send</i> KIRIM PESAN</button>
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
                                        <th width="20%">Tujuan</th>
                                        <th width="15%">Waktu Pesan</th>
                                        <th width="35%">Pesan</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($pesan as $data) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data->nama_no_telp ?></td>
                                            <td><?= date('d-m-Y (H:i)', strtotime($data->tgl_pesan)) ?></td>
                                            <td><?= $data->pesan ?></td>
                                            
                                            <td>
                                                <button title="Edit" class="btn btn-sm cbtn-raised bg-green waves-effect" data-toggle="modal" data-target="#modal_edit" onclick="editPesan('<?= $data->id_pesan ?>','<?= $data->id_no_telp ?>')" style="margin-bottom: 5px;"><i class="material-icons" style="margin-bottom: 10px;">border_color</i></button>
                                                <button title="Hapus" class="btn btn-sm cbtn-raised btn-danger waves-effect" onclick="hapusPesan('<?= $data->id_pesan ?>')" style="margin-bottom: 5px;"><i class="material-icons" style="margin-bottom: 10px;">delete</i></button>
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

<!-- Modal Kirim Pesan -->
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="col-md-1 col-sm-1 col-lg-1"></div>
                <div class="col-sm-10 col-md-10 col-lg-10">
                    <form name="simpanRole" id="simpanRole" method="post" action="<?= base_url().'Kebencanaan/kirimPesan'; ?>">
                        <!-- <input type="hidden" name="id_pesan" id="id_pesan"> -->
                        <div class="modal-header">
                            <center>
                                <h4 class="modal-title" id="defaultModalLabel">Kirim Pesan</h4>
                            </center>
                        </div>
                        <div class="modal-body" id="print-page">
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Pilih Nomor Tujuan
                                    </div>
                                    <div class="col-md-8">
                                        <div style="margin-top: -17px">
                                           <select class="form-control show-tick" name="nomor" id="nomor">
                                                <?php foreach ($nomor as $key) { ?>
                                                   <option value="<?= $key->id_no_telp ?>"><?= $key->nama_no_telp ?></option>
                                               <?php } ?>
                                           </select>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Teks Pesan 
                                    </div>
                                    <div class="col-md-8">
                                        <div id="content_pesan" class="form-line" style="margin-top: -5px;">
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="pesan" id="pesan" style="margin-bottom: -4px;">&nbsp</textarea>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btn_simpan" class="btn btn-primary waves-effect">KIRIM</button>
                            <button type="reset" id="btn_reset" class="btn btn-warning waves-effect">RESET</button>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">KELUAR</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Modal Edit Pesan -->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="col-md-1 col-sm-1 col-lg-1"></div>
                <div class="col-sm-10 col-md-10 col-lg-10">
                    <form name="simpanRole" id="simpanRole" method="post" action="<?= base_url().'Kebencanaan/updatePesan'; ?>">
                        <input type="hidden" name="id_pesan" id="id_pesan">
                        <div class="modal-header">
                            <center>
                                <h4 class="modal-title" id="defaultModalLabel">Kirim Pesan</h4>
                            </center>
                        </div>
                        <div class="modal-body" id="print-page">
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Pilih Nomor Tujuan
                                    </div>
                                    <div class="col-md-8">
                                        <div style="margin-top: -17px">
                                           <select class="form-control show-tick" name="nomor" id="nomor">
                                                <?php foreach ($nomor as $key) { ?>
                                                   <option class="nomor" id="<?= $key->id_no_telp ?>" value="<?= $key->id_no_telp ?>"><?= $key->nama_no_telp ?></option>
                                               <?php } ?>
                                           </select>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Teks Pesan 
                                    </div>
                                    <div class="col-md-8">
                                        <div id="content_pesan" class="form-line" style="margin-top: -5px;">
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="pesan" id="pesan" style="margin-bottom: -4px;">&nbsp</textarea>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btn_simpan" class="btn btn-primary waves-effect">KIRIM</button>
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
        $('#modal_add #pesan').val('');
    }

    function editPesan(id='', nomor='') {
        $.post("<?= base_url() ?>/Kebencanaan/showEditPesan", {id_pesan: id}, function(result){
            var dt = JSON.parse(result);
            $('#modal_edit #id_pesan').val(id);
            $('#modal_edit .nomor').removeAttr('selected');
            $('#modal_edit #'+nomor).attr('selected','');
            $('#modal_edit #nomor').selectpicker('refresh');
            $('#modal_edit #pesan').val(dt.pesan);
        });
    }

    function hapusPesan(id='') {
        var ids = parseInt(id);
        swal({
          title: "Hapus Data",
          text: "Apakah data pesan akan dihapus?",
          type: "info",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
        }, function () {
            setTimeout(function () {

                    $.post("<?= base_url() ?>/Kebencanaan/hapusPesan", {id_pesan: id}, function(result){
                      // alert(result);
                        if (result == 'Success') {
                            swal("Data berhasil dihapus!");  
                            window.location.href = "<?= base_url().'Kebencanaan/pesan/' ?>";
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





