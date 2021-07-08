<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Dashboard <?= $kategori ?>
                <!-- <small class="text-muted">Welcome to Nexa Application</small> -->
                </h2>
            </div>
            <!-- <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Nexa</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div> -->
        </div>
    </div>

    <div class="container-fluid">
        <!-- Widgets -->
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
              <div class="body"> 
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs">
                      <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#peta">MAP</a></li>
                      <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#laporan">LAPORAN</a></li>
                  </ul>                        
                  <!-- Tab panes -->
                  <div class="tab-content">
                      <div role="tabpanel" class="tab-pane in active" id="peta">
                          <div class="col-lg-12 col-md-12 col-sm-12" style="height: 500px">
                            <div id="map" class="map">
                                <div style="width: 130px; height: 70px; background-color: #6284bc; z-index: 2; position: relative; float: right; margin-bottom: -70px; text-align: center; padding: 5px;">
                                  <label id="info" style="color: white;">Jml. Laporan: 0</label>
                                  <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                      <button id="btn_sirine" class="buttonFlashOff" onclick="closeFlash(); closeSirine();">Matikan Sirine</button>
                                    </div>
                                  </div>
                                </div>

                                <div style="z-index: 2; position: absolute; margin-top: 455px; margin-left: 10px">
                                  <img src="<?= base_url().'assets/path_logo/ICON-SIYAP-SM-2.png' ?>">
                                </div>

                                <div id="popup" class="ol-popup">
                                  <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                                  <div id="popup-content" style="font-size: 9pt;"></div>
                                </div>
                            </div>
                          </div>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="laporan">
                        <b>LAPORAN KEJADIAN</b><br>
                        <div style="display: flex; overflow-x: auto;"> 
                          <table class="table table-bordered table-striped table-hover responsive" id="table_laporan" style="overflow-x: auto;">
                            <thead>
                              <tr>
                                  <th width="3%">#</th>
                                  <th width="8%">ID</th>
                                  <th width="15%">Pelapor</th>
                                  <th width="35%">Alamat Kejadian</th>
                                  <th width="20%">Keterangan</th>
                                  <th width="15%">Waktu Lapor</th>
                                  <th width="7%">Foto</th>
                                  <!-- <th width="7%">Status</th> -->
                              </tr>
                            </thead>
                            <tbody id="lapor_content">
                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>

        </div>
        <!-- #END# Widgets -->
    </div>
</section>

<script type="text/javascript">
   window.onload = function () {
      initialize_map();
      $('#popup').hide();
  }
</script>

<script type="text/javascript">
  function fancy() {
    $('.foto_kejadian').fancybox({});
  }
</script>

<!-- <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script> -->
<script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script>
<script src="https://www.gstatic.com/firebasejs/5.9.4/firebase.js"></script>

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
      document.getElementById("map").className = "map";
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

<script type="text/javascript">
  function addZero(n){
    if(n <= 9){
      return "0" + n;
    }
    return n
  }
</script>

