<section class="container" style="max-width: 100%; padding-top: 15px">
    <div class="map-height">

        <div id="outerMap" class="outerMap" style="width: 100%; height: 100%; z-index: 2;">

            <div style="width: 140px; height: 70px; background-color: #6284bc; z-index: 1; position: relative; float: right; margin-bottom: -70px; text-align: center; padding: 5px;">
                <label id="info" style="color: white;">Laporan Masuk: 0</label>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button style="width: 97%" id="btn_sirine" class="buttonFlashOff" onclick="closeFlash(); closeSirine();">Matikan Sirine</button>
                    </div>
                </div>
            </div>

            <div style="z-index: 2; position: absolute; bottom:150px;left:30px">
                <img src="<?= base_url() . 'assets/path_logo/ICON-SIYAP-SM-2.png' ?>">
            </div>

            <div id="map" class="map" style="width: 100%; height: 100%; z-index: 0;"></div>
        </div>

    </div>
</section>

<section class="container" style="max-width: 100%;">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2">
            <div class="heading text-center mb-40">
                <h2 class="heading__title">Laporan Kejadian</h2>
            </div><!-- /.heading -->
        </div><!-- /.col-lg-8 -->
    </div>
    <div class="p-5">
        <table class="table table-bordered table-striped table-hover responsive" id="table_laporan" style="overflow-x: auto; width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Pelapor</th>
                    <th>Alamat Kejadian</th>
                    <th>Keterangan</th>
                    <th>Waktu Lapor</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody id="lapor_content">
            </tbody>
        </table>
    </div>
</section>


<!-- Cluster Marker JS-->
<script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>

<!-- Leafleat Plugin JS -->
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>

<!-- datatable -->
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
    window.onload = function() {
        initialize_map();
        // $('#popup').hide();
    }
</script>

<!-- Datatable Laporan -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#table_laporan').DataTable({
            "language": {
                "paginate": {
                    "previous": '<i class="fas fa-angle-left"></i>',
                    "next": '<i class="fas fa-angle-right"></i>'
                }
            }
        });
    });
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
        Object.keys(audio).forEach(function(key) {
            audio[key].pause();
            audio[key].currentTime = 0;
        });
    }
</script>

