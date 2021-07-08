<section class="content">
    <!-- <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Dashboard <?//= $kategori ?> -->
                <!-- <small class="text-muted">Welcome to Nexa Application</small> -->
                <!-- </h2>
            </div> -->
            <!-- <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Nexa</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div> -->
        <!-- </div>
    </div> -->

    <!-- <div class="container-fluid"> -->
        <!-- Widgets -->
        <!-- <div class="row"> -->
          <!-- <div class="col-lg-12 col-md-12 col-sm-12"> -->
            <div class="card">
              <div class="body body-atas"> 
                  <!-- Nav tabs -->
                  <!-- <ul class="nav nav-tabs">
                      <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#peta">MAP</a></li>
                      <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#laporan">LAPORAN</a></li>
                      <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#statistik">STATISTIK</a></li>
                  </ul>                         -->
                  <!-- Tab panes -->
                  <div class="tab-content">
                      <div role="tabpanel" class="tab-pane in active" id="peta">
                          <div style="height: 100%">

                            <div id="outerMap" class="outerMap" style="width: 100%; height: 100%; z-index: 2;">

                              <div style="width: 140px; height: 70px; background-color: #6284bc; z-index: 1; position: relative; float: right; margin-bottom: -70px; text-align: center; padding: 5px;">
                                <label id="info" style="color: white;">Laporan Masuk: 0</label>
                                <div class="row">
                                  <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button style="width: 97%" id="btn_sirine" class="buttonFlashOff" onclick="closeFlash(); closeSirine();">Matikan Sirine</button>
                                  </div>
                                </div>
                              </div>

                              <div style="z-index: 2; position: absolute; bottom:30px;left:30px">
                                <img src="<?= base_url().'assets/path_logo/ICON-SIYAP-SM-2.png' ?>">
                              </div>

                              <div id="map" class="map" style="width: 100%; height: 100%; z-index: 0;"></div>
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

                      <div role="tabpanel" class="tab-pane" id="statistik">
                          <?php 
                              $nama_bulan = array(
                                  1 =>'Januari', 
                                  2 =>'Februari', 
                                  3 =>'Maret', 
                                  4 =>'April', 
                                  5 =>'Mei', 
                                  6 =>'Juni', 
                                  7 =>'Juli', 
                                  8 =>'Agustus', 
                                  9 =>'September', 
                                  10 =>'Oktober', 
                                  11 =>'November', 
                                  12 =>'Desember'
                              );

                              // if ($showGrafik == 'true') {
                              if ($data_lap != 'Kosong'){
                                  $lapPerBulan = array();
                                  
                                  foreach ($nama_bulan as $row => $value) {
                                      $tot = 0;
                                      foreach ($data_lap as $key) {
                                          if ($key->bulan == $row) {
                                              $tot = (int)$key->jml_lap;
                                          }
                                      }
                                      $lapPerBulan[] = array(
                                        "name" => $value,
                                        "y" => $tot,
                                        "drilldown" => $row
                                      );
                                  }

                                  $lapPerMinggu = array();
                                  foreach ($lapPerBulan as $row) {
                                      $dataLaporan = array();
                                      $minggu = 1;
                                      $bln = 0;
                                      foreach ($lap_per_minggu as $key) {
                                          if ($row['drilldown'] == $key->bulan) {
                                              $dataLaporan[] = array(
                                                  'Minggu '.$key->minggu,
                                                  (int)$key->jml_lap
                                              );
                                              $bln++;
                                          }
                                      }

                                      if ($bln == 0) {
                                          $lapPerMinggu[] = array(
                                              "name" => $row['name'],
                                              "id" => $row['drilldown'],
                                              "data" => array(array('Data Kosong', 0))
                                          );
                                      }else{
                                          $lapPerMinggu[] = array(
                                              "name" => $row['name'],
                                              "id" => $row['drilldown'],
                                              "data" => $dataLaporan
                                          );
                                      }
                                  }
                              }else{
                                  $lapPerBulan = '';
                              }
                              // var_dump(json_encode($lapPerBulan));
                              // echo "<br>";
                              // var_dump(json_encode($lapPerMinggu)); exit();
                              // }
                          ?>

                          <div class="clearfix">
                              <div class="col-lg-12 col-md-12">
                                  <div class="card product-report">
                                      <div class="header">
                                          <div class="row">
                                              <div class="col-lg-8 col-md-12 col-sm-12">
                                                  <h2>Jumlah Laporan Masuk Tahun <?=$tahun ?></h2>
                                              </div>
                                              <div class="col-lg-4 col-md-12 col-sm-12">
                                                  <form method="GET" action="<?= base_url().'Dashboard/index' ?>">
                                                      <div class="row">
                                                          <div class="col-lg-8 col-md-8 col-sm-8" >
                                                               <select name="tahun" class="form-control show-tick">
                                                                  <option value="">Pilih Tahun</option>
                                                                  <?php foreach ($data_thn as $key) { ?>
                                                                      <option <?= ($key->thn==$tahun?'selected':'') ?> value="<?= $key->thn ?>"><?= $key->thn ?></option>
                                                                  <?php } ?>
                                                              </select>
                                                          </div>
                                                          <div class="col-lg-4 col-md-4 col-sm-4" style="margin-top: 20px">
                                                              <button type="submit" class="btn btn-sm btn-block btn-primary waves-effect">Tampil</button>
                                                          </div>
                                                      </div>
                                                  </form>
                                              </div>
                                          </div>

                                      </div>
                                      <hr>
                                      <div class="body">
                                          <div class="row clearfix m-b-15">
                                              <div class="col-lg-8 col-md-12 col-sm-12">
                                                  <?php if ($lapPerBulan != '') { ?>
                                                      <div id="chart-bar-laporan" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                                                  <?php }else{ ?>
                                                      <h3 align="center">Data Grafik Kosong</h3>
                                                  <?php } ?>
                                              </div>
                                              <div class="col-lg-4 col-md-12 col-sm-12">
                                                  <div class="table-responsive" style="height: 400px">
                                                      <!-- <p>Contrary to popular belief, Lorem Ipsum is not simply random text</p> -->
                                                      <!-- <table class="table table-hover js-exportable"> -->
                                                      <table class="table table-hover">
                                                          <thead>
                                                              <tr>
                                                                  <th>Bulan</th>
                                                                  <th>Jumlah</th>
                                                              </tr>
                                                          </thead>
                                                          <tbody>
                                                              <?php 
                                                                  if ($lapPerBulan != '') {
                                                                     foreach ($lapPerBulan as $key) {
                                                               ?>
                                                                      <tr>
                                                                          <td><?= $key['name'] ?></td>
                                                                          <td><?= $key['y'] ?></td>
                                                                      </tr>
                                                              <?php }}else{ ?> 
                                                                      <tr align="center">
                                                                          <td colspan="2"><b>Data Kosong</b></td>
                                                                      </tr> 
                                                              <?php } ?>                                                                    
                                                          </tbody>
                                                      </table>                                    
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>

                              <!-- </div> -->
                          <!-- </section> -->
                      </div>
                  </div>
              </div>
            </div>
          <!-- </div> -->
        <!-- </div> -->
        <!-- #END# Widgets -->
    <!-- </div> -->
