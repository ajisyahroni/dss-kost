<!DOCTYPE html>
<html lang="en">
<?php
include "./config/connection_v2.php";
$query = "SELECT 
dss_kost_kriteria.id as ID,
dss_kost.id as id_kost,
dss_kriteria.id as id_kriteria,
dss_kost.nama as nama_kost,
dss_kost.harga,
dss_kost.luas_kamar,
dss_kost.jarak,
dss_kriteria.nama as kriteria,
dss_kriteria.tipe as tipe,
dss_kost_kriteria.value as nilai,
dss_fasilitas_kamar.nilai as fasilitas_kamar,
dss_fasilitas_penunjang.nilai as fasilitas_penunjang,
dss_fasilitas_lingkungan.nilai as fasilitas_lingkungan

FROM dss_kost_kriteria
INNER JOIN dss_kost ON dss_kost.id = dss_kost_kriteria.id_kost
INNER JOIN dss_fasilitas_kamar ON dss_kost.id_fasilitas_kamar = dss_fasilitas_kamar.id
INNER JOIN dss_fasilitas_penunjang ON dss_kost.id_fasilitas_penunjang = dss_fasilitas_penunjang.id
INNER JOIN dss_fasilitas_lingkungan ON dss_kost.id_fasilitas_lingkungan = dss_fasilitas_lingkungan.id
INNER JOIN dss_kriteria ON dss_kriteria.id = dss_kost_kriteria.id_kriteria
ORDER BY dss_kost_kriteria.id_kost,dss_kost_kriteria.id_kriteria";
$data = mysqli_query($connection, $query);



$arrayOfSample = [];
function fuzzyForPrice($price)
{
    $value = 0;
    if ($price < 250) {
        $value = 1;
    } else if ($price > 250 && $price <= 500) {
        $value = 0.75;
    } else if ($price > 500 && $price <= 750) {
        $value = 0.50;
    } else if ($price > 750 && $price <= 1000) {
        $value = 0.25;
    } else {
        $value = 0;
    }
    return $value;
}

function fuzzyForDistance($distance)
{
    $distanceValue = 0;
    if ($distance < 500) {
        $distanceValue = 1;
    } else if ($distance > 500 && $distance <= 750) {
        $distanceValue = 0.75;
    } else if ($distance > 750 && $distance <= 1000) {
        $distanceValue = 0.50;
    } else if ($distance > 1000 && $distance <= 1500) {
        $distanceValue = 0.25;
    } else {
        $distanceValue = 0;
    }
    return $distanceValue;
}


function fuzzyForRoom($room)
{
    $roomValue = 0;
    switch ($room) {
        case 6:
            $roomValue = 0;
            break;
        case 9:
            $roomValue = 0.25;
            break;
        case 12:
            $roomValue = 0.50;
            break;
        case 16:
            $roomValue = 0.75;
            break;
        case 20:
            $roomValue = 1;
            break;
        default:
            $roomValue = 0;
            break;
    }
    return $roomValue;
}


function array_push_assoc($array, $key, $value)
{
    $array[$key] = $value;
    return $array;
}


$id_alternate = '';

while ($d = mysqli_fetch_assoc($data)) {
    if ($d['id_kost'] != $id_alternate) {

        $arrayOfSample = array_push_assoc(
            $arrayOfSample,
            $d['nama_kost'],
            [
                abs($d['harga']),
                abs($d['luas_kamar']),
                abs($d['jarak']),
                abs($d['fasilitas_kamar']),
                abs($d['fasilitas_penunjang']),
                abs($d['fasilitas_lingkungan']),
            ]
        );

        $id_alternate = $d['id_kost'];
    }

    array_push($arrayOfSample[$d['nama_kost']], abs($d['nilai']));
}


// ARRAY OF WEIGH CALCULATION 
$harga = -1 *  abs($_POST['harga']);
$jarak =  -1 * abs($_POST['jarak']);
$luas_kamar =    abs($_POST['luas_kamar']);
$fasilitas_kamar =  abs($_POST['fasilitas_kamar']);
$fasilitas_penunjang =  abs($_POST['fasilitas_penunjang']);
$fasilitas_lingkungan =  abs($_POST['fasilitas_lingkungan']);

$arrayOfWeight = [$harga, $jarak, $luas_kamar, $fasilitas_kamar, $fasilitas_penunjang, $fasilitas_penunjang];

$kriteria_query = "SELECT * from dss_kriteria";
$kriteria = mysqli_query($connection, $kriteria_query);


while ($kdata = mysqli_fetch_assoc($kriteria)) {
    if ($kdata['tipe'] == 1) {
        array_push($arrayOfWeight, -1 * abs($_POST[$kdata['nama']]));
    } else {
        array_push($arrayOfWeight, abs($_POST[$kdata['nama']]));
    }
}


$sumOfWeight = 0;
foreach ($arrayOfWeight as $key => $value) {
    $sumOfWeight += abs($value);
}

// WEIGHT NORMALIZATION 
$normalizedWeight = [];
foreach ($arrayOfWeight as $key => $value) {
    $dividedBySum = $value / $sumOfWeight;
    array_push($normalizedWeight, $dividedBySum);
}

// CALCULATE THE VECTOR OF S VALUE 
$arrayOfVectorS = [];
$arrayOfInside = [];
$x = 1;
foreach ($arrayOfSample as $key => $value) {
    $arrayOfVectorS[$key] = 1;
    foreach ($value as $keyVal => $thisValue) {
        $pow = pow($thisValue, $normalizedWeight[$keyVal]);
        $arrayOfVectorS[$key] *= $pow;
    }
}

// CALCULATE VECTOR
$sigmaVector =  array_sum($arrayOfVectorS);
foreach ($arrayOfVectorS as $key => $value) {
    $arrayOfFinal[$key] = $value / $sigmaVector;
}

// SORTING ARRAY 
arsort($arrayOfFinal);

// SHOW THE TABLE
echo "<table class='table table-hover'>
    <thead>
        <th>Nama Kost</th>
        <th>Rank</th>
    </thead>
    <tbody>";
foreach ($arrayOfFinal as $key => $value) {
    echo
        "<tr>
                    <td>$key</td>
                    <td>$value</td>
                </tr>";
}
echo "</tbody></table>";

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>

<body>

</body>


</html>