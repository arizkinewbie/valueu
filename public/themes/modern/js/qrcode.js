function generateQRCode($this) {
	let token = '';
	if ($this) {
		token = $this.getAttribute("data-value");
	} else {
		token = document.getElementById('jwtoken').value;
	}
	let inputData = 'https://valueu.arizkinewbie.com/home?token=' + token;
	console.log('data:' + inputData);
	const canvas = document.getElementById('myCanvas');
	const ctx = canvas.getContext('2d');
	const logoSize = 50; // Ukuran logo

	ctx.clearRect(0, 0, canvas.width, canvas.height);

	// Menggunakan qrcode.js untuk membuat QR code
	QRCode.toCanvas(canvas, inputData, {
		width: canvas.width,
		height: canvas.height,
		color: {
			dark: '#000000', // Warna garis QR code
			light: '#ffffff' // Warna latar belakang
		},
		margin: 1 // Margin sekitar QR code
	}, function (error) {
		if (error) console.error(error);
		console.log('QR code generated successfully!');

		// Menambahkan logo di tengah QR code
		const logo = new Image();
		logo.src = window.location.origin + '/public/home/assets/qrueu.png';
		logo.onload = function () {
			const x = (canvas.width - logoSize) / 2;
			const y = (canvas.height - logoSize) / 2;
			ctx.drawImage(logo, x, y, logoSize, logoSize);
		};
	});
	// Simpan QR code dengan logo
	$('.qr-container').show();
}

function downloadQr() {
	var canvas = document.getElementById("myCanvas");
	var dataURL = canvas.toDataURL("image/png");
	var downloadLink = document.createElement("a");
	downloadLink.href = dataURL;
	downloadLink.download = Date.parse(new Date()) + "-qrcode.png";
	downloadLink.click();
}

// QRCode Reader
$('#scanQrCodeBtn, #scanQrCodeBtn2').on('click', async function () {
	const qrCodeReaderVideo = document.getElementById('qrCodeReader');
	let codeReader = new ZXing.BrowserQRCodeReader();
	if (qrCodeReaderVideo.style.display === 'block') {
		qrCodeReaderVideo.style.display = 'none';
		$('.card-body').show();
		codeReader.reset();
		return;
	}
	qrCodeReaderVideo.style.display = 'block';
	try {
		const devices = await codeReader.listVideoInputDevices();
		if (devices.length === 0) {
			alert('No video input devices found');
			throw new Error('No video input devices found');
		}
		const firstDeviceId = devices[0].deviceId;
		codeReader.decodeFromVideoDevice(firstDeviceId, 'qrCodeReader', (result, error) => {
			if (result) {
				console.log(`QR Code decoded: ${result.text}`);
				$token = result.text.split('=')[1];
				document.getElementById('token').value = $token;
				codeReader.reset();
				qrCodeReaderVideo.style.display = 'none';
			}
			if (error && !(error instanceof ZXing.NotFoundException)) {
				console.error('Error while scanning QR code:', error);
			}
		});
	} catch (err) {
		console.error('Unable to start QR code scanner:', err);
	}
});