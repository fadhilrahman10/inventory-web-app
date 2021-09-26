<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/sb-admin-2.css">

    <title> <?= $title; ?> </title>
</head>

<body>
    <h2 class="mb-auto align-center"><b>INVENTORY</b></h2>
    <h3>Data Barang Masuk</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID Barang Masuk</th>
                <th scope="col">Merek</th>
                <th scope="col">Nama Supplier</th>
                <th scope="col">Kategori</th>
                <th scope="col">Satuan</th>
                <th scope="col">Harga (Rp)</th>
                <th scope="col">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($barangMasuk as $bm) :  ?>
                <tr>
                    <td scope="row"><?= $no++; ?></td>
                    <td><?= $bm['id_barangMasuk']; ?></td>
                    <td><?= $bm['merek']; ?></td>
                    <td><?= $bm['nama_supplier']; ?></td>
                    <td><?= $bm['kategori']; ?></td>
                    <td><?= $bm['satuan']; ?></td>
                    <td><?= $bm['harga']; ?></td>
                    <td><?= $bm['jumlah']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>




<br><br><br><br><br><br>
<?= date("d M Y"); ?>
<br><br><br><br><br><br>
Mengetahui <br>


<script type="text/javascript">
    window.print();
</script>