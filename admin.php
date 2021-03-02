<?php
include_once 'inc/header.php';
require 'inc/dbh.inc.php';
include_once 'inc/addproduct.inc.php';
?>
<div class="container">
  <div class="row">
    <div class="column">
      
      <?php
      if(isset($_SESSION['message'])){
	echo "<h2>" . $_SESSION['message'] . "</h2>";
	unset($_SESSION['message']); 
      }  
      ?>
    </div>
  </div>
  <div class="row">
    <div class="column column-50" style="padding-top: 2rem;">
      <form action="inc/addproduct.inc.php" method="post">
	<input name="foodid" type="number"
	       value="<?= $updatefoodid ?>" hidden/>
	<label for="foodname">Food Name</label>
	<input  id="foodname" name="foodname"
		type="text" value="<?= $updatefoodname ?>"/>
	<label for="foodprice">Price</label>
	<input  id="foodprice" name="foodprice"
		type="number" value="<?= $updatefoodprice ?>"/>
	<label for="imageurl">Image Url</label>
	<input  id="imageurl" name="imageurl"
		type="text" value="<?= $updatefoodurl ?>"/>
	<label for="categoryid">Category Id</label>
	<input  id="categoryid" name="categoryid"
		type="number" value="<?= $category ?>"/>
	<button name="<?= $foodupdateoradd; ?>" type="submit">
	  <?php if($foodupdateoradd == 'savefood'): ?>
	    ADD
	  <?php else: ?>
	    UPDATE
	  <?php endif; ?>
	</button>
      </form>
      <table>
	<thead>
	  <tr>
            <th>Food ID</th>
	    <th>Name</th>
	    <th>Price</th>
	    <th></th>
	    <th></th>
	  </tr>
	</thead>
	<tbody>
	  <?php 
	  $sql = "SELECT * FROM food;";
	  $result = mysqli_query($conn, $sql);
	  //var_dump($result);
	  $resultCheck = mysqli_num_rows($result);
	  // echo $resultCheck;
	  if($resultCheck > 0):
	  while($row = mysqli_fetch_assoc($result)):
	  ?>
	    <tr>
	      <td><?= $row['idFood'] ?></td>
	      <td>
		<img alt="<?= $row['nameFood'] ?>"
		     src="<?= $row['imageUrlFood'] ?>"/>
	      </td>
	      <td><?= $row['nameFood'] ?></td>
	      <td><?= $row['priceFood'] ?></td>
	      <td>
		<a class="button"
		   href="admin.php?editfood=<?= $row['idFood'] ?>">
		  Update
		</a>
	      </td>
	      <td>
		<a
		  href="inc/addproduct.inc.php?deletefood=<?=$row['idFood']?>">
		  <i class="far fa-trash-alt"></i>
		</a>
	      </td>
	    </tr>
	  <?php endwhile; endif ?>
	</tbody>
      </table>
    </div>
    <div class="column column-40 column-offset-10" style="padding-top: 2rem;">
      <form action="inc/addproduct.inc.php" method="post">
	<input name="categoryid" type="number"
	       value="<?= $cupdateid ?>" hidden/>
	<label for="categoryname">Category Name</label>
	<input  id="categoryname" name="categoryname"
		    type="text" value="<?= $cupdatename ?>"/>
	<button name="<?= $cupdateoradd ?>" type="submit">
	  <?php if($cupdateoradd == 'savecategory'): ?>
	    ADD
	  <?php else: ?>
	    UPDATE
	  <?php endif; ?>
	</button>
      </form>
      <table>
	<thead>
	  <tr>
            <th>Id</th>
	    <th>Category Name</th>
	    <th></th>
	  </tr>
	</thead>
	<tbody>
	  <?php 
	  $sql = "SELECT * FROM category;";
	  $result = mysqli_query($conn, $sql);
	  //var_dump($result);
	  $resultCheck = mysqli_num_rows($result);
	  // echo $resultCheck;
	  if($resultCheck > 0):
	  while($row = mysqli_fetch_assoc($result)):
	  ?>
	    <tr>
	      <td><?= $row['idCategory'] ?></td>
	      <td><?= $row['nameCategory'] ?></td>
	      <td>
		<a class="button"
		   href="admin.php?editcategory=<?= $row['idCategory'] ?>">
		  UPDATE
		</a>
	      </td>
	      <td>
		<a
		  href="inc/addproduct.inc.php?deletec=<?=$row['idCategory']?>">
		  <i class="far fa-trash-alt"></i>
		</a>
	      </td>
	    </tr>
	  <?php endwhile; endif ?>
	</tbody>
      </table>
    </div>
  </div>
</div>
<?php include_once 'inc/footer.php' ?>
