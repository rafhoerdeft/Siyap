<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>HISTORI KEJADIAN</h2>
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
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="data-histori">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="15%">Pelapor</th>
                                        <th width="30%">Alamat Kejadian</th>
                                        <th width="10%">Keterangan</th>
                                        <th width="17%">Waktu Lapor</th>
                                        <th width="7%">Foto</th>
                                        <th width="10%">Status</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($histori as $data) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data->nama_user ?></td>
                                            <td><?= $data->alamat ?></td>
                                            <td><?= $data->keterangan ?></td>
                                            <td><?= date('d-m-Y (H:i)', strtotime($data->tgl_lapor)) ?></td>
                                            <td>
                                                <a class="foto_kejadian" href="<?= base_url().'assets/path_laporan/'.$data->image_lapor ?>"><button class="btn btn-primary waves-effect" style="width: 70px; margin-bottom: 5px;">Kejadian</button></a><br>
                                                <a class="foto_kejadian" href="<?= base_url().'assets/path_selfie/'.$data->image_selfie ?>"><button class="btn bg-pink waves-effect" style="width: 70px">Selfie</button></a>
                                            </td>
                                            <td><?= ucfirst($data->status) ?></td>
                                            <td>
                                                <?php if ($data->status == 'selesai') { ?>
                                                    <button class="btn bg-green waves-effect" data-toggle="modal" data-target="#modal_lapor" onclick="addLap('<?= $data->id_lapor ?>', '<?= $data->nama_user ?>')" style="width: 70px; margin-bottom: 5px;">Laporan</button><br>
                                                    <button class="btn bg-link waves-effect" style="width: 70px;" disabled>Selesai</button>
                                                <?php }else{ ?>
                                                    <button class="btn bg-link waves-effect" style="width: 70px; margin-bottom: 5px;" disabled>Laporan</button><br>
                                                    <button class="btn bg-orange waves-effect" onclick="lapSelesai('<?= $data->id_lapor ?>')" style="width: 70px;">Selesai</button>
                                                <?php } ?>
                                            </td>
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
</section>

<!-- Modal Laporan -->
<div class="modal fade" id="modal_lapor" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <form name="laporan" id="lp" method="post" action="<?= base_url().'Damkar/simpanLap'; ?>">
                        <input type="hidden" name="id_lapor" id="id_lapor">
                        <!-- <div class="modal-header"> -->
                            
                        <!-- </div> -->
                        <div class="modal-body" id="print-page">
                            <center>
                                <h4 class="modal-title" id="defaultModalLabel">Laporan Kegiatan/Kejadian</h4>
                            </center>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Jenis Kejadian
                                    </div>
                                    <div class="col-md-9">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="jenis_kejadian" id="jenis_kejadian" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Tanggal Kejadian
                                    </div>
                                    <div class="col-md-3">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="tgl_kejadian" id="tgl_kejadian" required style="margin-bottom: -4px;" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        Waktu Kejadian
                                    </div>
                                    <div class="col-md-3">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="waktu_awal" id="waktu_awal" required style="margin-bottom: -4px;" readonly>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Tanggal Selesai
                                    </div>
                                    <div class="col-md-3">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="tgl_selesai" id="tgl_selesai" style="margin-bottom: -4px;" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        Waktu Selesai
                                    </div>
                                    <div class="col-md-3">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="waktu_akhir" id="waktu_akhir" style="margin-bottom: -4px;" readonly required>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Alamat Kejadian
                                    </div>
                                    <div class="col-md-9">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <!-- <input type="text" class="form-control" name="almt_kejadian" id="almt_kejadian" required style="margin-bottom: -4px;"> -->
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="almt_kejadian" id="almt_kejadian" required style="margin-bottom: -4px;">&nbsp</textarea>

                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Keterangan
                                    </div>
                                    <div class="col-md-9">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <!-- <input type="text" class="form-control" name="almt_korban" id="almt_korban" required style="margin-bottom: -4px;"> -->
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="keterangan" id="keterangan" required style="margin-bottom: -4px;"></textarea>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Penyebab
                                    </div>
                                    <div class="col-md-9">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="penyebab_kejadian" id="penyebab_kejadian" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Nama Korban
                                    </div>
                                    <div class="col-md-9">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="nama_korban" id="nama_korban" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Alamat Korban
                                    </div>
                                    <div class="col-md-9">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <!-- <input type="text" class="form-control" name="almt_korban" id="almt_korban" required style="margin-bottom: -4px;"> -->
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="almt_korban" id="almt_korban" required style="margin-bottom: -4px;"></textarea>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Saksi
                                    </div>
                                    <div class="col-md-9">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="saksi" id="saksi" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Kerugian
                                    </div>
                                    <div class="col-md-9">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <input type="text" class="form-control" name="kerugian" id="kerugian" required style="margin-bottom: -4px;">
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Kronologi Kejadian
                                    </div>
                                    <div class="col-md-9">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <!-- <input type="text" class="form-control" name="kronologi" id="kronologi" required style="margin-bottom: -4px;"> -->
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="kronologi" id="kronologi" required style="margin-bottom: -4px;"></textarea>

                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Tindakan
                                    </div>
                                    <div class="col-md-9">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <!-- <input type="text" class="form-control" name="tindakan" id="tindakan" required style="margin-bottom: -4px;"> -->
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="tindakan" id="tindakan" required style="margin-bottom: -4px;"></textarea>

                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Pelapor
                                    </div>
                                    <div class="col-md-9">
                                        <div id="oldPass" class="form-line" style="margin-top: -5px;">
                                            <!-- <input type="text" class="form-control" name="pelapor" id="pelapor" required style="margin-bottom: -4px;"> -->
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="pelapor" id="pelapor" required style="margin-bottom: -4px;"></textarea>

                                        </div>
                                    </div>
                                </div>                        
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btn_simpan" class="btn btn-primary waves-effect">SIMPAN</button>
                            <a href="" class="btn btn-warning waves-effect" id="btn_cetak">CETAK</a>
                            <!-- <button class="btn btn-warning waves-effect" onclick="printLaporan('print-page')">CETAK</button> -->
                            <!-- <button type="reset" id="btn_simpan" class="btn btn-warning waves-effect">RESET</button> -->
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">KELUAR</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Initialize Firebase -->
<script src="https://www.gstatic.com/firebasejs/5.9.4/firebase.js"></script>
<script type="text/javascript">
    // var config = {
    //   apiKey: "AIzaSyCks8kbDWSA7c0ZgsjVyNp4sDaQlB1tK0I",
    //   authDomain: "panicbutton-8a07e.firebaseapp.com",
    //   databaseURL: "https://panicbutton-8a07e.firebaseio.com",
    //   projectId: "panicbutton-8a07e",
    //   storageBucket: "panicbutton-8a07e.appspot.com",
    //   messagingSenderId: "526078919663"
    // };

    // firebase.initializeApp(config);
