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
    $error = "";
    $reg_Uname = "/^[a-zA-Z]+$/"; 
    $reg_Sname = "/^[a-zA-Z]+\s?[a-zA-Z]+$/"; 
    $reg_Email = "/^\D\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
    $reg_Pswd = "/^(\S*)?\d+(\S*)?$/";
    $reg_Bday = "/^\d{4}\-\d{1,2}\-\d{1,2}$/";
    $reg_Pic = "/(jpeg|jpg|png)$/";
    $email = "";
    //$date = "mm/dd/yyyy";

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    if (isset($_POST["submitted"]) && $_POST["submitted"]) {
        $uname = trim($_POST["uname"]);
        $sname = trim($_POST["sname"]);
        $email = trim($_POST["email"]);
        $date = trim($_POST["date"]);
        $password = trim($_POST["pswd"]);
        $passwordr = trim($_POST["pswdr"]);
        $pic = trim($_POST["fileToUpload"]); 
        
        
        $db = new mysqli("localhost", "sms524", "Senses7", "sms524");
        if ($db->connect_error) {
            die ("Connection failed: " . $db->connect_error);
        }
        
        $q1 = "SELECT * FROM Users WHERE email = '$email';";
        $r1 = $db->query($q1);

        // if the email address is already in use by another user. 
        if($r1->num_rows > 0) {
            $validate = false;

        } else {
            $unameMatch = preg_match($reg_Uname, $uname);
            if ($uname == null || $uname == "" || $unameMatch == false) {
                $validate = false; 
                $error1 = "Username error. "; 
            } 

            $snameMatch = preg_match($reg_Sname, $sname);
            if ($sname == null || $sname == "" || $snameMatch == false) {
                $validate = false; 
                $error2 = "Screen Name error. "; 
            } 

            $emailMatch = preg_match($reg_Email, $email);
            if($email == null || $email == "" || $emailMatch == false) {
                $validate = false;
                $error3 = "Email error. "; 
            }
                
            $pswdLen = strlen($password);
            $pswdMatch = preg_match($reg_Pswd, $password);
            if($password == null || $password == "" || $pswdLen < 8 || $pswdMatch == false) {
                $validate = false;
                $error4 = "Password error. "; 
            }

            $pswdrMatch = preg_match($reg_Pswd, $passwordr);
            if ($passwordr == null || $passwordr == "" || $passwordr != $password || $pswdrMatch == false) {
                $validate = false; 
                $error5 = "Confirm Password error. "; 
            } 

            $bdayMatch = preg_match($reg_Bday, $date);
            if($date == null || $date == "" || $bdayMatch == false) {
                $validate = false;
                $error6 = "Date error. "; 
            }

            $picMatch = preg_match($reg_Pic, $pic);
            if ($pic == null || $pic == "" || $picMatch == false) {
                $error7 = "Image error. "; 
            }
        }

        if($validate == true) {
            $dateFormat = date("Y-m-d", strtotime($date));
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            
            $q2 =  "INSERT INTO Users (userName, screenName, avatar, bDate, email, pswd, pswdr) VALUES ('$uname','$sname', '$target_file', '$dateFormat', '$email', '$password', '$passwordr');";
            $r2 = $db->query($q2);
            
            if ($r2 === true) {
                header("Location: login.php");
                $db->close();
                exit();
            }
            
        } else {
            $error = $error1 . $error2 . $error3 . $error4 . $error5 . $error6 . $error7 . "Email is already in use by another user. Use different Email.";
            $db->close();
        }
    }
}
?>



<!DOCTYPE html>
<html lang=en>
    <head>
        <link rel = "stylesheet" type = "text/css" href = "style.css">
        <title> Sign Up </title>
        <script type="text/javascript" src="validate.js"> </script> 
    </head>

    <body>
        <div class = "signup-container">
            
            <section class="center">
                <h2> Sign Up </h2>
                <hr>
                <form id = "signup" action="signup.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="submitted" value="1"/>
                    <div>
                        <label> User Name </label>
                        <input id = "uname" name="uname" class= "info" type = "text"><p id="msg_uname"  class = "errStyle"></p>
                    </div>
                    <div>
                        <label> Screen Name </label>
                        <input id = "sname" name="sname" class= "info" type = "text"><p id="msg_sname"  class = "errStyle"></p>
                    </div>
                    <div>
                        <label> Birth Date </label>
                        <input id = "date" name="date" class= "info" type = "date"><p id="msg_date"  class = "errStyle"></p>
                    </div>
                    <div>
                        <label> Email </label>
                        <input id = "email" name="email" class= "info" type = "email"><p id="msg_email"  class = "errStyle"></p>
                    </div>
                    <div>
                        <label> Password </label>
                        <input id = "pswd" name="pswd" class="info" type = "password"><p id="msg_pswd"  class = "errStyle"></p>
                    </div>
                    <div>
                        <label> Re-Enter Password </label>
                        <input id="pswdr" name="pswdr" class="info" type = "password"><p id="msg_pswdr" class = "errStyle"></p>
                    </div>
                    <div>
                        <label> Upload Avatar Image </label>
                        <input  id = "fileToUpload" name="fileToUpload" class = "info" type="file"><p id="msg_pic"  class = "errStyle"></p>
                    </div>
                    <div class="err"><?=$error?></div>
                    
                    <div>
                        <input class ="button1" type="submit" value = "Sign Up">
                    </div>
                    
                </form> 
            </section> 
        </div>
        <script type="text/javascript" src="signup-r.js"> </script>
    </body>

</html>
