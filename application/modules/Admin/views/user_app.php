<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>USER APLIKASI</h2>
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
                                <?= $this->session->userdata('alert'); ?>
                            </div>
                            <div class="col-md-3 col-sm-3 col-lg-3" style="float: right;">
                                <button onclick="clear_data()" data-toggle="modal" data-target="#modal_add" class="btn bg-light-blue btn-block waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 13px;">person_add</i> TAMBAH USER</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="data-user">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="17%">Nama </th>
                                        <th width="30%">Alamat</th>
                                        <th width="5%">Jenis Kelamin</th>
                                        <th width="12%">Tanggal Lahir</th>
                                        <th width="10%">Nomor HP</th>
                                        <th width="10%">Username</th>
                                        <th width="5%">Role</th>
                                        <th width="5%">Foto</th>
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($user as $data) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data->nama ?></td>
                                            <td><?= $data->alamat ?></td>
                                            <td><?= $data->jenis_kelamin ?></td>
                                            <td><?= date('d-m-Y', strtotime($data->tgl_lahir)) ?></td>
                                            <td><?= $data->no_hp ?></td>
                                            <td><?= $data->username ?></td>
                                            <td><?= $data->role ?></td>
                                            <td>
                                                <?php if ($data->foto == '' || $data->foto == null) { ?>
                                                    <button title="Lihat Foto" class="btn btn-sm cbtn-raised btn-primary waves-effect" style="margin-bottom: 5px;"><i class="material-icons" style="margin-bottom: 10px;">visibility</i></button>
                                                <?php }else{ ?>
                                                    <a class="foto_kejadian" href="<?= base_url().'assets/path_profile/'.$data->foto ?>"><button title="Lihat Foto" class="btn btn-sm cbtn-raised btn-primary waves-effect" style="margin-bottom: 5px;"><i class="material-icons" style="margin-bottom: 10px;">visibility</i></button></a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button title="Edit" class="btn btn-sm cbtn-raised bg-green waves-effect" data-toggle="modal" data-target="#modal_edit" onclick="editUser('<?= $data->id_user ?>','<?= $data->nama ?>','<?= $data->jenis_kelamin ?>','<?= $data->alamat ?>','<?= date('d-m-Y', strtotime($data->tgl_lahir)) ?>','<?= $data->no_hp ?>','<?= $data->password ?>','<?= $data->id_role ?>','<?= $data->username ?>')" style="margin-bottom: 5px;"><i class="material-icons" style="margin-bottom: 10px;">border_color</i></button><br>
                                                <button title="Hapus" class="btn btn-sm cbtn-raised btn-danger waves-effect" onclick="hapusUser('<?= $data->id_user ?>')" style="margin-bottom: 5px;"><i class="material-icons" style="margin-bottom: 10px;">delete</i></button>
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

<!-- Modal Tambah User -->
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="col-md-1 col-sm-1 col-lg-1"></div>
                <div class="col-sm-10 col-md-10 col-lg-10">
                    <form name="laporan" id="lp" method="post" action="<?= base_url().'Admin/simpanUser'; ?>">
                        <!-- <input type="hidden" name="id_lapor" id="id_lapor"> -->
                        <div class="modal-header">
                            <center>
                                <h4 class="modal-title" id="defaultModalLabel">Tambah User</h4>
                            </center>
                        </div>
                        <div class="modal-body" id="print-page">
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Nama User
                                    </div>
                                    <div class="col-md-8">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="nama_user" id="nama_user" style="margin-bottom: -4px;">
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
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="almt_user" id="almt_user" style="margin-bottom: -4px;">&nbsp</textarea>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Jenis Kelamin
                                    </div>
                                    <div class="col-md-8">
                                        <!-- <div id="oldPass" class="form-line" style="margin-top: -5px;"> -->
                                        <div style="margin-top: -17px">
                                           <select class="form-control show-tick" name="jk_user" id="jk_user">
                                               <option value="Laki-Laki">Laki-Laki</option>
                                               <option value="Perempuan">Perempuan</option>
                                           </select>
                                        </div>
                                       <!-- </div> -->
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Tanggal Lahir
                                    </div>
                                    <div class="col-md-8">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="tgl_lhr" id="tgl_lhr" style="margin-bottom: -4px;" readonly>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Username
                                    </div>
                                    <div class="col-md-8">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="username" id="username" style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Nomor HP
                                    </div>
                                    <div class="col-md-8">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" onkeypress="return inputAngka(event);" maxlength="13" class="form-control" name="no_hp" id="no_hp" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Password
                                    </div>
                                    <div class="col-md-8">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="password" id="password" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Role User
                                    </div>
                                    <div class="col-md-8">
                                        <!-- <div id="oldPass" class="form-line" style="margin-top: -5px;"> -->
                                        <div style="margin-top: -17px">
                                           <select class="form-control show-tick" name="role_user" id="role_user" required>
                                               <?php foreach ($role as $key) { ?>
                                                        <option value="<?= $key->id_role ?>"><?= $key->role ?></option>
                                               <?php } ?>
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

<!-- Modal Edit User -->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="col-md-1 col-sm-1 col-lg-1"></div>
                <div class="col-sm-10 col-md-10 col-lg-10">
                    <form name="laporan" id="lp" method="post" action="<?= base_url().'Admin/updateUser'; ?>">
                        <input type="hidden" name="id_user" id="id_user">
                        <input type="hidden" name="no_hp_old" id="no_hp_old">
                        <div class="modal-header">
                            <center>
                                <h4 class="modal-title" id="defaultModalLabel">Edit Data User</h4>
                            </center>
                        </div>
                        <div class="modal-body" id="print-page">
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Nama User
                                    </div>
                                    <div class="col-md-8">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="nama_user" id="nama_user" style="margin-bottom: -4px;">
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
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="almt_user" id="almt_user" style="margin-bottom: -4px;">&nbsp</textarea>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Jenis Kelamin
                                    </div>
                                    <div class="col-md-8">
                                        <!-- <div id="oldPass" class="form-line" style="margin-top: -5px;"> -->
                                        <div style="margin-top: -17px">
                                           <select class="form-control show-tick" name="jk_user" id="jk_user">
                                               <option class="jk_user" value="Laki-Laki" id="Laki-Laki">Laki-Laki</option>
                                               <option class="jk_user" value="Perempuan" id="Perempuan">Perempuan</option>
                                           </select>
                                        </div>
                                       <!-- </div> -->
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Tanggal Lahir
                                    </div>
                                    <div class="col-md-8">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="tgl_lhr" id="tgl_lhr2" style="margin-bottom: -4px;" readonly>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Username
                                    </div>
                                    <div class="col-md-8">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="username" id="username" style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Nomor HP
                                    </div>
                                    <div class="col-md-8">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" onkeypress="return inputAngka(event);" maxlength="13" class="form-control" name="no_hp" id="no_hp" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Password
                                    </div>
                                    <div class="col-md-8">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="password" id="password" style="margin-bottom: -4px;" placeholder="Isi password jika ingin diubah">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        Role User
                                    </div>
                                    <div class="col-md-8">
                                        <!-- <div id="oldPass" class="form-line" style="margin-top: -5px;"> -->
                                        <div style="margin-top: -17px">
                                           <select class="form-control show-tick" name="role_user" id="role_user" required>
                                               <?php foreach ($role as $key) { ?>
                                                        <option class="role_user" value="<?= $key->id_role ?>" id="<?= $key->id_role ?>"><?= $key->role ?></option>
                                               <?php } ?>
                                           </select>
                                        </div>
                                       <!-- </div> -->
                                    </div>
                                </div>                        
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btn_simpan" class="btn btn-primary waves-effect">UPDATE</button>
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
        $('#nama_user').val('');
        $('#almt_user').val('');
        $('#tgl_lhr').val('');
        $('#no_hp').val('');
        $('#username').val('');
        $('#password').val('');
    }

    function editUser(id='', nama='', jk_user='', almt='', tgl_lhr='', no_hp='', pass='', role='', user='') {
        // alert(role);
        $('#modal_edit #id_user').val(id);
        $('#modal_edit #nama_user').val(nama);
        $('#modal_edit #almt_user').val(almt);
        $('#modal_edit #tgl_lhr2').val(tgl_lhr);
        $('#modal_edit #no_hp').val(no_hp);
        $('#modal_edit #no_hp_old').val(no_hp);
        $('#modal_edit #username').val(user);
        // $('#modal_edit #password').val(pass);
        $('#modal_edit .jk_user').removeAttr('selected');
        $('#modal_edit #'+jk_user).attr('selected','');
        $('#modal_edit #jk_user').selectpicker('refresh');
        $('#modal_edit .role_user').removeAttr('selected');
        $('#modal_edit #'+role).attr('selected','');
        $('#modal_edit #role_user').selectpicker('refresh');
    }

    function hapusUser(id='') {
        var ids = parseInt(id);
        swal({
          title: "Hapus Data",
          text: "Apakah data user akan dihapus?",
          type: "info",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
        }, function () {
            setTimeout(function () {

                    $.post("<?= base_url() ?>/Admin/hapusUser", {id_user: id}, function(result){
                      // alert(result);
                        if (result == 'Success') {
                            swal("Data berhasil dihapus!");  
                            window.location.href = "<?= base_url().'Admin/userApp/' ?>";
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
        window.location.href = "<?=base_url().'Admin/historiAduan' ?>";
    }
</script>





