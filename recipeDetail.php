<?php
session_start(); 

if(!isset($_SESSION["email"]))
{
    header("Location: login.php");
	exit();
}
else 
{
    $recipe_id = $_GET["rid"];
    $user_id = $_SESSION["user_id"];
    $screenName = $_SESSION["sname"];
    $validate = true; 
    $error = ""; 

    $db = new mysqli("localhost", "sms524", "Senses7", "sms524");

    if ($db->connect_error) {
        die ("Connection failed: " . $db->connect_error);
    }

    $q = "SELECT Users.screenName, Users.userName, Users.avatar, Users.email, Recipes.title, Recipes.ingred, Recipes.descrp, Recipes.datePosted, AVG(UserRatings.rated) as avgRating
    FROM Users INNER JOIN Recipes ON (Users.user_id = Recipes.user_id)
    INNER JOIN UserRatings ON (UserRatings.recipe_id = Recipes.recipe_id)
    WHERE Recipes.recipe_id = $recipe_id;"; 
    
    $r = $db->query($q); 
   
    
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
        <section class = "detail-container">
            <?php
                $row = $r->fetch_assoc();

                $avgR = round($row["avgRating"], 1);
                if ($avgR == null)
                {
                    $avgR = "N/A";
                }

                if ($row["screenName"] == $screenName)
                {
                    $error = "cannot rate own recipe";  
                }
            ?>
                <article class = "same">
                <img class = "profile" src="<?=$row["avatar"]?>" alt="AvatarIMG">
                
                    <ul class = "chef-info">
                        <li> <?=$row["screenName"]?> </li>
                        <li> <?=$row["email"]?> </li>
                        <li> Posted On: <?=$row["datePosted"]?> </li>
                    </ul> 
                
                </article>
                <article class="same">
                    
                    <form id = "rateForm" class = "ratingPosition" > <!-- action="recipeDetail.php?rid=<?=$recipe_id?>" method="post">  -->
                        <!-- <input type="hidden" name="submitted" value="1" /> -->
                        <p class="chef-info"> <?=$row["title"]?></p>
                        <h2 id="rating-for-<?=$recipe_id?>"> Recipe Rating: <?=$avgR?>  </h2>    <!-- remove this tag here (dom manipulation) and implement new tag with updated value from call back function --> 
                        <br>
                        <div class = "move">
                            <label class> Enter Rating (0-5) </label>
                            <button id = "negBtn" class = "btnStyle"> - </button> <input class = "rateField" type="number" value="0" id="myRating" name="myRating"> <button id = "posBtn" class = "btnStyle"> + </button>
                            <p id="msg_btn" class="errStyle">  </p>
                            <br>
                            <div class="err"><?=$error?></div>
                            <input id = "rate-btn-for-<?=$recipe_id?>" class ="Rate-Button button1 btnSize" type="button" value = "Rate">
                        </div>
                    </form>
                </article>
                <article class="same">
                    
                        <h4>Ingredients</h4>
                        <hr>
                        <div>
                            <?=$row["ingred"]?> 
                        </div>
                    
                </article>
                <article class = "background">
                    <img class = "food" src="plate.jpg" alt="image">
                </article>
                <article class= "description">
                    
                        <h4>Description</h4>
                        <hr>
                        <p>
                            <?=$row["descrp"]?> 
                        </p>
                    
                </article>
            <?php		
	            $db->close();
            ?>	
        </section>

        
        <script type="text/javascript" src="recipeDetail-r.js"> </script> 
    </body>


</html>