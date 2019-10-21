<?php
session_start();
ob_start();
if($_SESSION['user_name'] == null) { // if นี้ใช้ตรวจสอบถ้าไม่ได้ login ให้ไปหน้า login
header ("location:index.php");
}
date_default_timezone_set('Asia/Bangkok');
$servername = "localhost";
$username = "root";
$password = "root1234";
$dbname = "queue";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");
?>
<!DOCTYPE html>
<html>
<title>admin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
.button {width: 50%;
      }
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <form action="check_logout.php" method="post">
  <button name ="logOut" type="submit"class=" w3-button  w3-hover-none w3-hover-text-light-grey w3-right"><i class="fa fa-sign-out"></i>  log out</button>
</form>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
        <img src="images/MFEC1.png" class=" w3-margin-right" style="width:90px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong> <?php echo $_SESSION['user_name'];?></strong></span><br>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-home fa-fw"></i>  Home</a>
    <a href="admin.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-book"></i> History</a>
      <hr>
    <a href="setting_admin.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cogs"></i> setting admin</a>


  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-home"></i> My Home</b></h5>
  </header>

  <form class="" method="post">
    <div class="w3-row w3-container">
      <div class="w3-col s9  w3-center">
        <select class="w3-select" required name="option">
      <option value="" disabled selected>Choose your option</option>
      <option value="Deposit">Deposit (ฝากเงิน)</option>
      <option value="Withdraw">Withdraw (ถอนเงิน)</option>
      <option value="ฺBankTransfer">ฺBankTransfer (โอนเงิน)</option>
    </select>
      </div>
      <div class="w3-col s3 w3-center">
        <button type="submit"name="queue"class="w3-btn w3-teal" style="width: 100%;" >Queue</button>
      </div>
    </div>
  </form>



  <div class="w3-cowidth: 100%;ntainer">
    <hr>
    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
      <tr>
        <td class="w3-center">No.</td>
        <td class="w3-center">Display profile</td>
        <td class="w3-center">Display name</td>
        <!-- <td class="w3-center">Status message</td> -->
        <!-- <td class="w3-center">Status queue</td> -->
        <td class="w3-center">Time</td>
        <!-- <td class="w3-center">Day</td> -->
        <td class="w3-center">Modify</td>
      </tr>
      <?php
      $date= date('Y-m-d');
      $query = "SELECT * FROM customer_queue join customer on customer_queue.ID_customer = customer.ID_Customer" or die("Error:" . mysqli_error());
      $result = mysqli_query($conn, $query);
      $num = 0;
        while($row = mysqli_fetch_array($result)) {
          if ($row["date"] = $date && $row["Status_TypeQueue"] != 'complete' && $row["Status_TypeQueue"] != 'cancle') {
            $num = $num + 1 ;
      ?>
      <tr>
        <td class="w3-center"><?php echo $num;?></td>
        <td class="w3-center"> <img src=" <?php echo $row["image"]?>" alt="Smiley face" height="42" width="42"></td>
        <td class="w3-center"><?php echo $row["name_line"]?></td>
        <!-- <td class="w3-center"><?php echo $row["status"]?></td> -->
        <!-- <td class="w3-center"><?php echo $row["Status_TypeQueue"]?></td> -->
        <td class="w3-center"><?php echo $row["Time"]?></td>
        <!-- <td class="w3-center"><?php echo $row["Date"]?></td> -->
        <td class="w3-center">
          <form method="post"><button type="submit" name="Deposit" value="<?php echo $row["ID_Queue"]?>"class="w3-btn w3-teal">Deposit </button>
          <form method="post"><button type="submit" name="Withdraw" value="<?php echo $row["ID_Queue"]?>"class="w3-btn w3-teal">Withdraw</button>
          <form method="post"><button type="submit" name="ฺBankTransfer" value="<?php echo $row["ID_Queue"]?>"class="w3-btn w3-teal">BankTransfer</button>
          <form method="post"><button type="submit" name="cancle" value="<?php echo $row["ID_Queue"]?>"class="w3-btn w3-red">Cancle</button>
          </form></td>
      </tr>
    <?php }}?>
    </table><br>
<?php
if (isset($_POST['queue'])) {
    $dataa1 = "SELECT * , @n := @n + 1 AS queue_number FROM customer_queue,(SELECT @n := 0) AS m WHERE date = '$date'   AND Status_TypeQueue != 'complete' and Status_TypeQueue != 'cancle'" or die("Error:" . mysqli_error());
    $result = mysqli_query($conn, $dataa1);
    while($row = mysqli_fetch_array($result)) {
      $id = $row["ID_Queue"];
      $option = $_POST["option"];
      if ($row["queue_number"] == 1) {
        $dataa2 ="UPDATE customer_queue SET Status_TypeQueue ='complete', Status_Queue = '$option' where ID_Queue = '$id'";
        $result_statusquery = mysqli_query($conn,$dataa2);
      }
      else if ($row["queue_number"] == 2) {
        $dataa3 ="UPDATE customer_queue SET Status_TypeQueue ='Pending' where ID_Queue = '$id'";
        $result_statusquery = mysqli_query($conn,$dataa3);
      }
    }
    echo "<META HTTP-EQUIV='Refresh' CONTENT = '1;URL=#.php'>" ;
    $conn->close();
  } else if (isset($_POST['cancle'])) {
    $id = $_POST['cancle'];
    $dataa2 ="UPDATE customer_queue SET Status_TypeQueue ='cancle' where ID_Queue = '$id'";
    $result_statusquery = mysqli_query($conn,$dataa2);
      echo "<META HTTP-EQUIV='Refresh' CONTENT = '1;URL=#.php'>" ;
      $conn->close();
    }
    else if (isset($_POST['logOut'])) {
      session_start();
      session_destroy();
      echo ("<script>location.href='index.php'</script>");
    }
  mysqli_close($conn);
?>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect

</script>

</body>
</html>
