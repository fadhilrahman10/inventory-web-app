<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahSupplierModal">Tambah Supplier</a>

    <a href="<?= base_url('admin/printSupplier'); ?>" class="btn btn-success mb-3 ml-5" target="_blank"><i class="fa fa-print"></i> Print</a>

    <!-- Jika Gagal -->
    <?= form_error('name', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <?= form_error('noHp', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <?= form_error('address', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

    <!-- Jika Berhasil -->
    <?= $this->session->flashdata('message'); ?>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive table-hover">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th scope="col">#</th>
                            <th scope="col">Nama Supplier</th>
                            <th scope="col">Nomor HP</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <?php $i = 1; ?> -->
                        <?php foreach ($supplier as $s) : ?>
                            <tr>
                                <th scope="col"> <?= $i; ?></th>
                                <td><?= $s['nama_supplier']; ?></td>
                                <td><?= $s['no_hp']; ?></td>
                                <td><?= $s['alamat_supplier']; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/supplierDelete/') . $s['id_supplier']; ?>" class="btn btn-danger btn-icon-split" onclick="return confirm('Are you sure want to delete this supplier?');">
                                        <span class="icon text-white-100">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    </a>

                                </td>
                            </tr>
                            <!-- <?= $i++; ?> -->
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="tambahSupplierModal" tabindex="-1" aria-labelledby="tambahSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSupplierModalLabel">Tambah Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/supplier'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control form-control-user" id="id_supplier" name="id_supplier" value="<?= $id ?>" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Supplier">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="noHp" name="noHp" placeholder="Nomor Hp">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Alamat">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>