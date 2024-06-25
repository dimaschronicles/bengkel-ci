<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form action="<?= base_url('laporan'); ?>" method="get">
                <div class="form-row mb-3">
                    <div class="col">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="tanggal_mulai">
                    </div>
                    <div class="col">
                        <label for="tanggal_selesai">Tanggal Sampai</label>
                        <input type="date" class="form-control" name="tanggal_selesai">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    Filter
                </button>
                <a href="<?= base_url('laporan'); ?>" class="btn btn-secondary">
                    Reset
                </a>
            </form>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header">
            Hasil Filter
        </div>
        <?php if (!empty($transaksi)) : ?>
            <div class="card-body">
                <a href="<?= base_url('laporan/exportExcel') . '?tanggal_mulai=' . urlencode($tanggal_mulai) . '&tanggal_selesai=' . urlencode($tanggal_selesai); ?>" class="btn btn-success mb-3">
                    Cetak Laporan
                </a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No Transaksi</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Montir</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($transaksi as $t) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $t['no_pemesanan']; ?></td>
                                    <td><?= $t['tanggal_waktu']; ?></td>
                                    <td><?= $t['name']; ?></td>
                                    <td><?= $t['nama_montir']; ?></td>
                                    <td>Rp <?= $t['total']; ?></td>
                                    <td>
                                        <?php if ($t['status'] == 'dipesan') : ?>
                                            <span class="badge badge-warning"><?= $t['status']; ?></span>
                                        <?php elseif ($t['status'] == 'diproses') : ?>
                                            <span class="badge badge-primary"><?= $t['status']; ?></span>
                                        <?php elseif ($t['status'] == 'selesai') : ?>
                                            <span class="badge badge-success"><?= $t['status']; ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else : ?>
            <div class="card-body">
                <div class="alert alert-danger">
                    <?= isset($error_message) ? $error_message : 'Isikan tanggalnya terlebih dahulu.'; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->