<?php
session_start();
?>

<!DOCTYPE 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Bookings</title>
    <link rel="stylesheet" href="css/reserve.css">
</head>
<body class="background">
    <nav>
        <div class="wrapper">
            <div class="logo"><a href='#home'>THE SEVEN HOTELS</a></div>
            <div class="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#hotel">Hotel</a></li>
                    <li><a href="#sewa">Sewa Ruangan</a></li>
                    <li><a href="#fasilitas">Fasilitas</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                    <li><a href=" class="tbl-merah">Reserve Now</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <h1 class="text-center">FORM BOOKING </h1>
    <div class="boking">
        <form class="submission" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        
            <input type="text" id="firstname" name="firstname" placeholder="Masukan Nama Depan Anda" required>
            <input type="text" id="lastname" name="lastname" placeholder="Masukan Nama belakang Anda" required><br>
            <input  type="date" id="Startdate" name="indate" min="2021-07-03" max="2022-01-01" required><br>
            <input  type="date" id="Lastdate" name="outdate" min="2021-07-04" max="2022-01-01" required><br>
    
            <select name="hotelname" required>
                <option value="Deluxe Room">Deluxe Room</option>
                <option value="Executive Room">Exclusive Room</option>
                <option value="suit Room">Suit Room</option>
                <option value="Presidential Suite">Presidential Room</option>
            </select><br>
            <input type="submit" name="submit"><br>
        </form>

   <?php
    require_once "connect.php";

   $sql = "CREATE TABLE IF NOT EXISTS bookings(
       id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
       firstname VARCHAR(50),
       lastname VARCHAR(50),
       hotelname VARCHAR(50),
       indate VARCHAR(30),
       outdate VARCHAR(30),
       booked INT(4))";


   $conn ->query($sql);
   echo $conn-> error;
   
   //insert data ke dalam mysql

   if(isset($_POST['submit'])){
       //create Session var from post data
           $_SESSION['firstname'] = $_POST['firstname'];
           $_SESSION['lastname'] = $_POST['lastname'];
           $_SESSION['hotelname'] = $_POST['hotelname'];
           $_SESSION['indate'] = $_POST['indate'];
           $_SESSION['outdate'] = $_POST['outdate'];
       }

        //perhitungan hari menginap

        $datetime1 = new DateTime($_SESSION['indate']);
        $datetime2 = new DateTime($_SESSION['outdate']);
        $interval = $datetime1-> diff($datetime2);
        $daysbooked = $interval->format('%d');
        
        $value;


switch($_SESSION['hotelname']){

    case "Deluxe Room":
    $value = $daysbooked * 800000;
    break;

    case "Executive Room":
    $value = $daysbooked * 1500000;
    break;

    case "Suit Room":
    $value = $daysbooked * 3000000;
    break;

    case "Presidential Suite":
    $value = $daysbooked * 5000000;
    break;

    default:
    return "Invalid Booking";
}


echo "<div class='feedback'>  Nama Depan: ". $_SESSION['firstname'] . "<br>
   Nama Belakang: " . $_SESSION['lastname'].
   "<br> Tanggal Masuk: " . $_SESSION['indate'].
   "<br> Tanggal Keluar: " . $_SESSION['outdate'].
   "<br> Nama Kamar: " . $_SESSION['hotelname'].
   "<br> Lama Menginap: " . $interval->format('%d days') . "<br> Total  : " . $value . "</div>";

    echo "<form class='form-inline' role='form' method='post' action=".htmlentities($_SERVER["PHP_SELF"]).">
    <input type='submit' id='submit' name='confirm'></form>";

    if(isset($_POST['confirm'])){
        $stmt = $conn->prepare("INSERT INTO bookings(firstname,lastname,hotelname,indate,outdate)VALUES(?,?,?,?,?)");
        $stmt -> bind_param('sssss',$firstname,$lastname,$hotelname,$indate,$outdate);


        $firstname = $_SESSION['firstname'];
        $lastname = $_SESSION['lastname'];
        $hotelname = $_SESSION['hotelname'];
        $indate = $_SESSION['indate'];
        $outdate = $_SESSION['outdate'];
        $stmt -> execute();
    
    echo "booking confirmed";
    echo " <script> console.log('New records created successfully'); </script>";
    }
?>    
    </div>  
</body>
</html>