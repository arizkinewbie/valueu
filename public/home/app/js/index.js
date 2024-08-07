$(document).ready(function () {
  let param = new URLSearchParams(window.location.search);
  token = param.get("token") ?? null;
  let current_url = window.location.origin + "/home";
  if (token) {
    $.ajax({
      url: current_url + '/check?token=' + token,
      method: 'GET',
      success: function (data) {
        if (data.status == 200) {
          let iatFormat = new Date(data.data.iat * 1000);
          dataHTML = `
          <tr>
            <td class="text-center"><i class="fa-regular fa-circle-check text-success mb-2" style="font-size: 90px; display: block; margin: 0 auto;"></i>${data.message}.</td>
          </tr>
          <tr>
            <td width="700px" class="text-center"><b>Pengesahan Berlaku Hingga</b></td>
          </tr>
          <tr>
            <td class="text-center"><i>${data.data.tgl_berlaku}</i></td>
          </tr>
           <tr>
            <td width="700px"><b>Terbit Surat :</b></td>
          </tr>
          <tr>
            <td>${data.data.tgl_terbit}</td>
          </tr>
          <tr>
            <td><b>Nomor :</b></td>
          </tr>
          <tr>
            <td>${data.data.nomor}</td>
          </tr>
          <tr>
            <td><b>Perihal :</b></td>
          </tr>
          <tr>
            <td>${data.data.hal}</td>
          </tr>
          <tr>
            <td><b>Keterangan :</b></td>
          </tr>
          <tr>
            <td>${data.data.keterangan}</td>
          </tr>
          <tr>
          <tr>
            <td><b>Pengaju :</b></td>
          </tr>
          <tr>
            <td>${data.data.pengaju}</td>
          </tr>
          <tr>
            <td><b>Disahkan oleh :</b></td>
          </tr>
          <tr>
            <td>${data.data.iss}</td>
          </tr>
          <tr>
            <td><b>Disahkan pada :</b></td>
          </tr>
          <tr>
            <td>${iatFormat}</td>
          </tr>
          `;
        } else if (data.status == 400) {
          dataHTML = `
          <tr>
            <td class="text-center" width="700px"><i class="fa-solid fa-triangle-exclamation text-warning mb-2" style="font-size: 90px; display: block; margin: 0 auto;"></i>${data.message}.</td>
          </tr>`;
          $('#check-content').removeClass('alert-success');
          $('#check-content').addClass('alert-warning');
         } else {
          dataHTML = `
          <tr>
            <td class="text-center" width="700px"><i class="fa-regular fa-circle-xmark text-danger mb-2" style="font-size: 90px; display: block; margin: 0 auto;"></i>${data.message}.</td>
          </tr>`;
          $('#check-content').removeClass('alert-success');
          $('#check-content').addClass('alert-danger');
        }
        $('.card-body').hide();
        $('#check-content').html(dataHTML).show();
      },
      error: function (xhr, status, error) {
        console.log(error, xhr, status);
      }
    });
  }
});

//QRCode Reader
$('#scanQrCodeBtn, #scanQrCodeBtn2').on('click', function () {
  $('.card-body').hide();
  $('#check-content').hide();
  var qrCodeReaderDiv = document.getElementById('qrCodeReader');
  qrCodeReaderDiv.style.display = 'block';
  const html5QrCode = new Html5Qrcode("qrCodeReader");
  const qrCodeSuccessCallback = (decodedText, decodedResult) => {
    console.log(`QR Code decoded: ${decodedText}, ${decodedResult}`);

    // Regular expression to check if the decoded text is a URL
    const urlPattern = /^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([/\w .-]*)*\/?$/;

    if (urlPattern.test(decodedText)) {
      // Redirect to the URL
      window.location.href = decodedText.startsWith("http") ? decodedText : `http://${decodedText}`;
    } else {
      alert(`QR Code decoded: ${decodedText}`);
    }

    // Hide the QR code reader after successful scan
    html5QrCode.stop().then(() => {
      qrCodeReaderDiv.style.display = 'none';
    }).catch(err => {
      console.error('Failed to stop QR code reader:', err);
    });
  };

  const config = { fps: 10, qrbox: 250 };

  html5QrCode.start(
    { facingMode: "environment" },
    config,
    qrCodeSuccessCallback
  ).catch(err => {
    console.error('Unable to start QR code scanner:', err);
  });
});


// Accordion
const accordionButtons = document.querySelectorAll(".accordion__button");

accordionButtons.forEach((button) => {
  button.addEventListener("click", () => {
    // toggle class active to accordion
    button.parentElement.classList.toggle("active");

    const iconButton = button.querySelector(".accordion__icon img");

    // toggle accordion button icon
    if (iconButton.src.includes("icon-expand.svg")) {
      iconButton.src = "./public/home/assets/icon-collapse.svg";
    } else {
      iconButton.src = "./public/home/assets/icon-expand.svg";
    }
  });
});

// Team Staffs
const teamStaffs = document.querySelectorAll(".team__staff");
const staffPrevBtn = document.getElementById("staff-prev-btn");
const staffNextBtn = document.getElementById("staff-next-btn");

let staffCardExpandedIndex = 0;
expandStaffCardIndex(staffCardExpandedIndex);

teamStaffs.forEach((teamStaff, index) => {
  teamStaff.addEventListener("click", () => {
    staffCardExpandedIndex = index;
    expandStaffCardIndex(staffCardExpandedIndex);
  });
});

// prev btn
staffPrevBtn.addEventListener("click", () => {
  staffCardExpandedIndex -= 1;

  if (staffCardExpandedIndex < 0) {
    staffCardExpandedIndex = 0;
  }

  expandStaffCardIndex(staffCardExpandedIndex);
});

// next btn
staffNextBtn.addEventListener("click", () => {
  staffCardExpandedIndex += 1;

  if (staffCardExpandedIndex > teamStaffs.length - 1) {
    staffCardExpandedIndex = teamStaffs.length - 1;
  }

  expandStaffCardIndex(staffCardExpandedIndex);
});

function expandStaffCardIndex(n) {
  if (n === teamStaffs.length - 1) {
    staffNextBtn.classList.remove("active");
  } else {
    staffNextBtn.classList.add("active");
  }

  if (n === 0) {
    staffPrevBtn.classList.remove("active");
  } else {
    staffPrevBtn.classList.add("active");
  }

  for (let i = 0; i < teamStaffs.length; i++) {
    teamStaffs[i].classList.remove("active");
  }

  teamStaffs[staffCardExpandedIndex].classList.add("active");
}
