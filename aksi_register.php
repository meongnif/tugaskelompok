<?php
session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])){
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mengambil Informasi File
    $foto_pro = $_FILES['namafoto_pro']['name'];
    $tmp = $_FILES['namafoto_pro']['tmp_name'];

    // Validasi file
    if (isset($_FILES['namafoto_pro']) && $_FILES['namafoto_pro']['error'] === 0) {
        // File berhasil diunggah
        $lokasi_pro = 'assets/img/';
        $namafoto_pro = $foto_pro; // Mengubah nama file menjadi nama asli
        
        // Memindahkan file
        move_uploaded_file($tmp, $lokasi_pro . $namafoto_pro);
        
        // Query untuk memeriksa ketersediaan nama pengguna
        $check_query = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $check_query);
    
if (mysqli_num_rows($result) > 0) {

    // Jika nama pengguna sudah ada dalam database
     echo "<script>
     alert('Nama pengguna sudah digunakan. Silakan pilih nama pengguna lain.');
     location.href = 'register.php?status=gagal';
    </script>";
    } else {
    $sql = mysqli_query($conn, "INSERT INTO user (username, password, email, namalengkap, alamat, namafoto_pro) 
      VALUE ('$username', '$password', '$email', '$nama', '$alamat', '$namafoto_pro')");
    
    if ($sql) {
    // Jika pendaftaran berhasil
    echo "<script>
    alert('Pendaftaran Akun Berhasil');
    location.href = 'login.php?status=berhasil';
    </script>";
    } else {
    // Jika pendaftaran gagal
    echo "<script>
    alert('Pendaftaran Akun Gagal. Silakan coba lagi.');
    location.href = 'register.php?status=gagal';
    </script>";
    }
    }
}else {
    // File gagal diunggah
    echo "<script>
    alert('File gagal diunggah. Silakan coba lagi.');
    location.href = 'register.php?status=gagal';
    </script>";
    }
}
?>