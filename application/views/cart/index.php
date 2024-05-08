<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <div class="row">

        <div class="col-xl-8 col-lg-7">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Produk/Jasa</h6>
                </div>
                <div class="card-body">
                    <?php if (!$keranjang) : ?>
                        <div class="alert alert-danger" role="alert">
                            Tidak ada data
                        </div>
                    <?php else : ?>
                        <ul class="list-group mb-3">
                            <?php foreach ($keranjang as $k) : ?>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h5 class="my-0"><?= $k['nama_produk']; ?></h5>
                                        <small class="text-muted">
                                            <?php if ($k['jenis'] == 'jasa') : ?>
                                                [jasa]
                                            <?php else : ?>
                                                [sparepart]
                                            <?php endif; ?></small>
                                        <div class="d-flex align-items-center">
                                            <div class="input-group mr-2">
                                                <div class="input-group-prepend">
                                                    <?php if ($k['jenis'] != 'jasa' && $k['jumlah'] > 1) : ?>
                                                        <a href="<?= base_url('cart/decrease/' . $k['id']); ?>" class="btn btn-dark" id="decrease">
                                                            <i class="fas fa-minus"></i>
                                                        </a>
                                                    <?php else : ?>
                                                        <button class="btn btn-dark" disabled>
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                                <input type="numeric" class="form-control" value="<?= $k['jumlah']; ?>" readonly>
                                                <div class="input-group-append">
                                                    <?php if ($k['jenis'] != 'jasa') : ?>
                                                        <a href="<?= base_url('cart/increase/' . $k['id']); ?>" class="btn btn-info" id="increase">
                                                            <i class="fas fa-plus"></i>
                                                        </a>
                                                    <?php else : ?>
                                                        <button class="btn btn-info" disabled>
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <a href="<?= base_url('cart/delete/' . $k['id']); ?>" class="btn btn-danger">Hapus</a>
                                        </div>
                                    </div>
                                    <h4 class="text-muted">Rp <?= $k['jumlah'] * $k['harga']; ?></h4>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Donut Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lanjut Checkout</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <h4>Total Harga : Rp <?= $total_harga; ?></h4>
                </div>
                <div class="card-footer">
                    <?php if (!$keranjang) : ?>
                        <button type="button" class="btn btn-primary" disabled>
                            Checkout
                        </button>
                    <?php else : ?>
                        <a href="<?= base_url('cart/checkout'); ?>" class="btn btn-primary">
                            Checkout
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->