<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>EDIT DATA PENDIDIK</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="body bg-default">
                        <!-- <div class="row">
                            <div class="col-md-10"> -->
                                <!-- <font style="font-size: 25px;">Daftar Unit</font> -->
                            <!-- </div>
                            <div class="col-md-2">
                                <button type="button" name="add" id="add" class="btn btn-block btn-info waves-effect" data-toggle="modal" data-target="#Modal_Add">Tambah Data <i class="material-icons">library_add</i></button>

                            </div>
                        </div> -->

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <form id="form_validation" method="post" action="<?=base_url()."Admin/editPend" ?>">
                                        <input type="hidden" name="id_login" value="<?=$dataPend['id_login'] ?>">
                                        <input type="hidden" name="id_pend" value="<?=$dataPend['id_pend'] ?>">
                                        <div class="row clearfix">
                                            
                                            <div class="col-sm-12">
                                                <div class="form-group form-float">
                                                    <div class="form-line focused">
                                                        <label class="form-label">Nama Pendidik</label>
                                                        <input required type="text" value="<?=$dataPend['nama_pend'] ?>" name="nama_pend" id="nama_pend" class="form-control" />
                                                    </div>
                                                    <!-- <label id="error_nm" class="error" for="nama_user" style="display: block;"></label> -->
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row clearfix">
                                            
                                            <div class="col-sm-12">
                                                <div class="form-group form-float">
                                                    <label class="form-label">Jenis Kelamin</label>
                                                    <select required class="form-control show-tick" name="jk_pend" id="jk_pend">
                                                        <option value="Laki-Laki" <?= ($dataPend['jk_pend'] == 'Laki-Laki'?'selected':'') ?>>Laki-Laki</option>
                                                        <option value="Perempuan" <?= ($dataPend['jk_pend'] == 'Perempuan'?'selected':'') ?>>Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row clearfix">
                                            
                                            <div class="col-sm-12">
                                                <div class="form-group form-float">
                                                    <div class="form-line focused" id="tglLhrPend">
                                                        <label class="form-label">Tanggal Lahir</label>
                                                        <input required type="text" value="<?=$dataPend['tgl_lhr_pend'] ?>" name="tgl_lhr_pend" id="tgl_lhr_pend" class="form-control" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row clearfix">
                                            
                                            <div class="col-sm-12">
                                                <div class="form-group form-float">
                                                    <div class="form-line focused">
                                                        <label class="form-label">Alamat</label>
                                                        <textarea required rows="1" name="almt_pend" id="almt_pend" class="form-control no-resize auto-growth"><?=$dataPend['alamat_pend'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row clearfix">
                                            
                                            <div class="col-sm-12">
                                                <div class="form-group form-float">
                                                    <div class="form-line focused">
                                                        <label class="form-label">Nomor Telpon/HP</label>
                                                        <input onkeypress="return inputAngka(event);" value="<?=$dataPend['no_telpon_pend'] ?>" required type="text" name="no_telp_pend" id="no_telp_pend" class="form-control" maxlength="13" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row clearfix">
                                            
                                            <div class="col-sm-12">
                                                <div class="form-group form-float">
                                                    <div class="form-line focused">
                                                        <label class="form-label">Username</label>
                                                        <input required type="text" value="<?=$dataPend['username'] ?>" name="username" id="username" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row clearfix">
                                            
                                            <div class="col-sm-12">
                                                <div class="form-group form-float">
                                                    <div class="form-line ">
                                                        <label class="form-label">Password</label>
                                                        <input type="password" name="password" id="password" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    <!-- </div> -->
                                    <div class="row clearfix">
                                        <div class="col-md-4">
                                            <a href="<?=base_url().'Admin/dataLoginPendidik' ?>"> <button type="button" class="btn btn-block btn-info waves-effect">BATAL</button></a>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="reset" class="btn btn-block btn-warning waves-effect" id="btn_save">RESET</button>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-block btn-success waves-effect" id="btn_save">SIMPAN</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
