<?php
include '../../config/koneksi.php';
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$koneksi = mysqli_query($koneksi, "SELECT email,password FROM user WHERE email = '$email'");
$user_info = mysqli_fetch_assoc($koneksi);

if (password_verify($password, $user_info['password'])) {
    $_SESSION['email'] = $email;
    echo 'berhasil login';
    header('location:../admin');
} else {
    echo 'tidak berhasil login';
    header('location:login.php?pesan=gagal');
}
