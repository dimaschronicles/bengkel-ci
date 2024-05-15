<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <div class="row">
        <div class="col-md-6">

            <?= $this->session->flashdata('message'); ?>

            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['email']; ?></h5>
                    <p class="card-text"><?= $user['name']; ?></p>
                    <a href="<?= base_url('profile/editprofile'); ?>" class="btn btn-warning">Edit Data</a>
                    <a href="<?= base_url('profile/changepassword'); ?>" class="btn btn-danger">Ganti Password</a>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->