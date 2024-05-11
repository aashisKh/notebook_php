<?php

// echo $_COOKIE['key'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .bold{
            font-weight: bold;
            font-size:  100px;
            color:green !important;
        }
    </style>
</head>
<body>
    <p id="p"> data </p>
    <script>
        // let p = document.getElementById("p")
        //  p.style.color = "red"
        //  let regx = new RegExp("a", 'gi')
        //  console.log(regx)
        //  let span = document.createElement("span")
        //  span.innerText = "g"
        //  document.body.appendChild(span)
        //  span.setAttribute("class" , "bold")
        // let d = p.innerText.replace(regx ,`<b class="bold">${span.innerText}</b>`)
        // p.innerHTML = d
        // let string = "1234abc&"
        // let d = string.replace(/[0-9]|[a-z]\&/g , "*")
        // console.log(d)
        document.onreadystatechange = () => {
  if (document.readyState === "interactive") {
   alert("rr")
  }
};
    </script>
</body>
</html>