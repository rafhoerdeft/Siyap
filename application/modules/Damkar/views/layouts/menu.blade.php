<div class="search-bar">
    <div class="search-icon"> <i class="material-icons">search</i> </div>
    <input type="text" placeholder="Search Here...">
    <div class="close-search"> <i class="material-icons">close</i> </div>
</div>

<!-- #END# Search Bar -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="col-12">
        
        <div class="navbar-header">
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="#">Damkar</a>
        </div>

        <ul class="nav navbar-nav navbar-left">
            <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right"> 
            <li class=""><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
        </ul>
    </div>
</nav>

<!-- #Top Bar -->

<!-- <section> -->
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <?php  
                    $username = $this->session->userdata('username');
                    $namaUser = $this->session->userdata('nama_user');
                    $first = substr($namaUser, 0, 1);
                    $label = strtoupper($first);
                ?>
                <img src="<?php echo base_url().'assets/';?>assets/images/icon-profil/<?=$label?>.jpg" width="48" height="48" alt="User" />
            </div>
            <div class="info-container" style="width: 70%;">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <b><?php echo $namaUser; ?></b>
                </div>
                <!-- <div class="email"><?=$namaUser ?></div> -->
                <div class="btn-group user-helper-dropdown" style="float: right;"> 
                    <i style="margin-top: 30px" class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="button"> keyboard_arrow_down </i>
                    <ul class="dropdown-menu slideUp">
                        <!-- <li><a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_Ubah_Pwd"><i class="material-icons">lock</i>Ubah Password</a></li> -->
                        <!-- <li role="separator" class="divider"></li> -->
                        <li><a href="<?php echo base_url().'Login/logout'; ?>"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info --> 

        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="<?php if ($id_nav==1) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Damkar/index" ?>">
                        <i class="material-icons" style="float: left;">home</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Dashboard</span>
                    </a>
                </li>
                <li class="<?php if ($id_nav==2) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Damkar/trackLaporan" ?>">
                        <i class="material-icons" style="float: left;">map</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Tracking</span>
                    </a>
                </li>
                <li class="<?php if ($id_nav==3) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Damkar/historiAduan" ?>">
                        <i class="material-icons" style="float: left;">history</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Histori Kejadian</span>
                    </a>
                </li>
                <li class="<?php if ($id_nav==11) { echo 'active';}  ?>"> 
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons" style="float: left;">assignment</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Laporan Kejadian</span> 
                    </a>
                    <ul class="ml-menu">
                        <li class="<?= (isset($id_sub_nav))?(($id_sub_nav==11.1)?'active':''):''  ?>">
                            <a href="<?= base_url()."Damkar/kejadianKebakaran" ?>">
                                <span>Kebakaran</span>
                            </a>
                        </li>
                        <li class="<?= (isset($id_sub_nav))?(($id_sub_nav==11.2)?'active':''):''  ?>">
                            <a href="<?= base_url()."Damkar/kejadianLain" ?>">
                                <span>Lain-Lain</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="<?php if ($id_nav==6) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Damkar/pesan" ?>">
                        <i class="material-icons" style="float: left;">message</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Pesan</span>
                    </a>
                </li>

                <li class="header">MASTER DATA</li>

                <li class="<?php if ($id_nav==14) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Damkar/kepalaDamkar" ?>">
                        <i class="material-icons" style="float: left;">account_circle</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Kepala Damkar</span>
                    </a>
                </li>

                <li class="<?php if ($id_nav==15) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Damkar/piketDamkar" ?>">
                        <i class="material-icons" style="float: left;">work</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Piket Damkar</span>
                    </a>
                </li>

                <li class="<?php if ($id_nav==9) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Damkar/dataWmk" ?>">
                        <i class="material-icons" style="float: left;">store</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Data WMK</span>
                    </a>
                </li>

                <li class="<?php if ($id_nav==13) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Damkar/reguDamkar" ?>">
                        <i class="material-icons" style="float: left;">group</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Regu Damkar</span>
                    </a>
                </li>

                <li class="<?php if ($id_nav==4) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Damkar/userApp" ?>">
                        <i class="material-icons" style="float: left;">person</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">User Aplikasi</span>
                    </a>
                </li>

                <li class="<?php if ($id_nav==5) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Damkar/nomorTelp" ?>">
                        <i class="material-icons" style="float: left;">contact_phone</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Nomor HP SKPD</span>
                    </a>
                </li>
                
                <li class="<?php if ($id_nav==7) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Damkar/jenisKejadian" ?>">
                        <i class="material-icons" style="float: left;">accessibility</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Jenis Kejadian</span>
                    </a>
                </li>

                <li class="<?php if ($id_nav==12) { echo 'active';}  ?>"> 
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons" style="float: left;">local_shipping</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Mobil Damkar</span> 
                    </a>
                    <ul class="ml-menu">
                        <li class="<?= (isset($id_sub_nav))?(($id_sub_nav==12.1)?'active':''):''  ?>">
                            <a href="<?= base_url()."Damkar/mobilDamkar" ?>">
                                <span>Data Mobil</span>
                            </a>
                        </li>
                        <li class="<?= (isset($id_sub_nav))?(($id_sub_nav==12.2)?'active':''):''  ?>">
                            <a href="<?= base_url()."Damkar/alatDamkar" ?>">
                                <span>Item Damkar</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="<?php if ($id_nav==8) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Damkar/awalNotif" ?>">
                        <i class="material-icons" style="float: left;">notifications_active</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Awal Notif Masuk</span>
                    </a>
                </li>
                
                <li class="<?php if ($id_nav==10) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Damkar/batasJarak" ?>">
                        <i class="material-icons" style="float: left;">streetview</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Radius Laporan</span>
                    </a>
                </li>

                <li class="header">
                    &copy; <?= date('Y') ?> Create By - DISKOMINFO <br>
                    <b>Version: </b> 1.8.1
                </li>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <!-- <div class="legal">
            <div class="copyright">
                &copy; 2019 <a href="javascript:void(0);">Create By - DISKOMINFO</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.0
            </div>
        </div> -->
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#skins">Skins</a></li>
            <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#chat">Chat</a></li> -->
            <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings">Setting</a></li> -->
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane in active in active slideRight" id="skins">
                <div class="slim_scroll">
                    <h6>Flat Color</h6>
                    <ul class="choose-skin">                   
                        <li data-theme="purple" onclick="setTheme(this)">
                            <div class="purple"></div>
                            <span>Purple</span> </li>                   
                        <li data-theme="blue" onclick="setTheme(this)">
                            <div class="blue"></div>
                            <span>Blue</span> </li>
                        <li data-theme="cyan" onclick="setTheme(this)">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>                        
                    </ul>                    
                    <h6>Multi Color</h6>
                    <ul class="choose-skin">                        
                        <li data-theme="black" onclick="setTheme(this)">
                            <div class="black"></div>
                            <span>Black</span> </li>
                        <li data-theme="deep-purple" onclick="setTheme(this)">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span> </li>
                        <li data-theme="red" onclick="setTheme(this)">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>                        
                    </ul>                    
                    <h6>Gradient Color</h6>
                    <ul class="choose-skin">                    
                        <li data-theme="green" onclick="setTheme(this)">
                            <div class="green"></div>
                            <span>Green</span> </li>
                        <li data-theme="orange" onclick="setTheme(this)" >
                            <div class="orange"></div>
                            <span>Orange</span> </li>
                        <li data-theme="blush" onclick="setTheme(this)">
                            <div class="blush"></div>
                            <span>Blush</span>
                        </li>
                    </ul>
                </div>                
            </div>
        </div>
    </aside>

    <!-- #END# Right Sidebar -->
