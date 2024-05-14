<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('montir/create'); ?>" class="btn btn-primary">
                Tambah Montir
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($montir as $m) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $m['nama_montir']; ?></td>
                                <td><?= $m['no_hp_montir']; ?></td>
                                <td><?= $m['alamat_montir']; ?></td>
                                <td><?= $m['status_montir']; ?></td>
                                <td>
                                    <a href="<?= base_url('montir/edit/' . $m['id']); ?>" class="btn btn-warning">
                                        Edit
                                    </a>
                                    <a href="<?= base_url('montir/delete/' . $m['id']); ?>" class="btn btn-danger">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Status</th>
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