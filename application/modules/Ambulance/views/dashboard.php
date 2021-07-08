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

        <!-- Widgets -->
        <div class="row clearfix">
            <!-- JML ADMIN -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">JML USER APLIKASI</div>
                        <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?=$jml_user  ?></div>
                    </div>
                </div>
            </div>
            <!-- JML PIMPINAN -->
            <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">JUMLAH PIMPINAN</div>
                        <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?=$jml_pimpinan  ?></div>
                    </div>
                </div>
            </div> -->
            <!-- JML PETUGAS -->
            <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">JUMLAH PETUGAS</div>
                        <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?=$jml_petugas  ?></div>
                    </div>
                </div>
            </div>  -->      
            <!-- TOTAL USER -->
            <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL USER</div>
                        <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"><?=$jml_user  ?></div>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- #END# Widgets -->


    </div>
</section>