<?php
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("Asia/Bangkok");
$input = fopen("log_json.txt", "w") or die("Unable to open file!");
fwrite($input,$json);
fclose($input);
function mint($request)
{
  $servername = "localhost";
  $username = "root";
  $password = "root1234";
  $dbname = "queue";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $conn->set_charset("utf8");
  $queryText = $request["queryResult"]["queryText"];
  $userId = $request["originalDetectIntentRequest"]["payload"]["data"]["source"]["userId"];
  $date= date('Y-m-d');
  $time = date('H:i:s');
  $Status =  "Waiting" ;
  //นับคำที่เข้ามาว่าถึงคิวไหนแล้ว
  $select = "SELECT COUNT(*) as no FROM customer_queue WHERE  Date = '$date' and Status_Queue = '$queryText' and Status_TypeQueue != 'complete'  and  Status_TypeQueue != 'cancle'";
  $result = mysqli_query($conn, $select);
  $numRows = mysqli_num_rows($result);
    while($show = mysqli_fetch_array($result)) {
      $substr = (int)$show["no"];
    }
    if ($substr < 0) {
     $substr = 0 ;
    }else {
    $substr = $substr + 1 ;
  }
  $select = "SELECT ID_Customer FROM customer where ID_Customer = '$userId'";
  $result = mysqli_query($conn, $select);
  $numRows = mysqli_num_rows($result);
    while($show = mysqli_fetch_array($result)){
      $user_register = $show["ID_Customer"];
    }
    if ($user_register == null) {
      sendMessage(array(
          "source" => $request["responseId"],
          "fulfillmentText"=>"กรุณาสมัครสมาชิกก่อนทำรายการ",
          "payload" => array(
              "items"=>[
                  array(
                      "simpleResponse"=>
                  array(
                      "textToSpeech"=>"response from host"
                       )
                  )
              ],
              ),

      ));
    } else {
      $sql = "INSERT INTO customer_queue(ID_Customer,Status_Queue,Date,Time,Status_TypeQueue) select '$userId','$queryText','$date','$time','$Status' where not exists (SELECT * from customer_queue where Date = '$date' and Status_TypeQueue != 'complete' and Status_TypeQueue != 'cancle' and ID_customer = '$userId')";
      if ($queryText != ""){
        if ($conn->query($sql) === TRUE) {
          $select = "SELECT COUNT(*) as no FROM customer_queue WHERE  Date = '$date'  and Status_TypeQueue != 'complete' and Status_TypeQueue != 'cancle'";
          $result = mysqli_query($conn, $select);
          $numRows = mysqli_num_rows($result);
            while($show = mysqli_fetch_array($result)){
                  $substr1 = (int)$show["no"];
            }
            if ($substr1 < $substr ) {
              $message="ขออภัย คุณได้ทำการจองคิวไว้ก่อนหน้านี้แล้ว กรุณาตรวจสอบสถานะคิวอีกครั้ง";
            }
            else {
              $message= "จองคิวสำเร็จ";
            }
            sendMessage(array(
                "source" => $request["responseId"],
                "fulfillmentText"=>$message,
                "payload" => array(
                    "items"=>[
                        array(
                            "simpleResponse"=>
                        array(
                            "textToSpeech"=>"response from host"
                             )
                        )
                    ],
                    ),

            ));
      } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
       }
     }
    }
      mysqli_close($conn);
}
function processMessage($update) {
  $date2 = date("Y-m-d");
  $queryText2 = $request["queryResult"]["queryText"];
  $userId2 = $update["originalDetectIntentRequest"]["payload"]["data"]["source"]["userId"];
     if ($update["queryResult"]["queryText"] == "คิว") {
        $id =  $update["queryResult"]["parameters"]["number"];
        $conn = mysqli_connect("localhost", "root", "root1234", "queue");
        $sql = "SELECT *, @n := @n + 1 AS queue_number FROM customer_queue,(SELECT @n := 0) AS m WHERE date = '$date2' AND Status_TypeQueue != 'complete' and  Status_TypeQueue != 'cancle'" or die("Error:" . mysqli_error());
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) {
          if ($row["ID_customer"] == $userId2) {
            $status = $row["queue_number"];
          }
        }
        if ($status == null) {
          $ppp = "ไม่มีรายการ ";
        } else {
          $ppp = "ขณะนี้คุณอยู่คิวลำดับที่ : " . $status  ;
        }
        sendMessage(array(
          "source" => $update["responseId"],
          "fulfillmentText"=>$ppp,
          "payload" => array(
            "items"=>[
              array(
                "simpleResponse"=>
                array(
                  "textToSpeech"=>$ppp
                )
              )
              ],
            ),
          ));
        } else if ($update["queryResult"]["queryText"] == "ยกเลิก") {
           $id =  $update["queryResult"]["parameters"]["number"];
           $conn = mysqli_connect("localhost", "root", "root1234", "queue");
           $sql = "SELECT * FROM customer_queue where ID_customer = '$userId2' and Status_TypeQueue != 'complete' and  Status_TypeQueue != 'cancle'" or die("Error:" . mysqli_error());
           $result = mysqli_query($conn, $sql);
           while($row = mysqli_fetch_array($result)) {
               $status = $row["ID_customer"];
               $id = $row["ID_Queue"];
           }
           if ($status == null) {
             $ppp = "ไม่มีรายการ ";
           } else {
             $ppp = "ยกเลิกคิวสำเร็จ" ;
             $dataa2 ="UPDATE customer_queue SET Status_TypeQueue ='cancle' where ID_Queue = '$id'";
             $result_statusquery = mysqli_query($conn,$dataa2);
           }
           sendMessage(array(
             "source" => $update["responseId"],
             "fulfillmentText"=>$ppp,
             "payload" => array(
               "items"=>[
                 array(
                   "simpleResponse"=>
                   array(
                     "textToSpeech"=>$ppp
                   )
                 )
                 ],
               ),
             ));
        } else {
          sendMessage(array(
            "source" => $update["responseId"],
            "fulfillmentText"=>"ไม่ได้อยู่ใน intent ใดใด",
            "payload" => array(
              "items"=>[
                array(
                  "simpleResponse"=>
                  array(
                    "textToSpeech"=>"Bad request"
                  )
                )
                ],
              ),
            ));
          }
        }
        function sendMessage($parameters) {
          echo json_encode($parameters);
        }
$json = file_get_contents("php://input");
/*Decode Json From LINE Data Body*/
$request4 = json_decode($json, true);
if (isset($request4["queryResult"]["queryText"])) {
  if ($request4["queryResult"]["queryText"]=='คิว' || $request4["queryResult"]["queryText"]=='ยกเลิก') {
    processMessage($request4);
    echo $request4["queryResult"] ;
  } else if (strtolower($request4["queryResult"]["queryText"])== 'จองคิว') {
      mint($request4);
  }
}
?>
