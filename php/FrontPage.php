<?php
session_start();

if(isset($_GET['logout'])){
	unset($_SESSION);
	session_destroy();
	session_write_close();
}
?>
<html>
<head>
	<title></title >
	<link rel="stylesheet" type= "text/css" href="/project/css/style1.css">
</head>
<body>
	<div class="navBar">
		<h1>
			<a href="FrontPage.php" class="Lemonade">Lemonade <img class="lemon" src="/project/images/lemon.png"></a>
		</h1>
		<ul>
			<li><a href="loginIndex.php" class="login">Login</a></li>
			<li><a href="signUpIndex.php" class="signup">Sign up</a></li>
		</ul>
	</div>
	
	<div class="wrapper1">
		<h1 class="welcomeText">
			Best Place to <br/>
			Shop 
		</h1>
		<img class="illustration" src="/project/images/illustration.svg">
	</div>

	<div class="wrapper2"> 
		<img align="left" class="illustration2" src="/project/images/illustration2.svg">
		<h1 align="right" class="sectionText1">
			Why Lemonade?
		</h1>
	</div>

	<div class="wrapper3"> 
		<h1 align="left" class="sectionText2">
			Recycling for Our Children's <br>
			Tomorrow
		</h1>
		<img align="right" class="illustration3" src="/project/images/illustration3.svg">
	</div>


</body>
</html>
