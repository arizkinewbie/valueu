<?php

namespace App\Libraries;

require_once APPPATH . 'ThirdParty/PHPQRCode/autoload.php';
use chillerlan\QRCode\QRCode;

class QRCodeGenerator
{
  private $logoPath;
  private $outputPath;

  public function __construct($logoPath, $outputPath)
  {
    $this->logoPath = $logoPath;
    $this->outputPath = $outputPath;
  }

  public function generateQRCode($text, $qrCodeFile)
  {
    // Buat QR code
    $tempQRCodePath = $this->outputPath . 'temp_qrcode.png';
    // QRcode::png($text, $tempQRCodePath, QR_ECLEVEL_H, 10);

    // Load QR code dan logo
    $qrCode = imagecreatefrompng($tempQRCodePath);
    $logo = imagecreatefrompng($this->logoPath);

    // Dapatkan ukuran QR code dan logo
    $qrWidth = imagesx($qrCode);
    $qrHeight = imagesy($qrCode);
    $logoWidth = imagesx($logo);
    $logoHeight = imagesy($logo);

    // Ukuran logo yang diinginkan (misalnya 20% dari QR code)
    $logoNewWidth = $qrWidth * 0.2;
    $logoNewHeight = $logoHeight * ($logoNewWidth / $logoWidth);

    // Hitung posisi untuk menempatkan logo di tengah QR code
    $logoXPos = ($qrWidth - $logoNewWidth) / 2;
    $logoYPos = ($qrHeight - $logoNewHeight) / 2;

    // Tempatkan logo di tengah QR code
    imagecopyresampled($qrCode, $logo, $logoXPos, $logoYPos, 0, 0, $logoNewWidth, $logoNewHeight, $logoWidth, $logoHeight);

    // Simpan QR code dengan logo
    imagepng($qrCode, $this->outputPath . $qrCodeFile);

    // Hapus file sementara
    unlink($tempQRCodePath);

    // Bersihkan memori
    imagedestroy($qrCode);
    imagedestroy($logo);
  }
}
