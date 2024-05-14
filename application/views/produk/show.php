<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <?php if ($produk['foto'] == null) : ?>
                        <img class="card-img-top mb-5 mb-md-0" src="https://placehold.co/600x400" alt="image" />
                    <?php else : ?>
                        <img class="card-img-top mb-5 mb-md-0" src="<?= base_url('assets/upload/' . $produk['foto']) ?>" alt="<?= $produk['nama_produk']; ?>" />
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <div class="small mb-1">
                        JENIS: <?= strtoupper($produk['jenis']); ?> | STOK: <?= strtoupper($produk['stok'] ?? '-'); ?>
                    </div>
                    <h1 class="display-5 fw-bolder"><?= $produk['nama_produk']; ?></h1>
                    <div class="fs-5 mb-5">
                        <span>Rp <?= $produk['harga'] ?? '[harga jasa bisa berubah]'; ?></span>
                    </div>
                    <p class="lead"><?= $produk['deskripsi']; ?></p>
                    <div class="d-flex flex-column flex-md-row">
                        <form action="<?= base_url('produk/cart/' . $produk['id']); ?>" method="post">
                            <input type="hidden" name="produk_id" value="<?= $produk['id']; ?>">
                            <?php if (strtolower($produk['jenis']) == 'jasa') : ?>
                                <input type="hidden" name="jumlah" value="1">
                            <?php else : ?>
                                <div class="btn-group me-md-3 mb-3 mb-md-0" role="group">
                                    <button class="btn btn-danger" type="button" id="btnKurang">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input class="form-control text-center" id="jumlah" name="jumlah" type="num" value="1" style="max-width: 3rem" readonly />
                                    <button class="btn btn-success" type="button" id="btnTambah">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <button class="btn btn-primary flex-shrink-0 ml-2" type="submit">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="<?= base_url('produk/list'); ?>" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    document.getElementById('btnKurang').addEventListener('click', function() {
        var jumlah = parseInt(document.getElementById('jumlah').value);
        if (jumlah > 1) {
            document.getElementById('jumlah').value = jumlah - 1;
        }
    });

    document.getElementById('btnTambah').addEventListener('click', function() {
        var jumlah = parseInt(document.getElementById('jumlah').value);
        document.getElementById('jumlah').value = jumlah + 1;
    });

    // Automatically hide quantity controls if product type is 'jasa'
    <?php if (strtolower($produk['jenis']) == 'jasa') : ?>
        document.getElementById('jumlah').value = 1;
        document.getElementById('btnKurang').style.display = 'none';
        document.getElementById('btnTambah').style.display = 'none';
    <?php endif; ?>
</script>