<?php include_once 'inc/header.php' ?>
<div class="container">
  <div class="row" style="justify-content: center; padding-top: 2rem;">
    <div class="column column-33">
      <form action="inc/signup.inc.php" method="post">
	<label for="name">Full Name</label>
	<input id="name"
	       name="name"
	       type="text"
	       placeholder="Full Name" minlength="3" maxlength="60"/>
	<label for="mail">Email</label>
	<input id="mail"
	       name="mail" type="email" placeholder="example@gmail.com"/>
	<label for="phone">Phone Number</label>
	<input id="phone"
	       name="phone"
	       type="text" placeholder="01X12345678" maxlength="11" />
	<label for="pwd">Password</label>
	<input id="pwd" name="pwd" type="password" placeholder="Password"/>
	<label for="pwd-repeat">Repeat Password</label>
	<input id="pwd-repeat" name="pwd-repeat" type="password" placeholder="Repeat Password"/>
	<button name="signup-submit" type="submit"> Sign Up </button>
      </form>
    </div>
  </div>
</div>
<?php include_once 'inc/footer.php' ?>
