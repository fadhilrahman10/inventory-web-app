<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="col-xl-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h3 font-weight-bold text-primary text-uppercase mb-1">
                            <?= $admin['nama_admin']; ?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800 mb-3"><?= $admin['email']; ?></div>
                        <div class="h5 mb-0 font-weight-bold text-dark-800"><?= $admin['alamat_admin']; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->