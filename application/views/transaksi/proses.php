<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <form action="<?= base_url('transaksi/proses/' . $transaksi['id']); ?>" method="post">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="form-group row">
                    <label for="montir_id" class="col-sm-2 col-form-label">Montir</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="montir_id" name="montir_id">
                            <option value="">=== Pilih Montir ===</option>
                            <?php foreach ($montir as $m) : ?>
                                <option value="<?= $m['id']; ?>" <?= set_select('montir_id', $m['id'], $transaksi['montir_id'] == $m['id']); ?>>
                                    <?= $m['nama_montir']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('montir_id', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                Detail Pesanan
            </div>
            <div class="card-body">
                <a href="<?= base_url('transaksi/addproduk/' . $transaksiId); ?>" class="btn btn-dark mb-3">Tambah Produk</a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Produk</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($transaksiDetail as $td) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $td['nama_produk']; ?></td>
                                <td><?= $td['jenis']; ?></td>
                                <td><?= $td['jumlah']; ?></td>
                                <td>
                                    <?php if ($td['jenis'] == 'jasa') : ?>
                                        <input type="number" class="form-control" name="total_harga_<?= $td['id']; ?>" value="<?= set_value('total_harga_' . $td['id'], $td['total_harga']); ?>">
                                    <?php else : ?>
                                        <?= $td['total_harga']; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Proses Data</button>
                <a href="<?= base_url('transaksi'); ?>" class="btn btn-secondary">Batal</a>
            </div>
        </div>
    </form>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->