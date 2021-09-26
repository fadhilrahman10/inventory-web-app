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
    <h3>Data Barang</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kode</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Kategori</th>
                <th scope="col">satuan</th>
                <th scope="col">Stok</th>
                <th scope="col">Harga Beli</th>
                <th scope="col">Harga Jual</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($barang as $b) :  ?>
                <tr>
                    <td scope="row"><?= $no++; ?></td>
                    <td><?= $b['id_barang']; ?></td>
                    <td><?= $b['merek']; ?></td>
                    <td><?= $b['kategori']; ?></td>
                    <td><?= $b['satuan']; ?></td>
                    <td class="text-right"><?= $b['stok']; ?></td>
                    <td><?= indo_currency($b['harga_beli']); ?></td>
                    <td><?= indo_currency($b['harga_jual']); ?></td>
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