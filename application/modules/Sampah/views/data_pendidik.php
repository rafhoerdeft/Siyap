<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DATA PENDIDIK</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="body bg-default">
                        <div class="row">
                            <div class="col-md-10">
                                <!-- <font style="font-size: 25px;">Daftar Unit</font> -->
                            </div>
                            <div class="col-md-2">
                                <button type="button" name="add" id="add" class="btn btn-block btn-info waves-effect" data-toggle="modal" data-target="#Modal_Add">Tambah Data <i class="material-icons">library_add</i></button>

                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tbl-unit" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead style="font-size: 11pt">
                                            <tr>
                                                <th>#</th>
                                                <th>No Pendidik</th>
                                                <th>Nama Pendidik</th>
                                                <th>Alamat</th>
                                                <th>Username</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size: 10pt;">
                                            <?php  
                                                $i = 1;
                                                foreach ($data_pend as $key) {
                                                    // $tgl_lhr = date('d-m-Y',strtotime($key->tgl_lhr_user));
                                            ?>
                                                    <tr>
                                                        <td align="center"><?= $i++ ?></td>
                                                        <td><?= $key->no_user ?></td>
                                                        <td><?= $key->nama_pend ?></td>
                                                        <td><?= $key->alamat_pend ?></td>
                                                        <!-- <td align="center"><?= $tgl_lhr ?></td> -->
                                                        <!-- <td align="center"><?= $key->no_hp_user ?></td> -->
                                                        <td><?= $key->username ?></td>
                                                        <!-- <td><?= $key->status ?></td> -->
                                                        <td width="50">
                                                            <!-- <center> -->
                                                                <div class="col-md-5">
                                                                    <!-- <button id="editUser" onclick="showEditUser('<?=$key->id_user ?>')" type="button" data-toggle="modal" data-target="#Modal_Edit" class="btn btn-block btn-info waves-effect">Edit</button> -->
                                                                    <a href="<?=base_url().'Admin/showEditPend/'.$key->id_login ?>" class="btn btn-block bg-teal btn-sm waves-effect">Edit</a>
                                                                    <button onclick="delPendidik(<?=$key->id_login ?>, <?=$key->id_pend ?>)" class="btn btn-block btn-danger btn-sm waves-effect">Delete</button>
                                                                </div>
                                                            <!-- </center> -->
                                                        </td>
                                                    </tr>
                                            <?php        
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODAL ADD -->
<div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form_validation" method="post" action="<?=base_url()."Admin/tambahPend" ?>">
                <div class="modal-header">
                    <center>
                        <h4 class="modal-title" id="defaultModalLabel">Tambah Data Pendidik</h4>
                    </center>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-1"></div>
                        <div class="col-sm-10">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Nama Pendidik</label>
                                    <input required type="text" name="nama_pend" id="nama_pend" class="form-control" />
                                </div>
                                <!-- <label id="error_nm" class="error" for="nama_user" style="display: block;"></label> -->
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-1"></div>
                        <div class="col-sm-10">
                            <div class="form-group form-float">
                                <label class="form-label">Jenis Kelamin</label>
                                <select required class="form-control show-tick" name="jk_pend" id="jk_pend">
                                    <!-- <option label="Pilih Jenis Kelamin"></option> -->
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-1"></div>
                        <div class="col-sm-10">
                            <div class="form-group form-float">
                                <div class="form-line" id="tglLhrPend">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input required type="text" name="tgl_lhr_pend" id="tgl_lhr_pend" class="form-control" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-1"></div>
                        <div class="col-sm-10">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Alamat</label>
                                    <textarea required rows="1" name="almt_pend" id="almt_pend" class="form-control no-resize auto-growth"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-1"></div>
                        <div class="col-sm-10">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Nomor Telpon/HP</label>
                                    <input onkeypress="return inputAngka(event);" required type="text" name="no_telp_pend" id="no_telp_pend" class="form-control" maxlength="13" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-1"></div>
                        <div class="col-sm-10">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Username</label>
                                    <input required type="text" name="username" id="username" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-1"></div>
                        <div class="col-sm-10">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Password</label>
                                    <input required type="password" name="password" id="password" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
                    <button type="reset" class="btn btn-link waves-effect" id="btn_reset" onclick="resetPendidik()">RESET</button>
                    <button type="submit" class="btn btn-link waves-effect" id="btn_save">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODAL ADD-->
