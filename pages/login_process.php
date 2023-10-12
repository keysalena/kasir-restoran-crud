<?php
include "../conf/conn.php";
$username = mysqli_real_escape_string($koneksi, htmlentities($_POST['username']));
$password = mysqli_real_escape_string($koneksi, htmlentities($_POST['password']));
$check = mysqli_query($koneksi, "SELECT user.*, level.nama_level FROM user 
inner join level on user.id_level=level.id_level
WHERE username = '$username' AND password = '$password'") or die(mysqli_error($koneksi));

if (mysqli_num_rows($check) >= 1) {
    while ($row = mysqli_fetch_array($check)) {
        session_start();
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['username'] = $row['username']; // Add this line
        $_SESSION['nama_user'] = $row['nama_user']; // Add this line
        $_SESSION['nama_level'] = $row['nama_level']; // Add this line

        echo '<script>alert("Selamat Datang ' . $row['nama_user'] . ' Kamu Telah Login Ke Halaman ' . $row['nama_level'] . '!!!"); 
            window.location.href="index.php"</script>';
    }
} else {
    echo '<script>alert("Masukan Username dan Password dengan Benar !!!");
        window.location.href="login.php"</script>';
}
