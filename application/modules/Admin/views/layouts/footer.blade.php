    
    <!-- Jquery Core Js -->
    <script src="<?php echo base_url().'assets/'; ?>assets/bundles/libscripts.bundle.js"></script>    
    <script src="<?php echo base_url().'assets/'; ?>assets/bundles/vendorscripts.bundle.js"></script>

    <!-- Sweet Alert -->
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/sweetalert/sweetalert.min.js"></script>  
    <script src="<?php echo base_url().'assets/'; ?>assets/js/pages/ui/dialogs.js"></script> 

    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js --> 
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js --> 
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js --> 
    <script src="<?php echo base_url().'assets/'; ?>assets/vendors/js/forms/select/select2.full.min.js"></script> <!-- Select2 Plugin Js --> 
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/jquery-spinner/js/jquery.spinner.js"></script> <!-- Jquery Spinner Plugin Js --> 
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js --> 
    
    <script src="<?php echo base_url().'assets/assets/plugins/nouislider/nouislider.js'; ?>"></script> <!-- noUISlider Plugin Js --> 
    <script src="<?php echo base_url().'assets/assets/plugins/autosize/autosize.js'; ?>"></script> <!-- Autosize Plugin Js --> 
    <script src="<?php echo base_url().'assets/assets/plugins/momentjs/moment.js'; ?>"></script> <!-- Moment Plugin Js --> 

    {{-- ================================================================================ --}}

    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/jquery-validation/jquery.validate.js"></script> <!-- Jquery Validation Plugin Css --> 
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/jquery-steps/jquery.steps.js"></script> <!-- JQuery Steps Plugin Js --> 

    <!-- Bootstrap Material Datetime Picker Plugin Js --> 
    <script src="<?php echo base_url().'assets/'; ?>assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script> 

    <!-- Bootstrap 4 Datepicker -->
    <script src="<?=base_url().'assets/'; ?>assets/plugins/datepicker-4/gijgo.min.js" type="text/javascript"></script>

    <!-- date-range-picker -->
    <!-- <script src="<?php //echo base_url().'assets/assets/plugins/daterangepicker/moment-new.min.js';?>"></script> -->
    <!-- <script src="<?php //echo base_url().'assets/assets/plugins/daterangepicker/daterangepicker.js';?>"></script> -->

    <!-- Custom JS -->
    <script src="<?php echo base_url().'assets/'; ?>assets/bundles/mainscripts.bundle.js"></script>

    <!-- Image Galery -->
    <!-- <script src="<?php //echo base_url().'assets/assets/js/pages/medias/image-gallery.js'; ?>"></script>  -->

    <!-- Fancybox -->
    <script type="text/javascript" src="<?php echo base_url().'assets/';?>assets/plugins/fancybox/jquery.fancybox.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/';?>assets/plugins/fancybox/jquery.fancybox.pack.js"></script>

    <script src="<?php echo base_url().'assets/assets/js/pages/forms/form-validation.js'; ?>"></script> 
    <script src="<?php echo base_url().'assets/assets/js/pages/forms/advanced-form-elements.js'; ?>"></script> 
    <script src="<?php echo base_url().'assets/assets/js/pages/forms/basic-form-elements.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/assets/js/pages/tables/jquery-datatable.js'; ?>"></script>

    @yield('footer')

    <script type="text/javascript">
        $('.foto_kejadian').fancybox({});
    </script>

    <!-- Sorting Datatable -->
    <script type="text/javascript">
        // $(document).ready(function() {
        //     $('#data-histori').DataTable( {
        //         "order": [[ 0, "desc" ]]
        //     } );
        // });
    </script>

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
                    swal("Cancelled", "Your imaginary file is safe :", "error");
                }
            });
        }
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

    <!-- Input Angka -->
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
