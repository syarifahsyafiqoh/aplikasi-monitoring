<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Berkas per Seksi - BPDAS Barito</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            margin: 2cm 1.5cm;
            color: #000;
        }
        .kop {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }
        .kop img {
            max-width: 120px;
            margin-bottom: 10px;
        }
        .kop h2 {
            margin: 5px 0;
            font-size: 14pt;
        }
        .kop p {
            margin: 2px 0;
            font-size: 10pt;
        }
        h1 {
            text-align: center;
            margin: 20px 0 30px;
            font-size: 16pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }
        .total-row {
            background-color: #e9ecef;
            font-weight: bold;
        }
        .right {
            text-align: right;
        }
        .center {
            text-align: center;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 9pt;
            color: #666;
        }
        @page {
            size: portrait;
            margin: 1.5cm 1cm;
        }
        @bottom-center {
            content: "Halaman " counter(page);
            font-size: 9pt;
            color: #666;
        }
    </style>
</head>
<body>

    <!-- Kop Surat -->
    <div class="kop">
        <img src="data:image/png;base64,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" class="logo" alt="Logo BPDAS Barito">
        <h2>KEMENTERIAN KEHUTANAN</h2>
        <p>DIREKTORAT JENDERAL PENGELOLAAN DAERAH ALIRAN SUNGAI DAN REHABILITASI HUTAN</p>
        <p>BALAI PENGELOLAAN DAERAH ALIRAN SUNGAI BARITO</p>
        <p>Jl. Bhayangkara No.08, Telp. (0511) 4772627 Fax. 4781694 Banjarbaru</p>
        <p>Website: www.bpdasbarito.or.id</p>
    </div>

    <h1>Rekap Berkas per Seksi</h1>

    <?php if (!empty($rekap_seksi)): ?>
        <table>
            <thead>
                <tr>
                    <th class="center">No</th>
                    <th>Seksi</th>
                    <th class="center">Jumlah Berkas</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($rekap_seksi as $rs): ?>
                    <tr>
                        <td class="center"><?= $no++ ?></td>
                        <td><?= esc($rs['seksi'] ?: 'Tidak Diketahui') ?></td>
                        <td class="center"><?= number_format($rs['jumlah']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="2" class="right">Total Keseluruhan</td>
                    <td class="center"><?= number_format(array_sum(array_column($rekap_seksi, 'jumlah'))) ?></td>
                </tr>
            </tfoot>
        </table>
    <?php else: ?>
        <p style="text-align: center; font-style: italic;">Belum ada data berkas untuk operator ini.</p>
    <?php endif; ?>

    <div class="footer">
        Dicetak dari Sistem Monitoring Berkas Keuangan BPDAS Barito<br>
        Tanggal: <?= date('d F Y H:i') ?> WITA | Oleh: <?= session()->get('username') ?>
    </div>

</body>
</html>