// valadation file 

function LoginForm(event){
    
    var valid = true; 


    var elements = event.currentTarget; 
    var email = elements[1].value; 
    var pswd = elements[2].value; 
    
    // regex
    var regex_email = /^\D\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;    // ^(\w)+(\S*)+@[a-zA-Z]+?\.[a-zA-Z]{2,3}$
    var regex_pswd  = /^(\S*)?\d+(\S*)?$/;                         


    // getting all references to ids
    var msg_email = document.getElementById("msg_email"); 
    var msg_pswd = document.getElementById("msg_pswd"); 
    
    
    // setting error messages to empty strings
    msg_email.innerHTML = ""; 
    msg_pswd.innerHTML = ""; 


    //DOM manipulation
    var textNode; 
     


    // check email
    if (email == null || email == "")
    {
        textNode = document.createTextNode("Email cannot be empty"); 
        msg_email.appendChild(textNode);
        valid = false;  
        elements[1].classList.add("redBox"); 
    }
    else if (regex_email.test(email) == false)
    {
        textNode = document.createTextNode("Email must be of the format sample@test.com (cannot start with number)");
        msg_email.appendChild(textNode);
        valid = false;  
        elements[1].classList.add("redBox"); 
    }
    else
    {
        elements[1].classList.remove("redBox");
    }


    // check password
    if (pswd == null || pswd == "")
    {
        textNode = document.createTextNode("Password cannot be empty"); 
        msg_pswd.appendChild(textNode);
        valid = false;  
        elements[2].classList.add("redBox"); 
    }
    else if (pswd.length < 8)  // must be 8 characters or longer 
    {
        textNode = document.createTextNode("Password must be a minimum of 8 characters"); 
        msg_pswd.appendChild(textNode);
        valid = false; 
        elements[2].classList.add("redBox"); 
    }
    else if (regex_pswd.test(pswd) == false)
    {
        textNode = document.createTextNode("Password must have at least 1 number and no spaces");
        msg_pswd.appendChild(textNode);
        valid = false;  
        elements[2].classList.add("redBox"); 
    }
    else
    {
        elements[2].classList.remove("redBox");
    }

    
    if (valid == false)
    {
        event.preventDefault(); 
    }
    
}

