<!DOCTYPE html>
<html lang="en">

<!-- HEAD -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD pemilik</title>
</head>


<!-- BODY -->

<body>
    <h1>1. koneksi database</h1>
    <?php
    // INISIALISASI NAMA
    $serverName = "localhost";
    $user = "root";
    $password = "";
    $databaseName = "dss_kost_v2";

    // KONEKSI DATABASE
    $connection = mysqli_connect($serverName, $user, $password, $databaseName);
    // ERROR HANDLING
    if (mysqli_connect_errno()) {
        echo "terjadi error" . mysqli_connect_errno();
    } else {
        echo "koneksi database berhasil";
    }
    ?>

    <h1>2. Membaca Tabel</h1>
    <?php
    $cekNama = isset($_GET['nama']);
    if ($cekNama) {
        $dataYangDimasukkan = $_GET['nama'];
        $insertPemilik = "INSERT INTO `dss_pemilik`(`nama`) VALUES ('" . $dataYangDimasukkan  . "')";
        mysqli_query($connection, $insertPemilik);
    }

    $queryPemilik = "SELECT * FROM `dss_pemilik`";
    $hasil = mysqli_query($connection, $queryPemilik);

    // READ DATA
    while ($arrayOfHasil = mysqli_fetch_assoc($hasil)) {
        echo $arrayOfHasil["id"] . ". ";
        echo $arrayOfHasil["nama"];
        echo "<a href='hapus.php?id=" . $arrayOfHasil['id'] . "'>hapus</a>";
        echo "<a href='update_form.php?nama=" . $arrayOfHasil['nama'] . "'>update</a>";
        echo "</br>";
    }




    ?>



</body>

</html>