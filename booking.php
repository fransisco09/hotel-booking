<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boking Hotel Seven</title>
    <link rel="stylesheet" type="text/css" href="CSS/booking.css"/>
</head>
<body>
    <div class="box-form">
        <h2>FORM BOOKING SEVEN HOTEL</h2>
        <form action="" method="post">
            <input type="hidden" name="no_kamar">
            <input type="text" name="nama" placeholder="Masukan nama depan anda" required/> <br>
            Nomor NIK <br>
            <input type="text" name="nik" placeholder="Masukan Nomor Induk Kependudukan" value=""/> <br>
            Jenis Kelamin \ Tanggal Lahir <br>
            <input type="radio" name="kelamin"  value="Laki-Laki"/>Laki-laki &nbsp; &nbsp; &nbsp;
            <input type="radio" name="kelamin" value="Perempuan"/>Perempuan &nbsp; &nbsp; &nbsp;
            <input type="date" name="tgl_lahir" required> <br>
            No Telpon / HP <br>
            <input type="text" name="no_telp" placeholder="Masukan Nomor telpon" required/> <br> 
            Pilih Kamar 
            <select name="jenis_kamar" required>
                <option value="Holiday Inn">Single Room</option>
                <option value="Radison">Double Room</option>
                <option value="City Lodge">Connecting Room</option>
                <option value="Town Lodge">Cabana Room</option>
            </select> <br>
            Tanggal IN & OUT <br>
            <input type="date" name="tgl_in" required>
            <input type="date" name="tgl_out" required> <br>
            Catatan
            <textarea name="keterangan" placeholder="Catatan Tambahan" cols="90" rows="1"></textarea> <br>
            <input type="submit" name="proses" value="BOOKING NOW">           

        </form>
        <?php
            if(isset($_POST['proses'])){
                include "connect.php";
                $query = mysqli_query($conn, "INSERT INTO booking VALUES(
                    NULL,
                    '".$_POST['nik']."',
                    '".$_POST['nama']."',
                    '".$_POST['kelamin']."',
                    '".$_POST['tgl_lahir']."',
                    '".$_POST['no_telp']."',
                    '".$_POST['jenis_kamar']."',
                    '".$_POST['tgl_in']."',
                    '".$_POST['tgl_out']."',
                    '".$_POST['keterangan']."',");
                if($query){
                    echo'berhasil daftar';
                }
            }
        ?>

    </div>
</body>
</html>