<!-- </section> -->

<!-- Ubah Password -->
<div class="modal fade" id="Modal_Ubah_Pwd" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h4 class="modal-title" id="defaultModalLabel">Ubah Password</h4>
                </center>
            </div>
            <div class="modal-body">
                <form name="change-password" id="cp">
                <div class="form-group form-float">
                    <div id="oldPass" class="form-line">
                        <input type="Password" class="form-control" name="old_pass" id="old_pass" onkeyup="validPass();" required>
                        <label class="form-label">Password Lama</label>
                    </div>
                    <label id="error_oldPass" class="error" for="old_pass" style="display: block;"></label>
                </div>
                <div class="form-group form-float">
                    <div id="newPass" class="form-line">
                        <input type="Password" class="form-control" name="new_pass" id="new_pass" onkeyup="ulangPass();" required>
                        <label class="form-label">Password Baru</label>
                    </div>
                    <label id="error_newPass" class="error" for="new_pass" style="display: block;"></label>
                </div>
                <div class="form-group form-float">
                    <div id="newPass2" class="form-line">
                        <input type="Password" class="form-control" name="new_pass2" id="new_pass2" onkeyup="ulangPass();" required>
                        <label class="form-label">Ulangi Password</label>
                    </div>
                    <label id="error_newPass2" class="error" for="new_pass2" style="display: block;"></label>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_simpan" class="btn btn-link waves-effect">UBAH PASSWORD</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

