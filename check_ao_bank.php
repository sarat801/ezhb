
<?php

require_once 'connectDB.php';
error_reporting(E_ALL ^ E_NOTICE);
$money = (int)$_POST['money'];
$acc = $_POST['acc'];
$submit = $_POST['submit'];
$moneyc = (int)$_POST["moneyc"];
$bank = $_POST["bank"];

$conn = new connectDB();
$sql = "SELECT * FROM customer Where accountNumber ='" . $acc . "'";
$result = mysqli_query($conn->connect(), $sql);
$row = mysqli_fetch_array($result);

$f_name = $row['fname'];
$f_promptPay= $row['accountNumber'];


$con = new connectDB();

if ($submit == "aon") {
    echo $row['b_name']."<br>";
    echo $bank."<br>";
    if ($row['b_name'] == $bank) {
        if($money > 0){
            if($moneyc<$money ){
                echo "<script>";
                echo "alert(\"ยอดเงินของท่านไม่เพียงพอ\");";
                echo "window.history.back()";
                echo "</script>";
            }else{
                $con->updateaon_bank($money,$acc,$f_name,$f_promptPay);
                $con->updateaon_bank1($money);
            }
        }
        else{
            echo "<script>";
            echo "alert(\" กรุณารอกจำนวนเงิน \");";
            echo "window.history.back()";
            echo "</script>";
        }
    
    
    } 
    else {
      echo "<script>";
      echo "alert(\" ไม่พบเลขบัญชี้ กรุณาตรวจสอบเลขบัญชีหรือ ธนาคารอีกครั้ง \");";
      echo "window.history.back()";
      echo "</script>";
    }
    
} 

?>
