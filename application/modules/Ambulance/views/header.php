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
    
    <!-- OpenStreetMap -->
    <!-- <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css"> -->
    <link rel="stylesheet" href="https://openlayers.org/en/v5.3.0/css/ol.css" type="text/css">
    <!-- <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script> -->

    <style>
      .ol-popup {
        position: absolute;
        background-color: white;
        -webkit-filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));
        filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));
        padding: 15px;
        border-radius: 10px;
        border: 1px solid #cccccc;
        bottom: 12px;
        left: -50px;
        min-width: 280px;
      }
      .ol-popup:after, .ol-popup:before {
        top: 100%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
      }
      .ol-popup:after {
        border-top-color: white;
        border-width: 10px;
        left: 48px;
        margin-left: -10px;
      }
      .ol-popup:before {
        border-top-color: #cccccc;
        border-width: 11px;
        left: 48px;
        margin-left: -11px;
      }
      .ol-popup-closer {
        text-decoration: none;
        position: absolute;
        top: 2px;
        right: 8px;
      }
      .ol-popup-closer:after {
        content: "✖";
      }
    </style>
    
    <!-- Style Flash Button -->
    <style type="text/css">
        .buttonFlashOn {
          background-color: #004A7F;
          -webkit-border-radius: 1px;
          border-radius: 1px;
          border: none;
          color: #FFFFFF;
          cursor: pointer;
          display: inline-block;
          font-family: Arial;
          font-size: 13px;
          padding: 5px 15px;
          text-align: center;
          text-decoration: none;
          -webkit-animation: glowing 1500ms infinite;
          -moz-animation: glowing 1500ms infinite;
          -o-animation: glowing 1500ms infinite;
          animation: glowing 1500ms infinite;
        }
        @-webkit-keyframes glowing {
          0% { background-color: #B20000; -webkit-box-shadow: 0 0 3px #B20000; }
          50% { background-color: #FF0000; -webkit-box-shadow: 0 0 40px #FF0000; }
          100% { background-color: #B20000; -webkit-box-shadow: 0 0 3px #B20000; }
        }

        @-moz-keyframes glowing {
          0% { background-color: #B20000; -moz-box-shadow: 0 0 3px #B20000; }
          50% { background-color: #FF0000; -moz-box-shadow: 0 0 40px #FF0000; }
          100% { background-color: #B20000; -moz-box-shadow: 0 0 3px #B20000; }
        }

        @-o-keyframes glowing {
          0% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
          50% { background-color: #FF0000; box-shadow: 0 0 40px #FF0000; }
          100% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
        }

        @keyframes glowing {
          0% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
          50% { background-color: #FF0000; box-shadow: 0 0 40px #FF0000; }
          100% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
        }

        .buttonFlashOff{
          background-color: #004A7F;
          -webkit-border-radius: 1px;
          border-radius: 1px;
          border: none;
          color: #FFFFFF;
          cursor: pointer;
          display: inline-block;
          font-family: Arial;
          font-size: 13px;
          padding: 5px 15px;
          text-align: center;
          text-decoration: none;
        }
    </style>

    <!-- Style Frame Map -->
    <style type="text/css">
        .map{
            width: 100%; 
            height: 100%; 
            border: 5px solid #6284bc;
        }
        .mapFlash{
            width: 100%; 
            height: 100%; 
            border: 5px solid #004A7F;
            -webkit-animation: glow 1500ms infinite;
            -moz-animation: glow 1500ms infinite;
            -o-animation: glow 1500ms infinite;
            animation: glow 1500ms infinite;
        }
        @-webkit-keyframes glow {
          0% { border-color: #B20000; -webkit-box-shadow: 0 0 3px #B20000; }
          50% { border-color: #FF0000; -webkit-box-shadow: 0 0 40px #FF0000; }
          100% { border-color: #B20000; -webkit-box-shadow: 0 0 3px #B20000; }
        }

        @-moz-keyframes glow {
          0% { border-color: #B20000; -moz-box-shadow: 0 0 3px #B20000; }
          50% { border-color: #FF0000; -moz-box-shadow: 0 0 40px #FF0000; }
          100% { border-color: #B20000; -moz-box-shadow: 0 0 3px #B20000; }
        }

        @-o-keyframes glow {
          0% { border-color: #B20000; box-shadow: 0 0 3px #B20000; }
          50% { border-color: #FF0000; box-shadow: 0 0 40px #FF0000; }
          100% { border-color: #B20000; box-shadow: 0 0 3px #B20000; }
        }

        @keyframes glow {
          0% { border-color: #B20000; box-shadow: 0 0 3px #B20000; }
          50% { border-color: #FF0000; box-shadow: 0 0 40px #FF0000; }
          100% { border-color: #B20000; box-shadow: 0 0 3px #B20000; }
        }
    </style>
</head>

<body class="theme-orange">
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
   