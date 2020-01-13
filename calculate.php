<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>

<body class="container">
    <?php

    $arrayOfSample = [
        "Kost A1" => [4, 1, 3, 3, 3, 2],
        "Kost A7" => [4, 1, 4, 4, 3, 3],
        "Kost A13" => [3, 5, 4, 3, 4, 5],
        "Kost A23" => [1, 2, 5, 5, 4, 5]
    ];

    // WEIGHT EVERY CRITERIA DYNAMIC
    $harga = -1 *  abs($_POST['harga']);
    $luas_kamar =  -1 *  abs($_POST['luas_kamar']);
    $jarak =  abs($_POST['jarak']);
    $fasilitas_kamar =  abs($_POST['fasilitas_kamar']);
    $fasilitas_penunjang =  abs($_POST['fasilitas_penunjang']);
    $fasilitas_lingkungan =  abs($_POST['fasilitas_lingkungan']);
    $arrayOfWeight = [$harga, $luas_kamar, $jarak, $fasilitas_kamar, $fasilitas_penunjang, $fasilitas_penunjang];

    // WEIGHT EVERY CRITERIA
    // $arrayOfWeight = [-5, -4, 5, 3, 2, 4];
    $sumOfWeight = 0;
    foreach ($arrayOfWeight as $key => $value) {
        $sumOfWeight += abs($value);
    }
    echo "<strong>total weight</strong> :$sumOfWeight";
    echo "</br>";
    // NORMALISASI BOBOT
    $normalizedWeight = [];
    echo "<strong>normalisasi berat</strong>:";
    echo "</br>";
    foreach ($arrayOfWeight as $key => $value) {
        $dividedBySum = $value / $sumOfWeight;
        array_push($normalizedWeight, $dividedBySum);
        echo abs($dividedBySum);
        echo "</br>";
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
    echo "nilai vektor s = </br>";
    var_dump($arrayOfVectorS);
    echo "</br>";
    // CALCULATE VECTOR 



    $sigmaVector =  array_sum($arrayOfVectorS);

    echo "nilai sigma $sigmaVector";
    echo "</br> sn/sigma: </br>";
    foreach ($arrayOfVectorS as $key => $value) {
        $arrayOfFinal[$key] = $value / $sigmaVector;
        echo $arrayOfFinal[$key];
        echo "</br>";
    }
    // var_dump($arrayOfFinal);
    arsort($arrayOfFinal);
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
</body>

</html>