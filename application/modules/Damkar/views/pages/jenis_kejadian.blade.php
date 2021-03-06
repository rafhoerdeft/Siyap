@layout('layouts/master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>JENIS KEJADIAN</h2>
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
                                    <?= $this->session->userdata('alert_kejadian'); ?>
                                </div>
                                <div class="col-md-3 col-sm-3 col-lg-3" style="float: right;">
                                    <button onclick="addModal()" class="btn bg-light-blue btn-block waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 13px;">add_to_photos</i> TAMBAH JENIS KEJADIAN</button>
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
                                            <th style="text-align: center">Aksi</th>
                                            <th width="50%" style="text-align: center">Nama Jenis Kejadian</th>
                                            <th width="30%" style="text-align: center">Jenis Laporan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($kejadian as $data) { ?>
                                            <tr>
                                                <td align="center"><?= $no++; ?></td>
                                                <td align="center" nowrap>
                                                    <button title="Edit" class="btn btn-sm cbtn-raised bg-green waves-effect" 
                                                    data-id="<?= $data->id_jenis_lap ?>"
                                                    data-jenis="<?= $data->nama_jenis_lap ?>"
                                                    data-grup="<?= $data->grup_jenis ?>"
                                                    onclick="editKejadian(this)" style="margin-bottom: 5px;"><i class="material-icons" style="margin-bottom: 10px;">border_color</i></button>
                                                    <button title="Hapus" class="btn btn-sm cbtn-raised btn-danger waves-effect" 
                                                    data-id="<?= $data->id_jenis_lap ?>"
                                                    onclick="hapusKejadian(this)" style="margin-bottom: 5px;"><i class="material-icons" style="margin-bottom: 10px;">delete</i></button>
                                                </td>
                                                <td><?= $data->nama_jenis_lap ?></td>
                                                <td><?= ucwords(str_replace('_', ' ', $data->grup_jenis)) ?></td>                                                
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-lg-1"></div>
                    <div class="col-sm-10 col-md-10 col-lg-10">
                        <form name="simpanRole" id="simpanRole" method="post" action="<?= base_url().'Damkar/simpanKejadian'; ?>">
                            <!-- <input type="hidden" name="id_jenis_lap" id="id_jenis_lap"> -->
                            <div class="modal-header">
                                <center>
                                    <h4 class="modal-title" id="defaultModalLabel">Tambah Jenis Kejadian</h4>
                                </center>
                            </div>
                            <div class="modal-body" id="print-page">
                            
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Jenis Kejadian
                                        </div>
                                        <div class="col-md-8">
                                            <div id="content_jenis_lap" class="form-line" style="margin-top: -5px;">
                                                <textarea rows="1" class="form-control no-resize auto-growth" name="nama_jenis_lap" id="nama_jenis_lap" style="margin-bottom: -4px;">&nbsp</textarea>
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Jenis Laporan
                                        </div>
                                        <div class="col-md-8">
                                            <!-- <div id="oldPass" class="form-line" style="margin-top: -5px;"> -->
                                            <div style="margin-top: -17px">
                                            <select class="form-control show-tick" name="grup_jenis" id="grup_jenis">
                                                <option value="kebakaran">Kebakaran</option>
                                                <option value="non_kebakaran">Non Kebakaran</option>
                                            </select>
                                            </div>
                                        <!-- </div> -->
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

    <!-- Modal Edit Pesan -->
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-lg-1"></div>
                    <div class="col-sm-10 col-md-10 col-lg-10">
                        <form name="simpanRole" id="simpanRole" method="post" action="<?= base_url().'Damkar/updateKejadian'; ?>">
                            <input type="hidden" name="id_jenis_lap" id="id_jenis_lap">
                            <div class="modal-header">
                                <center>
                                    <h4 class="modal-title" id="defaultModalLabel">Update Jenis Kejadian</h4>
                                </center>
                            </div>
                            <div class="modal-body" id="print-page">
                            
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Jenis Kejadian
                                        </div>
                                        <div class="col-md-8">
                                            <div id="content_jenis_lap" class="form-line" style="margin-top: -5px;">
                                                <textarea rows="1" class="form-control no-resize auto-growth" name="nama_jenis_lap" id="nama_jenis_lap" style="margin-bottom: -4px;">&nbsp</textarea>
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Jenis Laporan
                                        </div>
                                        <div class="col-md-8">
                                            <!-- <div id="oldPass" class="form-line" style="margin-top: -5px;"> -->
                                            <div style="margin-top: -17px">
                                            <select class="form-control show-tick" name="grup_jenis" id="grup_jenis">
                                                <option value="kebakaran">Kebakaran</option>
                                                <option value="non_kebakaran">Non Kebakaran</option>
                                            </select>
                                            </div>
                                        <!-- </div> -->
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
            $('#modal_add #nama_jenis_lap').val('');
            $('#modal_add').modal({backdrop: 'static', keyboard: false});
        }

        function editKejadian(data) {
            var id = $(data).data().id;
            var jenis = $(data).data().jenis;
            var grup = $(data).data().grup;

            $('#modal_edit #id_jenis_lap').val(id);
            $('#modal_edit #nama_jenis_lap').val(jenis);
            $('#modal_edit #grup_jenis').val(grup).change();
            $('#modal_edit').modal({backdrop: 'static', keyboard: false});
        }

        function hapusKejadian(data) {
            var id = $(data).data().id;
            swal({
            title: "Hapus Data",
            text: "Apakah data jenis kejadian akan dihapus?",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            }, function () {
                setTimeout(function () {

                        $.post("<?= base_url() ?>/Damkar/hapusKejadian", {id_jenis_lap: id}, function(result){
                        // alert(result);
                            if (result == 'Success') {
                                swal("Data berhasil dihapus!");  
                                window.location.href = "<?= base_url().'Damkar/jenisKejadian/' ?>";
                            }else{
                                swal("Gagal!");
                            }
                        });
                }, 700);
            });
        }
    </script>

@endsection

