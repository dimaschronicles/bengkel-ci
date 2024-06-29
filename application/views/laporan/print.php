<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        /* CSS untuk gaya tabel, dapat disesuaikan sesuai kebutuhan */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .kop-surat {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .kop-surat img {
            margin-right: 20px;
        }

        .kop-surat .text {
            text-align: center;
        }
    </style>
</head>

<body onload="window.print();">
    <!-- kop surat -->
    <div class="kop-surat">
        <!-- <img src="<?= base_url(); ?>/assets/img/laliga.png" width="50"> -->
        <div class="text">
            <span><b>JUDUL KOP SURAT</b></span><br>
            <span style="font-size: 10px;">Jl. Raya Pangebatan</span>
        </div>
        <div></div>
    </div>

    <hr>

    <h3>Laporan Transaksi</h3>
    <p>Filter Tanggal: <?= htmlspecialchars($tanggal_mulai); ?> sampai <?= htmlspecialchars($tanggal_selesai); ?></p>

    <?php if (!empty($transaksi)) : ?>
        <table>
            <thead>
                <tr>
                    <th>No Transaksi</th>
                    <th>Tanggal</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Montir</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transaksi as $t) : ?>
                    <tr>
                        <td><?= htmlspecialchars($t['no_pemesanan']); ?></td>
                        <td><?= htmlspecialchars($t['tanggal_waktu']); ?></td>
                        <td><?= htmlspecialchars($t['name']); ?></td>
                        <td><?= htmlspecialchars($t['nama_montir']); ?></td>
                        <td>Rp <?= number_format($t['total'], 0, ',', '.'); ?></td>
                        <td><?= htmlspecialchars($t['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Tidak ada data transaksi untuk periode ini.</p>
    <?php endif; ?>
    <script>
        // Close tab when printing is canceled
        window.onafterprint = function() {
            window.close();
        };
    </script>
</body>

</html>