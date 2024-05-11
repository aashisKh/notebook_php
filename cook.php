<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        document.cookie ="key1=12345"
        document.cookie ="key2=123456"
        document.cookie ="key3=1234567"


        function checkCookie(coookieName){
            let getCookie = {}

        let cookie = document.cookie.split(";")
        cookie.forEach((value , index , array)=>{
            let cookie  = value.split("=") 
            if(cookie[0].trim() == coookieName){
                getCookie.key = cookie[0]
                getCookie.val = cookie[1] 

            }
        })
        return getCookie
        }

        
        let c = checkCookie("key")
        console.log(c)
        // let obj = {}
        // obj.key = 123
        // obj.val = "1234"
        // console.log(obj)
        document.addEventListener('visibilitychange', function() {
	if(document.hidden)
		console.log('Page is hidden from user view');
	else
		console.log('Page is in user view');
});
    </script>
</body>
</html>