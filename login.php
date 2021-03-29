<!DOCTYPE html>
<html>
    <head>
        <title>Login Form</title>
    </head>
    <body>
        <?php

            $hostname = "localhost";
            $username = "soumik";
            $password = "12345";
            $dbname = "skc";


            $username = $password ="";
            $usernameerr = $passworderr ="";

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                if(empty($_POST['uname'])) {                    
                    $usernameerr = "Please Fill up the Username!";
                }

                else if(empty($_POST['pass'])) {                    
                    $passworderr = "Please Fill up the password!";
                }

                else {
                    $username = $_POST['uname'];
                    $password = $_POST['pass'];


                    $stmt = $conn1->prepare("select password from login where user = ?");
		            $stmt->bind_param("s", $username);
		            $stmt->execute();
		            $res2 = $stmt->get_result();
		            $user = $res2->fetch_assoc();

                        $temp_user = $username;
                        $temp_pass = $username['password'];


                        if($temp_user == $username && $temp_pass == $password) 
                        {

                            echo "Login successfully.";

                        }
                       else{ echo "Wrong Password! Please Try Again.";}

                    }
                


                }

            }
        ?>
        
        <h1>Login Form</h1>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

            <fieldset>
                <legend><b>Login</b></legend>
            
                <label for="username">Username:</label>
                <input type="text" name="uname" id="username">
                <?php echo $usernameerr; ?>

                <br>

                <label for="parmanent_address">Password:</label>
                <input type="password" name="pass" id="password">
                <?php echo $passworderr; ?>
                
                </fieldset>

            <input type="submit" value="Login"> 
        </form>
        
    </body>
</html>