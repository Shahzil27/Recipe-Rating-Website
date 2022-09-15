<?php
session_start(); 

if(isset($_SESSION["email"]))
{
    header("Location: recipeList.php");
	exit();
}
else 
{
    $validate = true;
    $reg_Email = "/^\D\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";  
    $reg_Pswd = "/^(\S*)?\d+(\S*)?$/"; 

    $email = "";
    $password = ""; 
    $error = "";

    if (isset($_POST["submitted"]) && $_POST["submitted"]) {
        $email = trim($_POST["email"]);
        $password = trim($_POST["pswd"]);
        
        $db = new mysqli("localhost", "sms524", "Senses7", "sms524");
        if ($db->connect_error) {
            die ("Connection failed: " . $db->connect_error);
        }

        $q = "SELECT * FROM Users WHERE email = '$email' AND pswd = '$password';"; 
        
        $r = $db->query($q);
        $row = $r->fetch_assoc();
        if($email != $row["email"] && $password != $row["pswd"]) {
            $validate = false;

        } else {
            $emailMatch = preg_match($reg_Email, $email);
            if($email == null || $email == "" || $emailMatch == false) {
                $validate = false;
            }
            
            $pswdLen = strlen($password);
            $passwordMatch = preg_match($reg_Pswd, $password);
            if($password == null || $password == "" || $pswdLen < 8 || $passwordMatch == false) {
                $validate = false;
            }
        }
        
        if($validate == true) {
            session_start();
            $_SESSION["email"] = $row["email"];
            $_SESSION["sname"] = $row["screenName"];
            $_SESSION["user_id"] = $row["user_id"];
            header("Location: recipeList.php");
            $db->close();
            exit();

        } else {
            $error = "The email/password combination was incorrect, Login failed.";
            $db->close();
        }
    }
}

?>




<!DOCTYPE html>
<html lang=en>
    <head>
        <link rel = "stylesheet" type = "text/css" href = "style.css">
        <title> Rating Recipes - Login </title>
        <script type="text/javascript" src="validate.js"> </script> 
    </head>
    
 

    <body>
        <div class = "login-container">
            <h1> Login </h1>
            <hr>
            <form id = "Login" action="login.php" method = "POST">
                <input type="hidden" name="submitted" value="1"/>
                <div>
                    <label> Email </label>
                    <input class= "align1" type = "text" id="email" name="email"><p id = "msg_email" class = "errStyle"> </p>
                </div>
                
                <div>
                    <label> Password </label>
                    <input class="align1" type = "password" id = "pswd" name="pswd"><p id="msg_pswd" class = "errStyle">  </p>
                        
                </div>
                <div class="err"><?=$error?></div>
                <div>
                    <input class="button1" type="submit" value="Enter">
                        
                </div>
            </form>
            <hr>
            <div>
                <p class="log">
                    If you dont have an account then <a class= "link" href = "signup.php"> Sign-Up </a>  
                </p>    
            </div>

        </div>
        <script type="text/javascript" src="login-r.js"> </script> 
    </body>

</html>
