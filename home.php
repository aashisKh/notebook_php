


<?php
include './jsLink.php';
include './checkUserID.php';
?>



<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"> -->
<link rel="stylesheet" href="./cssFiles/design.css">

<title>Document</title>
<style>
    body{
        background-color: #3a3b3c;
        padding: 0;
        margin: 0;
    }
    #logout{
        border: none;
        outline: none;
        border-radius: 5px;
        background-color: yellow;
        color: black !important;
        font-weight: bold;
        margin-bottom: 10px;

        
    }
    #userPostSection{
        clear: both;
        display: grid;
        row-gap: 20px !important;
        grid-template-columns: 24% 24% 24% 24%;
        justify-content: space-evenly;
        padding-bottom: 40px;
        
    }
    .postOuter{
        background-color: #18191a;
        border-radius: 10px;
        padding: 10px;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        row-gap: 10px;
    }
    @media only screen and (max-width : 1025px){
        #userPostSection{
            grid-template-columns: 32% 32% 32%;
        }
        #form {
        width: 40% !important;
    }
    }
    @media only screen and (max-width : 770px){
        #userPostSection{
            grid-template-columns: 49% 49%;
        }
        .addNewPost{
            width: 50% !important;
        }

        #form {
        width: 80% !important;
    }
    }

    @media only screen and (max-width : 500px){
        #userPostSection{
            grid-template-columns: 98%;
        }
        .addNewPost{
            width: 98% !important;
        }
        #form {
        width: 90% !important;
    }
    }

/* 
    @media only screen and (max-width:1025px){

}

@media only screen and (max-width:770px){
    #form , #messageBox{
        width: 50%;
    }
}

@media only screen and (max-width:426px){
    #form , #messageBox{
        width: 90%;
    }
} */


    p{
        text-align: center;
        color: white;
        background-color: 	#242526;
        border-radius: 10px;

    }
    .title{
        padding: 10px;

    }
    .body{
        padding: 20px;
        text-align: center;
    }
    .actionButtonSection{
        display: flex;
        justify-content: space-evenly;
    }
    .btn{
        font-weight: bold;
        width: 40%;
        border-radius: none;
        padding: 10px;
        outline: none;
        border: none;
        border-radius: 10px;
    }
    .edit{
        background-color: yellow;
        color: black;
    }
    .delete{
        background-color: red;
        color: white;
    }
    .edit:hover{
        background-color: white;
    }
    .delete:hover{
        background-color: white;
        color: black;
    }
    .delete:focus , .edit:focus{
        background-color: white;
    }

    #showMessage , #showSuccessMessage{
        width: 80%;
        background-color: #18191a;
        color: white;
        padding: 10px;
        border-radius: 10px;
        visibility: hidden;
    }
    #showSuccessMessage{
        background-color: green;
        position: absolute;
    }
    #bottomSection{
        position: fixed;
        bottom: 0;
        width: 100%;
        display: flex;
        justify-content: center;
        z-index: 1;
    }
    .addNewPost{
        border: none;
        outline: none;
        padding: 10px;
        width: 30%;
        border-radius: 8px;
        margin: 10px;
        font-weight: bold;
        background-color: blue;
        color: white;
    }
    #topBar{
        display: flex;
        justify-content: space-between;
        padding: 20px;
        align-items: center;
    }
    .newPostAddingSection{
        width: 100%;
        height: 100vh;
        background-color: #00000099;
        position: absolute;
        top: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }




    button {
            margin: 7px 0px 0px 10px;
            outline: none;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }


        #hiddenField {
            width: 76%;
            background-color: yellow;
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 17px;
        }
        #newPostSection{
            width: 100%;
            background-color: #00000099;
            height: 100%;
            position: fixed;
            top: 0;
            display: flex;
            justify-content: center !important;
            align-items: center !important;
            z-index: 2;
            visibility: hidden;
           
        }
        #form{
            display: flex;
            flex-direction: column;
            background-color: skyblue;
            width: 50%;
            padding: 30px;
            border-radius: 10px;
        }
        .form {
            margin: 15px 0px 0px 0px;
            padding: 10px;
            border-radius: 10px;
            font-size: 17px;
            border: none;
        }
        #actionButtons{
            display: flex;
            justify-content: space-between;
        }
        .btn{
            width: 49%;
            cursor: pointer;
            margin-top: 10px;
            
        }
        .cancel{
            background-color: yellow;
            font-weight: bold;
        }
        .update{
            background-color: green;
            color:white;
        }

        .show{
            display: block;
        }
        #messageBox{
            margin-top: 40px;
            width: 80%;
            height: 40px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            visibility: hidden;
        }
        .success{
            background-color: green;
            color: white;
        }
        .warning{
            background-color: yellow;
            color: black;
        }
        .up , .delete{
            border-radius: 2px;
            font-weight: bold;
        }
        .up{
            background-color: yellow;
            font-weight: bold;
        }
        .delete{
            background-color: red;
            color: white;
            border-radius: 5px;
        }
        #username{
            color : white;
        }
</style>
</head>

<body>


<div id="topBar">
<div id="showMessage">No Post To Show</div>  
<div id="showSuccessMessage">Post is created successfully</div> 
<span id="username"> Welcome |  <span > </span>  </span>    
<button id="logout">Logout</button>
</div>


<div id="userPostSection">
</div>

<div id="bottomSection"><button class="addNewPost" id="addNewPost">Add Post</button></div>

<div id="newPostSection">
    <form id="form"> 
            <input type="text" id="postTitle" class="form" placeholder="Enter Post Title">
            <textarea class="form" id="postBody" placeholder="Enter Post Body"></textarea>
            <div id="actionButtons">
            <input type="button" class="btn cancel" value="Cancel" id="cancelButton">
            <input type="button" class="btn update" value="Post" id="postUserData">
            </div>
        </form>
    </div>


<script type="text/javascript" src="./jsFiles/index.js"></script>
<script src="./jsFiles/logout.js"></script>
</body>

</html>
