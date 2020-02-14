<?php
$connection = mysqli_connect("localhost", "root", "", "dss_kost_v2");
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
