<?php  ?>
<!DOCTYPE html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>COMMAND CENTER</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url().'assets/';?>assets/images/icon_kab_mgl2.png" type="image/x-icon">

    <link rel="stylesheet" href="<?php echo base_url().'assets/';?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="<?php //echo base_url().'assets/';?>assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css"/> -->
    <!-- <link rel="stylesheet" href="<?php //echo base_url().'assets/';?>assets/plugins/morrisjs/morris.css" /> -->

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?php echo base_url().'assets/';?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <!-- Wait Me Css -->
    <link href="<?php echo base_url().'assets/';?>assets/plugins/waitme/waitMe.css" rel="stylesheet" />
    <!-- Light Gallery Plugin Css -->
    <!-- <link href="<?php //echo base_url().'assets/';?>assets/plugins/light-gallery/css/lightgallery.css" rel="stylesheet"> -->

    <!-- Bootstrapt 4 Datepicker -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link href="<?=base_url().'assets/'; ?>assets/plugins/datepicker-4/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- daterange picker -->
    <!-- <link rel="stylesheet" href="<?php //echo base_url().'assets/';?>assets/plugins/daterangepicker/daterangepicker.css"> -->

    <!-- Colorpicker Css -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/';?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
    <!-- Multi Select Css -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/';?>assets/plugins/multi-select/css/multi-select.css">
    <!-- Select2 Css -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/';?>assets/vendors/css/forms/selects/select2.min.css">
    <!-- Bootstrap Spinner Css -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/';?>assets/plugins/jquery-spinner/css/bootstrap-spinner.css">
    <!-- Bootstrap Tagsinput Css -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/';?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
    <!-- Bootstrap Select Css -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/';?>assets/plugins/bootstrap-select/css/bootstrap-select.css" />
    <!-- noUISlider Css -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/';?>assets/plugins/nouislider/nouislider.min.css" />
    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/';?>assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">

    <!-- Sweetalert Css -->
    <link href="<?php echo base_url().'assets/'; ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/';?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url().'assets/';?>assets/css/color_skins.css">

    <!-- Fancybox -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/';?>assets/plugins/fancybox/jquery.fancybox.css">

    <!-- Dropify -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/';?>assets/plugins/dropify/dist/css/dropify.min.css">
    
    <!-- OpenStreetMap -->
    <!-- <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css"> -->
    <!-- <link rel="stylesheet" href="https://openlayers.org/en/v5.3.0/css/ol.css" type="text/css"> -->
    <!-- <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script> -->

    {{-- ==================================================================================== --}}

    @yield('header')


    <style type="text/css">
      #pop p{
        margin-bottom: -10px;
      }

      .sizeFontSm{
          font-size: 9pt;
      }
    </style>

  <script>
      function setTheme(data) {

        var name_theme = $(data).data('theme');

          var settings = {
              theme: name_theme,
          };

          localStorage.setItem('settings', JSON.stringify(settings));

          // settings = JSON.parse(localStorage.getItem('settings'));

          // $('body').removeClass().addClass('theme-' + settings.theme);
          // $(".right-sidebar .choose-skin li data-theme['"+settings.theme+"']").addClass("active");

          console.log(settings.theme); 
      }

      function loadTheme() {
        settings = JSON.parse(localStorage.getItem('settings'));
        if(settings){
          $('body').removeClass().addClass('theme-' + settings.theme);
          $(".right-sidebar .choose-skin li[data-theme='"+settings.theme+"']").addClass("active");
        } else {
          $('body').removeClass().addClass('theme-orange');
          $(".right-sidebar .choose-skin li[data-theme='orange']").addClass("active");
        }
        
      }

  </script>

</head>

<body class="theme-orange" onload="loadTheme();">
    <!-- Page Loader -->
   <div class="page-loader-wrapper">
        <div class="loader">        
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <p>Please wait...</p>
            <!-- <div class="m-t-30"><img src="assets/images/logo.svg" width="48" height="48" alt="Nexa"></div> -->
        </div>
    </div>


   <!--  <div class="page-loader-wrapper2">
        <div class="loader">
            <div class="preloader pl-size-xl">
                <div class="spinner-layer">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div> -->

    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
   