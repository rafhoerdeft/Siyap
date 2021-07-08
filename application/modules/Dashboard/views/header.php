<?php  ?>
<!DOCTYPE html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>SIYAP COMMAND CENTER</title>
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
    <!-- <link href="<?//= base_url().'assets/'; ?>assets/plugins/datepicker-4/gijgo.min.css" rel="stylesheet" type="text/css" /> -->

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
    <!-- <link rel="stylesheet" href="<?php //echo base_url().'assets/';?>assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css"> -->

    <link rel="stylesheet" href="<?php echo base_url().'assets/';?>assets/css/hm-style.css">


    <!-- Sweetalert Css -->
    <link href="<?php echo base_url().'assets/'; ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/';?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url().'assets/';?>assets/css/color_skins.css">

    <!-- Fancybox -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/';?>assets/plugins/fancybox/jquery.fancybox.css">
    
    <!-- OpenStreetMap -->
    <!-- <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css"> -->
    <!-- <link rel="stylesheet" href="https://openlayers.org/en/v5.3.0/css/ol.css" type="text/css"> -->
    <!-- <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script> -->

    <!-- Leafleat Plugin CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>

    <!-- Cluster Marker CSS-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />

   <!-- Cluster Marker JS-->
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>

    <!-- Leafleat Plugin JS -->
   <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
   integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
   crossorigin=""></script>

   <!-- <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=geometry&key=AIzaSyDcBM8hFljWAtmwZC82_bMjtiI169z_n7k"></script> -->

    <!-- <script type="text/javascript" src="https://gist.github.com/raw/4504864/c9ef880071f959398b7cf0b687d4f37c352ea86d/leaflet-google.js"></script> -->

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
        .outerMap{
            border: 5px solid #6284bc;
        }
        .outerMapFlash{
            /*width: 100%; 
            height: 100%; */
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

    <style>
      html{
        height: 100%;
      }
      body{
        height: 84.5%;
      }

      .content, .card, .card > .body-atas, .tab-content, .tab-pane{
        height: 100%;
      }

      #statistik{
        overflow: auto;
      }
  
      @media only screen and (max-width: 959px){
      body {
        height: 90%;
      }
      .tab-content{
          overflow: auto;
        }
      }
    </style>

    <style type="text/css">
      #pop p{
        margin-bottom: -10px;
      }
    </style>

     <!-- Jquery Core Js -->
     <script src="<?php echo base_url().'assets/'; ?>assets/bundles/libscripts.bundle.js"></script>    
    <script src="<?php echo base_url().'assets/'; ?>assets/bundles/vendorscripts.bundle.js"></script>

    <script>
      function loadTheme() {
        settings = JSON.parse(localStorage.getItem('settings'));
        console.log(settings);
        if(settings){
          $('body').removeClass().addClass('theme-' + settings.theme).addClass('index2');
          $(".right-sidebar li[data-theme='"+settings.theme+"']").addClass("active");
        } else {
          $('body').removeClass().addClass('theme-blue').addClass('index2');
          $(".right-sidebar li[data-theme='blue']").addClass("active");
        }
        
      }

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

      
      $(document).ready(function(){
        loadTheme();
      });     

    </script>
</head>

<body class="theme-blue index2">
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
   
   