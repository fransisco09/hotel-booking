<!DOCTYPE html>
<html>
<body>

<?php

require_once 'base.php';

//membuat koneksi
$conn =  mysqli_connect("localhost", "root", "", "db_hotel");

//chek kineksi
if (!$conn){
    echo"Koneksi Gagal";
}
$sql = "CREATE TABLE IF NOT EXISTS booking (
    no_kamar INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(12),
    nama VARCHAR(50),
    kelamin ENUM('Laki-laki','Perempuan'),
    tgl_lahir DATE,
    no_telp VARCHAR(13),
    jenis_kamar VARCHAR(20),
    tgl_in VARCHAR(30),
    tgl_out VARCHAR(30),
    keterangan VARCHAR(400))";
$conn ->query($sql);
if (!$conn){
    echo "Gagal membuat tebel";
}
?>


</form>
</body>
</html>