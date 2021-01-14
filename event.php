<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="login.css">
		<title>Make An Appointment</title>
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
      	<h1 style="font-family: Helvetica"><u>Book your appointment now!</u></h1>
      	<br>
      	<h2 style="font-family: Helvetica"><u>Beneficiary</u></h3>
	<form method="post" >
      	<div class="firstname" style="margin-left: 30px">
	      	<label style="font-family: Helvetica"><strong>First Name</strong></label>
	      	<br>
	      	<input style="border-radius: 10px; height: 20px" type="text" name="fname">
	    </div>
	    <div class="lastname" style="margin-left: 250px; margin-top: -45px">
	      	<label style="font-family: Helvetica"><strong>Last Name</strong></label>
	      	<br>
	      	<input style="border-radius: 10px; height: 20px" type="text" name="lname">
	    </div>
	    <div class="Email" style="margin-left: 470px; margin-top: -45px">
	      	<label style="font-family: Helvetica"><strong>Email</strong></label>
	      	<br>
	      	<input style="border-radius: 10px; height: 20px" type="text" name="email">
	    </div>
	     <div class="tel" style="margin-left: 690px; margin-top: -45px">
	      	<label style="font-family: Helvetica"><strong>Telephone</strong></label>
	      	<br>
	      	<input style="border-radius: 10px; height: 20px" type="text" name="phone">
	    </div>
	    <div class="descr" style="margin-left: 30px; margin-top: 20px">
	      	<label style="font-family: Helvetica"><strong>Description</strong></label>
	      	<br>
	      	<input style="border-radius: 10px; height: 80px; width: 500px" type="text" name="descr">
	    </div>
	    <br><br><br>
	    <h2 style="font-family: Helvetica"><u>Provider</u></h3>
      	<div class="firstname" style="margin-left: 30px">
	      	<label style="font-family: Helvetica"><strong>First Name</strong></label>
	      	<br>
	      	<input style="border-radius: 10px; height: 20px" type="text" name="pfname">
	    </div>
	    <div class="lastname" style="margin-left: 250px; margin-top: -45px">
	      	<label style="font-family: Helvetica"><strong>Last Name</strong></label>
	      	<br>
	      	<input style="border-radius: 10px; height: 20px" type="text" name="plname">
	    </div>
	    <div class="code" style="margin-left: 470px; margin-top: -45px">
	      	<label style="font-family: Helvetica"><strong>Code</strong></label>
	      	<br>
	      	<input style="border-radius: 10px; height: 20px" type="text" name="pcode">
	    </div>
	    <a href="./calendar.php"><button style="margin-top: 90px; margin-left: 550px; text-decoration:none;color:black">Cancel</button></a>
	    <button name="submit" type="submit" value="signup">Book</a></button>


		 <br><br><br><br><br><hr>
		  <nav class="footer-nav" role="navigation">
				<p style="text-align:center">Copyright &copy;
				  2020 Doctor Any Time. All rights reserved.</p>
		  </nav>
		</form>
	</body>
</html>
<html>
<body>
<style>
body{
  background-image:url("back2.jpg");
  background-size: cover;
  background-attachment: fixed;
}
button{
  width: 100px;
  height: 35px;
  border-radius: 30px;
  background-color: white;
  font-family: Helvetica;
  text-decoration: bold;
  font-size: 20px;
  display: inline-block;
}
.titlos{
  position: relative;
  left:110px;
  bottom: 110px;
  font-family: Helvetica;
  color: white;
}
.div2{
	margin-left: 480px;
	width: 400px;
}
.ikona{
  width: 150px;
}

.passbox{
	margin-left: 6px;
}
.butt{
	margin-left: 470px;
  margin-bottom: -230px;
}

</style>
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
  $description= trim($_POST['descr']);
  $first_pname= trim($_POST['pfname']); 
  $last_pname= trim($_POST['plname']);
  $pcode= trim($_POST['pcode']);

  
	

  
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
	if (empty($description)){
	    echo( "Please enter description.");	
	}
	  else{echo ($description);}
 
	if (empty($first_pname)){
	    echo( "Please enter p first name.");	
	}
	  else{echo ($first_pname);}
	if (empty($last_pname)){
	    echo( "Please enter p last name.");	
	}
	  else{echo ($last_pname);}
	if (empty($pcode)){
	    echo( "Please enter p code.");	
	}
	  else{echo ($pcode);}

	
        if (empty($error)){
	
          $insertQuery = $db->prepare("INSERT INTO appointments (bname,blastname,bemail,btelephone,bdescription,pname,plastname,pcode,date) VALUES(?,?,?,?,?,?,?,?,?);");
          $insertQuery->bind_param("sssisssis",$first_name,$last_name,$email,$telephone,$description,$first_pname,$last_pname,$pcode,$_GET['date']);
          $result = $insertQuery->execute();
          if ($result){
            $error.= '<p class="success">Your appointment was successful!</p>';
		header("location:./calendar.php");
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
 ?>
