<!DOCTYPE html>
<htmL>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <?php 
    // check if user is already logged in and go to index.php if that is true otherwise, exit to next statement
	session_start();
	if(isset($_SESSION["manager"])) {
		header("location: index.php");
		exit();
	}
	
	if(isset($_POST["username"]) && isset($_POST["password"])) {

		$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]);
		$password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]);
		// connect to database
		include "../connect_to_mysql_pdo.php";

		$res = $dbh->prepare("SELECT id FROM admin WHERE username=? AND password=? LIMIT 1"); // username='$manager' AND 
		$res->execute([$manager,$password]);
		$id = $res->fetchColumn();
		
		if($id){
			$_SESSION["id"] = $id;
			$_SESSION["manager"] = $manager;
			$_SESSION["password"] = $password;
			header("location: index.php");
			exit(); // prevent resof of the page from running if user is not logged in
		}
		else {
			echo 'That information is incorrect, try again <a href="index.php"> Here </a>';
			exit();
		}
	}
    ?>
    <style type="text/css">
	    body {
			background: url(bg.jpg) no-repeat center center fixed;
	    	-webkit-background-size: cover;
	    	-moz-background-size: cover;
	    	-o-background-size: cover;
	    	background-size: cover;
		}
		html, body{height:100%; margin:0;padding:0}
		.container-fluid{
			height:95%;
			display:table;
			width: 100%;
		 	padding: 0;
		}
		.row-fluid {
			height: 100%;
			display:table-cell;
			vertical-align:middle;
		}
		.centering {
			float:none;
			margin:0 auto;
		}
		.panel{
			border-radius: 10px;
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
		}
		.panel-heading{
			border-radius: 10px 10px 0px 0px;
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px 10px 0px 0px;
		}
		.helper-text {
			display:inline-block;
			padding-left:40px;
		}
	</style>
</head>
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="col-xs-2 col-md-4">
		</div>
		<div class="col-xs-8 col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-titles text-center">Admin Login</h2>
				</div>
				<form id="form1" name="form1" method="post" action="admin_login.php" class="panel-body">
				    <div class="input-group">
				    	<!--<label for="username">Username</label>-->
				    	<span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
						<input name="username" type="text" class="form-control" id="username" size="40" placeholder="Username"/>
					</div>
					<br>
					<div class="input-group">
				    	<!--<label for="password">Password</label>-->
				    	<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span></span>
						<input name="password" type="password" class="form-control" id="password" size="40" placeholder="Password" />
					</div>
					<br>
					<input name="button" type="submit" class="btn btn-default btn-primary" id="button" value="Sign In"/>
					<p class="helper-text">Not an admin? <a href="../index.php">Go to the store.</a></p>
				</form>
			</div>
		</div>
		<div class="col-xs-2 col-md-4">
		</div>
	</div>
</div>
</body>
</htmL>