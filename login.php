<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="login.css">
		<title>LogIn Form</title>
	</head>
	<body>		
		<header>
        <span>
        <a href="./welcome.php"><img class="ikona" src="logo.png"></a>
          <div class="titlos">
              <h2>Doctor Any Time</h2>
          </div>
        </span>
      </header>
		<div class="div2">
			<h1 style="font-family: Helvetica">Log In</h1>
			<p style="font-family: Helvetica"><b>Enter your credentials</b></p>
			<hr>
			<form method="post">
				<label for="username">Username: </label>
				<input class="usernamebox"  type="text" name="username" required>
				<br><br>
				<label for="pass">Password: </label>
				<input class="passbox" type="text" name="pass" required>
			
			<p style="color: red" "font-family: Hevletica">*All fields are required.</p>

			<button name="submit" type="submit" value="login">Login</button>
	  		<input class="remember" type="checkbox" checked="checked" name="remember"> Remember me
	  		<h5 style="font-family: Helvetica">Don't have an account yet? Sign Up<a href="./register.php" style="color:dodgerblue" "font-family: Helvetica"> here</a>.</h5> 
			
		</div>
</form>
	</body>
</html>

<?php
require_once "config.php";
require_once "session.php";
$error='';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
	
	$username=trim($_POST['username']);
	$password = trim($_POST['pass']);
	// validate if username is empty 
	if (empty($username)){
	   $error .= '<p class ="error">Please enter username.</p>';	
	}
	//validate if password is empty 
	if (empty($password)){
	   $error .= '<p class="error">Please enter your password.</p>';	
	}
	if (empty($error)){
	    $query= $db->prepare("SELECT * FROM USERS WHERE Username=?");
		$query->bind_param('s',$username);
	        $query->execute();
		$row=$query->get_result();
	        $user=$row->fetch_assoc();
	        echo "<script>console.log('".$user["Password"]."')</script>";
		if ($user){
		    if (password_verify($password,$user['Password'])){echo "<script>console.log('Here')</script>";
			$_SESSION["userid"] = $user['Email'];
			$_SESSION["user"] = $user;
			// REDIRECT THE USER TO SEARCH PAGE
			header("location: ./search2.php");
			exit;	
                    }else{
			 $error .='<p class="error">The password is not valid.</p>';
		         }
                 }else {
			$error .='<p class="error">No User exist with that email address.</p';
		 
	 }
	   $query->close();
 	}
 	// close connection 
 mysqli_close($db);
}
?>
