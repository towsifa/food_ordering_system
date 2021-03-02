<?php include_once 'inc/header.php';
require 'inc/dbh.inc.php';
//print_r($_REQUEST);
?>

<div class="container">

  <div class="row">
    <div class="column" style="text-align: center; margin-top: 1rem;">
      <h1>Order Summery</h1>
    </div>
  </div>
  <table>
    <thead>
      <tr>
	<th>Food Name</th>
	<th>Quantity</th>
	<th>Price</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if(isset($_SESSION['userId']) && isset($_SESSION['orderidnow'])){
	$orderid = $_SESSION['orderidnow'];
	$sql = "SELECT * FROM order_item WHERE order_list=".$orderid.";";
	//echo $sql;
	//die();
	$result = mysqli_query($conn, $sql);
	// var_dump($result);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0):
	while($row = mysqli_fetch_assoc($result)):
	$foodsql = "SELECT nameFood, priceFood FROM food WHERE idFood= ";
	$foodsql .= $row['food'].";";
	//echo $foodsql;
	$food_result = mysqli_query($conn, $foodsql);
	$food_n_p = mysqli_fetch_assoc($food_result);
	//print_r($food_n_p);
	//die();
      ?>
	<tr>
	  <td><?= $food_n_p['nameFood']; ?></td>
	  <td><?= $row['quantityOrderItem']; ?></td>
	  <td>&#2547;<?= $food_n_p['priceFood']; ?></td>
	</tr>
      <?php endwhile; endif; ?>
    </tbody>
    <tfoot>
      <?php if(isset($_SESSION['placeorder'])):
      $order_address_sql = "SELECT addressOrderList, noteOrderList, deliveryOrderList FROM order_list WHERE idOrderList=".$_SESSION['orderidnow'].";";
      //echo $order_address_sql;
      //die();
      $order_address_result = mysqli_query($conn, $order_address_sql);
      $order_address = mysqli_fetch_assoc($order_address_result);
      //print_r($order_address);
      ?>
	
	<tr>
	  <td colspan="2">Address:</td>
	  <td><?= $order_address['addressOrderList']; ?></td>
	</tr>
	<tr>
	  <td colspan="2">Note:</td>
	  <td><?= $order_address['noteOrderList']; ?></td>
	</tr>
	<tr>
	  <td colspan="2">Delivery Time:</td>
	  <td><?= $order_address['deliveryOrderList']; ?></td>
	</tr>
      <?php endif; ?>
      <tr>
	<td colspan="2">Total</td>
	<?php if(isset($_SESSION['cartTotal'])): ?>
	  <td>&#2547;<?= $_SESSION['cartTotal'] ?></td>
	<?php endif ?>
      </tr>
    </tfoot>
      <?php } ?>
  </table>
  <div class="row">
    <div class="column column column-offset-40">
      <!-- Trigger/Open The Modal -->
      <?php if(!isset($_SESSION['placeorder'])): ?>
	<button id="placeorder">Place Order</button>
      <?php endif; ?>
      <!-- The Modal Start -->
      <div id="myModal" class="modal">
	<!-- Modal content -->
	<div class="modal-content">
	  <div class="modal-header">
	    <span class="close">&times;</span>
	    <h2>Add Order Delivery Informations</h2>
	  </div>
	  <div class="modal-body">
	    <form action="inc/placeorder.inc.php" method="post">
	      <label for="address">Address</label>
	      <textarea cols="30"
		      id="address" name="address" rows="10"></textarea>
	      <label for="note">Note</label>
	      <input id="note"
		   name="note" type="text" placeholder="Bring ASAP" />
	      <label for="dvtime">Delivery Time</label>
	      <input id="dvtime"
		     name="dvtime"
		     type="datetime-local"
		     value="<?= date('Y-m-d H:i:s'); ?>"
	      />
	      <button type="submit"
		      name="placeOrder" >Confirm Order</button>
	    </form>
	  </div>
	</div>
      </div>
      <!-- The Model End -->
    </div>
  </div>
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
</div>

<?php include_once 'inc/footer.php' ?>
