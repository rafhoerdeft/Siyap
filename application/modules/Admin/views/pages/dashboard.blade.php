@layout('layouts/master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

        <!--  <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="body bg-default">
                            <div class="row">
                                <div class="col-md-10">
                                    <font style="font-size: 25px;">Daftar Unit</font>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" name="add" id="add" class="btn btn-block btn-info waves-effect" data-toggle="modal" data-target="#Modal_Add">Add <i class="material-icons">library_add</i></button>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="tbl-unit" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th width="50">No</th>
                                            <th>Kode Unit</th>
                                            <th>Nama Unit</th>
                                            <th>Note</th>
                                            <th width="150">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show-unit">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <?php 
                // $nama_bulan = array(
                //     1 =>'Januari', 
                //     2 =>'Februari', 
                //     3 =>'Maret', 
                //     4 =>'April', 
                //     5 =>'Mei', 
                //     6 =>'Juni', 
                //     7 =>'Juli', 
                //     8 =>'Agustus', 
                //     9 =>'September', 
                //     10 =>'Oktober', 
                //     11 =>'November', 
                //     12 =>'Desember'
                // );

                // // if ($showGrafik == 'true') {
                // if ($data_lap != 'Kosong'){
                //     $lapPerBulan = array();
                    
                //     foreach ($nama_bulan as $row => $value) {
                //         $tot = 0;
                //         foreach ($data_lap as $key) {
                //             if ($key->bulan == $row) {
                //                 $tot = (int)$key->jml_lap;
                //             }
                //         }
                //         $lapPerBulan[] = array(
                //         "name" => $value,
                //         "y" => $tot,
                //         "drilldown" => $row
                //         );
                //     }

                //     $lapPerMinggu = array();
                //     foreach ($lapPerBulan as $row) {
                //         $dataLaporan = array();
                //         $minggu = 1;
                //         $bln = 0;
                //         foreach ($lap_per_minggu as $key) {
                //             if ($row['drilldown'] == $key->bulan) {
                //                 $dataLaporan[] = array(
                //                     'Minggu '.$key->minggu,
                //                     (int)$key->jml_lap
                //                 );
                //                 $bln++;
                //             }
                //         }

                //         if ($bln == 0) {
                //             $lapPerMinggu[] = array(
                //                 "name" => $row['name'],
                //                 "id" => $row['drilldown'],
                //                 "data" => array(array('Data Kosong', 0))
                //             );
                //         }else{
                //             $lapPerMinggu[] = array(
                //                 "name" => $row['name'],
                //                 "id" => $row['drilldown'],
                //                 "data" => $dataLaporan
                //             );
                //         }
                //     }
                // }else{
                //     $lapPerBulan = '';
                // }

            ?>

            <!-- JML USER -->
            <div class="row clearfix">
                <!-- JML USER PELAPOR -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">JML USER PELAPOR</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?=$user_pelapor  ?></div>
                        </div>
                    </div>
                </div>
                <!-- JML PETUGAS -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">JML USER PETUGAS</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?=$user_petugas  ?></div>
                        </div>
                    </div>
                </div>
                <!-- JML ADMIN -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">JML USER ADMIN</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?=$user_admin  ?></div>
                        </div>
                    </div>
                </div>       
                <!-- TOTAL USER -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL USER</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"><?=$total_user  ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!-- JML LAPORAN -->
            <div class="row clearfix">
                <!-- JML KTEGORI AKTIF -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-deep-purple hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">widgets</i>
                        </div>
                        <div class="content">
                            <div class="text">KATEGORI AKTIF</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?=$jml_ktg_aktif  ?></div>
                        </div>
                    </div>
                </div>
                <!-- JML KATEGORI NON AKTIF -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">widgets</i>
                        </div>
                        <div class="content">
                            <div class="text">KATEGORI NON AKTIF</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?=$jml_ktg_non  ?></div>
                        </div>
                    </div>
                </div>
                <!-- JML LAPORAN BULANAN -->
                <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-deep-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">assignment_returned</i>
                        </div>
                        <div class="content">
                            <div class="text">LAPORAN BULAN INI</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?=$lap_bulanan  ?></div>
                        </div>
                    </div>
                </div> -->       
                <!-- JML LAPORAN TAHUNAN -->
                <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-blue-grey hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">assignment_returned</i>
                        </div>
                        <div class="content">
                            <div class="text">LAPORAN TAHUN INI</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"><?=$lap_tahunan  ?></div>
                        </div>
                    </div>
                </div> -->
            </div>

            <!-- <br>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card product-report">
                        <div class="header">
                            <div class="row">
                                <div class="col-lg-8 col-md-12 col-sm-12">
                                    <h2>Jumlah Laporan Masuk Tahun <?=$tahun ?></h2>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <form method="GET" action="<?= base_url().'Damkar/index' ?>">
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
            </div> -->

        </div>
    </section>
@endsection

@section('footer')

    {{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}
    {{-- <script src="https://code.highcharts.com/modules/series-label.js"></script> --}}
    {{-- <script src="https://code.highcharts.com/modules/exporting.js"></script> --}}
    {{-- <script src="https://code.highcharts.com/modules/drilldown.js"></script> --}}

    <!-- <script type="text/javascript">
        showGrafik();

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
                "data": <?//= json_encode($lapPerBulan) ?>
            }
            ],
            drilldown: {
            "series": <?//= json_encode($lapPerMinggu) ?>
            }
        });
        }
    </script> -->
@endsection