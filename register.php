<?php
require_once "config.php";
require_once "session.php";
if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])){
  $first_name= trim($_POST['full name']);
  $last_name= trim($_POST['last name']);
  $email= trim($_POST['email']);
  $telephone= trim($_POST['telephone']);
  $username= trim($_POST['username']);
  $password= trim($_POST['password']);
  $password_hash=password_hash($password, PASSWORD_BCRYPT);
  if($query = $db->prepare("SELECT * FROM users WHERE email = ?")){
    $error= '';
    // Bind parameters (s=string i=int b =blob,etc)in our case theusername is a string so weuse "S"
    $query->bind_param('s',$email);
    $query->execute();
    // store the result so we can check if the account exists in the database.
    $query->store_result();
      if ($query->num_rows>0){
        $error.='<p class="error">The email addres is already registered!</p>';
      }else{
        //valid password
        if(strlen($password)<6){
          $error.= '<p class="error">Password must have atleast 6 characters.</p>';
        }
        if (empty($error)){
          $insertQuery = $db->prepare("INSERT INTO users (fullname,lastname,email,telephone,username,password) VALUES(?,?,?,?,?,?);");
          $insertQuery->bind_param("sss",$first_name,$last_name,$email,$telephone,$username,$password_hash);
          $result = $insertQuery->execute();
          if ($result){
            $error.= '<p class="success">Your registration was successful!</p>';
          }
          else{
            $error .='<p class="error">Something went wrong!</p>';
          }
        }
      }
   }
    $query->close();
    $insertQuery->close();
    // close DB fann_get_total_connection
    mysqli_close($db);
}
 ?>
 <!DOCTYPE html>
 <html>
 	<head>
 		<meta charset="utf-8">
 		<link rel="stylesheet" href="signup.css">
 		<title>SignUp Form</title>
 	</head>
 	<body>
 		<header>
         <span>
         <a href="./home.html"><img class="ikona" src="logo.png"></a>
           <div class="titlos">
               <h2>Doctor Any Time</h2>
           </div>
         </span>
       </header>
 		<div class="div2">
 			<h1 style="font-family: Helvetica">Sign Up</h1>
 			<p style="font-family: Helvetica"><b>Please fill in this form to create account</b></p>
 			<hr>
 			<form>
 				<label for="fname">First Name: </label>
 				<input type="text" name="fname">
 				<br><br>
 				<label for="lname">Last Name: </label>
 				<input class="lnamebox" type="text" name="lname">
 				<br><br>
 				<label for="email">Email: </label>
 				<input class="emailbox" type="text" name="email">
 				<br><br>
 				<label for="phone">Telephone: </label>
 				<input class="phonebox" type="text" name="phone">
 				<br><br>
 				<label for="username">Username: </label>
 				<input class="usernamebox"  type="text" name="username">
 				<br><br>
 				<label for="pass">Password: </label>
 				<input class="passbox" type="text" name="pass">
 			</form>
 			<p style="color: red" "font-family: Hevletica">*All fields are required.</p>
             <h5 style="font-family: Helvetica">By creating an account you agree to our <a href="#" style="color:dodgerblue" "font-family: Helvetica">Terms & Privacy</a>.</h5>
 		</div>
 		<div class="butt">
 	  	<a href="./home.html"><button>Cancel</button></a>
 	  	<a href="#"><button>Sign Up</button></a>
 	  </div>
 	</body>
 </html>
