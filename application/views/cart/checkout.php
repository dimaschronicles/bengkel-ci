<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Keranjang Anda</span>
                        <span class="badge badge-secondary badge-pill"><?= $jumlah_barang; ?></span>
                    </h4>
                    <ul class="list-group mb-3">
                        <?php foreach ($keranjang as $k) : ?>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0"><?= $k['nama_produk']; ?></h6>
                                    <small class="text-muted"><?= $k['jumlah']; ?> x <?= $k['harga']; ?></small>
                                </div>
                                <span class="text-muted">Rp <?= $k['jumlah'] * $k['harga']; ?></span>
                            </li>
                        <?php endforeach; ?>
                        <!-- <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Promo code</h6>
                                <small>EXAMPLECODE</small>
                            </div>
                            <span class="text-success">-$5</span>
                        </li> -->
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total</span>
                            <strong>Rp <?= $total_harga; ?></strong>
                        </li>
                    </ul>
                    <!-- <form class="card p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Promo code">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">Redeem</button>
                            </div>
                        </div>
                    </form> -->
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Form</h4>
                    <form action="<?= base_url('cart/checkout'); ?>" method="post">
                        <div class="mb-3">
                            <label for="plat_nomor">Plat Nomor</label>
                            <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" placeholder="X 1234 XX">
                            <?= form_error('plat_nomor', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                            <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                            <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                        </div>
                        <hr class="mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="same-address">
                            <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="save-info">
                            <label class="custom-control-label" for="save-info">Save this information for next time</label>
                        </div> -->

                        <hr class="mb-4">

                        <h4 class="mb-3">Jenis Pembayaran</h4>
                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input id="jenis_pembayaran_cash" name="jenis_pembayaran" type="radio" class="custom-control-input" value="cash">
                                <label class="custom-control-label" for="jenis_pembayaran_cash">Cash</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="jenis_pembayaran_qris" name="jenis_pembayaran" type="radio" class="custom-control-input" value="qris">
                                <label class="custom-control-label" for="jenis_pembayaran_qris">QRIS</label>
                            </div>
                            <?= form_error('jenis_pembayaran', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <!-- <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cc-cvv">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div> -->
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Lanjut Proses Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->