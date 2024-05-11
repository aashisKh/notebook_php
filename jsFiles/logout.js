


let logout = document.getElementById("logout")
logout.onclick = (e)=>{
    e.preventDefault()
    let c = checkCookie("key") 
    document.cookie = `key = ${c.val} ; max-age = 0`
    window.localStorage.removeItem("currentUser")
    window.location = "login.php"
}

function checkCookie(coookieName) {
    let getCookie = {}

    let cookie = document.cookie.split(";")
    cookie.forEach((value, index, array) => {
        let cookie = value.split("=")
        if (cookie[0].trim() == coookieName) {
            getCookie.key = cookie[0]
            getCookie.val = cookie[1]

        }
    })
    return getCookie
}