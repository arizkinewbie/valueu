jQuery(document).ready(function () {
	$(".select2").select2({
		theme: "bootstrap-5"
	});
	if (document.getElementById('jwtoken').value != '') {
		generateQRCode();
	}

	//show/hide tanggal berlaku
	$('[name="expiredOption"]').on('change', function () {
		if (this.value == 'Y') {
			$('#form-tgl-berlaku').show();
			$('input[name="tgl_berlaku"]').removeAttr('disabled');
			$('input[name="tgl_berlaku"]').attr('required');
		} else {
			$('#form-tgl-berlaku').hide();
			$('input[name="tgl_berlaku"]').val('');
			$('input[name="tgl_berlaku"]').removeAttr('required');
			$('input[name="tgl_berlaku"]').attr('disabled');
		}
	});

	//check form data
	$('#form-container').on('submit', function () {
		form = $(this);
		var data = form.serializeArray();
		$.each(data, function (key, value) {
			console.log(value.name + ": " + value.value);
		});
		console.log(form);
	});
});