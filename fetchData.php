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
    <title>Document</title>

    <style>
        body{
            margin : 0;
            padding: 0;
        }
        table {
            width: 95%;
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        th {
            background-color: teal;
            color: white;
            
            cursor: pointer;
        }

        #tableDesign {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        tr {
            background-color: black;
            color: white;
        
            cursor: pointer;
        }

        td , th {
            width:20vw !important;
            padding: 10px;
        }

        tr:hover {
            background-color: blueviolet;
        }

        button {
            margin: 7px 0px 0px 10px;
            outline: none;
            border: none;
            padding: 5px;
            cursor: pointer;
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
        #updateContentSection{
            width: 100%;
            background-color: #00000099;
            height: 100%;
            position: absolute;
            display: flex;
            justify-content: center !important;
            align-items: center !important;
           
        }
        #form{
            display: flex;
            flex-direction: column;
            background-color: skyblue;
            width: 50%;
            padding: 30px;
            border-radius: 10px;
        }
        input {
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
        }
        @media only screen and (max-width : 500px){
            td{
                width: 100%;
            }
    }
    .searchSection{
        display: flex;
        justify-content: center;
    }
    #searchUsername{
        border: 2px solid red;
    }
    .bold{
        font-weight: bold;
        color: red;
        font-size: 20px;
    }
    </style>
</head>

<body>
    <div class="searchSection">
        <input type="text" id="searchUsername" placeholder="Enter Username">
    </div>
    <div id="updateContentSection">
    <form id="form">
            
            <input type="text" id="userID" readonly >
            <input type="text" id="username">
            <input type="text" id="password">
            <div id="actionButtons">
            <input type="button" class="btn cancel" value="Cancel" id="cancelButton">
            <input type="button" class="btn update" value="Update" id="updateButton">
            </div>
        </form>
    </div>

    <div id="tableDesign">
        <div id="messageBox">
            <span id="infoBox"></span>
        </div>
    <!-- <table id="userTable">
            <tr class="tableHeading">
                <th>ID</th>
                <th>USERNAME</th>
                <th>PASSWORD</th>
                <th>ACTIONS</th>
            </tr>
        </table> -->

        <table id="userTable1">
        <tr class="tableHeading">
                <th>ID</th>
                <th>USERNAME</th>
                <th>PASSWORD</th>
                <th>ACTIONS</th>
            </tr>
        </table>
        <div id="hiddenField">No Data To Show</div>
    </div>

    <script src="./jsFiles/fetchData.js"></script>
</body>

</html>