</section>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<script type="text/javascript">
    // var show = "<?//= $showGrafik ?>";
    // if (show == 'true') {
    showGrafik();
    // }
    function showGrafik() {
      Highcharts.chart('chart-bar-laporan', {
        chart: {
          type: 'column'
        },
        title: {
          text: "Grafik Jumlah Laporan Masuk"
          // text: ""
        },
        subtitle: {
          text: ''
        },
        xAxis: {
          type: 'category'
        },
        yAxis: {
          title: {
            text: 'Total Laporan'
          }

        },
        credits: 'false',
        legend: {
          enabled: false
        },
        plotOptions: {
          series: {
            borderWidth: 0,
            dataLabels: {
              enabled: true,
              format: '{point.y}'
            }
          }
        },

        tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
        },

        series: [
          {
            "name": "Laporan Masuk Per Bulan",
            "colorByPoint": true,
            "data": <?= json_encode($lapPerBulan) ?>
          }
        ],
        drilldown: {
          "series": <?= json_encode($lapPerMinggu) ?>
        }
      });
    }
</script>

<script type="text/javascript">
   window.onload = function () {
      initialize_map();
      // $('#popup').hide();
  }
</script>

<script type="text/javascript">
  function fancy() {
    $('.foto_kejadian').fancybox({});
  }
</script>

<!-- <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script> -->
<!-- <script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script> -->
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

      var database = firebase.database().ref().child('/<?= $kategori ?>');
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
                         "<a class='foto_kejadian' href=<?= base_url().'assets/path_laporan/' ?>"+img_kejadian+" rel='kejadian'> <button onclick='fancy()' class='btn btn-block bg-green waves-effect'>FOTO KEJADIAN</button> </a>"+
                         "<a class='foto_kejadian' href=<?= base_url().'assets/path_selfie/' ?>"+img_selfie+" rel='selfie'> <button style='margin-bottom:10px' onclick='fancy()' class='btn btn-block bg-pink waves-effect'>FOTO PELAPOR</button> </a>"+
                         // "</div>"+
                         "</center></p>"+
                        '</div>';
                       // "<img src=<?//= base_url().'assets/path_laporan/' ?>"+feature.get('img')+" height='150'></p>";
        // contents += "<input class='btn btn-block btn-raised btn-primary waves-effect' type='button' name='Selesai' value='Selesai' onclick='lapSelesai("+feature.get('id_lapor')+", "+feature.get('key')+")'>";

        // content.innerHTML = '<p>Alamat:</p><p>'+feature.get('alamat')+'</p>';

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

