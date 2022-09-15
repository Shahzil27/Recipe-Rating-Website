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

    $q = "SELECT Recipes.recipe_id, Recipes.datePosted, AVG(UserRatings.rated) as avgRating
        FROM Recipes INNER JOIN UserRatings ON (UserRatings.recipe_id = Recipes.recipe_id)
        GROUP BY Recipes.recipe_id
        ORDER BY Recipes.recipe_id DESC;"; 

    
    $r = $db->query($q);
    $count = 0;

    $phpArray = array(); 

    while (($row = $r->fetch_assoc()) && ($count < 20)) 
    {
        $count = $count + 1; 
        $phpArray[] = $row; 

    }
    
    $jsonResult = json_encode($phpArray);
    echo($jsonResult); 
    
}
?>