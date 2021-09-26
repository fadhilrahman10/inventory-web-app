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
    <h3>Data Supplier</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID Supplier</th>
                <th scope="col">Nama Supplier</th>
                <th scope="col">Nomor HP</th>
                <th scope="col">Alamat</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($supplier as $s) :  ?>
                <tr>
                    <td scope="row"><?= $no++; ?></td>
                    <td><?= $s['id_supplier']; ?></td>
                    <td><?= $s['nama_supplier']; ?></td>
                    <td><?= $s['no_hp']; ?></td>
                    <td><?= $s['alamat_supplier']; ?></td>
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