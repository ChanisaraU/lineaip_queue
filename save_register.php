<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Save Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mystyle.css">
  </head>
  <body>

<?php
    $servername = "localhost";
    $username = "root";
    $password = "root1234";
    $dbname = "queue";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");
	//เชื่อมไปที่ฐานข้อมูล


  $valueUsername = $_POST['Admin_username'];
  $id = $_POST['id'];
  $image = $_POST['image'];
  $name = $_POST['name'];
  $status = $_POST['status'];
  $valuePassword = $_POST['Admin_password'];
  $valueName = $_POST['Admin_name'];
  $valueEmail = $_POST['Admin_email'];
  $valueTelephone = $_POST['Admin_phone'];
  $valueAddress = $_POST['address'];

  $sql = "INSERT INTO customer(ID_Customer,Username,Password,Name,Email,Telephone,Address,name_line,image,status) VALUE ('$id','$valueUsername','$valuePassword','$valueName','$valueEmail','$valueTelephone','$valueAddress','$name','$image','$status')";
  if ($conn->query($sql) === TRUE) {
       echo "<center><h3>---+สมัครสมาชิกเรียบร้อยแล้ว+--</center></h3>" ;
       echo "<center><h3>--+ปิดแท็บได้เลยค่ะ+--</center></h3>";
       echo "<img src='Image.jpg' >";

   } else {
   echo "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();


?>
</body>
</html>
<style media="screen">
  h3 {
    color: #88BBAA;
  }

</style>
