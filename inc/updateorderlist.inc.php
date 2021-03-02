<?php
require 'dbh.inc.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if(isset($_REQUEST['deleteorder'])){
    $sql = "DELETE FROM order_list WHERE idOrderList =".$_REQUEST['deleteorder'].";";
    // echo $sql;
    // die;
    mysqli_query($conn, $sql);
    $_SESSION['message'] = "Order Deleted From Database";
    header("Location: ../profile.php");
    exit();
}