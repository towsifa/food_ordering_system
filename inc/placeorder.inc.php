<?php
require "dbh.inc.php";
session_start();

if (isset($_REQUEST['placeOrder'])) {
    // print_r($_REQUEST);
    // die();
    $nowFormat = date('Y-m-d H:i:s');
    $sql = "UPDATE order_list SET ";
    $sql .= "addressOrderList='" . $_REQUEST['address'] . "',";
    $sql .= "noteOrderList='" . $_REQUEST['note'] . "',";
    $sql .= "deliveryOrderList= '$nowFormat'";
    $sql .= " WHERE idOrderList=". $_SESSION['orderidnow'] .";";
    // echo $sql;
    mysqli_query($conn, $sql);
    $_SESSION['message'] = "Order Successful";
    $_SESSION['placeorder'] = 'done';
    //print_r($_SESSION);
    //die();
    header("Location: ../order.php");
    exit();
}
