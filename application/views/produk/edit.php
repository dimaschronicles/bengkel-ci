<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= base_url('produk/edit/' . $produk['id']); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $produk['nama_produk']; ?>">
                        <?= form_error('nama_produk', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= $produk['deskripsi']; ?></textarea>
                        <?= form_error('deskripsi', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <fieldset class="form-group row">
                    <legend class="col-form-label col-sm-2 float-sm-left pt-0">Jenis</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis" id="jenis" value="sparepart" <?= ($produk['jenis'] == 'sparepart') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="jenis">
                                Spare Part
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis" id="jenis" value="jasa" <?= ($produk['jenis'] == 'jasa') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="jenis">
                                Jasa
                            </label>
                        </div>
                        <?= form_error('jenis', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </fieldset>
                <div id="stokField" style="display: none;">
                    <div class="form-group row">
                        <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="stok" name="stok" value="<?= $produk['stok']; ?>">
                            <?= form_error('stok', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="harga" name="harga" value="<?= $produk['harga']; ?>">
                        <?= form_error('harga', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="foto" class="col-sm-2 col-form-label">Foto (opsional)</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control-file" id="foto" name="foto" accept=".png, .jpg, .jpeg">
                        <?= form_error('foto', '<small class="text-danger pl-3">', '</small>'); ?>
                        <?php if (!empty($produk['foto'])) : ?>
                            <div class="mt-3">
                                <img src="<?= base_url('assets/upload/' . $produk['foto']); ?>" alt="Foto Produk" style="max-width: 200px;">
                                <p>gambar sebelumnya</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                        <a href="<?= base_url('produk'); ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var jenisRadios = document.querySelectorAll('input[name="jenis"]');
        var stokField = document.getElementById('stokField');

        // Function to toggle display of stok field
        function toggleStokField() {
            if (jenisRadios[0].checked) { // If sparepart is selected
                stokField.style.display = 'block';
            } else {
                stokField.style.display = 'none';
            }
        }

        // Initial state
        toggleStokField();

        // Event listener for jenis radios
        for (var i = 0; i < jenisRadios.length; i++) {
            jenisRadios[i].addEventListener('change', toggleStokField);
        }
    });
</script>