<script type="text/javascript">
    function addZero(n) {
        if (n <= 9) {
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


    var mymap = L.map('map', {
        attributionControl: false
    });
    var layer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        // attribution: '&copy; <a href="<?= base_url() ?>">SIYAP</a> Application',
        maxZoom: 18,
        minZoom: 8,
    });
    layer.addTo(mymap);

    var wilayah = L.imageOverlay("<?= base_url() . 'assets/path_vector/batas_kab_mgl_new_2.svg' ?>", [
        [-7.71664, 110.03432],
        [-7.31243, 110.45586]
    ], {
        opacity: 0.8
    }).addTo(mymap);

    // Add Attribution Control
    var attributionControl = L.control({
        position: "bottomright"
    });
    attributionControl.onAdd = function(map) {
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
            popupAnchor: [3, -45]
        },
    });

    // =================================================================================

    function initialize_map() {

        var database = firebase.database().ref().child('/<?= $kategori ?>');
        database.on('child_added', function(snapshot) {
            if (snapshot.exists()) {

                if (snapshot.val().role == 'User') {
                    audio[snapshot.key] = new Audio('<?= base_url(); ?>assets/audio/Sirine.mp3');
                    audio[snapshot.key].play();
                    audio[snapshot.key].loop = true;

                    // ---Change View Camera---
                    var setView = mymap.setView([parseFloat(snapshot.val().latitude), parseFloat(snapshot.val().longitude)], mapDefaultZoom);

                    aduan++;
                    $('#info').html('Jml. Laporan: ' + aduan);
                    // $('#btn_sirine').className = "buttonFlashOn";
                    document.getElementById("btn_sirine").className = "buttonFlashOn";
                    document.getElementById("outerMap").className = "outerMapFlash";

                    // Add row tabel laporan
                    $.post("<?= base_url() ?>/Dashboard/dataLap", {
                        id_lap: snapshot.val().id_lapor,
                        kategori: "<?= $kategori ?>"
                    }, function(result) {

                        var datas = JSON.parse(result);

                        var tgl_lapor = new Date(datas.tgl_lapor);
                        var waktu = addZero(tgl_lapor.getDate()) + '-' + addZero(tgl_lapor.getMonth() + 1) + '-' + tgl_lapor.getFullYear() + ' (' + addZero(tgl_lapor.getHours()) + ':' + addZero(tgl_lapor.getMinutes()) + ')';
                        nom++;
                        var contentLap = '<tr id=' + snapshot.val().id_lapor + '>' +
                            '<td>' + nom + '</td>' +
                            '<td>' + snapshot.val().id_lapor + '</td>' +
                            '<td>' + snapshot.val().nama_pelapor + '</td>' +
                            '<td>' + snapshot.val().alamat + '</td>' +
                            '<td>' + snapshot.val().keterangan + '</td>' +
                            '<td>' + waktu + '</td>' +
                            '<td>' +
                            "<a class='foto_kejadian' href=<?= base_url() . 'assets/path_laporan/' ?>" + snapshot.val().image_lapor + "> <button onclick='fancy()' class='btn btn-block btn-success'>KEJADIAN</button> </a> <br>" +
                            "<a class='foto_kejadian' href=<?= base_url() . 'assets/path_selfie/' ?>" + snapshot.val().image_selfie + "> <button onclick='fancy()' class='btn btn-block btn-info'>PELAPOR</button> </a>" +
                            '</td>' +
                            // '<td>'+datas.status+'</td>'+
                            '</tr>';
                        $('#lapor_content').append(contentLap);
                    });

                }
                add_map_point(snapshot);
            }
        });

        database.on('child_changed', function(snapshot) {
            if (snapshot.exists()) {
                mymap.removeLayer(markers[snapshot.key]);
                add_map_point(snapshot);
            }
        });

        database.on('child_removed', function(snapshot) {
            if (snapshot.exists()) {
                // window.alert(snapshot.key);
                mymap.removeLayer(markers[snapshot.key]);

                if (snapshot.val().role == 'User') {
                    aduan--;
                    $('#info').html('Jml. Laporan: ' + aduan);

                    // Remove row tabel laporan
                    $('#' + snapshot.val().id_lapor).remove();
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
            } else {
                keterangan = ket;
            }
            var contents = '<div id="pop">' +
                '<p>ID Aduan: <b>' + id_lapor + '</b></p>' +
                '<p>Nama Pelapor: <b>' + nama + '</b></p>' +
                '<p>Alamat Kejadian: <br><b>' + alamat + '</b></p>' +
                '<p>Keterangan: <br><b>' + keterangan + '</b></p>' +
                "<p><center>" +
                // "<div id='aniimated-thumbnials'>"+
                // "<a class='foto_kejadian' href=<?//= base_url().'assets/path_laporan/' ?>"+img_kejadian+" rel='saksake'> <img class='img-fluid img-thumbnail' height='150' src=<?//= base_url().'assets/path_laporan/' ?>"+img_kejadian+" alt=''> </a>"+
                "<a class='foto_kejadian' href=<?= base_url() . 'assets/path_laporan/' ?>" + img_kejadian + " rel='kejadian'> <button onclick='fancy()' class='btn btn-block bg-green waves-effect'>FOTO KEJADIAN</button> </a>" +
                "<a class='foto_kejadian' href=<?= base_url() . 'assets/path_selfie/' ?>" + img_selfie + " rel='selfie'> <button style='margin-bottom:10px' onclick='fancy()' class='btn btn-block bg-pink waves-effect'>FOTO PELAPOR</button> </a>" +
                // "</div>"+
                "</center></p>" +
                '</div>';
            // "<img src=<?//= base_url().'assets/path_laporan/' ?>"+feature.get('img')+" height='150'></p>";
            // contents += "<input class='btn btn-block btn-raised btn-primary waves-effect' type='button' name='Selesai' value='Selesai' onclick='lapSelesai("+feature.get('id_lapor')+", "+feature.get('key')+")'>";

            // content.innerHTML = '<p>Alamat:</p><p>'+feature.get('alamat')+'</p>';

            var iconAduan = new icons({
                iconUrl: "<?= base_url(); ?>assets/assets/images/marker-aduan-min.png"
            });
            var marker = L.marker([parseFloat(lat), parseFloat(lng)], {
                icon: iconAduan
            }).addTo(mymap);
            var popup = marker.bindPopup(contents);
        } else {
            var key = data.key;
            var nama = data.val().nama_petugas;
            var id_lapor = data.val().id_lapor;
            var alamat = data.val().alamat;
            var nama_pelapor = data.val().nama_pelapor;
            var role = 'Petugas';

            var contents = '<div id="pop">' +
                '<p>ID Aduan: <b>' + id_lapor + '</b></p>' +
                '<p>Nama Petugas: <b>' + nama + '</b></p>' +
                '<br>' +
                '</div>';

            var iconAduan = new icons({
                iconUrl: "<?= base_url(); ?>assets/assets/images/Marker-damkar-min.png"
            });
            var marker = L.marker([parseFloat(lat), parseFloat(lng)], {
                icon: iconAduan
            }).addTo(mymap);
            var popup = marker.bindPopup(contents);
        }

        markers[data.key] = marker;
    }
</script>