<?php
$mahasiswa = [
    "eren" => 100,
    "mikasa" => 88,
    "armin" => 67,
    "levi" => 39,
    "erwin" => 20
];

foreach ($mahasiswa as $nama => $nilai) {
    echo "nama: $nama, nilai: $nilai \n";
    
    if ($nilai >= 100) {
        echo "grade: A \n";

    } else if ($nilai >= 90) {
        echo "grade: B \n";
    } else if ($nilai >= 55) {
        echo "grade: C \n";

    } else if ($nilai >= 35) {
        echo "grade: D \n";
    } else {
        echo "grade: E \n";
    } 
}
?> 