<!-- OpenStreetMap Config -->
<script>  
    /* OSM & OL example code provided by https://mediarealm.com.au/ */
    var map;
    var markers = [];
    var mapLat = -7.5919789;
    var mapLng = 110.219374;
    var mapDefaultZoom = 15;
    var element;
    var popup;
    var aduan = 0;
    var element = document.getElementById('popup');
    var content = document.getElementById('popup-content');
    var closer = document.getElementById('popup-closer');
    var audio = [];
    var nom = 0;

    function maping(lat, lng) {
      map = new ol.Map({
        target: "map",
        loadTilesWhileAnimating: true,
        // controls: defaultControls({attribution: false}).extend([attribution]),
        layers: [
          new ol.layer.Tile({
            source: new ol.source.OSM({
              url: "https://a.tile.openstreetmap.org/{z}/{x}/{y}.png",
              crossOrigin: ''
            })
          })
        ],
        view: new ol.View({
          center: ol.proj.fromLonLat([lng, lat]),
          zoom: mapDefaultZoom,
          maxZoom: 18,
          minZoom: 8
        })
      });
    }

    function initialize_map() {
      maping(mapLat, mapLng);

      // var overlay = new ol.Overlay({
      //   element: element,
      //   autoPan: true,
      //   autoPanAnimation: {
      //     duration: 250
      //   }
      // });
      // map.addOverlay(overlay);
      
      var database = firebase.database().ref().child('/<?= $kategori ?>');
      database.on('child_added', function(snapshot){
        if(snapshot.exists()){
            var zoom = map.getView().getZoom();
            add_map_point(snapshot);

            if (snapshot.val().role == 'User'){
              audio[snapshot.key] = new Audio('<?= base_url(); ?>assets/audio/Sirine.mp3');
              audio[snapshot.key].play();
              audio[snapshot.key].loop = true;

              // ---Change View Camera---
              map.setView(new ol.View({
                  center: ol.proj.fromLonLat([snapshot.val().longitude, snapshot.val().latitude]),
                  zoom: zoom
                })
              );

              aduan++;
              $('#info').html('Jml. Laporan: '+aduan);
              // $('#btn_sirine').className = "buttonFlashOn";
              document.getElementById("btn_sirine").className = "buttonFlashOn";
              document.getElementById("map").className = "mapFlash";

              // Add row tabel laporan
              $.post("<?= base_url() ?>/Dashboard/dataLap", {id_lap: snapshot.val().id_lapor, kategori: "<?= $kategori ?>"}, function(result){

                var datas = JSON.parse(result);

                var tgl_lapor = new Date(datas.tgl_lapor);
                var waktu = addZero(tgl_lapor.getDate())+'-'+addZero(tgl_lapor.getMonth()+1)+'-'+tgl_lapor.getFullYear()+' ('+addZero(tgl_lapor.getHours())+':'+addZero(tgl_lapor.getMinutes())+')';
                nom++;
                var contentLap =  '<tr id='+snapshot.val().id_lapor+'>'+
                                    '<td>'+nom+'</td>'+
                                    '<td>'+snapshot.val().id_lapor+'</td>'+
                                    '<td>'+snapshot.val().nama_pelapor+'</td>'+
                                    '<td>'+snapshot.val().alamat+'</td>'+
                                    '<td>'+snapshot.val().keterangan+'</td>'+
                                    '<td>'+waktu+'</td>'+
                                    '<td>'+
                                      "<a class='foto_kejadian' href=<?= base_url().'assets/path_laporan/' ?>"+snapshot.val().image_lapor+"> <button onclick='fancy()' class='btn btn-block bg-green waves-effect'>KEJADIAN</button> </a> <br>"+
                                     "<a class='foto_kejadian' href=<?= base_url().'assets/path_selfie/' ?>"+snapshot.val().image_selfie+"> <button onclick='fancy()' class='btn btn-block bg-pink waves-effect'>PELAPOR</button> </a>"+
                                    '</td>'+
                                    // '<td>'+datas.status+'</td>'+
                                  '</tr>';
                $('#lapor_content').append(contentLap);
              });
              
            }
            // maping(snapshot.val().latitude, snapshot.val().longitude);
        }
      });

      database.on('child_changed', function(snapshot){
        if(snapshot.exists()){
            var zoom = map.getView().getZoom();
            map.removeLayer(markers[snapshot.key]);
            add_map_point(snapshot);

            // overlay.setPosition(ol.proj.fromLonLat([snapshot.val().longitude, snapshot.val().latitude]));

            // ---Change Camera---
            // map.setView(new ol.View({
            //     center: ol.proj.fromLonLat([snapshot.val().longitude, snapshot.val().latitude]),
            //     zoom: zoom
            //   })
            // );

            // map.setView(new ol.View.animate({
            //     center: ol.proj.fromLonLat([snapshot.val().longitude, snapshot.val().latitude]),
            //     duration: 3000,
            //     zoom: zoom
            //   })
            // );
            // maping(snapshot.val().latitude, snapshot.val().longitude);
        }
      });

      database.on('child_removed', function(snapshot){
        if(snapshot.exists()){
            // window.alert(snapshot.key);
            map.removeLayer(markers[snapshot.key]);

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
        var vectorLayer = new ol.layer.Vector({
          source: new ol.source.Vector({
            features: [
              new ol.Feature({
                geometry: new ol.geom.Point(ol.proj.transform([parseFloat(lng), parseFloat(lat)], 'EPSG:4326', 'EPSG:3857')),
                nama: data.val().nama_pelapor,
                key: data.key,
                id_lapor: data.val().id_lapor,
                id_user: data.val().id_user,
                alamat: data.val().alamat,
                role: 'User',
                status: data.val().status,
                keterangan: data.val().keterangan,
                img_kejadian: data.val().image_lapor,
                img_selfie: data.val().image_selfie
              })
            ]
          }),
          style: new ol.style.Style({
            image: new ol.style.Icon({
              anchor: [0.5, 46],
              anchorXUnits: 'fraction',
              anchorYUnits: 'pixels',
              src: "<?= base_url(); ?>assets/assets/images/marker-aduan-min.png"
            })
          })
        });
      }else{
        var vectorLayer = new ol.layer.Vector({
          source: new ol.source.Vector({
            features: [
              new ol.Feature({
                geometry: new ol.geom.Point(ol.proj.transform([parseFloat(lng), parseFloat(lat)], 'EPSG:4326', 'EPSG:3857')),
                key: data.key,
                nama: data.val().nama_petugas,
                id_lapor: data.val().id_lapor,
                alamat: data.val().alamat,
                nama_pelapor: data.val().nama_pelapor,
                role: 'Petugas'
              })
            ]
          }),
          style: new ol.style.Style({
            image: new ol.style.Icon({
              anchor: [0.5, 46],
              anchorXUnits: 'fraction',
              anchorYUnits: 'pixels',
              // src: 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/93/Map_marker_font_awesome.svg/50px-Map_marker_font_awesome.svg.png'
              src: "<?= base_url(); ?>assets/assets/images/Marker-damkar-min.png"
            })
          })
        });
      }
      
      markers[data.key] = vectorLayer;
      map.addLayer(vectorLayer);

      closer.onclick = function() {
        popup.setPosition(undefined);
        closer.blur();
        return false;
      };

      popup = new ol.Overlay({
        element: element,
        positioning: 'bottom-center',
        stopEvent: false,
        offset: [0, -50]
      });
      map.addOverlay(popup);

      // display popup on click
      map.on('singleclick', function(evt) {
        $('#popup').show();
        var feature = map.forEachFeatureAtPixel(evt.pixel,
          function(feature) {
            return feature;
          }
        );
        // alert(feature);
        if (feature) {
          if (feature.get('role')=='User') {

            // if (aduan == 1) {
            //   closeFlash();
            // }
            
            // Stop Audio
            // audio[feature.get('key')].pause();
            // audio[feature.get('key')].currentTime = 0;

            var coordinates = feature.getGeometry().getCoordinates();
            var ket = feature.get('keterangan');
            var keterangan = '';
            if (ket == '' || ket == undefined) {
              keterangan = 'Tidak ada';
            }else{
              keterangan = ket;
            }
            var contents = '<p>ID Aduan: <b>'+feature.get('id_lapor')+'</b></p>'+
                           '<p>Nama Pelapor: <b>'+feature.get('nama')+'</b></p>'+
                           '<p>Alamat Kejadian: <br><b>'+feature.get('alamat')+'</b></p>'+
                           '<p>Keterangan: <br><b>'+keterangan+'</b></p>'+
                           "<p><center>"+
                           // "<div id='aniimated-thumbnials'>"+
                           // "<a class='foto_kejadian' href=<?//= base_url().'assets/path_laporan/' ?>"+feature.get('img_kejadian')+" rel='saksake'> <img class='img-fluid img-thumbnail' height='150' src=<?//= base_url().'assets/path_laporan/' ?>"+feature.get('img_kejadian')+" alt=''> </a>"+
                           "<a class='foto_kejadian' href=<?= base_url().'assets/path_laporan/' ?>"+feature.get('img_kejadian')+" rel='kejadian'> <button class='btn btn-block bg-green waves-effect'>FOTO KEJADIAN</button> </a>"+
                           "<a class='foto_kejadian' href=<?= base_url().'assets/path_selfie/' ?>"+feature.get('img_selfie')+" rel='selfie'> <button class='btn btn-block bg-pink waves-effect'>FOTO PELAPOR</button> </a>"+
                           // "</div>"+
                           "</center></p>";
                           // "<img src=<?//= base_url().'assets/path_laporan/' ?>"+feature.get('img')+" height='150'></p>";
            // contents += "<input class='btn btn-block btn-raised btn-primary waves-effect' type='button' name='Selesai' value='Selesai' onclick='lapSelesai("+feature.get('id_lapor')+", "+feature.get('key')+")'>";
            content.innerHTML = contents;

            // content.innerHTML = '<p>Alamat:</p><p>'+feature.get('alamat')+'</p>';
            popup.setPosition(coordinates);

            $('.foto_kejadian').fancybox({});
          }else{
            var coordinates = feature.getGeometry().getCoordinates();
            var contents = '<p>ID Aduan: <b>'+feature.get('id_lapor')+'</b></p>'+
                           '<p>Nama Petugas: <b>'+feature.get('nama')+'</b></p>';
                           
            content.innerHTML = contents;

            // content.innerHTML = '<p>Alamat:</p><p>'+feature.get('alamat')+'</p>';
            popup.setPosition(coordinates);
          }
        } 
      });
    }
</script>

