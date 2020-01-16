<!DOCTYPE html>
<html lang="en">
<?php
include "./config/connection.php";
$query = "SELECT dss_kost.nama, dss_kost.harga, dss_kost.luas_kamar, dss_kost.jarak, dss_fasilitas_kamar.nilai AS fasilitas_kamar, dss_fasilitas_penunjang.nilai AS fasilitas_penunjang, dss_fasilitas_lingkungan.nilai AS fasilitas_lingkungan FROM dss_kost INNER JOIN dss_fasilitas_kamar ON dss_kost.id_fasilitas_kamar = dss_fasilitas_kamar.id INNER JOIN dss_fasilitas_penunjang ON dss_kost.id_fasilitas_penunjang = dss_fasilitas_penunjang.id INNER JOIN dss_fasilitas_lingkungan ON dss_kost.id_fasilitas_lingkungan = dss_fasilitas_lingkungan.id";
$data = mysqli_query($connection, $query);
$arrayOfSample = [];

function array_push_assoc($array, $key, $value)
{
    $array[$key] = $value;
    return $array;
}
function fuzzyForPrice($price)
{
    $value = 0;
    if ($price < 250) {
        $value = 5;
    } else if ($price > 250 && $price <= 500) {
        $value = 4;
    } else if ($price > 500 && $price <= 750) {
        $value = 3;
    } else if ($price > 750 && $price <= 1000) {
        $value = 2;
    } else {
        $value = 1;
    }
    return $value;
}

function fuzzyForDistance($distance)
{
    $distanceValue = 0;
    if ($distance < 500) {
        $distanceValue = 5;
    } else if ($distance > 500 && $distance <= 750) {
        $distanceValue = 4;
    } else if ($distance > 750 && $distance <= 1000) {
        $distanceValue = 3;
    } else if ($distance > 1000 && $distance <= 1500) {
        $distanceValue = 2;
    } else {
        $distanceValue = 1;
    }
    return $distanceValue;
}

while ($d = mysqli_fetch_assoc($data)) {

    $arrayOfSample = array_push_assoc(
        $arrayOfSample,
        $d['nama'],
        [
            fuzzyForPrice(abs($d['harga'])),
            abs($d['luas_kamar']),
            fuzzyForDistance(abs($d['jarak'])),
            abs($d['fasilitas_kamar']),
            abs($d['fasilitas_penunjang']),
            abs($d['fasilitas_lingkungan']),
        ]
    );
}
// ARRAY OF WEIGH CALCULATION 
$arrayOfWeight = [-5, -4, 5, 3, 2, 4];
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