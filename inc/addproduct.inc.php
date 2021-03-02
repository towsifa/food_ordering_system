<?php
require 'dbh.inc.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
// All Food data
$updatefoodid = '';
$updatefoodname = '';
$updatefoodprice = '';
$updatefoodurl = '';
$category = '';
$foodupdateoradd= 'savefood';

// All Category Data
$cupdateid = '';
$cupdatename = '';
$cupdateoradd = 'savecategory';

if(isset($_REQUEST['editfood'])){
    $sql = "SELECT * FROM food WHERE idFood=" . $_REQUEST['editfood'] . ";";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $updatefoodid = $row['idFood'];
        $updatefoodname = $row['nameFood'];
        $updatefoodprice = $row['priceFood'];
        $updatefoodurl = $row['imageUrlFood'];
        $category = $row['category'];
        $foodupdateoradd= 'updatefood';
    }
}
if(isset($_REQUEST['editcategory'])){
    $sql = "SELECT * FROM category WHERE idCategory=";
    $sql .= $_REQUEST['editcategory'] . ";";
    //echo $sql;
    //die;
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $cupdateid = $row['idCategory'];
        $cupdatename = $row['nameCategory'];
        $cupdateoradd = 'updatec';

    }
}



if(isset($_REQUEST['savefood'])) {
  $sql =  "INSERT INTO food (nameFood, priceFood, imageUrlFood, category) ";
  $sql .= "VALUES ('" . $_REQUEST['foodname'] . "', ";
  $sql .= $_REQUEST['foodprice'] . ", '" . $_REQUEST['imageurl'] . "', ";
  $sql .= $_REQUEST['categoryid'] . ");";
  // echo $sql;
  // die;
  mysqli_query($conn, $sql);
  $mysqlfoodid = mysqli_insert_id($conn);
  $_SESSION['message'] = "New Food Added to Database";
  header("Location: ../admin.php");
  exit();
}elseif(isset($_REQUEST['savecategory'])){
  $sql =  "INSERT INTO category (nameCategory) ";
  $sql .= "VALUES ('" . $_REQUEST['categoryname'] . "');";
  //echo $sql;
  //die;
  mysqli_query($conn, $sql);
  $mysqlfoodid = mysqli_insert_id($conn);
  $_SESSION['message'] = "New Category Added to Database";
  header("Location: ../admin.php");
  exit();
}elseif(isset($_REQUEST['updatefood'])){
    $sql =  "UPDATE food SET nameFood='" . $_REQUEST['foodname'] . "', ";
    $sql .= "priceFood=" . $_REQUEST['foodprice'] . ", ";
    $sql .= "imageUrlFood='" . $_REQUEST['imageurl'] . "', ";
    $sql .= "category=" . $_REQUEST['categoryid'] . " WHERE ";
    $sql .= "idFood=" . $_REQUEST['foodid'] . ";";
    //echo $sql;
    //die;
    mysqli_query($conn, $sql);
    $_SESSION['message'] = "Food Updated to Database";
    header("Location: ../admin.php");
    exit();
}elseif(isset($_REQUEST['updatec'])){
    $sql =  "UPDATE category SET nameCategory='";
    $sql .= $_REQUEST['categoryname'] . "'  WHERE ";
    $sql .= "idCategory=" . $_REQUEST['categoryid'] . ";";
    //echo $sql;
    //die;
    mysqli_query($conn, $sql);
    $_SESSION['message'] = "Category Updated to Database";
    header("Location: ../admin.php");
    exit();
}elseif(isset($_REQUEST['deletefood'])){
    $sql = "DELETE FROM food WHERE idFood=".$_REQUEST['deletefood'].";";
    // echo $sql;
    // die;
    mysqli_query($conn, $sql);
    $_SESSION['message'] = "Food Deleted From Database";
    header("Location: ../admin.php");
    exit();
}elseif(isset($_REQUEST['deletec'])){
    $sql = "DELETE FROM category WHERE idCategory=".$_REQUEST['deletec'].";";
    // echo $sql;
    // die;
    mysqli_query($conn, $sql);
    $_SESSION['message'] = "Category Deleted From Database";
    header("Location: ../admin.php");
    exit();
}
