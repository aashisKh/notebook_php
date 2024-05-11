

let loginButton = document.getElementById("loginButton")
let messageBox = document.getElementById("messageBox")

loginButton.onclick = async (e) => {
  e.preventDefault()
  let username = document.getElementById("username").value
  let password = document.getElementById("password").value


  if (username.length < 5 || password.length < 5) {
    messageBox.innerText = "username or password length cannot be less than 5."
    messageBox.setAttribute("class", "warning")
    hideMessage()

  } else {
    let status = await saveNewUser(username, password)
    console.log(status)
    if (status != "false") {
        messageBox.innerText = "Login successfull"
        messageBox.setAttribute("class", "success")
        // console.log(username)
        const secKey = Math.random().toString(20).substring(2,100)
        document.cookie = `key = ${status}`
        window.localStorage.setItem("currentUser" , username )
        window.location = "home.php"
      
        hideMessage()
    }else{
      messageBox.innerText = "username or password incorrect"
      messageBox.setAttribute("class", "warning")
      hideMessage()
    }


  }



}
// window.localStorage.removeItem("currentUser")
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
  formData.append("type", "login")
  let data = await fetch("saveNewUser.php", {
    method: "POST",
    body: formData

  })
    .then(response => response.text())
    .then(res => { return res })
  return data
  // console.log(data)
}