<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahBarangModal">Tambah Barang</a>

    <a href="<?= base_url('admin/printBarang'); ?>" class="btn btn-success mb-3 ml-5" target="_blank"><i class="fa fa-print"></i> Print</a>

    <!-- Jika Gagal -->
    <?= form_error('merek', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <?= form_error('harga', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

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
                            <th scope="col">Barcode</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Harga Beli</th>
                            <th scope="col">Harga Jual</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- <?php $i = 1; ?> -->
                        <?php foreach ($barang as $b) : ?>
                            <tr>
                                <th scope="col"> <?= $i; ?></th>
                                <td>
                                    <img src="<?= site_url('admin/barcode/') . $b['id_barang']; ?>">
                                </td>
                                <td><?= $b['id_barang']; ?></td>
                                <td><?= $b['merek']; ?></td>
                                <td><?= $b['kategori']; ?></td>
                                <td><?= $b['satuan']; ?></td>
                                <td class="text-right"><?= $b['stok']; ?></td>
                                <td><?= indo_currency($b['harga_beli']); ?></td>
                                <td><?= indo_currency($b['harga_jual']); ?><S /td>
                                <td align="center">
                                    <a href="<?= base_url('admin/barangDelete/') . $b['id_barang']; ?>" class="btn btn-danger btn-icon-split" onclick="return confirm('Are you sure want to delete this supplier?');">
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
    <img src="<?= site_url('admin/qrcode/' . $id); ?>" alt="">
    <img src="<?= site_url('admin/barcode/' . $id); ?>" alt="">

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="tambahBarangModal" tabindex="-1" aria-labelledby="tambahBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBarangModalLabel">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/barang'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control form-control-user" id="id_barang" name="id_barang" value="<?= $id ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Barang</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>

                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" name="kategori" id="kategori">
                            <option value=""></option>
                            <option value="Deterjen">Deterjen</option>
                            <option value="Kosmetik">Kosmetik</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <select class="form-control" name="satuan" id="satuan">
                            <option value="Pcs">Pcs</option>
                            <option value="Bks">Bks</option>
                            <option value="Btl">Btl</option>
                            <option value="Dus">Dus</option>
                            <option value="Klg">Klg</option>
                            <option value="Unit">Unit</option>
                            <!-- <?php foreach ($distinctSatuan as $ds) : ?>
                                <option value="<?= $ds['satuan']; ?>"><?= $ds['satuan']; ?></option>
                            <?php endforeach; ?> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok">
                    </div>
                    <div class="form-group">
                        <label for="harga_beli">Harga Beli</label>
                        <input type="number" class="form-control" id="harga_beli" name="harga_beli">
                    </div>
                    <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="number" class="form-control" id="harga_jual" name="harga_jual">
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