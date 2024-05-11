





let sButton = document.getElementById("signupButton")
let messageBox = document.getElementById("messageBox")

sButton.onclick = async (e) => {
  
    e.preventDefault()
    let username = document.getElementById("username").value
    let password = document.getElementById("password").value
    let cPassword = document.getElementById("cPassword").value


    if (username.length < 5 || password.length < 5) {
        messageBox.innerText = "username or password length cannot be less than 5."
        messageBox.setAttribute("class", "warning")
        hideMessage()
        
    }


    else if (cPassword != password || password != cPassword) {
        messageBox.innerText = "Password didnot match."
        messageBox.setAttribute("class", "warning")
        hideMessage()
    } else {
        let status = await saveNewUser(username, password)
        console.log(status)
        if (status != "exist") {
            messageBox.innerText = "Signup successfull"
            messageBox.setAttribute("class", "success")
            console.log(username)
            // const secKey = Math.random().toString(20).substring(2,100)
            document.cookie = `key = ${status}`
            window.localStorage.setItem("currentUser" , username )
            window.location = "home.php"
          
            hideMessage()
        }
        else if (status == "exist") {
            
            messageBox.innerText = "User already exist"
            messageBox.setAttribute("class", "warning")
            hideMessage()
        }



    }



}
const hideMessage = () => {
    setTimeout(() => {
        messageBox.setAttribute("class", "hide")
    }, 1000)
}

const saveNewUser = async (username, password) => {
    let status = "false"
    let formData = new FormData()
    formData.append("username", username)
    formData.append("password", password)
    formData.append("type", "signup")
    let data = await fetch("saveNewUser.php", {
        method: "POST",
        body: formData

    })
        .then(response => response.text())
    return data
}