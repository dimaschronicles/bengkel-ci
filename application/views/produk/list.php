<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <?php foreach ($produk as $p) : ?>
                    <div class="col-md-3 mb-3">
                        <div class="card text-left">
                            <?php if ($p['foto'] == null) : ?>
                                <img class="card-img-top" src="https://placehold.co/600x400" alt="image">
                            <?php else : ?>
                                <img class="card-img-top" src="<?= base_url('assets/upload/' . $p['foto']) ?>" alt="image">
                            <?php endif; ?>
                            <div class="card-body">
                                <h4 class="card-title"><?= $p['nama_produk']; ?></h4>
                                <p class="card-text">Rp <?= $p['harga']; ?> | Stok : <?= $p['stok'] ?? '-'; ?> | Jenis : <?= $p['jenis']; ?></p>
                                <a href="#" class="btn btn-primary">
                                    <i class="fas fa-cart-plus"></i>
                                    Keranjang
                                </a>
                                <a href="#" class="btn btn-info">
                                    <i class="fas fa-info-circle"></i>
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->