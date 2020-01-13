<?php
w = mysqli_connect("localhost", "root", "", "dcs_kost");
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
