<?php
require "dbh.inc.php";
session_start();

//print_r($_REQUEST);
//die();

if(isset($_REQUEST['foodQn']) && isset($_REQUEST['foodId'])){
  $_SESSION['cartFoodId'][$_REQUEST['foodId']] = $_REQUEST['foodQn'];
  //echo $_REQUEST['foodId'];
  //echo $_REQUEST['foodQn'];
  //die;
}elseif(isset($_REQUEST['foodId'])){
  if(!isset($_SESSION['cartFoodId'])){
    $_SESSION['cartFoodId'] = array();
  }
  $foodidarr = array_keys($_SESSION['cartFoodId']);
  if (!in_array($_REQUEST['foodId'], $foodidarr) ) {
    $_SESSION['cartFoodId'][$_REQUEST['foodId']] = 1;
  }
  //print_r($_SESSION['cartFoodId']);
  //die;
}elseif(isset($_REQUEST['rmFoodId'])) {
  $key = $_REQUEST['rmFoodId'];
  // echo $key;
  // print_r($_SESSION['cartFoodId']);
  $foodidarr = array_keys($_SESSION['cartFoodId']);
  $val = array_search($key, $foodidarr);
  if($val !== false) {
    //echo $val;
    unset($_SESSION['cartFoodId'][$key]);
  }    
}elseif(isset($_REQUEST['order-submit'])){
  $sql = "INSERT INTO order_list (totalOrderList, customer) VALUES (";
  $sql .= $_REQUEST['cart-total']. ", ". $_SESSION['userId'];
  $sql .= ");";
  //echo $sql;
  //die;
  mysqli_query($conn, $sql);
  $ordermysqlid = mysqli_insert_id($conn);
  //echo $ordermysqlid;
  //die;
  $_SESSION['orderidnow'] = $ordermysqlid;
  foreach($_SESSION['cartFoodId'] as $key=>$values){
    $sql = "INSERT INTO order_item (quantityOrderItem, food, order_list) ";
    $sql .= "VALUES (". $values. ", ". $key. ", ". $ordermysqlid;
    $sql .= ");";
    mysqli_query($conn, $sql);
  }
  unset($_SESSION['cartFoodId']);
  $_SESSION['cartTotal'] = $_REQUEST['cart-total'];
  unset($_SESSION['placeorder']);
  header("Location: ../order.php");
  exit();
}
$foodidarr = array_keys($_SESSION['cartFoodId']);
$whereIn = implode(',', $foodidarr);
// echo $whereIn;
$sql = "SELECT * FROM food WHERE idFood IN (".$whereIn.");";
// echo $sql;
// die();
$result = mysqli_query($conn, $sql);
// var_dump($result);
$resultCheck = mysqli_num_rows($result);
if($resultCheck > 0){
  while($row = mysqli_fetch_assoc($result)){
    $html = '<tr>';
    $html .= '<td class="food-title">';
    $html .= (string) $row['nameFood']; 
    $html .= '</td>';
    $html .= '<td>';
    $html .= '<input class="cart-quantity" name="foodquantity" ';
    $html .= 'type="number" value="'.$_SESSION['cartFoodId'][$row['idFood']];
    $html .= '" min="1" onchange="quantityChange(this, this.value)" />';
    $html .= '</td>';
    $html .= '<td class="food-price">';
    $html .= (string) $row['priceFood'];
    $html .= '</td>';
    $html .= '<td class="remove-food" onclick="removeTableRow(this)">';    
    $html .= '<i class="far fa-trash-alt"></i>';
    $html .= '</td>';
    $html .= '<td><span hidden class="food-id">';
    $html .= (string) $row['idFood'];
    $html .= '</span></td>';
    $html .= '</tr>';
    echo $html;
}} 
