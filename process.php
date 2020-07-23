<?php
$servername = "localhost";
$username = "root";
$password = "";
$db= "mooreadvice";

// Create connection
$connect = new mysqli($servername, $username, $password, $db);

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

session_start();

$id = 0;
$update = false;

$clientName = '';
$clientEmail = '';
$clientNumber = '';
$paymentMode = '';




if(isset($_POST['Submit'])){
    $clientName = $_POST['clientName'];
    $clientEmail = $_POST['clientEmail'];
    $clientNumber = $_POST['clientNumber'];
    $paymentMode = $_POST['paymentMode'];

    mysqli_query($connect,"INSERT INTO client_info (clientName,clientEmail,clientNumber,paymentMode) VALUES('$clientName', '$clientEmail','$clientNumber', '$paymentMode')") or
   die(mysqli_error($connect));

   $_SESSION['message']="Record has been submitted!";
   $_SESSION['msg_type'] = "success";

   header("location: index.php");
}
   if (isset($_GET['delete'])){
       $id = $_GET['delete'];
       
       mysqli_query($connect,"DELETE FROM client_info WHERE $id=id") or die(mysqli_error($connect));
       
       $_SESSION['message']="Record has been deleted!";
       $_SESSION['msg_type'] = "danger";

       header("location: index.php");
   
   }

   if(isset($_GET['edit'])){
       $id = $_GET['edit'];
       $update = true;
       $result = mysqli_query($connect,"SELECT * FROM client_info WHERE id = $id") or die($mysqli->error());
       if(count($result)==1){
           $row = $result->fetch_array();
           $clientName = $_POST['clientName'];
           $clientNumber = $_POST['clientNumber'];
           $clientEmail = $_POST['clientEmail'];
           $paymentMode = $_POST['paymentMode'];
       
       }
   }

   if(isset($_POST['update'])){
       $id = $POST['id'];
       $clientname = $_POST['clientName'];
       $clientnumber = $_POST['clientNumber'];
       $clientemail = $_POST['clientEmail'];
       $paymentmode = $_POST['paymentMode'];
       
       mysqli_query($connect,"UPDATE client_info SET clientName ='$clientName', clientEmail ='$clientEmail',clientNumber ='$clientNumber', paymentMode ='$paymentMode' WHERE id=$id") or
        die($mysqli->error);
        $_SESSION['message']= "Record has been updated";
        $_SESSION['msg_type'] = "warning";

        header('location: index.php');
   }
?>