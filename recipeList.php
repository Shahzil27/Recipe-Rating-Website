<?php
session_start(); 

if(!isset($_SESSION["email"]))
{
    header("Location: login.php");
	exit();
}
else
{
    $user_id = $_SESSION["user_id"];
    $screenName = $_SESSION["sname"];
    
    $db = new mysqli("localhost", "sms524", "Senses7", "sms524");
    if ($db->connect_error) {
        die ("Connection failed: " . $db->connect_error);
    }

    $q = "SELECT Recipes.recipe_id, Recipes.title, Recipes.ingred, Recipes.descrp, Recipes.datePosted, Users.screenName, Users.avatar, AVG(UserRatings.rated) as avgRating
        FROM Users RIGHT JOIN Recipes ON (Users.user_id = Recipes.user_id)
        LEFT JOIN UserRatings ON (UserRatings.recipe_id = Recipes.recipe_id)
        GROUP BY Recipes.recipe_id
        ORDER BY Recipes.recipe_id DESC;"; 
    
    $r = $db->query($q);
    $count = 0;
    
}

?>





<!DOCTYPE html>
<html lang=en>
    <head>
        <!--<meta charset = "utf-8" />-->
        <link rel = "stylesheet" type = "text/css" href = "style.css">
        
        <title> Recipe List </title>

    </head>

    <body class = "recipes">
        <header>
            <h1 class = "recipeH1"> Welcome to Rating Recipes! </h1>
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
        
        <div id="all-tiles" class="tile-box"> 
            <?php
                while (($row = $r->fetch_assoc()) && ($count < 20)) 
                {
                    $count = $count + 1; 
                    $avgR = round($row["avgRating"], 1);

                    if ($avgR == null)
                    {
                        $avgR = "N/A";
                    }

                    $ingred = substr($row["ingred"],0,37) . "...";
                    $descp = substr($row["descrp"],0,37) . "...";

            ?>	
                    <div id="tile-for-rid-<?=$row["recipe_id"]?>" class ="tile">
                        <br>
                        <div id="image-<?=$row["recipe_id"]?>"> <img src="<?=$row["avatar"]?>" alt = "User Image"> </div>
                        <div>
                            <div id="link-<?=$row["recipe_id"]?>"> <a href="recipeDetail.php?rid=<?=$row["recipe_id"]?>"> <?=$row["title"]?> </a> </div>
                            <div>
                                <p class = "discription">
                                    <div id="ingred-<?=$row["recipe_id"]?>">
                                        ingredients: 
                                        <?=$ingred?>
                                    </div>
                                    <br>
                                    <div id="descp-<?=$row["recipe_id"]?>">
                                        Description: 
                                        <?=$descp?>
                                    </div>
                                    <br>
                                    <div id="date-<?=$row["recipe_id"]?>">
                                        Posted on: 
                                        <?=$row["datePosted"]?>
                                    </div>
                                </p>
                            </div>
                            <hr>
                            <div id="chefName-<?=$row["recipe_id"]?>" class = "cookName">
                                <?=$row["screenName"]?>
                            </div>
                            <div class = "rating">
                                <span id="re-Rate-<?=$row["recipe_id"]?>"> <?=$avgR?> </span><span><img class="star" src="star.png" alt="Rating: "></span>
                                
                            </div>
                        </div>
                    </div>
            <?php
                }
                $db->close(); 
            ?>
        </div>
        <script type="text/javascript" src="validate.js"> </script> 
    </body>
</html>