<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Nota Pelanggan - Bengkel</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 3px 0;
            text-align: center;
        }
    </style>
</head>

<body onload="window.print();">
    <header class="clearfix">
        <h1>NOTA</h1>
        <div id="company" class="clearfix">
            <div>Bengkel</div>
            <div>Jl. Bung Hatta,<br /> No 102, Purwokerto Utara</div>
            <div>(021) 12345678</div>
        </div>
        <div id="project">
            <div><span>NAMA</span> <?= $transaksi['name']; ?></div>
            <div><span>EMAIL</span> <?= $transaksi['email']; ?></div>
            <div><span>PLAT</span> <?= strtoupper($transaksi['plat_nomor']); ?></div>
            <div><span>TANGGAL</span> <?= $transaksi['tanggal_waktu']; ?></div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">LAYANAN</th>
                    <th class="desc">JENIS</th>
                    <th>PRICE</th>
                    <th>QTY</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $transaksi_detail = $this->db->select('transaksi_detail.*, produk.*')
                    ->from('transaksi_detail')
                    ->join('produk', 'produk.id = transaksi_detail.produk_id')
                    ->where('transaksi_detail.transaksi_id', $transaksi['id'])
                    ->get()
                    ->result_array();
                ?>
                <?php foreach ($transaksi_detail as $detail) : ?>
                    <tr>
                        <td class="service"><?= $detail['nama_produk']; ?></td>
                        <td class="desc"><?= $detail['jenis']; ?></td>
                        <td class="unit">Rp <?= $detail['harga']; ?></td>
                        <td class="qty"><?= $detail['jumlah']; ?></td>
                        <td class="total">Rp <?= $detail['total_harga']; ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4">SUBTOTAL</td>
                    <td class="total">Rp <?= $transaksi['total']; ?></td>
                </tr>
                <!-- <tr>
                    <td colspan="4">TAX 25%</td>
                    <td class="total">$1,300.00</td>
                </tr> -->
                <tr>
                    <td colspan="4" class="grand total">TOTAL</td>
                    <td class="grand total">Rp <?= $transaksi['total']; ?></td>
                </tr>
            </tbody>
        </table>
        <div id="notices">
            <div>KETERANGAN:</div>
            <div class="notice"><?= $transaksi['keterangan']; ?></div>
        </div>
        <div id="notices" style="margin-top: 10px;">
            <div>JENIS PEMBAYARAN:</div>
            <div class="notice"><?= strtoupper($transaksi['jenis_pembayaran']); ?></div>
        </div>
    </main>
    <footer>
        Auto generated by system.
    </footer>
    <script>
        // Close tab when printing is canceled
        window.onafterprint = function() {
            window.close();
        };
    </script>
</body>

</html>