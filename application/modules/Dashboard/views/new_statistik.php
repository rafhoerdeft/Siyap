<!-- ========================
       page title 
    =========================== -->
<section class="page-title page-title-layout8 bg-overlay bg-parallax text-center">
    <div class="bg-img"><img src="<?= base_url('assets/assets_front/images/sliders/1.jpg') ?>" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 offset-xl-3">
                <h1 class="pagetitle__heading">Statistik</h1>
            </div><!-- /.col-xl-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->

<section class="container">
    <?php
    $nama_bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );

    // if ($showGrafik == 'true') {
    if ($data_lap != 'Kosong') {
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
                        'Minggu ' . $key->minggu,
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
            } else {
                $lapPerMinggu[] = array(
                    "name" => $row['name'],
                    "id" => $row['drilldown'],
                    "data" => $dataLaporan
                );
            }
        }
    } else {
        $lapPerBulan = '';
    }
    ?>

    <div class="row">
        <div class="col-md-8">
            Jumlah Laporan Masuk Tahun <?= $tahun ?>
        </div>
        <div class="col-md-4">
            <form action="<?= base_url('Dashboard/statistik') ?>" method="get" class="row">
                <div class="col-8">
                    <div class="form-group">
                        <select name="tahun" class="form-control">
                            <?php foreach ($data_thn as $key) { ?>
                                <option <?= ($key->thn == $tahun ? 'selected' : '') ?> value="<?= $key->thn ?>"><?= $key->thn ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary">Tampil</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <?php if ($lapPerBulan != '') { ?>
                <div id="chart-bar-laporan"></div>
            <?php } else { ?>
                <h3 align="center">Data Grafik Kosong</h3>
            <?php } ?>
        </div>
        <div class="col-md-4">
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
                            <?php }
                        } else { ?>
                            <tr align="center">
                                <td colspan="2"><b>Data Kosong</b></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<script type="text/javascript">
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

            series: [{
                "name": "Laporan Masuk Per Bulan",
                "colorByPoint": true,
                "data": <?= json_encode($lapPerBulan) ?>
            }],
            drilldown: {
                "series": <?= json_encode($lapPerMinggu) ?>
            }
        });
    }
</script>