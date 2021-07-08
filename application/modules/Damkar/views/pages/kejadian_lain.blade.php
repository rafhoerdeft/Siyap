@layout('layouts/master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>KEJADIAN LAIN-LAIN</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <!-- <h2> BASIC EXAMPLE </h2> -->
                            <!-- <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more-vert"></i> </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul> -->
                            <div class="row">
                                <div class="col-md-9 col-sm-9 col-lg-9" style="margin-bottom: -35px;">
                                    <?= show_alert() ?>
                                </div>
                                <div class="col-md-3 col-sm-3 col-lg-3" style="float: right;">
                                    <a href="<?= base_url('Damkar/addKejadianLain') ?>" class="btn btn-sm bg-light-blue btn-block waves-effect" style="margin-bottom: -15px"><i class="material-icons" style="margin-bottom: 13px;">note_add</i> Tambah Laporan</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="body">
                            <div>
                                <style>
                                    #data_kejadian tbody{
                                        font-size: 8pt;
                                    }
                                </style>
                                <table id="data_kejadian" class="table table-bordered table-striped table-hover table-responsive">
                                    <thead style="font-size: 9pt">
                                        <tr>
                                            <th width="5%">ID</th>
                                            <!-- <th width="15%">Pelapor</th> -->
                                            <th width="15%">Aksi</th>
                                            <th width="5%">Foto Kejadian</th>
                                            <th width="15%">Waktu Lapor</th>
                                            <th width="20%">Alamat Kejadian</th>
                                            <th width="20%">Keterangan</th>
                                            <th width="15%">Jenis Kejadian</th>
                                            <!-- <th width="5%">Status</th> -->
                                        </tr>
                                    </thead>
                                    <!-- <tbody style="font-size: 8pt"> -->
                                        <?php //$no=1; foreach ($histori as $data) { ?>
                                        <!-- <tr> -->
                                            <!-- <td><?//= $data->id_lapor ?></td> -->
                                            <!-- <td><?//= $data->nama_user ?></td> -->
                                            <!-- <td nowrap>
                                                <a href="<?//= base_url('Damkar/editKejadianLain/'.encode($data->id_lapor)) ?>" title="Edit" class="btn btn-sm bg-green waves-effect" 
                                                style="margin-bottom: 5px; width: 5px;">
                                                <i class="material-icons" 
                                                style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">border_color</i></a>

                                                <button title="Hapus" class="btn btn-sm btn-danger waves-effect" onclick="delLap('<?//= $data->id_lapor ?>')" 
                                                style="margin-bottom: 5px; width: 5px;"><i class="material-icons" 
                                                style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">delete</i></button>

                                                <a href="<?//= base_url('Damkar/cetakLap/'.$data->id_lapor) ?>" target="_blank" title="Cetak Laporan" class="btn btn-sm bg-purple waves-effect"
                                                    style="margin-bottom: 5px; width: 5px;"><i
                                                        class="material-icons"
                                                        style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">assignment</i></a>
                                            </td> -->
                                            <!-- <td><?//= $data->alamat ?></td>
                                            <td><?//= $data->keterangan ?></td>
                                            <td><?//= $data->nama_jenis_lap ?></td>
                                            <td><?//= date('d-m-Y (H:i)', strtotime($data->tgl_lapor)) ?></td>
                                            <td>
                                                <?php 
                                                    // if ($data->foto_kejadian != null && $data->foto_kejadian != '') {
                                                    //     $pic = explode(",", $data->foto_kejadian);
                                                    //     $i = 0;
                                                    //     foreach ($pic as $key => $file) {
                                                    //         $i++;
                                                ?>
                                                <a class="foto_kejadian"
                                                    href="<?//= base_url().'assets/path_kejadian/'.$file ?>" rel="<?//= $data->id_lapor ?>"><button
                                                        class="btn btn-sm btn-raised bg-deep-purple waves-effect"
                                                        style="margin-bottom: 8px; font-size: 8pt; margin-left: -2px; width: 50px"><i class="material-icons" 
                                                        style="margin-bottom: 8px; font-size: 10pt; margin-left: -2px;">image</i> Foto <?//= $i ?></button></a><br>
                                                <?php //} } ?>

                                            </td> -->
                                            <!-- <td><?//= ucfirst($data->status) ?></td> -->
                                            
                                        <!-- </tr>
                                        <?php //} ?>
                                    </tbody> -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('footer')
    <!-- Jquery DataTable Plugin Js --> 
    <script src="<?php echo base_url().'assets/assets/bundles/datatablescripts.bundle.js'; ?>"></script>

    <script>
        function delLap(data) {
            var id = $(data).data().id;
            swal({
            title: "Hapus Data",
            text: "Apakah laporan akan dihapus?",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            }, function () {
                setTimeout(function () {

                        $.post("<?= base_url() ?>/Damkar/hapusLaporan", {id_lapor: id}, function(result){
                        // alert(result);
                            if (result == 'Success') {
                                swal("Data berhasil dihapus!");  
                                window.location.href = "<?= base_url().'Damkar/kejadianLain/' ?>";
                            }else{
                                swal("Gagal!");
                            }
                        });
                }, 700);
            });
        }
    </script>

    <!-- Show Laporan Lain-Lain -->
    <script type="text/javascript">
        function addZero(n) {
            if (n <= 9) {
                return "0" + n;
            }
            return n
        }

        function addLap(id, pelapor) {
            $('#modal_lapor #id_lapor').val('');
            $('#modal_lapor #pelapor').val('');
            $('#modal_lapor #tgl_kejadian').val('');
            $('#modal_lapor #waktu_awal').val('');
            $('#modal_lapor #waktu_akhir').val('');
            $('#modal_lapor #tgl_selesai').val('');
            $('#modal_lapor #no_hp_pelapor').val('');
            $('#modal_lapor #almt_kejadian').val('');
            $('#modal_lapor #keterangan').val('');
            $('#modal_lapor #jenis_kejadian').val('');
            $('#modal_lapor #penyebab_kejadian').val('');
            $('#modal_lapor #nama_korban').val('');
            $('#modal_lapor #almt_korban').val('');
            $('#modal_lapor #saksi').val('');
            $('#modal_lapor #kerugian').val('');
            $('#modal_lapor #kronologi').val('');
            $('#modal_lapor #tindakan').val('');
            $('#modal_lapor #unit').val('');
            $('#modal_lapor #regu').val('');
            $('#modal_lapor #pos').val('');
            $('#modal_lapor #kronologi').val('');

            $.post("<?= base_url() ?>/Damkar/showLap", {
                id_lap: id
            }, function(result) {
                var dt = JSON.parse(result);

                var tgl_lapor = new Date(dt.lapor.tgl_lapor);
                var waktu_awal = new Date(dt.lapor.tgl_lapor);

                $('#modal_lapor #id_lapor').val(id);
                $('#modal_lapor #pelapor').val(pelapor);
                $('#modal_lapor #tgl_kejadian').val(addZero(tgl_lapor.getDate()) + '-' + addZero(tgl_lapor.getMonth() +
                    1) + '-' + tgl_lapor.getFullYear());
                $('#modal_lapor #waktu_awal').val(addZero(waktu_awal.getHours()) + ':' + addZero(waktu_awal
                .getMinutes()));

                if (dt.lapor.waktu_selesai === null) {

                    if (dt.waktu[0].waktu_selesai === '' || dt.waktu[0].waktu_selesai === null || dt.waktu[0]
                        .waktu_selesai === 'null') {
                        $('#modal_lapor #waktu_akhir').val('');
                        $('#modal_lapor #tgl_selesai').val('');
                    } else {
                        var wkt_akhr = new Date(dt.waktu[0].waktu_selesai);
                        // alert(addZero(wkt_akhr.getDate())+'-'+addZero(wkt_akhr.getMonth()+1)+'-'+wkt_akhr.getFullYear());  
                        $('#modal_lapor #waktu_akhir').val(addZero(wkt_akhr.getHours()) + ':' + addZero(wkt_akhr
                            .getMinutes()));
                        $('#modal_lapor #tgl_selesai').val(addZero(wkt_akhr.getDate()) + '-' + addZero(wkt_akhr
                            .getMonth() + 1) + '-' + wkt_akhr.getFullYear());
                    }
                } else {
                    var waktu_akhir = new Date(dt.lapor.waktu_selesai);

                    $('#modal_lapor #tgl_selesai').val(addZero(waktu_akhir.getDate()) + '-' + addZero(waktu_akhir
                        .getMonth() + 1) + '-' + waktu_akhir.getFullYear());
                    $('#modal_lapor #waktu_akhir').val(addZero(waktu_akhir.getHours()) + ':' + addZero(waktu_akhir
                        .getMinutes()));
                }

                $('#modal_lapor #no_hp_pelapor').val(dt.lapor.no_hp);
                $('#modal_lapor #almt_kejadian').val(dt.lapor.alamat);
                $('#modal_lapor #keterangan').val(dt.lapor.keterangan);
                $('#modal_lapor #jenis_kejadian').val(dt.lapor.jenis_kejadian);
                $('#modal_lapor #penyebab_kejadian').val(dt.lapor.penyebab_kejadian);
                $('#modal_lapor #nama_korban').val(dt.lapor.nama_korban);
                $('#modal_lapor #almt_korban').val(dt.lapor.alamat_korban);
                $('#modal_lapor #saksi').val(dt.lapor.saksi);
                $('#modal_lapor #kerugian').val(dt.lapor.kerugian);
                $('#modal_lapor #kronologi').val(dt.lapor.kronologi);
                $('#modal_lapor #tindakan').val(dt.lapor.tindakan);
                $('#modal_lapor #unit').val(dt.lapor.unit);
                $('#modal_lapor #regu').val(dt.lapor.regu);
                $('#modal_lapor #pos').val(dt.lapor.pos);
                $('#modal_lapor #btn_cetak').attr("href", "<?= base_url().'Damkar/cetakLap/' ?>" + id);

                // =======================================================================================

                var ket_kejadian = '';
                for (var x = 0; x < dt.kronologi.length; x++) {
                    ket_kejadian += dt.kronologi[x].keterangan + '\n\n';
                }

                if (dt.lapor.kronologi === '' || dt.lapor.kronologi === null || dt.lapor.kronologi === 'null') {
                    $('#modal_lapor #kronologi').val(ket_kejadian);
                } else {
                    $('#modal_lapor #kronologi').val(dt.lapor.kronologi);
                }
                // alert(ket_kejadian);

                // ======================================================================================

                $('#modal_lapor #photo').html('');

                var pic;
                pic = "<div class ='col-sm-4 col-md-4 col-lg-4'>" +
                    "<a class='file_photo' rel='kejadian' href='<?= base_url()."assets/path_laporan/"?>" + dt.lapor
                    .image_lapor + "'>" +
                    "<img onclick='fancy()' src='<?= base_url()."assets/path_laporan/" ?>" + dt.lapor.image_lapor +
                    "' width='100%' style='margin-bottom: 20px;'>" +
                    "</a>" +
                    "</div>";
                $('#modal_lapor #photo').append(pic);

                var file;
                var file_photo = [];
                for (var i = 0; i < dt.foto.length; i++) {
                    // alert(dt.foto[i].foto_kejadian);
                    var photo = dt.foto[i].foto_kejadian;
                    if (photo != '-' && photo != '' && photo != null) {
                        file = photo.split(",");

                        for (var x = 0; x < file.length; x++) {
                            if (file[x] != "") {
                                file_photo.push(file[x]);
                            }
                        }
                    }

                }

                for (var j = 0; j < file_photo.length; j++) {
                    // alert(file_photo[j]);
                    pic = "<div class ='col-sm-4 col-md-4 col-lg-4'>" +
                        "<a class='file_photo' rel='kejadian' href='<?= base_url()."assets/path_kejadian/"?>" +
                        file_photo[j] + "'>" +
                        "<img onclick='fancy()' src='<?= base_url()."assets/path_kejadian/" ?>" + file_photo[j] +
                        "' width='100%' style='margin-bottom: 20px;'>" +
                        "</a>" +
                        "</div>";
                    $('#modal_lapor #photo').append(pic);
                }

                $('#modal_lapor').modal('show');

            });

        }
    </script>

    <!-- Show Laporan Kebakaran -->
    <script type="text/javascript">
        // function addZero(n){
        //   if(n <= 9){
        //     return "0" + n;
        //   }
        //   return n
        // }

        function addLapKebakaran(id, pelapor) {
            $('#modal_lapor2 #no_hp_pelapor').val('');
            $('#modal_lapor2 #almt_kejadian').val('');
            $('#modal_lapor2 #keterangan').val('');
            $('#modal_lapor2 #ket_kejadian').val('');
            $('#modal_lapor2 #obyek_terbakar').val('');
            $('#modal_lapor2 #asal_api').val('');
            $('#modal_lapor2 #nama_pemilik').val('');
            $('#modal_lapor2 #kerugian').val('');
            $('#modal_lapor2 #kronologi').val('');
            $('#modal_lapor2 #unit').val('');
            $('#modal_lapor2 #regu').val('');
            $('#modal_lapor2 #pos').val('');
            $('#modal_lapor2 #id_lapor').val('');
            $('#modal_lapor2 #pelapor').val('');
            $('#modal_lapor2 #tgl_kejadian2').val('');
            $('#modal_lapor2 #waktu_awal2').val('');
            $('#modal_lapor2 #waktu_akhir2').val('');
            $('#modal_lapor2 #tgl_selesai2').val('');
            $('#modal_lapor2 #kronologi').val('');

            $.post("<?= base_url() ?>/Damkar/showLap", {
                id_lap: id
            }, function(result) {
                var dt = JSON.parse(result);
                // alert(dt.waktu[0].waktu_selesai);            

                var tgl_lapor = new Date(dt.lapor.tgl_lapor);
                var waktu_awal = new Date(dt.lapor.tgl_lapor);

                $('#modal_lapor2 #id_lapor').val(id);
                $('#modal_lapor2 #pelapor').val(pelapor);
                $('#modal_lapor2 #tgl_kejadian2').val(addZero(tgl_lapor.getDate()) + '-' + addZero(tgl_lapor
                .getMonth() + 1) + '-' + tgl_lapor.getFullYear());
                $('#modal_lapor2 #waktu_awal2').val(addZero(waktu_awal.getHours()) + ':' + addZero(waktu_awal
                    .getMinutes()));

                if (dt.lapor.waktu_selesai === null) {

                    if (dt.waktu[0].waktu_selesai === '' || dt.waktu[0].waktu_selesai === null || dt.waktu[0]
                        .waktu_selesai === 'null') {
                        $('#modal_lapor2 #waktu_akhir2').val('');
                        $('#modal_lapor2 #tgl_selesai2').val('');
                    } else {
                        var wkt_akhr = new Date(dt.waktu[0].waktu_selesai);
                        $('#modal_lapor2 #waktu_akhir2').val(addZero(wkt_akhr.getHours()) + ':' + addZero(wkt_akhr
                            .getMinutes()));
                        $('#modal_lapor2 #tgl_selesai2').val(addZero(wkt_akhr.getDate()) + '-' + addZero(wkt_akhr
                            .getMonth() + 1) + '-' + wkt_akhr.getFullYear());
                    }
                } else {
                    var waktu_akhir = new Date(dt.lapor.waktu_selesai);

                    $('#modal_lapor2 #tgl_selesai2').val(addZero(waktu_akhir.getDate()) + '-' + addZero(waktu_akhir
                        .getMonth() + 1) + '-' + waktu_akhir.getFullYear());
                    $('#modal_lapor2 #waktu_akhir2').val(addZero(waktu_akhir.getHours()) + ':' + addZero(waktu_akhir
                        .getMinutes()));
                }

                $('#modal_lapor2 #no_hp_pelapor').val(dt.lapor.no_hp);
                $('#modal_lapor2 #almt_kejadian').val(dt.lapor.alamat);
                $('#modal_lapor2 #keterangan').val(dt.lapor.keterangan);
                $('#modal_lapor2 #ket_kejadian').val(dt.lapor.ket_laporan);
                $('#modal_lapor2 #obyek_terbakar').val(dt.lapor.obyek_terbakar);
                $('#modal_lapor2 #asal_api').val(dt.lapor.asal_api);
                $('#modal_lapor2 #nama_pemilik').val(dt.lapor.nama_korban);
                $('#modal_lapor2 #kerugian').val(dt.lapor.kerugian);
                $('#modal_lapor2 #kronologi').val(dt.lapor.kronologi);
                $('#modal_lapor2 #unit').val(dt.lapor.unit);
                $('#modal_lapor2 #regu').val(dt.lapor.regu);
                $('#modal_lapor2 #pos').val(dt.lapor.pos);
                $('#modal_lapor2 #btn_cetak').attr("href", "<?= base_url().'Damkar/cetakLap2/' ?>" + id);

                // =======================================================================================

                var ket_kejadian = '';
                for (var x = 0; x < dt.kronologi.length; x++) {
                    ket_kejadian += dt.kronologi[x].keterangan + '\n\n';
                }

                if (dt.lapor.kronologi === '' || dt.lapor.kronologi === null || dt.lapor.kronologi === 'null') {
                    $('#modal_lapor2 #kronologi').val(ket_kejadian);
                } else {
                    $('#modal_lapor2 #kronologi').val(dt.lapor.kronologi);
                }

                // alert(ket_kejadian);

                // ======================================================================================

                $('#modal_lapor2 #photo').html('');

                var pic;
                pic = "<div class ='col-sm-4 col-md-4 col-lg-4'>" +
                    "<a class='file_photo' rel='kejadian' href='<?= base_url()."assets/path_laporan/"?>" + dt.lapor
                    .image_lapor + "'>" +
                    "<img onclick='fancy()' src='<?= base_url()."assets/path_laporan/" ?>" + dt.lapor.image_lapor +
                    "' width='100%' style='margin-bottom: 20px;'>" +
                    "</a>" +
                    "</div>";
                $('#modal_lapor2 #photo').append(pic);

                var file;
                var file_photo = [];
                for (var i = 0; i < dt.foto.length; i++) {
                    // alert(dt.foto[i].foto_kejadian);
                    var photo = dt.foto[i].foto_kejadian;
                    if (photo != '-' && photo != '' && photo != null) {
                        file = photo.split(",");

                        for (var x = 0; x < file.length; x++) {
                            if (file[x] != "") {
                                file_photo.push(file[x]);
                            }
                        }
                    }

                }

                for (var j = 0; j < file_photo.length; j++) {
                    // alert(file_photo[j]);
                    pic = "<div class ='col-sm-4 col-md-4 col-lg-4'>" +
                        "<a class='file_photo' rel='kejadian' href='<?= base_url()."assets/path_kejadian/"?>" +
                        file_photo[j] + "'>" +
                        "<img onclick='fancy()' src='<?= base_url()."assets/path_kejadian/" ?>" + file_photo[j] +
                        "' width='100%' style='margin-bottom: 20px;'>" +
                        "</a>" +
                        "</div>";
                    $('#modal_lapor2 #photo').append(pic);
                }

                $('#modal_lapor2').modal('show');

            });

        }
    </script>

    <script type="text/javascript">
        function printLaporan(n) {
            // var button = $('#buttonPrintInvoice').hide();
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(n).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            // document.body.innerHTML = restorepage;
            // $('#detailInvoice').modal('hide');
            window.location.href = "<?=base_url().'Damkar/historiAduan' ?>";
        }
    </script>

    <script>
        $("#data_kejadian").DataTable({
            "processing": true,
            "serverSide": true,
            "searching": true,
            "scrollX": true,
            "order":[],  
            "ajax":{  
                "url": "<?= base_url('Damkar/getDataKejadian/non_kebakaran') ?>",  
                "type": "POST",
                // "success":function(data){
                //     console.log(data);
                // },
                // "beforeSend": function () {
                //     $(".loading-page").show();
                // },
                // "complete": function () {
                //     $(".loading-page").hide();
                // },
            },  
            "columnDefs":[  
                {  
                    "targets":0,  
                    "width": "10",
                    "orderable":false,  
                    "class":"text-center" 
                },
                {  
                    "targets":1,  
                    "width": "150",
                    "orderable":false,  
                    "class":"text-center" 
                }, 
                {  
                    "targets":2,  
                    "width": "10",
                    "orderable":false,  
                    "class":"text-center" 
                }
                // {  
                //     "targets":3,  
                //     "width": "50",
                //     "class":"text-center" 
                // },
                // {  
                //     "targets":4,  
                //     "width": "100"
                // },
                // {  
                //     "targets":5,  
                //     "width": "70"
                // },
            ],  
            "pageLength": 10
        }).on('draw.dt', function () {
            $('.foto_kejadian').fancybox({});
        });
    </script>
@endsection