function SignUpForm(event){
    
    
    var valid = true; 

    var elements = event.currentTarget; 
    var uname = elements[1].value;
    var sname = elements[2].value; 
    var date = elements[3].value; 
    var email = elements[4].value; 
    var pswd = elements[5].value; 
    var pswdr = elements[6].value; 
    var pic = elements[7].value; 
     

    // regex
    var regex_uname = /^[a-zA-Z]+$/; 
    var regex_sname = /^[a-zA-Z]+\s?[a-zA-Z]+$/;
    var regex_email = /^\D\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;    // ^(\w)+(\S*)+@[a-zA-Z]+?\.[a-zA-Z]{2,3}$
    var regex_pswd = /^(\S*)?\d+(\S*)?$/;                         
    var regex_pic = /(jpeg|jpg|png)$/;  

    // getting all references to ids
    var msg_uname = document.getElementById("msg_uname");
    var msg_sname = document.getElementById("msg_sname"); 
    var msg_date = document.getElementById("msg_date");  
    var msg_email = document.getElementById("msg_email"); 
    var msg_pswd = document.getElementById("msg_pswd"); 
    var msg_pswdr = document.getElementById("msg_pswdr"); 
    var msg_pic = document.getElementById("msg_pic"); 
    
    
    // setting error messages to empty strings
    msg_uname.innerHTML = "";
    msg_sname.innerHTML = ""; 
    msg_date.innerHTML = ""; 
    msg_email.innerHTML = ""; 
    msg_pswd.innerHTML = ""; 
    msg_pswdr.innerHTML = ""; 
    msg_pic.innerHTML = ""; 


    //DOM manipulation
    var textNode; 


    // username checking
    if (uname == null || uname == "")
    {
        textNode = document.createTextNode("Username cannot be empty"); 
        msg_uname.appendChild(textNode); 
        valid = false; 
        elements[1].classList.add("redBox"); 
    }
    else if (regex_uname.test(uname) == false)
    {
        textNode = document.createTextNode("Username can only contain Letters (No numbers or spaces)"); 
        msg_uname.appendChild(textNode);
        valid = false; 
        elements[1].classList.add("redBox"); 
    }
    else
    {
        elements[1].classList.remove("redBox");
    }

    // sname check 
    if (sname == null || sname == "")
    {
        textNode = document.createTextNode("Screen Name cannot be empty"); 
        msg_sname.appendChild(textNode); 
        valid = false; 
        elements[2].classList.add("redBox"); 
    }
    else if (regex_sname.test(sname) == false)
    {
        textNode = document.createTextNode("Screen Name can only contain letters (no numbers)"); 
        msg_sname.appendChild(textNode);
        valid = false; 
        elements[2].classList.add("redBox"); 
    }
    else
    {
        elements[2].classList.remove("redBox");
    }


    // date check 
    if (date == null || date == "" )
    {
        textNode = document.createTextNode("Birth-Date cannot be empty"); 
        msg_date.appendChild(textNode); 
        valid = false; 
        elements[3].classList.add("redBox"); 
    }
    else if (date[0] > 2)
    {
        textNode = document.createTextNode("Year not acceptable"); 
        msg_date.appendChild(textNode); 
        valid = false; 
        elements[3].classList.add("redBox");   
        
    }
    else
    {
        elements[3].classList.remove("redBox");
    }

    // check email
    if (email == null || email == "")
    {
        textNode = document.createTextNode("Email cannot be empty"); 
        msg_email.appendChild(textNode); 
        valid = false; 
        elements[4].classList.add("redBox"); 
    }
    else if (regex_email.test(email) == false)
    {
        textNode = document.createTextNode("Email must be of format username@test.com or username123@test.ca"); 
        msg_email.appendChild(textNode);
        valid = false; 
        elements[4].classList.add("redBox"); 
    }
    else
    {
        elements[4].classList.remove("redBox");
    }

    // check password 
    if (pswd == null || pswd == "")
    {
        textNode = document.createTextNode("Password cannot be empty"); 
        msg_pswd.appendChild(textNode); 
        valid = false; 
        elements[5].classList.add("redBox"); 
    }
    else if (pswd.length < 8)
    {
        textNode = document.createTextNode("Password must be at least 8 characters long"); 
        msg_pswd.appendChild(textNode); 
        valid = false; 
        elements[5].classList.add("redBox"); 
    }
    else if (regex_pswd.test(pswd) == false)
    {
        textNode = document.createTextNode("Password must have at least 1 number character and no spaces"); 
        msg_pswd.appendChild(textNode);
        valid = false; 
        elements[5].classList.add("redBox"); 
    }
    else
    {
        elements[5].classList.remove("redBox");
    }

    // check confirm password
    if (pswdr == null || pswdr == "")
    {
        textNode = document.createTextNode("Confirm password cannot be empty"); 
        msg_pswdr.appendChild(textNode); 
        valid = false; 
        elements[6].classList.add("redBox"); 
    }
    else if (pswdr != pswd)
    {
        textNode = document.createTextNode("Passwords do not match"); 
        msg_pswdr.appendChild(textNode);
        valid = false; 
        elements[6].classList.add("redBox"); 
    }
    else
    {
        elements[6].classList.remove("redBox");
    }

    // check image
    if (pic == null || pic == "")
    {
        textNode = document.createTextNode("Must upload an Avatar image"); 
        msg_pic.appendChild(textNode); 
        valid = false; 
        elements[7].classList.add("redBox"); 
    }
    else if (regex_pic.test(pic) == false)
    {
        textNode = document.createTextNode("File type must be jpeg/jpg OR png"); 
        msg_pic.appendChild(textNode);
        valid = false; 
        elements[7].classList.add("redBox");  
    }
    else
    {
        elements[7].classList.remove("redBox");
    }


    if (valid == false)
    {
        event.preventDefault(); 
    }
  
    
}


