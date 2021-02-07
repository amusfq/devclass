<?php

$server = 'localhost';
$user = 'root';
$password = '';
$tabel = 'devclassblog';

$koneksi = mysqli_connect($server, $user, $password, $tabel);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}