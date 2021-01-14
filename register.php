
<!DOCTYPE html>
 <html>
 	<head>
		<link rel="stylesheet" href="signup.css">
 		<meta charset="utf-8">
 		<title>SignUp Form</title>
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
 			<h1 style="font-family: Helvetica">Sign Up</h1>
 			<p style="font-family: Helvetica"><b>Please fill in this form to create account</b></p>
 			<hr>
 			<form method="post" >
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
 				<input class="passbox" placeholder="At least 6 characters"type="text" name="pass">

			         <p style="color: red" "font-family: Hevletica">*All fields are required.</p>
             <h5 style="font-family: Helvetica">By creating an account you agree to our <a href="#" style="color:dodgerblue" "font-family: Helvetica">Terms & Privacy</a>.</h5>
 		</div>
 		<div class="butt">
 	  	<a href="./welcome.php"><button style= "text-decoration:none;color:black">Cancel</button></a>
 	  	<button name="submit" type="submit" value="signup">Sign Up</button>
 	  </div>

 			
 	</form>	

 	</body>
 </html>

<?php
require_once "config.php";
require_once "session.php";

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
  $first_name= trim($_POST['fname']); 
  $last_name= trim($_POST['lname']);
  $email= trim($_POST['email']);
  $telephone= trim($_POST['phone']);
  $username= trim($_POST['username']);
  $password= trim($_POST['pass']);
  $password_hash=password_hash($password, PASSWORD_BCRYPT);
	

  
	if (empty($first_name)){
	   echo( "Please enter firstname.");	
	}
	  else{echo ($first_name);}
	
	if (empty($last_name)){
	    echo( "Please enter lastname.");	
	}
	  else{echo ($last_name);}
	if (empty($email)){
	    echo( "Please enter email.");	
	}
	  else{echo ($email);}
	if (empty($telephone)){
	    echo( "Please enter telephone.");	
	}
	  else{echo ($telephone);}
	if (empty($username)){
	    echo( "Please enter username.");	
	}
	  else{echo ($username);}
 
	if (empty($password)){
	    echo( "Please enter password.");	
	}
	  else{echo ($password);}
 
  if($query = $db->prepare("SELECT * FROM USERS WHERE Email = ?")){
    $error= '';
    // Bind parameters (s=string i=int b =blob,etc)in our case theusername is a string so weuse "S"
    $query->bind_param('s',$email);
    $query->execute();
    // store the result so we can check if the account exists in the database.
    $query->store_result();
      if ($query->num_rows>0){
        $error.='<p class="error">The email address is already registered!</p>';
      }else{
        //valid password
        if(strlen($password)<6){
          $error.= '<p class="error">Password must have atleast 6 characters.</p>';
        }
	
        if (empty($error)){
          $insertQuery = $db->prepare("INSERT INTO USERS (FirstName,LastName,Email,Telephone,Username,Password) VALUES(?,?,?,?,?,?);");
          $insertQuery->bind_param("sssiss",$first_name,$last_name,$email,$telephone,$username,$password_hash);
          $result = $insertQuery->execute();
          if ($result){
            $error.= '<p class="success">Your registration was successful!</p>';
		header("location:./login.php");
   		$query->close();
    		$insertQuery->close();
    		echo($error);
    		// close DB fann_get_total_connection
    		mysqli_close($db);
          }
          else{
            $error .='<p class="error">Something went wrong!</p>';
          }
        }
      }
   }

}
 ?>
 
