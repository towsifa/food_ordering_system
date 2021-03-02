<?php
session_start();
if (isset($_POST['login-submit'])) {
  require 'dbh.inc.php';
  $mail = $_POST['mail'];
  $pwd = $_POST['pwd'];

  if (empty($mail) || empty($pwd)) {
    header("Location: ../login.php?error=emptyfields");
    exit();
  }else{
    $sql = "SELECT * FROM customer WHERE emailCustomer=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../login.php?error=sqlerror");
      exit();
    }else{
      mysqli_stmt_bind_param($stmt, "s", $mail);
      mysqli_stmt_execute($stmt);
      $resultCheck = mysqli_stmt_get_result($stmt);
      //print_r($resultCheck);
      //die();
      if ($row = mysqli_fetch_assoc($resultCheck)) {
        $pwdChk = password_verify($pwd, $row['pwdCustomer']);
        if ($pwdChk == false) {
          header("Location: ../login.php?error=wrongpassword");
          exit();
        }elseif($pwdChk == true){
          $_SESSION['userId'] = $row['idCustomer'];
	  $_SESSION['userName'] = $row['nameCustomer'];
	  $_SESSION['userPhone'] = $row['phoneCustomer'];
	  $_SESSION['userEmail'] = $row['emailCustomer'];
	  $_SESSION['isEmployee'] = $row['isEmployee'];
          header("Location: ../index.php?login=success");
          exit();
        }else{
          header("Location: ../login.php?error=wrongpassword");
          exit();
        }
      }else{
        header("Location: ../login.php?error=nouser");
        exit();
      }
    }
  }
}else{
  header("Location: ../login.php");
  exit();
}
