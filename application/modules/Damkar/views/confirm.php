  <!DOCTYPE html>
  <html>
  <head>
    <title>Confirm</title>
   <!-- Sweet Alert Css -->
    <link href="<?php echo base_url().'assets/';?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
  </head>

  <body>
   <!-- Sweet Alert Plugin Js -->
    <script src="<?php echo base_url().'assets/';?>assets/plugins/sweetalert/sweetalert.min.js"></script>
     <!-- Fungsi Dialog -->
    <script type="text/javascript">
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
                timer: 700,
                showConfirmButton: false
            });
        }

        function showSuccessMessage(input,link) {
            swal({
                title: input+"!",
                text: "Data Berhasil "+input+"!",
                type: "success",
                timer: 700,
                showConfirmButton: false
            }, function () {
                window.location = link;
            });
        }

        function showFailedMessage(input) {
            swal({
                title: "Gagal!",
                text: "Data Gagal "+input+"!",
                type: "error",
                timer: 700,
                showConfirmButton: false
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

    <!-- Notif Tambah User -->
    <script type="text/javascript">
        var notif_pend = '<?= $notif_pend; ?>';
        if (notif_pend == 'Tambah Sukses') {
            showSuccessMessage('Ditambahkan','<?php echo base_url()."Admin/dataLoginPendidik"; ?>');
        }
        if (notif_pend == 'Tambah Gagal') {
            showFailedMessage('Ditambahkan')
            history.back(-1);
        }

        if (notif_pend == 'Edit Sukses') {
            showSuccessMessage('Diupdate','<?php echo base_url().'Admin/dataLoginPendidik'; ?>');
        }
        if (notif_pend == 'Edit Gagal') {
            showFailedMessage('Diupdate')
            history.back(-1);
        }
    </script>
  </body>
  </html>

   