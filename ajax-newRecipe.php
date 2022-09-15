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
    
    if (isset($_GET["lastdate"]))
    {

        $lastUpdate = ($_GET["lastdate"]);
        $formatedDate = date("Y-m-d H:i:s", $lastUpdate);  
        $dateStr = strval($formatedDate); 

        $q = "SELECT recipe_id, datePosted FROM Recipes WHERE datePosted>'$dateStr'";  

        $r = $db->query($q);
        
        if ($r->num_rows > 0)   // new recipes found
        {
            $q1 = "SELECT Recipes.recipe_id, Recipes.title, Recipes.ingred, Recipes.descrp, Recipes.datePosted, Users.screenName, Users.avatar, AVG(UserRatings.rated) as avgRating
            FROM Users RIGHT JOIN Recipes ON (Users.user_id = Recipes.user_id)
            LEFT JOIN UserRatings ON (UserRatings.recipe_id = Recipes.recipe_id)
            WHERE datePosted>'$dateStr'
            GROUP BY Recipes.recipe_id
            ORDER BY Recipes.recipe_id DESC;";  

            $r1 = $db->query($q1);

            $phpArray = array(); 

            while ($row = $r1->fetch_assoc()) 
            {
                $phpArray[] = $row; 

            }
            
            $jsonResult = json_encode($phpArray);
            echo($jsonResult); 
        }
        else
        {
            echo ("[]");  
        }

    }
    
    
}
?>