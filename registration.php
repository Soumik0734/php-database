<!DOCTYPE html>
<html>
    <head>
        <title>Registration Form</title>
    </head>
    <body>
        <?php

             $hostname = "localhost";
             $username = "soumik";
             $password = "12345";
             $dbname = "skc";


            $firstname = $lastname = $gender = $email = $username = $password = $rec_email ="";
            $firstnameerr = $lastnameerr= $gendererr = $emailerr = $usernameerr = $passworderr = $rec_emailerr ="";

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                if(empty($_POST['fname'])) {
                    $firstnameerr = "Please Fill up the firstname!";
                }

                else if(empty($_POST['lname'])) {                    
                    $lastnameerr = "Please Fill up the lastname!";
                    
                }

                else if(empty($_POST['gender'])) {                    
                    $gendererr = "Please Fill up the gender!";
                    
                }

                else if(empty($_POST['e-mail'])) {                    
                    $emailerr = "Please Fill up the email!";
                    
                }

                else if(empty($_POST['uname'])) {                    
                    $usernameerr = "Please Fill up the username!";
                }

                else if(empty($_POST['pass'])) {                    
                    $passworderr = "Please Fill up the password!";
                }

                else if(empty($_POST['remail'])) {                    
                    $rec_emailerr = "Please Fill up the recovery email!";
                }

                else {
                    $firstname = $_POST['fname'];
                    $lastname = $_POST['lname'];
                    $gender = $_POST['gender'];
                    $email = $_POST['e-mail'];
                    $username = $_POST['uname'];
                    $password = $_POST['pass'];
                    $rec_email = $_POST['remail'];


                    $conn1 = mysqli_connect($hostname, $username, $password, $dbname);
	                if(mysqli_connect_error()) 
                    {
		            echo "2. Database Connection Failed!...";
		            echo "<br>";
		            echo mysqli_connect_error();
	                }
	                else 
                    {
		            echo "2. Database Connection Successful!";

		            $stmt2 = mysqli_prepare($conn1, "insert into users (firstname, lastname, gender, email, username, password, rec_email) values (?, ?, ?, ?, ?, ?, ?)");
		            mysqli_stmt_bind_param($stmt2, "sssvviv",$p1, $p2, $p3, $p4, $p5, $p6, $p7);
		            $p1 = $firstname;
		            $p2 = $lastname;
                    $p3 = $gender;
                    $p4 = $email;
                    $p5 = $username;
                    $p6 = $password;
                    $p7 = $rec_email;
		            $res = mysqli_stmt_execute($stmt2);

		        if($res) {
			      echo "Data Insert Successful!";
		        }
		        else {
			      echo "Failed to Insert Data.";
			      echo "<br>";
			      echo $conn1->error;
		             }
	                
                    }

	             mysqli_close($conn1);


                    
                

                }

            }
        ?>
        <h1>Registration Form</h1>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

            <fieldset>
                <legend><b>Basic Information:</b></legend>
            
                <label for="firstname">First Name:</label>
                <input type="text" name="fname" id="firstname">
                <?php echo $firstnameerr; ?>

                <br>

                <label for="lastname"> LastName:</label>
                <input type="text" name="lname" id="lastname">
                <?php echo $lastnameerr; ?>

                <br>

                <label for="gender">Gender:  </label>
                <input type="radio" name="gender" id="male" value="male">  
                <label for="gender">Male </label>
                <input type="radio" name="gender" id="female" value="female">
                <label for="gender">Female </label>
                <input type="radio" name="gender" id="other" value="other">
                <label for="gender">Other </label>
                <?php echo $gendererr; ?>

                <br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="e-mail">
                <?php echo $emailerr; ?>

            </fieldset>

            <fieldset>
                <legend><b>Account Information:</b></legend>

                <label for="username">Username:</label>
                <input type="text" name="uname" id="username">
                <?php echo $usernameerr; ?>

                <br>

                <label for="parmanent_address">Password:</label>
                <input type="password" name="pass" id="password">
                <?php echo $passworderr; ?>

                <br>

                <label for="rec_email">Recovery email:</label>
                <input type="email" id="rec_email" name="remail">
                <?php echo $rec_emailerr; ?>
                
                </fieldset>

            <input type="submit" value="Submit"> 
        </form>
        
    </body>
</html>