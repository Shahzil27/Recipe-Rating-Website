<?php
session_start(); 

if(!isset($_SESSION["email"]))
{
    header("Location: login.php");
	exit();
}
else 
{
    $validate = true; 
    $error = ""; 
    $screenName = $_SESSION["sname"];

    if (isset($_POST["submitted"]) && $_POST["submitted"]) {
        $title = $_POST["title"];
        $ingred = $_POST["ingredients"];
        $descp = $_POST["descrip"];
        
        $date = date("Y-m-d H:i:s");  
        $user_id = $_SESSION["user_id"];
        
        $db = new mysqli("localhost", "sms524", "Senses7", "sms524");
        if ($db->connect_error) {
            die ("Connection failed: " . $db->connect_error);
        }
        
        if ($title == null || $title == "")
        {
            $validate = false;
        }

        if ($ingred == null || $ingred == "")
        {
            $validate = false;
        }

        if ($descp == null || $descp == "")
        {
            $validate = false; 
        }

        if ($validate == true)
        {
            $q1 =  "INSERT INTO Recipes (user_id, title, datePosted, descrp, ingred) VALUES ('$user_id', '$title', '$date', '$descp', '$ingred');";
            $r1 = $db->query($q1);

            if ($r1 === true)
            {
                header("Location: recipeList.php");
                $db->close(); 
                exit(); 
            }
            else 
            {
                $error = "ERROR: Avoid Using special characters such as (',?,~,). Posting failed."; 
                $db->close();
            }
        }
        else 
        {
            $error = "Input fields cannot be empty. Recipe-Post failed."; 
            $db->close();
        }

    }
    

}
?>


<!DOCTYPE html>
<html lang=en>
    <head>
        <link rel = "stylesheet" type = "text/css" href = "style.css">
        <title> Post Recipe </title>
        <script type="text/javascript" src="validate.js"> </script> 
    </head>
    <body class = "recipes">
        <header>
            <h1 class = "recipeH1"> Post Your Own Recipe! </h1>
        </header> 
        
        <div class="nav-box">
            <nav>
                <ul>
                    <li>
                        <?=$screenName?>
                    </li>
                    
                    <li>
                        <a href="logout.php"> Log Out </a>
                    </li>
                    <li>
                        <a href="recipeList.php"> Recipe List </a>
                    </li>
                    <li>
                        <a href= "postRecipe.php"> Add Recipe </a>
                    </li>
                    <li>
                        <form class="search-bar">
                            <input type="search" name="search" id="search">
                            <button class ="search-button"> Go </button>
                        </form>
                    </li>

                </ul>
            </nav>
        </div>
        <br>
        <section class = "info-container">
            <div>
                <form id = "postRecipe" class="newRecipe" action="postRecipe.php" method="post">
                <input type="hidden" name="submitted" value="1"/>
                    <div class="err"><?=$error?></div>
                    <div>
                        <label> Recipe Title </label>
                        <input id = "title" name="title" class= "enterTitle" type = "text"><p id = "counter" class="counterStyle"> 0 / 50 characters </p>
                        <p id = "msg_title" class = "errStyle" >  </p>
                        <br>
                    </div>
                    <div>
                        <label> Ingredients </label>
                        <textarea name="ingredients" id="info2" cols="60" rows="10"></textarea><p id = "msg_ingrd" class = "errStyle" >  </p>
                        <br>
                    </div>
                    <div>
                        <label> Description </label>
                        <textarea name="descrip" id="info3" cols="115" rows="10"></textarea><p id = "msg_descp" class = "errStyle" >  </p>
                        <br>
                    </div>
                    <br>
                    
                    <div>
                        <input class ="button1" type="submit" value = "Add Recipe!">
                    </div>

                </form>

            </div>
        </section>
      
        <script type="text/javascript" src="postRecipe-r.js"> </script> 
    </body>


</html>
