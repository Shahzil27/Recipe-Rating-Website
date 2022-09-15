<?php
session_start(); 

if(!isset($_SESSION["email"]))
{
    header("Location: login.php");
	exit();
}
else 
{
    $db = new mysqli("localhost", "sms524", "Senses7", "sms524");
    
    if ($db->connect_error) {
        die ("Connection failed: " . $db->connect_error);
    }
    
    $user_id = $_SESSION["user_id"];
    $validate = true; 

    if (isset($_GET["rid"]) && $_GET["rated"])
    {
        $input = trim($_GET["rated"]); 
        $recipe_id = trim($_GET["rid"]); 
        $reg_Rate = "/^[0-5]$/";
        
        $rateMatch = preg_match($reg_Rate, $input);
        if ($rateMatch == false)
        {
            $validate = false; 
        } 

        $verify = true;
        $q5 = "SELECT user_id, recipe_id FROM Recipes WHERE user_id = '$user_id' AND recipe_id ='$recipe_id';";
        $r5 = $db->query($q5);
        if ($row5 = $r5->fetch_assoc())     // checking to make sure that the creator isnt trying to rate their own recipe 
        {
            $verify = false;
        }
        else
        {
            $verify = true; 
        }

        if (($validate == true) && ($verify == true))
        { 
            $q3 = "SELECT user_id, recipe_id, rate_id FROM UserRatings WHERE user_id = '$user_id' AND recipe_id = '$recipe_id';";
            $r3 = $db->query($q3);

            $phpArray = array(); 

            if($row1 = $r3->fetch_assoc())   // checking if rating already exists from current user 
            {
                
                $rate_id = $row1["rate_id"];
                $q4 = "UPDATE UserRatings SET rated = '$input' WHERE rate_id ='$rate_id';";
                $r4 = $db->query($q4); 


                if ($r4 === true)
                {
                   $q7 = "SELECT Recipes.recipe_id, Recipes.title, AVG(UserRatings.rated) as avgRating
                   FROM Recipes INNER JOIN UserRatings ON (UserRatings.recipe_id = Recipes.recipe_id)
                   WHERE Recipes.recipe_id = '$recipe_id';";   

                   $result = $db->query($q7);
                   $row7 = $result->fetch_assoc(); 
                   $phpArray[] = $row7; 
                   
                   $jsonResult = json_encode($phpArray);
                   echo($jsonResult);  
                }
            }
            else
            {    
                $q2 = "INSERT INTO UserRatings (user_id, recipe_id, rated) VALUES ('$user_id', '$recipe_id', '$input');"; 
                $r2 = $db->query($q2);

                if ($r2 === true)
                {
                    $q7 = "SELECT Recipes.recipe_id, Recipes.title, AVG(UserRatings.rated) as avgRating
                    FROM Recipes INNER JOIN UserRatings ON (UserRatings.recipe_id = Recipes.recipe_id)
                    WHERE Recipes.recipe_id = '$recipe_id';";   
 
                    $result = $db->query($q7);
                    $row7 = $result->fetch_assoc(); 
                    $phpArray[] = $row7; 
                    
                    $jsonResult = json_encode($phpArray);
                    echo($jsonResult); 
                }
            }
        }
        else
        {
            $error = "Cannot Rate your own Recipe.";     
        }

    }
    

   
    
}
?>