</script>

<!-- Event Laporan Selesai -->
<script type="text/javascript">
  function lapSelesai(id='', key='') {
        var config = {
          apiKey: "AIzaSyCks8kbDWSA7c0ZgsjVyNp4sDaQlB1tK0I",
          authDomain: "panicbutton-8a07e.firebaseapp.com",
          databaseURL: "https://panicbutton-8a07e.firebaseio.com",
          projectId: "panicbutton-8a07e",
          storageBucket: "panicbutton-8a07e.appspot.com",
          messagingSenderId: "526078919663"
        };

        firebase.initializeApp(config);
      // alert(id+' - '+key);
      var ids = parseInt(id);
      swal({
          title: "Aduan",
          text: "Apakah aduan ini sudah selesai?",
          type: "info",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
      }, function () {
            setTimeout(function () {

                    $.post("<?= base_url() ?>/Damkar/lapSelesai", {id_lap: id, key: key}, function(result){
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
                                swal("Aduan sudah selesai!"); 
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


<script type="text/javascript">
    function addZero(n){
      if(n <= 9){
        return "0" + n;
      }
      return n
    }

    function addLap(id, pelapor) {
        $.post("<?= base_url() ?>/Damkar/showLap", {id_lap: id}, function(result){
            var dt = JSON.parse(result);
            var tgl_lapor = new Date(dt.tgl_lapor);
            var waktu_awal = new Date(dt.tgl_lapor);
            var waktu_akhir = new Date(dt.waktu_selesai);
            // alert(dt.waktu_selesai);
            $('#id_lapor').val(id);
            $('#pelapor').val(pelapor);
            $('#tgl_kejadian').val(addZero(tgl_lapor.getDate())+'-'+addZero(tgl_lapor.getMonth()+1)+'-'+tgl_lapor.getFullYear());
            $('#waktu_awal').val(addZero(waktu_awal.getHours())+':'+addZero(waktu_awal.getMinutes()));

            if (dt.waktu_selesai === '' || dt.waktu_selesai === null || dt.waktu_selesai === 'null') {
                $('#waktu_akhir').val('');
                $('#tgl_selesai').val('');
            }else{
                $('#tgl_selesai').val(addZero(waktu_akhir.getDate())+'-'+addZero(waktu_akhir.getMonth()+1)+'-'+waktu_akhir.getFullYear());
                $('#waktu_akhir').val(addZero(waktu_akhir.getHours())+':'+addZero(waktu_akhir.getMinutes()));
            }

            $('#almt_kejadian').val(dt.alamat);
            $('#keterangan').val(dt.keterangan);
            $('#jenis_kejadian').val(dt.jenis_kejadian);            
            $('#penyebab_kejadian').val(dt.penyebab_kejadian);
            $('#nama_korban').val(dt.nama_korban);
            $('#almt_korban').val(dt.alamat_korban);
            $('#saksi').val(dt.saksi);
            $('#kerugian').val(dt.kerugian);
            $('#kronologi').val(dt.kronologi);
            $('#tindakan').val(dt.tindakan);
            $('#btn_cetak').attr("href","<?= base_url().'Damkar/cetakLap/' ?>"+id);
        });
        
    }
</script>

<script type="text/javascript">
    function printLaporan(n){
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





