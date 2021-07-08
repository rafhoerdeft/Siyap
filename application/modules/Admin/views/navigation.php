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
            <a class="navbar-brand" href="#">Super Admin</a>
        </div>

        <ul class="nav navbar-nav navbar-left">
            <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a></li>
           <!--  <li><a href="mail-inbox.html" class="inbox-btn hidden-sm-down" data-close="true"><i class="zmdi zmdi-email"></i></a></li>
            <li class="dropdown menu-app hidden-sm-down"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"> <i class="zmdi zmdi-apps"></i> </a>
                <ul class="dropdown-menu slideDown">
                    <li class="body">
                        <ul class="menu">
                            <li><a href="blog-dashboard.html"><i class="zmdi zmdi-blogger"></i><span>Blog</span></a></li>
                            <li><a href="contact.html"><i class="zmdi zmdi-accounts-list"></i><span>Contacts</span></a></li>
                            <li><a href="chat.html"><i class="zmdi zmdi-comment-text"></i><span>Chat</span></a></li>
                            <li><a href="javascript:void(0)"><i class="zmdi zmdi-arrows"></i><span>Notes</span></a></li>
                            <li><a href="javascript:void(0)"><i class="zmdi zmdi-view-column"></i><span>Taskboard</span></a></li>
                            <li><a href="events.html"><i class="zmdi zmdi-calendar-note"></i><span>Calendar</span></a></li>
                        </ul>
                    </li>
                </ul>
            </li> -->
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
                    <a href="<?= base_url()."Admin/index" ?>">
                        <i class="material-icons" style="float: left;">home</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Dashboard</span>
                    </a>
                </li>
                <li class="<?php if ($id_nav==2) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Admin/kategori" ?>">
                        <i class="material-icons" style="float: left;">widgets</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Kategori</span>
                    </a>
                </li>
                <li class="<?php if ($id_nav==3) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Admin/infoApp" ?>">
                        <i class="material-icons" style="float: left;">perm_device_information</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Info Aplikasi</span>
                    </a>
                </li>
                <li class="<?php if ($id_nav==4) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Admin/userApp" ?>">
                        <i class="material-icons" style="float: left;">person</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">User Aplikasi</span>
                    </a>
                </li>
                <li class="<?php if ($id_nav==5) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Admin/roleUser" ?>">
                        <i class="material-icons" style="float: left;">phonelink_lock</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Role User</span>
                    </a>
                </li>
                <li class="<?php if ($id_nav==6) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Admin/nomorDarurat" ?>">
                        <i class="material-icons" style="float: left;">phone_in_talk</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Nomor Darurat</span>
                    </a>
                </li>
                <li class="<?php if ($id_nav==7) { echo 'active';}  ?>">
                    <a href="<?= base_url()."Admin/sliderApp" ?>">
                        <i class="material-icons" style="float: left;">view_carousel</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Slider Aplikasi</span>
                    </a>
                </li>
                <!-- <li class="<?php //if ($id_nav==3) { echo 'active';}  ?>">
                    <a href="<?//= base_url()."Admin/dataLoginAnak" ?>">
                        <i class="material-icons" style="float: left;">group</i>
                        <span style="float: left; margin-top: 5px; margin-left: 20px">Data Anak</span>
                    </a>
                </li> -->
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2019 <a href="javascript:void(0);">Create By - DISKOMINFO</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.0
            </div>
        </div>
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
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span> </li>                   
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span> </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>                        
                    </ul>                    
                    <h6>Multi Color</h6>
                    <ul class="choose-skin">                        
                        <li data-theme="black" class="active">
                            <div class="black"></div>
                            <span>Black</span> </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span> </li>
                        <li data-theme="red">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>                        
                    </ul>                    
                    <h6>Gradient Color</h6>
                    <ul class="choose-skin">                    
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span> </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span> </li>
                        <li data-theme="blush">
                            <div class="blush"></div>
                            <span>Blush</span>
                        </li>
                    </ul>
                </div>                
            </div>
           <!--  <div role="tabpanel" class="tab-pane pullUp" id="chat">
                <div class="right_chat slim_scroll">
                    <div class="search">
                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Search..." required autofocus>
                            </div>
                        </div>
                    </div>
                    <h6>Recent</h6>
                    <ul class="list-unstyled">
                        <li class="online">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?//=base_url().'assets/' ?>assets/images/xs/avatar4.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Sophia</span>
                                        <span class="message">There are many variations of passages of Lorem Ipsum available</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>
                        <li class="online">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?//=base_url().'assets/' ?>assets/images/xs/avatar5.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Grayson</span>
                                        <span class="message">All the Lorem Ipsum generators on the</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>
                        <li class="offline">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?//=base_url().'assets/' ?>assets/images/xs/avatar2.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Isabella</span>
                                        <span class="message">Contrary to popular belief, Lorem Ipsum</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>
                        <li class="me">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?//=base_url().'assets/' ?>assets/images/xs/avatar1.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">John</span>
                                        <span class="message">It is a long established fact that a reader</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>
                        <li class="online">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?//=base_url().'assets/' ?>assets/images/xs/avatar3.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Alexander</span>
                                        <span class="message">Richard McClintock, a Latin professor</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>                        
                    </ul>
                    <h6>Contacts</h6>
                    <ul class="list-unstyled">
                        <li class="offline inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?//=base_url().'assets/' ?>assets/images/xs/avatar10.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?//=base_url().'assets/' ?>assets/images/xs/avatar6.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?//=base_url().'assets/' ?>assets/images/xs/avatar7.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?//=base_url().'assets/' ?>assets/images/xs/avatar8.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?//=base_url().'assets/' ?>assets/images/xs/avatar9.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="online inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?//=base_url().'assets/' ?>assets/images/xs/avatar5.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?//=base_url().'assets/' ?>assets/images/xs/avatar4.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?//=base_url().'assets/' ?>assets/images/xs/avatar3.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="online inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?//=base_url().'assets/' ?>assets/images/xs/avatar2.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?//=base_url().'assets/' ?>assets/images/xs/avatar1.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane slideLeft" id="settings">
                <div class="settings slim_scroll">
                    <p class="text-left">General Settings</p>
                    <ul class="setting-list">
                        <li> <span>Report Panel Usage</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever"></span></label>
                            </div>
                        </li>
                        <li> <span>Email Redirect</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox">
                                    <span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p class="text-left">System Settings</p>
                    <ul class="setting-list">
                        <li> <span>Notifications</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever"></span></label>
                            </div>
                        </li>
                        <li> <span>Auto Updates</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p class="text-left">Account Settings</p>
                    <ul class="setting-list">
                        <li> <span>Offline</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox">
                                    <span class="lever"></span></label>
                            </div>
                        </li>
                        <li> <span>Location Permission</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> -->
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
                <!-- <div class="form-group form-float">
                    <div id="username" class="form-line focused">
                        <input type="text" value="<?//= $username; ?>" class="form-control" name="user" id="user" readonly required>
                        <label class="form-label">Username</label>
                    </div>
                    <label id="error_user" class="error" for="user" style="display: block;"></label>
                </div> -->
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