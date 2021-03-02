<?php session_start(); ?>
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
    <header>
      <nav class="navigation">
	<ul>
	  <li><a href="home.php">Home</a></li>
	  <li><a href="index.php">Order</a></li>
	 
	  <?php if(isset($_SESSION['isEmployee'])): ?>
	    <li><a href="admin.php">Admin</a></li>
	  <?php endif; ?>
	</ul>
	<div>
	  <?php if(isset($_SESSION['userId'])): ?>
	    <a href="profile.php">
	      Welcome <?= $_SESSION['userName']; ?>
	    </a>
	    <a class="button" href="inc/logout.inc.php">Log Out</a>
	  <?php else: ?>
	    <a class="button" href="login.php">Log In</a>
	    <a class="button" href="signup.php">Sign UP</a>
	  <?php endif; ?>
	</div>
      </nav>
    </header>
