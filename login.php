<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <title>Items List</title>
    <link rel="stylesheet"
	  href="css/all.css" type="text/css" media="screen" />
    <link rel="stylesheet"
	  href="css/normalize.css" type="text/css" media="screen" />
    <link rel="stylesheet"
	  href="css/milligram.css" type="text/css" media="screen" />
    <link rel="stylesheet"
	  href="css/items.css" type="text/css" media="screen" />
    <link rel="stylesheet"
	  href="css/index.css" type="text/css" media="screen" />

  </head>
  <body>
    <div class="container">
      <div class="row" style="text-align: center;">
	<div class="column">
	  <h1>Welcome to Restrogirl</h1>
	</div>
      </div>
      <div class="row" style="justify-content: center; padding-top: 2rem;">
	<div class="column column-33">
	  <form action="inc/login.inc.php" method="post">
	    <label for="mail">Email</label>
	    <input id="mail"
		   name="mail" type="email" placeholder="example@gmail.com"/>
	    <label for="pwd">Password</label>
	    <input id="pwd" name="pwd" type="password" placeholder="password"/>
	    <button name="login-submit" type="submit"> Login </button>
	    <p>OR</p>
	    <a class="button" href="signup.php">SignUp</a>
	  </form>
	</div>
      </div>
    </div>
<?php include_once 'inc/footer.php' ?>