function PostRecipeForm (event)
{
    var valid = true; 

    var elements = event.currentTarget; 
    var title = elements[1].value; 
    var ingrd = elements[2].value; 
    var descp = elements[3].value; 


    var msg_title = document.getElementById("msg_title");
    var msg_ingrd = document.getElementById("msg_ingrd");
    var msg_descp = document.getElementById("msg_descp"); 
    
    msg_title.innerHTML = ""; 
    msg_ingrd.innerHTML = ""; 
    msg_descp.innerHTML = ""; 

    var textNode; 

    // check title 
    if (title == null || title == "")
    {
        textNode = document.createTextNode("Title cannot be empty");
        msg_title.appendChild(textNode);
        valid = false; 
        elements[1].classList.add("redBox");   
    }
    else if (title.length > 50)
    {
        textNode = document.createTextNode("Title is too long. Must be 50 characters or less");
        msg_title.appendChild(textNode);
        //valid = false; 
        elements[1].classList.add("redBox");  
    }
    else 
    {
        elements[1].classList.remove("redBox");
    }

    // check ingredients
    if (ingrd == null || ingrd == "")
    {
        textNode = document.createTextNode("Ingredients field cannot be empty");
        msg_ingrd.appendChild(textNode);
        valid = false; 
        elements[2].classList.add("redBox");   
    }
    else 
    {
        elements[2].classList.remove("redBox");
    }

    // check ingredients
    if (descp == null || descp == "")
    {
        textNode = document.createTextNode("Description field cannot be empty");
        msg_descp.appendChild(textNode);
        valid = false; 
        elements[3].classList.add("redBox");   
    }
    else 
    {
        elements[3].classList.remove("redBox");
    }


    if (valid == false)
    {
        event.preventDefault(); 
    }
    
    
}

function TitleCounter (event)
{
    var textNode; 
    var input = event.currentTarget; 
    var title = input.value; 

    var displayCount = document.getElementById("counter");    // call it charLeft
    var msg_title = document.getElementById("msg_title");
    msg_title.innerHTML = ""; 

    var maxChar = 50; 
    var charUsed = title.length; 
    var charLeft = maxChar - charUsed; 

    if (charUsed > 50)
    {
        displayCount.classList.add("red"); 
        textNode = document.createTextNode("character limit has been exceeded");
        msg_title.appendChild(textNode);  
    }
    else 
    {
        displayCount.classList.remove("red");
    }
    displayCount.innerHTML = charUsed + " / " + charLeft + " characters"; 


}

function PositiveButton (event)
{
    event.preventDefault(); 
    var button = event.currentTarget; 
    var negBtn = document.getElementById("negBtn"); 
    var ratingStr = document.getElementById("myRating"); 
    var num = parseInt(ratingStr.value); 
    
    if (num < 5) 
    {
        negBtn.classList.remove("hide"); 
        ratingStr.value = num + 1;
    } 
    else if (num >= 5)
    {
        button.classList.add("hide"); 
    }
    


}

function NegativeButton (event)
{
    event.preventDefault(); 
    var button = event.currentTarget; 
    var posBtn = document.getElementById("posBtn"); 
    var ratingStr = document.getElementById("myRating"); 
    var num = parseInt(ratingStr.value); 
 
    if (num > 0) 
    {
        posBtn.classList.remove("hide"); 
        ratingStr.value = num - 1;
    } 
    else if (num <= 0)
    {
        button.classList.add("hide"); 
    }


}

function HandleButtons(event)
{
    var ratingStr = event.currentTarget;
    var num = parseInt(ratingStr.value);  

    var posBtn = document.getElementById("posBtn");
    var negBtn = document.getElementById("negBtn");
    
    if (num < 0)
    {
        negBtn.classList.add("hide");
    }
    else if (num > 5)
    {
        posBtn.classList.add("hide"); 
    }
    else 
    {
        negBtn.classList.remove("hide");
        posBtn.classList.remove("hide");
    }
}

function AjaxRateButton(event)
{
    var btnID = event.currentTarget.id;
    var rid = btnID.split("-")[3];

    console.log(rid); 
    var rating = document.getElementById("myRating").value;

    var httpModule = new XMLHttpRequest(); 

    httpModule.onreadystatechange = function () {

        // use DOM manipulaiton to update the rating for this specific recipe and show in the detail page by selecting the tag's innerHTML 

        if (httpModule.status == 200 && httpModule.readyState == 4) 
        {
            var result = httpModule.responseText; 
            var jsonArray = JSON.parse(result);
            
            var avgRated = jsonArray[0].avgRating;
             
            var avgR = Math.round(avgRated * 10) / 10; 

            if (avgR == null)
            {
                avgR = "N/A";
            }

            var ratingHtwoTag = document.getElementById("rating-for-" + rid);
            ratingHtwoTag.innerHTML = "Recipe Rating: " + avgR; 
        }

    }


    httpModule.open("GET", "ajax-rate.php?rid=" + rid + "&rated=" + rating, true); 

    httpModule.send(); 


    
}

