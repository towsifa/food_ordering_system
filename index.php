<?php
include_once 'inc/header.php';
require 'inc/dbh.inc.php';
?>
<!-- Start Card Container -->
<div class="container-70">
  <!-- Card row Start -->
  <div class="row row-wrap">
    <!-- Card column start -->
    <?php 
    $sql = "SELECT * FROM food;";
    $result = mysqli_query($conn, $sql);
    //var_dump($result);
    $resultCheck = mysqli_num_rows($result);
    // echo $resultCheck;
    if($resultCheck > 0){
      while($row = mysqli_fetch_assoc($result)){
    ?>
      <div class="column column-33">  
	<img class="card-image" alt="" src="<?= $row['imageUrlFood'] ?>"/> 
	<div class="row">
	  <h3 class="card-title"><?= $row['nameFood'] ?></h3>   
	  <h5>
	    &#2547;
	    <span class="card-price"><?= $row['priceFood'] ?></span>
	  </h5>
	</div>
	<span hidden class="food-id"><?= $row['idFood'] ?></span>
	<button class="add-to-cart">Add to Cart</button>
      </div>
    <?php }} ?>
    <!-- Card Column End -->
  </div>
  <!-- Card Row End -->
</div>
<!-- Card Container End -->
<div class="container-25">
  <!-- Cart Start -->
  <div class="cart">
    <h1>CART</h1>
    <table id="cart-table">
      <thead>
        <tr>
          <th>Title</th>
          <th>Quantity</th>
	  <th>Price</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
	<?php
	$_SESSION['cartFoodId'] = isset($_SESSION['cartFoodId']) ? $_SESSION['cartFoodId'] : array('0' => 0);
	// print_r($_SESSION['cartFoodId']);
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
	?>
	    <tr>
	      <td class="food-title">
		<?= $row['nameFood']; ?> 
	      </td>
	      <td>
		<input class="cart-quantity"
		       name="foodquantity"
		       type="number"
		       value="<?= $_SESSION['cartFoodId'][$row['idFood']] ?>"
		       min="1"
		       onchange="quantityChange(this, this.value)"
		/>
	      </td>
	      <td class="food-price">
		<?= $row['priceFood']; ?>
	      </td>
	      <td class="remove-food" onclick="removeTableRow(this)">
		  <i class="far fa-trash-alt"></i>
	      </td>
	      <td>
		<span hidden class="food-id"><?= $row['idFood']; ?></span>
	      </td>
	    </tr>
	<?php }} ?>
      </tbody>
    </table>
    <?php if(isset($_SESSION['userId'])): ?>
      <form action="inc/total.inc.php" method="post">
      <label for="cart-total">Total</label>
      <h2><span class="cart-total"></span></h2>
      <input id="cart-total" name="cart-total" value="1" hidden/>
      <button name="order-submit" type="submit"> Order Now </button>
      </form>
    <?php else: ?>
      <label for="cart-total">Total</label>
      <h2><span class="cart-total"></span></h2>
      <button id="login-load" type="submit">Order</button>
    <?php endif; ?>
  </div>
  <!-- Cart End -->
</div>

<?php include_once 'inc/footer.php' ?>
