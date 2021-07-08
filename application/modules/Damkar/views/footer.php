    

    <!-- Light Gallery Plugin Js --> 
    <!-- <script src="<?php //echo base_url().'assets/'; ?>assets/plugins/light-gallery/js/lightgallery-all.js"></script>  -->

    <!-- Sweet Alert -->
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/sweetalert/sweetalert.min.js"></script>  
    <script src="<?php echo base_url().'assets/'; ?>assets/js/pages/ui/dialogs.js"></script> 

    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js --> 
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js --> 
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js --> 
    <script src="<?php echo base_url().'assets/'; ?>assets/vendors/js/forms/select/select2.full.min.js"></script> <!-- Select2 Plugin Js --> 
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/jquery-spinner/js/jquery.spinner.js"></script> <!-- Jquery Spinner Plugin Js --> 
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js --> 
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/nouislider/nouislider.js"></script> <!-- noUISlider Plugin Js --> 

    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/jquery-validation/jquery.validate.js"></script> <!-- Jquery Validation Plugin Css --> 
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/jquery-steps/jquery.steps.js"></script> <!-- JQuery Steps Plugin Js --> 

    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/autosize/autosize.js"></script> <!-- Autosize Plugin Js --> 
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/momentjs/moment.js"></script> <!-- Moment Plugin Js --> 

    <!-- Bootstrap Material Datetime Picker Plugin Js --> 
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script> 

    <!-- Bootstrap 4 Datepicker -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
    <script src="<?=base_url().'assets/'; ?>assets/plugins/datepicker-4/gijgo.min.js" type="text/javascript"></script>

    <!-- date-range-picker -->
    <!-- <script src="<?php //echo base_url().'assets/';?>assets/plugins/daterangepicker/moment-new.min.js"></script> -->
    <!-- <script src="<?php //echo base_url().'assets/';?>assets/plugins/daterangepicker/daterangepicker.js"></script> -->

    <!-- Jquery DataTable Plugin Js --> 
    <script src="<?php echo base_url().'assets/'; ?>assets/bundles/datatablescripts.bundle.js"></script>
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>

    <!-- Custom JS -->
    <script src="<?php echo base_url().'assets/'; ?>assets/bundles/mainscripts.bundle.js"></script>

    <!-- Image Galery -->
    <script src="<?php echo base_url().'assets/'; ?>assets/js/pages/medias/image-gallery.js"></script> 

    <!-- Fancybox -->
    <script type="text/javascript" src="<?php echo base_url().'assets/';?>assets/plugins/fancybox/jquery.fancybox.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/';?>assets/plugins/fancybox/jquery.fancybox.pack.js"></script>

    <script src="<?php echo base_url().'assets/'; ?>assets/js/pages/forms/form-validation.js"></script> 
    <script src="<?php echo base_url().'assets/'; ?>assets/js/pages/forms/advanced-form-elements.js"></script> 
    <script src="<?php echo base_url().'assets/'; ?>assets/js/pages/forms/basic-form-elements.js"></script>
    <script src="<?php echo base_url().'assets/'; ?>assets/js/pages/tables/jquery-datatable.js"></script>

    <script type="text/javascript">
        $("#pilih #admin").on('change', function() {
            if(this.checked) {
                $("#pilih #semua").prop('checked', false).checkboxradio('refresh');
            }else{
                $("#pilih #semua").prop('checked', true).checkboxradio('refresh');
            }
        });

        $("#pilih #semua").on('change', function() {
            if(this.checked) {
                $("#pilih #admin").prop('checked', false).checkboxradio('refresh');
            }else{
                $("#pilih #admin").prop('checked', true).checkboxradio('refresh');
            }
        });
    </script>

    <script type="text/javascript">
        $('.foto_kejadian').fancybox({});
    </script>

    <!-- Sorting Datatable -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#data-histori').DataTable( {
                "order": [[ 0, "desc" ]]
            } );
        });
    </script>

    <?php if (isset($data_histori)) { ?>
        <script>
            $("#data_histori").DataTable({
                "processing": true,
                "serverSide": true,
                "searching": true,
                "scrollX": true,
                "order":[],  
                "ajax":{  
                    "url": "<?= base_url('Damkar/getDataHistori') ?>",  
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
                        "width": "100",
                        "orderable":false,  
                        "class":"text-center" 
                    }
                    // {  
                    //     "targets":2,  
                    //     "width": "10",
                    //     "orderable":false,  
                    //     "class":"text-center" 
                    // }
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
    <?php } ?>

    <?php if (isset($data_kejadian)) { ?>
        <script>
            $("#data_kejadian").DataTable({
                "processing": true,
                "serverSide": true,
                "searching": true,
                "scrollX": true,
                "order":[],  
                "ajax":{  
                    "url": "<?= base_url('Damkar/getDataKejadian/'.$jenis_lap) ?>",  
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
    <?php } ?>

    <script>
        $(".select2").select2({dropdownCssClass: "sizeFontSm"});
    </script>


    <!-- Fungsi Dialog -->
    <script type="text/javascript">
        //These codes takes from http://t4t5.github.io/sweetalert/
        function showBasicMessage() {
            swal("Here's a message!");
        }

        function showWithTitleMessage() {
            swal("Here's a message!", "It's pretty, isn't it?");
        }

        function validasiMessage(){
            swal({
                title: "Dilarang!",
                text: "Data tidak boleh lebih dari jumlah permintaan!",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
        }

        function showSuccessMessage(input) {
            swal({
                title: input+"!",
                text: "Data Berhasil "+input+"!",
                type: "success",
                timer: 1000,
                showConfirmButton: false
            });
        }

        function showFailedMessage(input) {
            swal({
                title: "Gagal!",
                text: "Data Gagal "+input+"!",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
        }

        function showConfirmMessage(id) {
            swal({
                title: "Anda yakin data akan dihapus?",
                text: "Data tidak akan dapat di kembalikan lagi!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Hapus!",
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    type : "GET",
                    url  : "<?php echo base_url('Damkar/deleteUnit')?>",
                    dataType : "html",
                    data : {id:id},
                    success: function(data){
                        // alert(data);

                        $('#tbl-unit').DataTable().destroy();
                        showUnit();
                        $('#tbl-unit').DataTable().draw();
                        // kode_otomatis();
                        // $('#editModal #pilihBrg').attr('selected','');
                        // $('#editModal').modal('hide');

                        if(data=='Success'){
                            showSuccessMessage('Dihapus');
                        }else{
                            showFailedMessage('Dihapus');
                        } 
                    }
                });
                return false;
                // swal("Hapus!", "Data telah berhasil dihapus.", "success");
            });
        }

        function showCancelMessage() {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "Your imaginary file has been deleted.", "success");
                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
        }
    </script>

 <!--    <script type="text/javascript">
        $("#tgl_lhr_pend, #tglLhrPend").on('click',function(){
            $('#tglLhrPend').attr('class','form-line focused');
            // setInterval(function(){
            //     if ($('#tgl_lhr_pend').val() != '') {
            //          $('#tglLhrPend').attr('class','form-line focused');
            //     }
            // },10);
        });

        $("#tgl_lhr_pend").on("change.datepicker", function (e) {
             var date = $(this).val();
             $('#tglLhrPend').attr('class','form-line focused');
        });

        function resetPendidik() {
             $('#tglLhrPend').attr('class','form-line');
        }
    </script> -->

<!--     <script type="text/javascript">
        function delPendidik(id_log, id_pend) {
            // alert(id);
            swal({
                title: "Anda yakin data akan dihapus?",
                text: "Data tidak akan dapat di kembalikan lagi!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Hapus!",
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('Damkar/deletePend')?>",
                    dataType : "html",
                    data : {id_log:id_log, id_pend:id_pend},
                    success: function(data){
                        // alert(data);
                        if(data=='Success'){
                            showSuccessMessage('Dihapus');
                            setTimeout(function(){location='<?= base_url('Damkar/dataLoginPendidik')?>'},700);
                        }else{
                            showFailedMessage('Dihapus');
                        } 
                    }
                });
                return false;
                // swal("Hapus!", "Data telah berhasil dihapus.", "success");
            });
        }
    </script> -->

    <!-- UBAH PASSWORD -->
    <script type="text/javascript">
        // $("#old_pass").on('click',function(){
        //     $('#oldPass').attr('class','form-line focused');
        //     $('#error_oldPass').html('');
        // });
        // $("#new_pass").on('click',function(){
        //     $('#newPass').attr('class','form-line focused');
        //     $('#error_newPass').html('');
        // });
        // $("#new_pass2").on('click',function(){
        //     $('#newPass2').attr('class','form-line focused');
        //     $('#error_newPass2').html('');
        // });

        // UBAH PASSWORD
        $('#Modal_Ubah_Pwd #btn_simpan').on('click',function(){
            var id = <?php echo $this->session->userdata('id_login'); ?>;
            var oldPass=$('#Modal_Ubah_Pwd #old_pass').val();
            var newPass=$('#Modal_Ubah_Pwd #new_pass').val();
            var newPass2=$('#Modal_Ubah_Pwd #new_pass2').val();
            // $('#coba').html(sabar);
            if (oldPass=='' || newPass=='' || newPass2=='') {
                if (oldPass=='') {
                    $('#oldPass').attr('class','form-line focused error');
                    $('#error_oldPass').html('Field harus diisi.');
                }
                if (newPass=='') {
                    $('#newPass').attr('class','form-line focused error');
                    $('#error_newPass').html('Field harus diisi.');
                }
                if (newPass2=='') {
                    $('#newPass2').attr('class','form-line focused error');
                    $('#error_newPass2').html('Field harus diisi.');
                }
            }else{
                $('.page-loader-wrapper2').show();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('Damkar/changePassword')?>",
                    dataType : "html",
                    data : {id:id, oldPass:oldPass, newPass:newPass},
                    success: function(data){
                        // alert(data);
                        $('.page-loader-wrapper2').hide();  
                        $('#Modal_Ubah_Pwd').modal('hide');   
                        $("#cp")[0].reset();
                        $('#oldPass').attr('class','form-line');
                        $('#newPass').attr('class','form-line');
                        $('#newPass2').attr('class','form-line');
                        $('#error_oldPass').attr('style','color:red');
                        $('#error_oldPass').html('');
                        $('#error_newPass').attr('style','color:red');
                        $('#error_newPass').html('');
                        $('#error_newPass2').attr('style','color:red');
                        $('#error_newPass2').html('');

                        if(data=='Success'){
                            showSuccessMessage('Tersimpan');
                        }else{
                            showFailedMessage('Tersimpan');
                        }  
                    }
                });
                return false;
            }
        });

        // VALIDASI PASSWORD LAMA
        function validPass(){
            var id = <?php echo $this->session->userdata('id_login'); ?>;
            var pass = $('#old_pass').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/Damkar/validPassword')?>",
                dataType : "html",
                data : {id:id, pass:pass},
                success: function(data){     
                    // alert(data);         
                    if(data=='Valid'){
                        $('#oldPass').attr('class','form-line focused success');
                        $('#error_oldPass').attr('style','color:green');
                        $('#error_oldPass').html('Password valid.');
                        $('#Modal_Ubah_Pwd #btn_simpan').removeAttr('disabled');
                        if ($('#newPass2').attr('class')=='form-line focused error') {
                            $('#Modal_Ubah_Pwd #btn_simpan').attr('disabled','');
                        }
                    }else{
                        $('#oldPass').attr('class','form-line focused error');
                        $('#error_oldPass').attr('style','color:red');
                        $('#error_oldPass').html('Password tidak valid.');
                        $('#Modal_Ubah_Pwd #btn_simpan').attr('disabled','');
                    }  
                    if (pass=='') {
                        $('#oldPass').attr('class','form-line focused');
                        $('#error_oldPass').html('');
                        $('#Modal_Ubah_Pwd #btn_simpan').removeAttr('disabled');
                    }
                }
            });
            return false;
        }

        // ULANGI PASS
        function ulangPass(){
            var pass1 = $('#new_pass').val();
            var pass2 = $('#new_pass2').val();

            if(pass1==pass2){
                $('#newPass2').attr('class','form-line focused success');
                $('#error_newPass2').attr('style','color:green');
                $('#error_newPass2').html('Password cocok.');
                $('#Modal_Ubah_Pwd #btn_simpan').removeAttr('disabled');
                if ($('#oldPass').attr('class')=='form-line focused error') {
                    $('#Modal_Ubah_Pwd #btn_simpan').attr('disabled','');
                }
            }else{
                $('#newPass2').attr('class','form-line focused error');
                $('#error_newPass2').attr('style','color:red');
                $('#error_newPass2').html('Password tidak cocok.');
                $('#Modal_Ubah_Pwd #btn_simpan').attr('disabled','');
            }  
            if (pass2=='') {
                $('#newPass2').attr('class','form-line focused');
                $('#error_newPass2').html('');
                $('#Modal_Ubah_Pwd #btn_simpan').removeAttr('disabled');
            }
        }
    </script>

    <!-- Format Date Range Picker -->
    <!-- <script type="text/javascript">
        $(function() {

            $('#tgl_lhr_user').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
              }
            });

            $('#tgl_lhr_user').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' / ' + picker.endDate.format('YYYY-MM-DD'));
            });

            $('#tgl_lhr_user').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

        });
    </script> -->

    <script type="text/javascript">
         $.fn.datepicker.dates['id'] = {
                days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
                daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
                months: ["Januari", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                today: "Today"
            };
    </script>

    <!-- Date picker -->
    <script type="text/javascript">
        $('#tgl_kejadian').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy',
            autoclose: true,
            language: 'id'
        })

        $('#tgl_kejadian2').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy',
            autoclose: true,
            language: 'id'
        })

        $('#tgl_selesai').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy',
            autoclose: true,
            language: 'id'
        })

        $('#tgl_selesai2').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy',
            autoclose: true,
            language: 'id'
        })

        $('#tgl_lhr').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy',
            autoclose: true,
            language: 'id'
        })

        $('#tgl_lhr2').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy',
            autoclose: true,
            language: 'id'
        })
    </script>

    <script type="text/javascript">
        $('#waktu_awal').timepicker({
            autoclose: true
        });
        $('#waktu_akhir').timepicker({
            autoclose: true
        });

        $('#waktu_awal2').timepicker({
            autoclose: true
        });
        $('#waktu_akhir2').timepicker({
            autoclose: true
        });
    </script>

    <script type="text/javascript">
        function inputAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
            return true;
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.alert').fadeTo(3000, 500).slideUp(500);
        });
    </script>

</body>

</html>
