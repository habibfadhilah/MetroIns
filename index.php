<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "db_inventaris";

$koneksi = mysqli_connect($host, $user, $password, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database.");
} else {
    echo "Koneksi sukses.";
}

$id = "";
$kode_barang = "";
$nama_barang = "";
$kategori = "";
$stok = "";
$harga_satuan = "";
$sukses = "";
$error = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "DELETE FROM barang WHERE id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Data berhasil dihapus";
    } else {
        $error = "Data gagal dihapus";
    }
}

if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM barang WHERE id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $kode_barang = $r1['kode_barang'];
    $nama_barang = $r1['nama_barang'];
    $kategori = $r1['kategori'];
    $stok = $r1['stok'];
    $harga_satuan = $r1['harga_satuan'];

    if ($id == "") {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $harga_satuan = $_POST['harga_satuan'];

    if ($id && $kode_barang && $nama_barang && $kategori && $stok && $harga_satuan) {
        if ($op == 'edit') {
            $sql1 = "UPDATE barang SET kode_barang = '$kode_barang', nama_barang = '$nama_barang', kategori = '$kategori', stok = '$stok', harga_satuan = '$harga_satuan' WHERE id = '$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diubah";
            } else {
                $error = "Data gagal diubah";
            }
        } else {
            $sql1 = "INSERT INTO barang (id, kode_barang, nama_barang, kategori, stok, harga_satuan) VALUES ('$id', '$kode_barang', '$nama_barang', '$kategori', '$stok', '$harga_satuan')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukkan data.";
            } else {
                $error = "Gagal memasukkan data.";
            }
        }
    } else {
        $error = "Silakan isi semua data.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- UNTUK MEMASUKKAN DATA BARANG -->
        <div class="card">
            <div class="card-header">Create/Edit Data Barang
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                }
                ?>
                <form action="" method="POST">
                    <input type="hidden" name="op" value="<?php echo $op; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="mb-3 row">
                        <label for="id" class="col-sm-2 col-form-label">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kode_barang" class="col-sm-2 col-form-label">Kode Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?php echo $kode_barang; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $nama_barang; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $kategori; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="stok" name="stok" value="<?php echo $stok; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="harga_satuan" class="col-sm-2 col-form-label">Harga Satuan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="harga_satuan" name="harga_satuan" value="<?php echo $harga_satuan; ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- UNTUK MENAMPILKAN DATA BARANG -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Barang
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">ID</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM barang ORDER BY id DESC";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $no = $r2['id'];
                            $kode_barang = $r2['kode_barang'];
                            $nama_barang = $r2['nama_barang'];
                            $kategori = $r2['kategori'];
                            $stok = $r2['stok'];
                            $harga_satuan = $r2['harga_satuan'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $no; ?></td>
                                <td scope="row"><?php echo $kode_barang; ?></td>
                                <td scope="row"><?php echo $nama_barang; ?></td>
                                <td scope="row"><?php echo $kategori; ?></td>
                                <td scope="row"><?php echo $stok; ?></td>
                                <td scope="row"><?php echo $harga_satuan; ?></td>
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $no ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $no ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

</html>