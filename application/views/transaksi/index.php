<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Transaksi</th>
                            <th>Nama</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($transaksi as $t) : ?>
                            <?php
                            $transaksi_detail = $this->db->select('transaksi_detail.*, produk.*')
                                ->from('transaksi_detail')
                                ->join('produk', 'produk.id = transaksi_detail.produk_id')
                                ->where('transaksi_detail.transaksi_id', $t['id'])
                                ->get()
                                ->result_array();
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $t['no_pemesanan']; ?></td>
                                <td><?= $t['name']; ?></td>
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
                                <td>
                                    <?php if ($user['role_id'] == 1) : ?>
                                        <?php if ($t['status'] == 'dipesan') : ?>
                                            <a href="<?= base_url('transaksi/proses/' . $t['id']); ?>" class="btn btn-primary">
                                                Proses Data
                                            </a>
                                        <?php elseif ($t['status'] == 'diproses') : ?>
                                            <a href="<?= base_url('transaksi/selesai/' . $t['id']); ?>" class="btn btn-success">
                                                Selesai Data
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal<?= $t['id']; ?>">
                                        Detail
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?= $t['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="list-group">
                                                        <?php foreach ($transaksi_detail as $detail) : ?>
                                                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                                                <div>
                                                                    <h6 class="my-0"><?= $detail['nama_produk']; ?></h6>
                                                                    <small class="text-muted"><?= $detail['jumlah']; ?> x <?= $detail['harga']; ?></small>
                                                                </div>
                                                                <span class="text-muted">Rp <?= $detail['jumlah'] * $detail['harga']; ?></span>
                                                            </li>
                                                        <?php endforeach; ?>
                                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                                            <div>
                                                                <h6 class="my-0">Jenis Pembayaran</h6>
                                                            </div>
                                                            <span class="text-muted"><?= strtoupper($t['jenis_pembayaran']); ?></span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                                            <div>
                                                                <h6 class="my-0">Plat Nomor</h6>
                                                            </div>
                                                            <span class="text-muted"><?= strtoupper($t['plat_nomor']); ?></span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                                            <div>
                                                                <h6 class="my-0">Keterangan</h6>
                                                            </div>
                                                            <span class="text-muted"><?= $t['keterangan'] ?? '[tidak ada keterangan]'; ?></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($user['role_id'] == 2) : ?>
                                        <a href="<?= base_url('transaksi/nota/' . $t['id']); ?>" target="_blank" class="btn btn-danger">
                                            Nota
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>No Transaksi</th>
                            <th>Nama</th>
                            <th>Jenis Pembayaran</th>
                            <th>Total Harga</th>
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