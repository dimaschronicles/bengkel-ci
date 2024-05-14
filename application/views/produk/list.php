<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="jasa-tab" data-toggle="tab" href="#jasa" role="tab" aria-controls="jasa" aria-selected="true">Jasa</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="sparepart-tab" data-toggle="tab" href="#sparepart" role="tab" aria-controls="sparepart" aria-selected="false">Sparepart</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="jasa" role="tabpanel" aria-labelledby="jasa-tab">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row">
                        <?php if ($jasa !== null) : ?>
                            <?php foreach ($jasa as $j) : ?>
                                <div class="col-md-3 mb-3">
                                    <div class="card text-left">
                                        <?php if ($j['foto'] == null) : ?>
                                            <img class="card-img-top" src="https://placehold.co/600x400" alt="image">
                                        <?php else : ?>
                                            <img class="card-img-top" src="<?= base_url('assets/upload/' . $j['foto']) ?>" alt="image">
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h4 class="card-title"><?= $j['nama_produk']; ?></h4>
                                            <a href="<?= base_url('cart/store/' . $j['id']); ?>" class="btn btn-primary">
                                                <i class="fas fa-cart-plus"></i>
                                                Keranjang
                                            </a>
                                            <a href="<?= base_url('produk/detail/' . $j['id']); ?>" class="btn btn-info">
                                                <i class="fas fa-info-circle"></i>
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <h3>Tidak ada layanan</h3>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sparepart Tab Content -->
        <div class="tab-pane fade" id="sparepart" role="tabpanel" aria-labelledby="sparepart-tab">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <?php if ($sparepart !== null) : ?>
                            <?php foreach ($sparepart as $s) : ?>
                                <div class="col-md-3 mb-3">
                                    <div class="card text-left">
                                        <?php if ($s['foto'] == null) : ?>
                                            <img class="card-img-top" src="https://placehold.co/600x400" alt="image">
                                        <?php else : ?>
                                            <img class="card-img-top" src="<?= base_url('assets/upload/' . $s['foto']) ?>" alt="image">
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h4 class="card-title"><?= $s['nama_produk']; ?></h4>
                                            <p class="card-text">Rp <?= $s['harga']; ?> | Stok : <?= $s['stok'] ?? '-'; ?></p>
                                            <a href="<?= base_url('cart/store/' . $s['id']); ?>" class="btn btn-primary">
                                                <i class="fas fa-cart-plus"></i>
                                                Keranjang
                                            </a>
                                            <a href="<?= base_url('produk/detail/' . $s['id']); ?>" class="btn btn-info">
                                                <i class="fas fa-info-circle"></i>
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <h3>Tidak ada sparepart</h3>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->