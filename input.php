<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inputan</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>

<body class="container">
    <form action="calculate.php" method="post">
        <label for="harga">Harga</label>
        <br>
        <select name="harga" id="harga">
            <option value="5">Sangat Penting</option>
            <option value="4">Penting</option>
            <option value="3">Cukup Penting</option>
            <option value="2">Tidak Penting</option>
            <option value="1">Sangat Tidak Penting</option>
        </select>

        <br>
        <label for="luas_kamar">Luas Kamar</label>
        <br>
        <select name="luas_kamar" id="luas_kamar">
            <option value="5">Sangat Penting</option>
            <option value="4">Penting</option>
            <option value="3">Cukup Penting</option>
            <option value="2">Tidak Penting</option>
            <option value="1">Sangat Tidak Penting</option>
        </select>


        <br>
        <label for="jarak">Jarak</label>
        <br>
        <select name="jarak" id="jarak">
            <option value="5">Sangat Penting</option>
            <option value="4">Penting</option>
            <option value="3">Cukup Penting</option>
            <option value="2">Tidak Penting</option>
            <option value="1">Sangat Tidak Penting</option>
        </select>


        <br>
        <label for="fasilitas_kamar">Fasilitas Kamar</label>
        <br>
        <select name="fasilitas_kamar" id="fasilitas_kamar">
            <option value="5">Sangat Penting</option>
            <option value="4">Penting</option>
            <option value="3">Cukup Penting</option>
            <option value="2">Tidak Penting</option>
            <option value="1">Sangat Tidak Penting</option>
        </select>


        <br>
        <label for="fasilitas_penunjang">Fasilitas Penunjang</label>
        <br>
        <select name="fasilitas_penunjang" id="fasilitas_penunjang">
            <option value="5">Sangat Penting</option>
            <option value="4">Penting</option>
            <option value="3">Cukup Penting</option>
            <option value="2">Tidak Penting</option>
            <option value="1">Sangat Tidak Penting</option>
        </select>


        <br>
        <label for="fasilitas_lingkungan">Fasilitas linkungan</label>
        <br>
        <select name="fasilitas_lingkungan" id="fasilitas_lingkungan">
            <option value="5">Sangat Penting</option>
            <option value="4">Penting</option>
            <option value="3">Cukup Penting</option>
            <option value="2">Tidak Penting</option>
            <option value="1">Sangat Tidak Penting</option>
        </select>

        <br>
        <input type="submit" value="submit">
    </form>
</body>

</html>