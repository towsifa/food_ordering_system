<?php
//print_r($_POST);
//die();
if(isset($_POST['signup-submit'])) {
  require 'dbh.inc.php';
  $name = $_POST['name'];
  $mail = $_POST['mail'];
  $phone = $_POST['phone'];
  $pwd = $_POST['pwd'];
  $pwdRe = $_POST['pwd-repeat'];
  if(empty($name) || empty($mail) || empty($phone)
     || empty($pwd) || empty($pwdRe)){
    $url = sprintf("name=%s&mail=%s",$name, $mail);
    header("Location: ../signup.php?error=emptyfield&".$url);
    exit();
  }elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    $url = sprintf("name=%s",$name);
    header("Location: ../signup.php?error=invalidemail&".$url);
    exit();
  }elseif (!preg_match("/^[0-9]*$/", $phone)) {
    $url = sprintf("name=%s&mail=%s",$name, $mail);
    header("Location: ../signup.php?error=invalidphone&email=".$url);
    exit();
  }elseif ($pwd !== $pwdRe) {
    $url = sprintf("name=%s&email=%s",$name, $email);
    header("Location: ../signup.php?error=passwordcheck&".$url);
    exit();
  }else{
    $sql = "SELECT emailCustomer FROM customer WHERE emailCustomer=? ";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../signup.php?error=sqlerror");
      exit();
    }else{
      mysqli_stmt_bind_param($stmt, "s", $mail);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck > 0) {
        header("Location: ../signup.php?error=mailtaken");
        exit(); 
      }else{
        $sql = "INSERT INTO customer (nameCustomer, emailCustomer, phoneCustomer, pwdCustomer) VALUES(?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../signup.php?error=sqlerror");
          exit();
        }else{
          $pwdHashed = password_hash($pwd, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "ssss", $name, $mail, $phone, $pwdHashed);
          mysqli_stmt_execute($stmt);
          header("Location: ../login.php?signup=success");
          exit();
        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close();
}else{
  header("Location: ../signup.php");
  exit();
}
