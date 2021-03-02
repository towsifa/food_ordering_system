<?php
include_once 'inc/header.php';
require 'inc/dbh.inc.php';
?>
<div class="container">
<div class="row">
    <div class="column" style="text-align: center; border: 2px solid #9b4dca; ">
      <?php
      if(isset($_SESSION['message'])){
    echo "<h1 style='color: #9b4dca; padding-top: 2rem;'> <i>" . $_SESSION['message'] . "<i></h1>";
    unset($_SESSION['message']); 
      }  
      ?>
    </div>
  </div>
  <div class="row">
    <div class="column column-33">
      <h1 style="text-align: center; padding-top: 2rem;">
    User Profile Informations
      </h1>
      <table>
    <tr>
          <td>Name:</td>
      <td><?= $_SESSION['userName'] ?></td>
    </tr>
    <tr>
          <td>Email:</td>
      <td><?= $_SESSION['userEmail'] ?></td>
    </tr>
    <tr>
          <td>Phone:</td>
      <td><?= $_SESSION['userPhone'] ?></td>
    </tr>
      </table>
    </div>
    <div class="column">
      <h1 style="text-align: center; padding-top: 2rem;">
    User Orders Informations
      </h1>
      <table>
    <thead>
      <tr>
        <?php
        if($_SESSION['isEmployee'] == 1):?>
          <th>Customer</th>
        <?php  endif; ?>
        <th>Delivery Date and Time</th>
        <th>Address</th>
        <th>Note</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (isset($_SESSION['userId'])) {
        if($_SESSION['isEmployee'] == 1){
          $sql = "SELECT * FROM order_list;";
          // $sql .= "WHERE customer=". $_SESSION['userId'] .";";
        }else{
          $sql = "SELECT * FROM order_list ";
          $sql .= "WHERE customer=". $_SESSION['userId'] .";";
        }
        //echo $sql;
        //die();
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        // echo $resultCheck;
        if($resultCheck > 0):
        while($row = mysqli_fetch_assoc($result)):
      ?>
        <tr>
          <?php
          if($_SESSION['isEmployee'] == 1):
          $cussql = "SELECT nameCustomer FROM customer WHERE idCustomer=";
          $cussql .= $row['customer'] . ";";
          //echo $cussql;
          //die;
          $cusresult = mysqli_query($conn, $cussql);
          $cusrow = mysqli_fetch_assoc($cusresult);
          ?>
        <td><?= $cusrow['nameCustomer'] ?></td>
          <?php else: ?>
          <?php  endif; ?>
          <td><?= $row['deliveryOrderList'] ?></td>
          <td><?= $row['addressOrderList'] ?></td>
          <td><?= $row['noteOrderList'] ?></td>
          <td><?= $row['totalOrderList'] ?></td>
          <?php if($_SESSION['isEmployee'] == 1): ?>
          <td>
	        	<a href="inc/updateorderlist.inc.php?deleteorder=<?=$row['idOrderList']?>">
		          <i class="far fa-trash-alt"></i>
		        </a>
	        </td>
          <?php endif; ?>
        </tr>
      <?php endwhile; endif; }?>
    </tbody>
      </table>
    </div>
  </div>
  <!-- Row End -->
</div>
<?php include_once 'inc/footer.php' ?>