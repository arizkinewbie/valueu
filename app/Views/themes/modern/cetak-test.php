<?php 
// Memuat helper yang diperlukan
helper(['html', 'format']);
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php base_url()?>public/themes/modern/css/cetakdata.css"/>
    </head>
    <body>
    <div class="data-pt">
        <b> I. <u>PENGALAMAN PENGELOLAAN PTS</u></b>
        <ul>
            <li>Apakah Badan Penyelenggara pernah menyelenggarakan PTS ?
                <pre>     Ya [ V ] / Tidak [ ]</pre>
            </li>
        </ul>
        <ul>
            <li>Jika Ya, tuliskan data singkat PTS yang pernah dikelola :</li>
            <br>
            <?php foreach ($PT as $i => $dataPT) : ?>
                <table>
                    <tr>
                        <td>
                            <b><?= ($i + 1); ?> </b>
                        </td>
                        <td>
                            <b>Nama PTS</b>
                        </td>
                        <td>
                            <b>: <?= $dataPT['nama_pt'] . ' (' . $dataPT['kode_pt'] . ')'; ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Jumlah Prodi</td>
                        <td>: <?= format_ribuan($dataPT['jml_prodi']) . ' Prodi'; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Jumlah Mahasiswa</td>
                        <td>: <?= format_ribuan($dataPT['jml_mhs']) . ' Orang'; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Jumlah Dosen Tetap</td>
                        <td>: <?= format_ribuan($dataPT['jml_dosen_tetap_pt']) . ' Orang'; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Jumlah Dosen Penghitung Rasio</td>
                        <td>: <?= format_ribuan($dataPT['jml_dosen_rasio']) . ' Orang'; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Rasio Dosen tetap : Mahasiswa (Institusi)</td> <!-- K : I -->
                        <td>: 1 : <?= number_format($dataPT['jml_mhs']/ $dataPT['jml_dosen_rasio'], 2, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Lap. PDPT Terakhir</td>
                        <td>: <?= $dataPT['persen_lapor'] . '% (' . substr($dataPT['smt_lapor'], 0, 4) . '-' . substr($dataPT['smt_lapor'], 4, 1). ')'; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Berdasarkan data PDDIKTI tanggal</td>
                        <td>: <?= format_tanggal($dataPT['tgl_input']) ?></td>
                    </tr>
                </table>
                <br>
                <div class="data-prodi">
                    <table style="border-collapse: collapse; margin-left: 10pt" cellspacing="0">
                        <tbody>
                        <tr>
                            <td class="no"><b>No</b></td>
                            <td class="prodi"><b>Program Studi</b></td>
                            <td class="jenjang"><b>Jen</b></td>
                            <td class="semawal"><b>Sem. <br>Awal</b></td>
                            <td class="jumlah-mhs"><b>Jum. Mhs</b></td>
                            <td class="jumlah-dosen"><b>Jum. Dosen Tetap</b></td>
                            <td class="jumlah-dosen"><b>Jum. Dosen Rasio</b></td>
                            <td class="rasio"><b>Rasio</b></td>
                            <td class="aps-sd"><b>Akreditasi<br>sd</b></td>
                            <td class="peringkat"><b>Peringkat</b></td>
                            <td class="lap-akhir"><b>Lap. Akhir</b></td>
                        </tr>
                        <?php if (isset($Prodi[$i]) && is_array($Prodi[$i])) : ?>
                            <?php foreach ($Prodi[$i] as $j => $prodi) : ?>
                                <tr>
                                    <td class="no"><?= ($j + 1); ?></td>
                                    <td><?= $prodi['nama_prodi']; ?></td>
                                    <td><?= $prodi['jenjang']; ?></td>
                                    <td><?= $prodi['smt_awal_prodi']; ?></td>
                                    <td><?= $prodi['jml_mhs_prodi']; ?></td>
                                    <td><?= $prodi['jml_dosen_tetap_prodi']; ?></td>
                                    <td><?= $prodi['jml_dosen_rasio']; ?></td>
                                    <td><?= str_replace('.', ',', $prodi['rasio_mhs_prodi']); ?></td>
                                    <td><?= $prodi['tgl_kadal_aps']; ?></td>
                                    <td><?= $prodi['aps']; ?></td>
                                    <td class="lap-akhir"><?= $prodi['lap_akhir']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="10">Data Prodi tidak tersedia.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <br/><br/>
            <?php endforeach; ?>
        </ul>
    </div>
    <p style="padding-top: 2pt; text-align: left;">Catatan Telaah:</p>
        <div class="telaah"> 
            <?= $dataPT['yayasan'] ?> menyelenggarakan <?= $TotalPT ?> PTS di lingkungan Lembaga Layanan Pendidikan Tinggi (LLDIKTI) Wilayah III, yaitu <?= $T_PTArray; ?>.<br/><br/>
            <?php
                $telaahPTs = [];
                foreach ($PT as $i => $dataPT) {
                    // Cek jika "Telaah Yayasan" dipilih atau PT tertentu dipilih
                    if ($telaahOption == "Telaah Yayasan" || $dataPT['nama_pt'] == $selectedPT) {
                        $akreditasiCounts = [];
                        if (isset($Prodi[$i]) && is_array($Prodi[$i])) {
                            foreach ($Prodi[$i] as $prodi) {
                                $akreditasi = $prodi['aps']; // Misalkan 'aps' adalah field yang menyimpan nilai akreditasi
                                if (!isset($akreditasiCounts[$akreditasi])) {
                                    $akreditasiCounts[$akreditasi] = 0;
                                }
                                $akreditasiCounts[$akreditasi]++;
                            }
                        }
                        $akreditasiStrings = [];
                        foreach ($akreditasiCounts as $akreditasi => $count) {
                            $akreditasiStrings[] = "$count program studi terakreditasi $akreditasi";
                        }
                        $akreditasiString = implode(', ', $akreditasiStrings);
                        $telaah = $dataPT['nama_pt'] . " menyelenggarakan " . $dataPT['jml_prodi'] . " program studi ($akreditasiString) dengan jumlah mahasiswa sebanyak " . format_ribuan($dataPT['jml_mhs']) . " orang, dosen tetap sebanyak " . format_ribuan($dataPT['jml_dosen_tetap_pt']) . " orang, dan rasio dosen tetap terhadap mahasiswa sebesar 1 : " . number_format($dataPT['jml_mhs'] / $dataPT['jml_dosen_tetap_pt'], 2, ',', '.') . ". Institusi " . $dataPT['nama_pt'] . " aktif menyampaikan laporan PD-Dikti dengan persentase laporan " . $dataPT['persen_lapor'] . "% (" . substr($dataPT['smt_lapor'], 0, 4) . '-' . substr($dataPT['smt_lapor'], 4, 1) . ").";
                        $telaahPTs[] = $telaah;
                    }
                }
                echo implode('<br><br>', $telaahPTs);
            ?>

        </div>
    <!-- LOGIKA TELAAH
    Disetiap perguruan tinggi loop, lalu di dalamnya ada loop prodi sisipkan format telaah PT lalu simpan ke variabel array untuk nanti di panggil diakhir -->
    <footer style="padding-top: 5pt; font-size: 9pt; text-align: right">
        <p>
            <i> Dikeluarkan pada tanggal <?php echo date('d-m-Y H:i:s') ?><br> oleh Sistem Rekam Jejak Perguruan Tinggi (<?= $_ENV['Author']?>)</i><br/>
        </p>
    </footer>
    </body>
</html>
