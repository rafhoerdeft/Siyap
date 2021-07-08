 <!-- Search Bar -->
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
            <a href="javascript:void(0);" class="h-bars"></a> 
            <a class="navbar-brand" href="javascript:void(0);"><img style="margin-left: 7px;" src="<?= base_url().'assets/path_logo/LOGO-SIYAP-FULL-WTH.png' ?>" height="25"> MONITORING</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <!-- <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="zmdi zmdi-search"></i></a></li> -->
            <li title="Login Admin"><a href="<?= base_url().'Login' ?>" class="mega-menu" data-close="true"><i class="zmdi zmdi-power"></i></a></li>
            <li class=""><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
        </ul>
    </div>
</nav>

<div class="menu-container">
    <div class="menu">
        <!-- <ul> -->
            <?php 
                // foreach ($menu as $key) { 
                //     if ($key->tampil == 'true') {
            ?>
                        <!-- <li><a href="<?//=base_url().'Dashboard/index/'.$key->nama_kategori ?>"><?//= $key->nama_kategori ?></a></li> -->
            <?php //}} ?>
        <!-- </ul> -->

        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#peta">MAP</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#laporan">LAPORAN</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#statistik">STATISTIK</a></li>
        </ul>  
    </div>
</div>

<!-- Right Sidebar -->
<aside id="rightsidebar" class="right-sidebar">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#skins">Skins</a></li>
        <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#chat">Chat</a></li> -->
        <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings">Setting</a></li> -->
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane in active in active slideRight" id="skins">
            <ul class="choose-skin slim_scroll">
                <h6>Flat Color</h6>                    
                <li data-theme="purple" onclick="setTheme(this)">
                    <div class="purple"></div>
                    <span>Purple</span> </li>                   
                <li data-theme="blue" onclick="setTheme(this)">
                    <div class="blue"></div>
                    <span>Blue</span> </li>
                <li data-theme="cyan" onclick="setTheme(this)">
                    <div class="cyan"></div>
                    <span>Cyan</span> </li>
                <h6>Multi Color</h6>
                <li data-theme="black" onclick="setTheme(this)">
                    <div class="black"></div>
                    <span>Black</span> </li>
                <li data-theme="deep-purple" onclick="setTheme(this)">
                    <div class="deep-purple"></div>
                    <span>Deep Purple</span> </li>
                <li data-theme="red" onclick="setTheme(this)">
                    <div class="red"></div>
                    <span>Red</span> </li>
                <h6>Gradient Color</h6>
                <li data-theme="green" onclick="setTheme(this)">
                    <div class="green"></div>
                    <span>Green</span> </li>
                <li data-theme="orange" onclick="setTheme(this)">
                    <div class="orange"></div>
                    <span>Orange</span> </li>
                <li data-theme="blush" onclick="setTheme(this)">
                    <div class="blush"></div>
                    <span>Blush</span> </li>
            </ul>
        </div>
    </div>
</aside>
