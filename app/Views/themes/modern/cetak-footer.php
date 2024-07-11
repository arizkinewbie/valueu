<?php
helper(['html', 'format']);
$urutanAkreditasi = ['unggul', 'a', 'baik sekali', 'b', 'baik', 'c', 'baik\'', 'c\'', 'tidak terakreditasi'];
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="<?php base_url() ?>public/themes/modern/css/cetakdata.css" />
</head>

<body>
    <p style="padding-top: 2pt; text-align: left;">Catatan Telaah:</p>
    <div class="telaah">
        <?= $selectedYayasan ?> menyelenggarakan <?= $TotalPT ?> PTS di lingkungan Lembaga Layanan Pendidikan Tinggi (LLDIKTI) Wilayah III, yaitu <?= $T_PTArray; ?>.<br /><br />
        <?php
        $telaahPTs = [];
        foreach ($PT as $i => $dataPT) {
            if ($telaahOption == "Telaah Yayasan" || $dataPT['nama_pt'] == $selectedPT) {
                $akreditasiCounts = [];
                if (isset($Prodi[$i]) && is_array($Prodi[$i])) {
                    foreach ($Prodi[$i] as $prodi) {
                        $akreditasi = strtolower($prodi['aps']); // Ubah menjadi lowercase
                        if (!isset($akreditasiCounts[$akreditasi])) {
                            $akreditasiCounts[$akreditasi] = 0;
                        }
                        $akreditasiCounts[$akreditasi]++;
                    }
                }

                uksort($akreditasiCounts, function ($a, $b) use ($urutanAkreditasi) {
                    $posA = array_search($a, $urutanAkreditasi);
                    $posB = array_search($b, $urutanAkreditasi);
                    return $posA - $posB;
                });

                $akreditasiStrings = [];
                foreach ($akreditasiCounts as $akreditasi => $count) {
                    $akreditasiFormatted = ucwords($akreditasi); // Ubah menjadi title case
                    if ($akreditasiFormatted === 'Tidak Terakreditasi' or $akreditasiFormatted === 'Tidak Terakreditas' or $akreditasiFormatted === 'Tidak Terakredita' or $akreditasiFormatted === 'Kadaluarsa' or $akreditasiFormatted === 'T') {
                        $akreditasiStrings[] = "$count program studi tidak terakreditasi";
                    } else {
                        $akreditasiStrings[] = "$count program studi terakreditasi $akreditasiFormatted";
                    }
                }
                $akreditasiString = implode(', ', $akreditasiStrings);
                $telaah = $dataPT['nama_pt'] . " menyelenggarakan " . $dataPT['jml_prodi'] . " program studi ($akreditasiString) dengan jumlah mahasiswa sebanyak " . format_ribuan($dataPT['jml_mhs']) . " orang, dosen tetap sebanyak " . format_ribuan($dataPT['jml_dosen_tetap_pt']) . " orang, dan rasio dosen tetap terhadap mahasiswa sebesar 1 : " . number_format($dataPT['jml_mhs'] / $dataPT['jml_dosen_tetap_pt'], 2, ',', '.') . ". Institusi " . $dataPT['nama_pt'] . " aktif menyampaikan laporan PD-Dikti dengan persentase laporan " . $dataPT['persen_lapor'] . "% (" . substr($dataPT['smt_lapor'], 0, 4) . '-' . substr($dataPT['smt_lapor'], 4, 1) . ").";
                $telaahPTs[] = $telaah;
            }
        }
        echo implode('<br><br>', $telaahPTs);
        ?>
    </div>
    <footer>
        <p>
            <i> Dicetak pada tanggal <?= format_tanggal(date('Y-m-d H:i:s')) ?> WIB<br />
                Berdasarkan data PDDIKTI tanggal <?= format_tanggal($dataPT['tgl_input']) ?><br />
                Oleh Sistem Rekam Jejak Perguruan Tinggi (<?= $_ENV['Author'] ?>)</i><br />
        </p>
    </footer>
</body>

</html>