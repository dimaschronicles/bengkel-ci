<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-header">
            <a href="<?= base_url('transaksi/proses/' . $transaksi['id']); ?>" class="btn btn-secondary">
                Kembali
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Jenis</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($produk as $p) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $p['nama_produk']; ?></td>
                                <td><?= $p['jenis']; ?></td>
                                <td><?= $p['stok'] ?? '-'; ?></td>
                                <td><?= $p['harga'] ?? '-'; ?></td>
                                <td>
                                    <a href="<?= base_url('transaksi/storeproduk/' . $p['id'] . '/' . $transaksi['id']); ?>" class="btn btn-primary">
                                        Tambah
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Jenis</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->