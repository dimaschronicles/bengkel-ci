<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('produk/create'); ?>" class="btn btn-primary">
                Tambah Produk
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
                                <td><?= $p['harga']; ?></td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal<?= $p['id']; ?>">
                                        Detail
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?= $p['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <strong>Nama Produk :</strong>
                                                            <?= $p['nama_produk']; ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>Deskripsi :</strong>
                                                            <?= $p['deskripsi']; ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>Jenis :</strong>
                                                            <?= $p['jenis']; ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>Stok :</strong>
                                                            <?= $p['stok'] ?? '-'; ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>Harga :</strong>
                                                            <?= $p['harga'] ?? '-'; ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <?php if ($p['foto'] != null) : ?>
                                                                <img class="img-fluid" src="<?= base_url('assets/upload/' . $p['foto']) ?>" alt="Produk Image">
                                                            <?php else : ?>
                                                                <p>-</p>
                                                            <?php endif; ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?= base_url('produk/edit/' . $p['id']); ?>" class="btn btn-warning">
                                        Edit
                                    </a>
                                    <a href="<?= base_url('produk/delete/' . $p['id']); ?>" class="btn btn-danger">
                                        Hapus
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