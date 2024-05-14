<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <?php if ($user['role_id'] == 1 || $user['role_id'] == 3) : ?>
        <!-- Content Row -->
        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Transaksi Diproses</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $transaksi_diproses; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-wrench fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Transaksi Selesai</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $transaksi_selesai; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Customer</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $customer; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Produk & Layanan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $jumlah_produk_layanan; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-boxes fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($user['role_id'] == 2) : ?>
        <div class="card">
            <div class="card-header">
                Daftar Produk & Layanan
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if ($produk !== null) : ?>
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
                                        <p class="card-text">Jenis : <?= $p['jenis']; ?></p>
                                        <a href="<?= base_url('cart/store/' . $p['id']); ?>" class="btn btn-primary">
                                            <i class="fas fa-cart-plus"></i>
                                            Keranjang
                                        </a>
                                        <a href="<?= base_url('produk/detail/' . $p['id']); ?>" class="btn btn-info">
                                            <i class="fas fa-info-circle"></i>
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <h3>Tidak ada data</h3>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?= base_url('produk/list'); ?>">Lihat selengkapnya</a>
            </div>
        </div>
    <?php endif; ?>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->