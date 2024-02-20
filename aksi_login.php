<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password= $_POST['password'];

$sql =mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($sql);

if( $cek >0) {
    $data =mysqli_fetch_array($sql);
    $_SESSION['username'] = $username;
    $_SESSION['userid']= $data['userid'];
    $_SESSION['status'] = 'login';
    echo"<script>
    alert('Login Berhasil');
    </script>";
    header('Location: index.php?status=sukses');
}else{
    echo"<script>
    alert('Login gagal');
    </script>";
    header('Location: login.php?status=gagal');
}
?>