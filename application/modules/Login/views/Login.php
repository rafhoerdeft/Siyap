<?php  ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>COMMAND CENTER</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url().'assets/';?>assets/images/icon_kab_mgl2.png" type="image/x-icon">

    <link rel="stylesheet" href="<?php echo base_url().'assets/'; ?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url().'assets/'; ?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url().'assets/'; ?>assets/css/authentication.css">
    <link rel="stylesheet" href="<?php echo base_url().'assets/'; ?>assets/css/color_skins.css">
    <!-- Sweetalert Css -->
    <link href="<?php echo base_url().'assets/'; ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />


</head>

<body class="theme-orange">
<div class="authentication">
    <div class="card" style="margin-top: 90px; position: relative;">
        <div class="body">
            <div class="row" >
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="header slideDown">
                        <div class="logo"><img src="<?php echo base_url().'assets/'; ?>assets/images/logo_kab_mgl_sm.png" width="100" alt="Logo"></div>

                        <h1 style="color: #fff; margin-bottom: 0px; -webkit-text-stroke: 4px #000; -moz-text-stroke: 4px #000;">S I Y A P</h1>
                        <h1 style="color: #fff; margin-bottom: 0px; margin-top: -24.5px;">S I Y A P</h1>

                        <h1 style="color: #fff; margin-bottom: 0px; -webkit-text-stroke: 4px #000; -moz-text-stroke: 4px #000;">Aplikasi Layanan Cepat Tanggap</h1>
                        <h1 style="color: #fff; margin-bottom: 0px; margin-top: -50px;">Aplikasi Layanan Cepat Tanggap</h1>
                        
                        <!-- <h1 style="color: #fff; margin-bottom: 0px; -webkit-text-stroke: 5px #000; -moz-text-stroke: 5px #000;">Kabupaten Magelang</h1>
                        <h1 style="color: #fff; margin-bottom: 0px; margin-top: -24.5px;">Kabupaten Magelang</h1> -->

                        <!-- <label style="color: white; font-size: 10pt; font-weight: bold;">Comand Center</label> -->
                        <!-- <label style="color: #c41111; font-weight: bold; font-size: 16pt">Kabupaten Magelang</label> -->

                        <!-- <ul class="list-unstyled l-social">
                            <li><a href="#"><i class="zmdi zmdi-facebook-box"></i></a></li>
                            <li><a href="#"><i class="zmdi zmdi-linkedin-box"></i></a></li>                            
                            <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                        </ul> -->
                    </div>                        
                </div>
                <form class="col-lg-12 col-md-12 col-sm-12" id="sign_in">
                    <h5 class="title">Silahkan login dahulu</h5>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group form-float" style="margin-bottom: -20px">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="material-icons">person</i> </span>
                                <div class="form-line">
                                    <input required type="text" name="username" id="username" class="form-control">
                                    <label class="form-label">Username</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="material-icons">lock</i> </span>
                                <div class="form-line">
                                    <input required type="password" name="password" id="password" class="form-control">
                                    <label class="form-label">Password</label>
                                </div>
                            </div>
                        </div>
                    </div>
                                           
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="submit" class="btn btn-raised btn-block bg-dark-red waves-effect" style="color: white; font-weight: bold;">Login</button>
                        <!-- <a href="sign-up.html" class="btn btn-raised btn-default waves-effect">SIGN UP</a>                         -->
                    </div>
                      
                </form>                  
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="<?php echo base_url().'assets/'; ?>assets/bundles/libscripts.bundle.js"></script>    
<script src="<?php echo base_url().'assets/'; ?>assets/bundles/vendorscripts.bundle.js"></script>
<script src="<?php echo base_url().'assets/'; ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- Sweet Alert -->
<script src="<?php echo base_url().'assets/'; ?>assets/plugins/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 
<script src="<?php echo base_url().'assets/'; ?>assets/js/pages/ui/dialogs.js"></script> 

<script src="<?php echo base_url().'assets/'; ?>assets/js/pages/forms/form-validation.js"></script> 
<script src="<?php echo base_url().'assets/'; ?>assets/js/pages/forms/advanced-form-elements.js"></script> 
<script src="<?php echo base_url().'assets/'; ?>assets/js/pages/forms/basic-form-elements.js"></script>

<script src="<?php echo base_url().'assets/'; ?>assets/plugins/jquery-validation/jquery.validate.js"></script> <!-- Jquery Validation Plugin Css --> 
<script src="<?php echo base_url().'assets/'; ?>assets/plugins/jquery-steps/jquery.steps.js"></script> <!-- JQuery Steps Plugin Js --> 

<!-- <script src="<?php //echo base_url().'assets/'; ?>assets/bundles/mainscripts.bundle.js"></script> -->
<!-- Custom Js --> 


 <!-- Fungsi Dialog -->
<script type="text/javascript">
    //These codes takes from http://t4t5.github.io/sweetalert/
    function showBasicMessage() {
        swal("Here's a message!");
    }

    function showWithTitleMessage() {
        swal("Here's a message!", "It's pretty, isn't it?");
    }

    function validasiMessage(){
        swal({
            title: "Dilarang!",
            text: "Data tidak boleh lebih dari jumlah permintaan!",
            type: "error",
            timer: 1000,
            showConfirmButton: false
        });
    }

    function showSuccessMessage(input) {
        swal({
            title: input+"!",
            text: "Data Berhasil "+input+"!",
            type: "success",
            timer: 1000,
            showConfirmButton: false
        });
    }

    function showFailedMessage(input) {
        swal({
            title: "Gagal!",
            text: input,
            type: "error",
            timer: 1000,
            showConfirmButton: false
        });
    }

    function showConfirmMessage(id) {
        swal({
            title: "Anda yakin data akan dihapus?",
            text: "Data tidak akan dapat di kembalikan lagi!!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Hapus!",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('Damkar/deleteUnit')?>",
                dataType : "html",
                data : {id:id},
                success: function(data){
                    // alert(data);

                    $('#tbl-unit').DataTable().destroy();
                    showUnit();
                    $('#tbl-unit').DataTable().draw();
                    // kode_otomatis();
                    // $('#editModal #pilihBrg').attr('selected','');
                    // $('#editModal').modal('hide');

                    if(data=='Success'){
                        showSuccessMessage('Dihapus');
                    }else{
                        showFailedMessage('Dihapus');
                    } 
                }
            });
            return false;
            // swal("Hapus!", "Data telah berhasil dihapus.", "success");
        });
    }

    function showCancelMessage() {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        });
    }
</script>

<script type="text/javascript">
    $('#sign_in').submit(function(){
        var username = $('#username').val();
        var password = $('#password').val();
        // alert(username + password);
        // $('#coba').html(sabar);
        if (username=='' || password=='') {
            if (username=='') {
                $('#user').attr('class','form-line focused error');
                $('#error_username').html('Field harus diisi.');
            }
            if (password=='') {
                $('#pass').attr('class','form-line focused error');
                $('#error_password').html('Field harus diisi.');
            }
        }else{
            $('.page-loader-wrapper2').show();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('Login/cek_login')?>",
                // beforeSend: $('.page-loader-wrapper').show(),
                dataType : "html",
                data : {username:username , password:password},
                success: function(data){
                    // alert(data);
                    if(data=='Gagal'){
                        showFailedMessage('Username atau Password Salah!');
                    }
                    else {
                        window.location = '<?= base_url(); ?>'+data;
                    }
                }
            });
            return false;
        }
    });
</script>

</body>
</html>