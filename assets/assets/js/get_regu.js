var protocol = window.location.protocol;
var host = window.location.hostname;

function getRegu() {
	var wmk = $("#modal_form #wmk").val();
	
	if (wmk != "") {
		$("#modal_form #loading-regu").fadeIn("slow");

		$.post(
			protocol + "//" + host + "/Siyap/Damkar/getDataRegu",
			{ id_wmk: wmk },
			function (result) {
				$("#modal_form #loading-regu").fadeIn("slow").delay(100).slideUp("slow");

				var dt = JSON.parse(result);
				// console.log(dt.data);

				if (dt.response) {
					var list = "";
					list += '<option value="" hidden>Pilih Regu</option>';
					for (var i = 0; i < dt.data.length; i++) {
						list +=
							'<option value="' +
							dt.data[i].id_regu +
							'">' +
							dt.data[i].nama_regu +
							"</option>";
					}

                    $("#modal_form #regu").html(list);
                    $('#modal_form #regu').selectpicker('refresh');
				} else {
                    var list = '<option value="" hidden>Pilih Regu</option> <option value="" disabled>Data regu kosong</option>';
                    $("#modal_form #regu").html(list);
                    $('#modal_form #regu').selectpicker('refresh');
                }
			}
		);
	}
}

