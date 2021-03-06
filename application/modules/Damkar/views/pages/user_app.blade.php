@layout('layouts/master')

@section('content')
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
                                <div class="col-md-6" style="margin-bottom: -35px;">
                                    <?= $this->session->flashdata('alert'); ?>
                                </div>
                                <div class="col-md-4">
                                    <form id="form_role" action="<?= base_url('Damkar/userApp') ?>" method="POST">
                                        <div class="row">
                                            <div class="col-md-4 btn bg-red" style="padding: 13px;">
                                                Role User
                                            </div>
                                            <div class="col-md-8">
                                                <div style="margin-top: -4px">
                                                <select class="form-control show-tick" name="id_role" id="id_role" onchange="submitForm()">
                                                    <?php foreach ($role as $key) { ?>
                                                                <option <?= ($key['id_role']==$selected_role?'selected':'') ?> value="<?= $key['id_role'] ?>"><?= $key['role'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                </div>
                                            </div>
                                        </div>  
                                    </form>
                                </div>
                                <div class="col-md-2" style="float: right;">
                                    <button onclick="addModal()" data-toggle="modal" class="btn bg-light-blue btn-block btn-raised waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 13px;">person_add</i> TAMBAH USER</button>
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
                                            <th width="5%">Foto</th>
                                            <th>Aksi</th> 
                                            <th width="17%">Nama </th>
                                            <th width="30%">Alamat</th>
                                            <th width="7%">Jenis Kelamin</th>
                                            <th width="12%">Tanggal Lahir</th>
                                            <th width="10%">Nomor HP</th>
                                            <th width="10%">Username</th>
                                            <?php if ($selected_role == 2) { ?>
                                                <th>WMK</th>
                                                <th>Regu</th>
                                                <th>Jabatan</th>
                                            <?php } ?>
                                            <!-- <th width="5%">Role</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($user as $data) { ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td nowrap>
                                                    <?php if ($data->foto == '' || $data->foto == null) { ?>
                                                        <button disabled title="Lihat Foto" class="btn btn-sm btn-sm btn-raised btn-secondary waves-effect" style="margin-bottom: 5px; width: 5px;"><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">visibility</i></button>
                                                    <?php }else{ ?>
                                                        <a class="foto_kejadian" href="<?= base_url().'assets/path_profile/'.$data->foto ?>"><button title="Lihat Foto" class="btn btn-sm btn-sm btn-raised btn-primary waves-effect" style="margin-bottom: 5px; width: 5px;">
                                                        <i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">visibility</i>
                                                        </button></a>
                                                    <?php } ?>
                                                </td>
                                                <td nowrap>
                                                    <button title="Edit" class="btn btn-sm btn-sm btn-raised bg-green waves-effect" 
                                                    data-id="<?= $data->id_user ?>"
                                                    data-nama="<?= $data->nama ?>"
                                                    data-jk="<?= $data->jenis_kelamin ?>"
                                                    data-almt="<?= $data->alamat ?>"
                                                    data-tgllhr="<?= date('d-m-Y', strtotime($data->tgl_lahir)) ?>"
                                                    data-nomor="<?= $data->no_hp ?>"
                                                    data-role="<?= str_replace(" ", "_", $data->role) ?>"
                                                    data-user="<?= $data->username ?>"
                                                    data-wmk="<?= $data->id_wmk ?>"
                                                    data-regu="<?= $data->id_regu ?>"
                                                    data-jabatan="<?= $data->jabatan ?>"
                                                    onclick="editModal(this)" style="margin-bottom: 5px; width: 5px;"><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">border_color</i></button>

                                                    <button title="Hapus" class="btn btn-sm btn-sm btn-raised btn-danger waves-effect" onclick="hapusUser('<?= $data->id_user ?>')" style="margin-bottom: 5px; width: 5px;"><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">delete</i></button>
                                                </td>
                                                <td nowrap><?= $data->nama ?></td>
                                                <td><?= $data->alamat ?></td>
                                                <td><?= $data->jenis_kelamin ?></td>
                                                <td nowrap><?= date('d-m-Y', strtotime($data->tgl_lahir)) ?></td>
                                                <td><?= $data->no_hp ?></td>
                                                <td><?= $data->username ?></td>
                                                <?php if ($selected_role == 2) { ?>
                                                    <td><?= $data->nama_wmk ?></td>
                                                    <td><?= $data->nama_regu ?></td>
                                                    <td><?= $data->jabatan ?></td>
                                                <?php } ?>
                                                <!-- <td><?//= $data->role ?></td> -->
                                                
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
                        <form name="laporan" id="lp" method="post" action="<?= base_url().'Damkar/simpanUser'; ?>">
                            <input type="hidden" name="role_user" id="role_user" value="<?= $selected_role ?>">
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
                                                <input type="password" class="form-control" name="password" id="password" required style="margin-bottom: -4px;">
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <!-- <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Role User
                                        </div>
                                        <div class="col-md-8">
                                            <div style="margin-top: -17px">
                                            <select class="form-control show-tick" name="role_user" id="role_user" required>
                                                <?php //foreach ($role as $key) { ?>
                                                            <option value="<?//= $key->id_role ?>"><?//= $key->role ?></option>
                                                <?php //} ?>
                                            </select>
                                            </div>
                                        </div>
                                    </div>                        
                                </div> -->
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
    <div class="modal fade" id="modal_form" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-lg-1"></div>
                    <div class="col-sm-10 col-md-10 col-lg-10">
                        <form name="laporan" id="form_input" method="post" action="<?= base_url().'Damkar/updateUser'; ?>">
                            <input type="hidden" name="id_user" id="id_user">
                            <input type="hidden" name="no_hp_old" id="no_hp_old">
                            <input type="hidden" name="role_user" id="role_user" value="<?= $selected_role ?>">
                            <div class="modal-header">
                                <center>
                                    <h4 class="modal-title" id="modal_title">Edit Data User</h4>
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
                                                <input type="text" class="form-control" name="nama_user" id="nama_user" style="margin-bottom: -4px;" required>
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
                                                <textarea rows="1" class="form-control no-resize auto-growth" name="almt_user" id="almt_user" style="margin-bottom: -4px;" required>&nbsp</textarea>
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
                                            <select class="form-control show-tick" name="jk_user" id="jk_user" required>
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
                                                <input type="text" class="form-control" name="tgl_lhr" id="tgl_lhr2" style="margin-bottom: -4px;" required readonly>
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                                <!-- ============================================================= -->

                                <?php //if ($selected_role == 2) { ?>
                                    <div style="<?= ($selected_role != 2)?'display:none;':'' ?>">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    WMK
                                                </div>
                                                <div class="col-md-8">
                                                    <div style="margin-top: -17px">
                                                    <select class="form-control show-tick" name="wmk" id="wmk" onchange="getRegu()" <?= ($selected_role == 2)?'required':'' ?> >
                                                            <?php foreach ($wmk as $key) { ?>
                                                            <option value="<?= $key->id_wmk ?>"><?= $key->nama_wmk ?></label> </option>
                                                        <?php } ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>                        
                                        </div>

                                        <div style="z-index: 20; margin-top: -50px; margin-bottom: -25px; text-align: center; display: none" id="loading-regu">
                                            <img src="<?= base_url() . 'assets/assets/images/loading/loading1.gif' ?>" width="100">
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    Regu
                                                </div>
                                                <div class="col-md-8">
                                                    <div style="margin-top: -17px">
                                                    <select class="form-control show-tick" name="regu" id="regu" <?= ($selected_role == 2)?'required':'' ?>>
                                                            <option value="" hidden>Pilih Regu</option>
                                                            <option value="" disabled>Pilih WMK dahulu</option>
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
                                                    <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                                        <input type="text" class="form-control" name="jabatan" id="jabatan" style="margin-bottom: -4px;" <?= ($selected_role == 2)?'required':'' ?>>
                                                    </div>
                                                </div>
                                            </div>                        
                                        </div>
                                    </div>
                                <?php //} ?>

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
                                                <input type="password" class="form-control" name="password" id="password" style="margin-bottom: -4px;" placeholder="Isi password jika ingin diubah">
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

    <script src="<?= base_url('assets/assets/js/get_regu.js') ?>"></script>

    <script>
        getRegu();
    </script>

    <!-- Clear - Edit - Hapus User -->
    <script type="text/javascript">
        function clear_data() {
            $('#modal_form #nama_user').val('');
            $('#modal_form #almt_user').val('');
            $('#modal_form #tgl_lhr').val('');
            $('#modal_form #no_hp').val('');
            $('#modal_form #username').val('');
            $('#modal_form #password').val('');
            $('#modal_form #jabatan').val('');
            // $('#modal_form #wmk').val('1').change();
            // var list = '<option value="" hidden>Pilih Regu</option> <option value="" disabled>Data regu kosong</option>';
            // $("#modal_form #regu").html(list);
            // $('#modal_form #regu').selectpicker('refresh');
        }

        function addModal() {
            clear_data();
            $('#modal_form #modal_title').html('Tambah Data User');
            $('#modal_form #form_input').attr('action', "<?= base_url().'Damkar/simpanUser'; ?>");
            $('#modal_form #wmk').val('1').change();
            $('#modal_form #wmk').selectpicker('refresh');
            $('#modal_form').modal({backdrop: 'static', keyboard: false});  
        }

        function editModal(data) {
            var id = $(data).data().id;
            var nama = $(data).data().nama;
            var jk_user = $(data).data().jk;
            var almt = $(data).data().almt;
            var tgl_lhr = $(data).data().tgllhr;
            var no_hp = $(data).data().nomor;
            var role = $(data).data().role;
            var user = $(data).data().user;
            var wmk = $(data).data().wmk;
            var regu = $(data).data().regu;
            var jabatan = $(data).data().jabatan;

            clear_data();
            $('#modal_form #modal_title').html('Edit Data User');
            $('#modal_form #form_input').attr('action', "<?= base_url().'Damkar/updateUser'; ?>");
            $('#modal_form #id_user').val(id);
            $('#modal_form #nama_user').val(nama);
            $('#modal_form #almt_user').val(almt);
            $('#modal_form #tgl_lhr2').val(tgl_lhr);
            $('#modal_form #no_hp').val(no_hp);
            $('#modal_form #no_hp_old').val(no_hp);
            $('#modal_form #username').val(user);
            // $('#modal_form #password').val(pass);
            $('#modal_form #jk_user').val(jk_user).change();

            if (regu != '' && regu != null) {
                if (wmk != '' && wmk != null) {
                    $('#modal_form #wmk').val(wmk).change();
                    $('#modal_form #wmk').selectpicker('refresh');
                }
                setTimeout(function(){ 
                    $('#modal_form #regu').val(regu).change(); 
                    $('#modal_form #regu').selectpicker('refresh');
                }, 2000);
                $('#modal_form #jabatan').val(jabatan);
            } else {
                $('#modal_form #wmk').val(1).change();
                $('#modal_form #wmk').selectpicker('refresh');
            }
            
            // $('#modal_form .jk_user').removeAttr('selected');
            // $('#modal_form #'+jk_user).attr('selected','');
            // $('#modal_form #jk_user').selectpicker('refresh');
            // $('#modal_form .role_user').removeAttr('selected');
            // $('#modal_form #'+role).attr('selected','');
            // $('#modal_form #role_user').selectpicker('refresh');
            $('#modal_form').modal({backdrop: 'static', keyboard: false});  
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

                        $.post("<?= base_url() ?>/Damkar/hapusUser", {id_user: id}, function(result){
                        // alert(result);
                            if (result == 'Success') {
                                swal("Data berhasil dihapus!");  
                                window.location.href = "<?= base_url().'Damkar/userApp/' ?>";
                            }else{
                                swal("Gagal!");
                            }
                        });
                }, 700);
            });
        }
    </script>

    <script>
        function submitForm() {
            $('#form_role').submit();
        }
    </script>
@endsection





