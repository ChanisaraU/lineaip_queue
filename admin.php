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
    <button name ="logOut" type="submit" class=" w3-button  w3-hover-none w3-hover-text-light-grey w3-right"><i class="fa fa-sign-out"></i>  log out</button>
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
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-home"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="adminpage.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home fa-fw"></i>  Home</a>
    <!-- <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Queue</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Traffic</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>  Geo</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-diamond fa-fw"></i>  Orders</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i>  News</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bank fa-fw"></i>  General</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  History</a> -->
    <a href="#" class="w3-bar-item w3-button w3-padding  w3-blue"><i class="fa fa-book"></i> History</a>
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
    <h5><b><i class="fa fa-book"></i> History</b></h5>
  </header>
  <?php
  $date= date('Y-m-d');
  $result=mysqli_query($conn,"SELECT * from customer_queue");
  while($row = mysqli_fetch_array($result)) {
    if ($row["Status_TypeQueue"] == 'cancle' || $row["Status_TypeQueue"] == 'complete' || $row["Status_TypeQueue"] == 'incomplete'  ) {
        $all = $all + 1;
    }
    if ($row["Status_TypeQueue"] == 'cancle') {
      $cancle = $cancle + 1;
    } else if ($row["Status_TypeQueue"] == 'complete' ) {
      $complete = $complete + 1;
    } else if ($row["Status_TypeQueue"] == incomplete) {
      $incomplete = $incomplete + 1;
    }
  }
  ?>
  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-close w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $cancle;?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Cancle</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-check w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $complete;?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Complete</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-minus w3-xxxlarge"></i></div>
        <div class="w3-right">

          <h3><?php echo $incomplete;?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Incomplete</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-newspaper-o  w3-xxxlarge"></i></div>
        <div class="w3-right">

          <h3><?php echo $all;?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>All History</h4>
      </div>
    </div>
  </div>
  <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
    <tr>
      <td class="w3-center">No.</td>
      <td class="w3-center">Display profile</td>
      <td class="w3-center">Display name</td>
      <td class="w3-center">Status message</td>
      <td class="w3-center">Status queue</td>
      <td class="w3-center">Time</td>
      <td class="w3-center">Day</td>
      <td class="w3-center">Modify</td>
    </tr>
    <?php
    $date= date('Y-m-d');
    $query = "SELECT * FROM customer_queue join customer on customer_queue.ID_customer = customer.ID_Customer" or die("Error:" . mysqli_error());
    $result = mysqli_query($conn, $query);
    $num = 0;
      while($row = mysqli_fetch_array($result)) {
        if ($row["date"] != $date) {
          if ($row["Status_TypeQueue"] == 'cancle' ||$row["Status_TypeQueue"] == 'complete' ) {
          $num = $num + 1 ;
    ?>
    <tr>
      <td class="w3-center"><?php echo $num;?></td>
      <td class="w3-center"> <img src=" <?php echo $row["image"]?>" alt="Smiley face" height="42" width="42"></td>
      <td class="w3-center"><?php echo $row["name_line"]?></td>
      <td class="w3-center"><?php echo $row["status"]?></td>
      <td class="w3-center"><?php echo $row["Status_Queue"]?></td>
      <td class="w3-center"><?php echo $row["Time"]?></td>
      <td class="w3-center"><?php echo $row["Date"]?></td>
      <td class="w3-center"><form method="post"><button type="submit" name="delete" value="<?php echo $row["ID_Queue"]?>"class="w3-btn  w3-red">Delete</button> </form></td>
    </tr>
  <?php }}}?>
  </table>
  <br>
<?php
if (isset($_POST['delete'])) {
  $id = $_POST['delete'];
  $dataa2 ="DELETE FROM customer_queue WHERE  ID_Queue = '$id'";
  $result_statusquery = mysqli_query($conn,$dataa2);
    echo "<META HTTP-EQUIV='Refresh' CONTENT = '1;URL=#.php'>" ;
    $conn->close();
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
