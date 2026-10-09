<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "db_traveldigabung";

$conn = new mysqli(
    $host,
    $user,
    $password,
    $database
);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");


function rupiah($number)
{
    return "Rp " . number_format(
        (float)$number,
        0,
        ",",
        "."
    );
}


function tanggal($date)
{
    if (!$date) {
        return "-";
    }

    return date("d M Y", strtotime($date));
}


function waktu($date)
{
    if (!$date) {
        return "-";
    }

    return date("H:i", strtotime($date));
}

?>