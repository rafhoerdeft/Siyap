@layout('layouts/master')

@section('header')
    <!-- Leaflet Plugin CSS-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>

    <!-- Cluster Marker CSS-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
    
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
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>TRACKING DAMKAR</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="col-lg-12 col-md-12 col-sm-12" style="height: 525px">

                <div id="outerMap" class="outerMap" style="width: 100%; height: 100%; z-index: 2;">

                  <div style="width: 130px; height: 70px; background-color: #6284bc; z-index: 1; position: relative; float: right; margin-bottom: -70px; text-align: center; padding: 5px;">
                    <label id="info" style="color: white;">Jml. Laporan: 0</label>
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <button id="btn_sirine" class="buttonFlashOff" onclick="closeFlash(); closeSirine();">Matikan Sirine</button>
                      </div>
                    </div>
                  </div>

                  <div style="z-index: 2; position: absolute; margin-top: 480px; margin-left: 12px">
                    <img src="<?= base_url().'assets/path_logo/ICON-SIYAP-SM-2.png' ?>">
                  </div>

                  <div id="map" class="map" style="width: 100%; height: 100%; z-index: 0;"></div>
                </div>
              </div>
          </div>
        </div>
        <!-- #END# Widgets -->
    </div>
  </section>

  <!-- Modal Batalkan Laporan -->
  <div class="modal fade" id="modal_batal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <form name="laporan" id="lp" method="post" action="">
                        <input type="hidden" name="id_lapor" id="id_lapor">
                        <!-- <div class="modal-header"> -->
                            
                        <!-- </div> -->
                        <div class="modal-body" id="print-page">
                            <center>
                                <h4 class="modal-title" id="defaultModalLabel">Batalkan Laporan</h4>
                            </center>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-line" style="margin-top: -5px;">
                                            <!-- <input type="text" class="form-control" name="almt_korban" id="almt_korban" required style="margin-bottom: -4px;"> -->
                                            Keterangan Batal
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="ket_batal" id="ket_batal" required style="margin-bottom: -4px;" placeholder="Masukkan Keterangan"></textarea>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="batalkanLap()" id="btn_simpan" class="btn btn-primary waves-effect">BATALKAN</button>
                            <button type="reset" id="btn_simpan" class="btn btn-warning waves-effect">RESET</button>
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
    
  <!-- Cluster Marker JS-->
  <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>

  <!-- Leaflet Plugin CSS-->
  <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
  integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
  crossorigin=""></script>

  <!-- <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script> -->
  <!-- <script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script> -->
  <script src="https://www.gstatic.com/firebasejs/5.9.4/firebase.js"></script>

  <script type="text/javascript">
    window.onload = function () {
        initialize_map();
        loadTheme();
        // $('#popup').hide();
    }
  </script>

  <script type="text/javascript">
    function fancys() {
      $('.foto_kejadian').fancybox({});
    }
  </script>

  <!-- Initialize Firebase -->
  <script type="text/javascript">
      var config = {
          apiKey: "AIzaSyAPkOj6yMUHNvvcVRiAjntLd8Y5Rb5UQs8",
        authDomain: "panicbutton-1554857641771.firebaseapp.com",
        databaseURL: "https://panicbutton-1554857641771.firebaseio.com",
        projectId: "panicbutton-1554857641771",
        storageBucket: "panicbutton-1554857641771.appspot.com",
        messagingSenderId: "306651005669",
        appId: "1:306651005669:web:6a599479b6308d48"
      };

      firebase.initializeApp(config);
  </script>

  <script type="text/javascript">
      // Change Style Flash
      function closeFlash() {
        document.getElementById("btn_sirine").className = "buttonFlashOff";
        document.getElementById("outerMap").className = "outerMap";
      }

      // Stop Sirine Sound
      function closeSirine() {
        // Loop variable array using key
        Object.keys(audio).forEach(function (key) {
          audio[key].pause();
          audio[key].currentTime = 0;
        });
      }
  </script>

  <!-- OpenStreetMap Config -->
  <script>  
      /* OSM & OL example code provided by https://mediarealm.com.au/ */
      var map;
      var markers = [];
      var mapLat = -7.50273; 
      var mapLng = 110.25227;
      var mapDefaultZoom = 11;
      var element;
      // var popup;
      var aduan = 0;
      var audio = [];
      var nom = 0;


      var mymap = L.map('map', {attributionControl: false});
      var layer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
          // attribution: '&copy; <a href="<?= base_url() ?>">SIYAP</a> Application',
          maxZoom: 18,
          minZoom: 8,
      });
      layer.addTo(mymap);

      var wilayah = L.imageOverlay("<?= base_url().'assets/path_vector/batas_kab_mgl_new_2.svg' ?>", [[-7.71664, 110.03432],[-7.31243, 110.45586]], {opacity: 0.8}).addTo(mymap);

      // Add Attribution Control
      var attributionControl = L.control({
        position: "bottomright"
      });
      attributionControl.onAdd = function (map) {
        var div = L.DomUtil.create("div", "leaflet-control-attribution");
        div.innerHTML = "<a href='#'>SIYAP</a>";
        return div;
      };
      mymap.addControl(attributionControl);
      // =======================================================

      var setView = mymap.setView([mapLat, mapLng], mapDefaultZoom);
      var icons = L.Icon.extend({
          options: {
              // shadowUrl: 'leaf-shadow.png',
              // iconSize:     [38, 95],
              // shadowSize:   [50, 64],
              iconAnchor: [12, 46],
              // shadowAnchor: [4, 62],
              popupAnchor:  [3, -45]
          },
      });

      // =================================================================================

      function initialize_map() {

        var database = firebase.database().ref().child('/Damkar');
        database.on('child_added', function(snapshot){
          if(snapshot.exists()){

              if (snapshot.val().role == 'User'){
                audio[snapshot.key] = new Audio('<?= base_url(); ?>assets/audio/Sirine.mp3');
                audio[snapshot.key].play();
                audio[snapshot.key].loop = true;

                // ---Change View Camera---
                var setView = mymap.setView([parseFloat(snapshot.val().latitude), parseFloat(snapshot.val().longitude)], mapDefaultZoom);

                aduan++;
                $('#info').html('Jml. Laporan: '+aduan);
                // $('#btn_sirine').className = "buttonFlashOn";
                document.getElementById("btn_sirine").className = "buttonFlashOn";
                document.getElementById("outerMap").className = "outerMapFlash";
              }
              add_map_point(snapshot);
          }
        });

        database.on('child_changed', function(snapshot){
          if(snapshot.exists()){
              mymap.removeLayer(markers[snapshot.key]);
              add_map_point(snapshot);
          }
        });

        database.on('child_removed', function(snapshot){
          if(snapshot.exists()){
              // window.alert(snapshot.key);
              mymap.removeLayer(markers[snapshot.key]);

              if (snapshot.val().role == 'User'){
                aduan--;
                $('#info').html('Jml. Laporan: '+aduan);

                // Remove row tabel laporan
                $('#'+snapshot.val().id_lapor).remove();
                nom--;
              }
          }
        });
      }

      function add_map_point(data) {
        var lat = data.val().latitude;
        var lng = data.val().longitude;

        if (data.val().role == 'User') {

          var nama = data.val().nama_pelapor;
          var key = data.key;
          var id_lapor = data.val().id_lapor;
          var id_user = data.val().id_user;
          var alamat = data.val().alamat;
          var role = 'User';
          var status = data.val().status;
          var ket = data.val().keterangan;
          var img_kejadian = data.val().image_lapor;
          var img_selfie = data.val().image_selfie;

          var keterangan = '';
          if (ket == '' || ket == undefined) {
            keterangan = 'Tidak ada';
          }else{
            keterangan = ket;
          }
          var contents = '<div id="pop">'+
                          '<p>ID Aduan: <b>'+id_lapor+'</b></p>'+
                          '<p>Nama Pelapor: <b>'+nama+'</b></p>'+
                          '<p>Alamat Kejadian: <br><b>'+alamat+'</b></p>'+
                          '<p>Keterangan: <br><b>'+keterangan+'</b></p>'+
                          "<p><center>"+
                          // "<div id='aniimated-thumbnials'>"+
                          // "<a class='foto_kejadian' href=<?//= base_url().'assets/path_laporan/' ?>"+img_kejadian+" rel='saksake'> <img class='img-fluid img-thumbnail' height='150' src=<?//= base_url().'assets/path_laporan/' ?>"+img_kejadian+" alt=''> </a>"+
                          "<a class='foto_kejadian' href=<?= base_url().'assets/path_laporan/' ?>"+img_kejadian+" rel='kejadian'> <button onclick='fancys()' class='btn btn-block bg-green waves-effect'>FOTO KEJADIAN</button> </a>"+
                          "<a class='foto_kejadian' href=<?= base_url().'assets/path_selfie/' ?>"+img_selfie+" rel='selfie'> <button style='margin-bottom:10px' onclick='fancys()' class='btn btn-block bg-pink waves-effect'>FOTO PELAPOR</button> </a>"+
                          // "</div>"+
                          "</center></p>"+
                          '</div>';
                        // "<img src=<?//= base_url().'assets/path_laporan/' ?>"+feature.get('img')+" height='150'></p>";

          // content.innerHTML = '<p>Alamat:</p><p>'+feature.get('alamat')+'</p>';
          contents += '<div class="row">'+
                        '<div class="col-md-6 col-md-6 col-lg-6">'+
                          "<input class='btn btn-block btn-raised btn-primary waves-effect' type='button' name='Selesai' value='Selesai' onclick='lapSelesai("+id_lapor+", "+key+")'>"+
                        '</div>'+
                        '<div class="col-md-6 col-md-6 col-lg-6">'+
                        "<button class='btn btn-block btn-raised btn-danger waves-effect' type='button' name='Batal' data-toggle='modal' data-target='#modal_batal' onclick='lapBatal("+id_lapor+")'>Batal</button>"
                        '</div>'+
                      '</div>';

          var iconAduan = new icons({iconUrl: "<?= base_url(); ?>assets/assets/images/marker-aduan-min.png"});
          var marker = L.marker([parseFloat(lat), parseFloat(lng)],{icon: iconAduan}).addTo(mymap);
          var popup = marker.bindPopup(contents);
        }else{
          var key = data.key;
          var nama = data.val().nama_petugas;
          var id_lapor = data.val().id_lapor;
          var alamat = data.val().alamat;
          var nama_pelapor = data.val().nama_pelapor;
          var role = 'Petugas';

          var contents = '<div id="pop">'+
                          '<p>ID Aduan: <b>'+id_lapor+'</b></p>'+
                          '<p>Nama Petugas: <b>'+nama+'</b></p>'+
                          '<br>'+
                        '</div>';

          var iconAduan = new icons({iconUrl: "<?= base_url(); ?>assets/assets/images/Marker-damkar-min.png"});
          var marker = L.marker([parseFloat(lat), parseFloat(lng)],{icon: iconAduan}).addTo(mymap);
          var popup = marker.bindPopup(contents);
        }
      
        markers[data.key] = marker;
      }
  </script>

  <!-- Event Laporan Selesai -->
  <script type="text/javascript">
    function lapSelesai(id, key) {
        // alert(id+' - '+key);
        swal({
            title: "Aduan",
            text: "Apakah aduan ini sudah selesai?",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            setTimeout(function () {
                // var remove = firebase.database().ref('Damkar/'+key).remove();
                var remove = 0;
                var ref = firebase.database().ref().child('/Damkar');
                var query = ref.orderByChild("id_lapor").equalTo(id);
                query.once("value", function(snapshot) {
                  snapshot.forEach(function(child) {
                    child.ref.remove();
                    remove++;
                  });
                });

                if (remove > 0) {
                    $.post("<?= base_url() ?>/Damkar/lapSelesai", {id_lap: id, key: key}, function(result){
                      // alert(result);
                        if (result == 'Success') {
                          swal("Aduan sudah selesai!");
                          popup.setPosition(undefined);
                          closer.blur();
                        }else{
                          swal("Gagal!");
                        }
                    });
                }else{
                    swal("Gagal!");
                }
            }, 700);
        });
    }
  </script>

  <!-- Event Batalkan Laporan -->
  <script type="text/javascript">
      function lapBatal(id='') {
          // alert(id);
          $('#modal_batal #id_lapor').val(id);
      }

      function batalkanLap() {
          var id = $('#modal_batal #id_lapor').val();
          var ket = $('#modal_batal #ket_batal').val();

          var ids = parseInt(id);
            swal({
                title: "Batalkan Laporan",
                text: "Apakah laporan ini akan dibatalkan?",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function () {
                  setTimeout(function () {

                          $.post("<?= base_url() ?>/Damkar/lapBatal", {id_lap: id, ket: ket}, function(result){
                            // alert(result);
                              if (result == 'Success') {

                                // var remove = firebase.database().ref('Damkar/'+key).remove();
                                  var removes = 0;
                                  var ref = firebase.database().ref().child('/Damkar');
                                  var query = ref.orderByChild("id_lapor").equalTo(ids);
                                  query.once("value", function(snapshot) {
                                    snapshot.forEach(function(child) {
                                      removes++;
                                      // alert(child.key);
                                      child.ref.remove();
                                    });
                                    // alert(removes);
                                    if (removes > 0) {
                                      swal("Laporan sudah dibatalkan!"); 
                                      location.reload();
                                    }else{
                                      swal("Gagal!");
                                    }
                                  });  

                              }else{
                                swal("Gagal!");
                              }
                          });
                  }, 700);
            });
      }
  </script>
@endsection