setInterval(refreshRate, 20000); 

function refreshRate()
{
    var httpModule = new XMLHttpRequest(); 
    
    console.log(1); 
    httpModule.onreadystatechange = function () {
        if (httpModule.status == 200 && httpModule.readyState == 4)
        {
            
            var result = httpModule.responseText; 
            var jsonArray = JSON.parse(result);

            // call back function so maninpulate the DOM 
            for (var i=0; i<jsonArray.length; i++)
            {
                var rid = jsonArray[i].recipe_id; 
                var avgRated = jsonArray[i].avgRating;
                 
                
                if (avgRated === null)
                {
                    var avgR = "N/A";
                }
                else
                {
                    var avgR = Math.round(avgRated * 10) / 10; 
                }
                
                


                var ratePTag = document.getElementById("re-Rate-" + rid);
                ratePTag.innerHTML = avgR; 

            }

        }
    }

    httpModule.open("GET", "ajax-newRate.php" , true); 
    httpModule.send(); 
}




setInterval(refreshRecipes, 90000); 
var lastUpdate = Math.round((Date.now())/1000); 

function refreshRecipes()
{
    var httpModule = new XMLHttpRequest(); 
    
    console.log(2); 
    

    httpModule.onreadystatechange = function () {
        
        if (httpModule.status == 200 && httpModule.readyState == 4)
        {
            
            var result = httpModule.responseText; 
            var jsonArray = JSON.parse(result);
            
            var parentTileBox = document.getElementById("all-tiles"); 
            
            for (var i=0; i<jsonArray.length; i++)
            {
                console.log(3);
                var rid = jsonArray[i].recipe_id; 

                var divTag = document.getElementById("tile-for-rid-" + rid); 
                if (divTag)
                {
                    console.log("already exists"); 
                    var avgRated = jsonArray[i].avgRating;
                 
                    if (avgRated === null)
                    {
                        var avgR = "N/A";
                    }
                    else
                    {
                        var avgR = Math.round(avgRated * 10) / 10; 
                    }

                    var ratePTag = document.getElementById("re-Rate-" + rid);
                    ratePTag.innerHTML = avgR; 
                }
                else
                {
                    console.log("new tile found"); 
                    var tileDivTag = document.createElement("div");
                    tileDivTag.innerHTML = `
                    <br>
                    <div id="image-`+ jsonArray[i].recipe_id +`"> <img src="`+ jsonArray[i].avatar +`" alt = "User Image"> </div>
                    <div>
                        <div id="link-`+ jsonArray[i].recipe_id +`"> <a href="recipeDetail.php?rid=`+ jsonArray[i].recipe_id +`"> `+ jsonArray[i].title +` </a> </div>
                        <div>
                            <p class = "discription">
                                <div>
                                    ingredients: 
                                    `+ jsonArray[i].ingred +`
                                </div>
                                <br>
                                <div>
                                    Description: 
                                    `+ jsonArray[i].descrp +`
                                </div>
                                <br>
                                <div>
                                    Posted on: 
                                    `+ jsonArray[i].datePosted +`
                                </div>
                            </p>
                        </div>
                        <hr>
                        <div class = "cookName">
                            `+ jsonArray[i].screenName +`  
                        </div>
                        <div class = "rating">
                            <span id="re-Rate-`+ jsonArray[i].recipe_id +`"> `+ jsonArray[i].avgRating +` </span><span><img class="star" src="star.png" alt="Rating: "></span>
                            
                        </div>
                    </div>
                    `;

                    var id = "tile-for-rid-" + jsonArray[i].recipe_id;
                    tileDivTag.setAttribute("id", id);  
                    tileDivTag.setAttribute("class", "tile"); 
                    parentTileBox.insertBefore(tileDivTag, parentTileBox.childNodes[0]); 

                    
                    parentTileBox.removeChild(parentTileBox.lastElementChild); 
                    
                }

            }
            
        }

    }
    console.log(lastUpdate); 
    httpModule.open("GET", "ajax-newRecipe.php?lastdate=" + lastUpdate, true); 
    
    httpModule.send(); 
}
