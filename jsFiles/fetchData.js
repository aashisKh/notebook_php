let userTable = document.getElementById("userTable1")
let hiddenField = document.getElementById("hiddenField")
let updateContentSection = document.getElementById("updateContentSection")
let cancelButton = document.getElementById("cancelButton")
let updateButton = document.getElementById("updateButton")
let userID = document.getElementById("userID")
let messageBox = document.getElementById("messageBox")
let infoBox = document.getElementById("infoBox")
let Username = document.getElementById("username")
let Password = document.getElementById("password")
updateContentSection.style.visibility = "hidden"
hiddenField.style.visibility = "hidden"

let setNewValue


const fetchUserData = async () => {
//    $("#userTable1 tr").remove()
    $.post("fetchUser.php",
        function (data, status) {
            // console.log(data)
            let response = JSON.parse(data)
            // console.log(response)
           if(response.length == 0){
            logOutUSer()
           }
            $.each(response, (index, values) => {
                const {
                    ID,
                    Username,
                    Password
                } = values
                // console.log(ID)
                let tr = document.createElement("tr")
                tr.setAttribute("class" , "userDataTable")
                let id = document.createElement("td")

                let username = document.createElement("td")
                let password = document.createElement("td")
                let action = document.createElement("td")
                let update = document.createElement("button")
                let del = document.createElement("button")
                id.innerText = ID
                username.innerText = Username
                password.innerText = Password
               if(Username == window.localStorage.getItem("currentUser")){
                
                tr.style.backgroundColor = "green"
               }
                update.innerText = "Update"
                update.setAttribute("class" , "up")
                del.setAttribute("class" , "delete")
                del.innerText = "Delete"


                // username.appendChild(update)
                // password.appendChild(update)
                action.appendChild(update)
                action.appendChild(del)
                tr.appendChild(id)
                tr.appendChild(username)
                tr.appendChild(password)
                tr.appendChild(action)
                userTable.appendChild(tr)
                update.addEventListener("click", checkClick)
                del.addEventListener("click", checkClick)
            })
            if ($("#userTable1 tr").length === 1) {
                hiddenField.style.visibility = "visible"
            }
        }
    )
}

const checkClick = (e) => {

    if (e.target.innerText == "Delete") {
        const id = (e.target.parentElement.parentElement.firstChild.innerText)
        // console.log(id)
        
       if(e.target.parentElement.parentElement.children[1].innerText == window.localStorage.getItem("currentUser")){
       let askUser =  confirm("You are currently logged in. Are you sure you want to delete Account")

       if(askUser === true){
        
        $.post("deleteUser.php", {
            Id: id
        },
            function (data, status) {

              
                $(e.target.parentElement.parentElement).remove()
                if ($("#userTable1 tr").length == 0) {
                    hiddenField.style.visibility = "visible"
                }
            })
            // let c = checkCookie("key") 
        // document.cookie = `key = ${c.val} ; max-age = 0`
        // window.localStorage.removeItem("currentUser")
        // window.location = "login.php"
        logOutUSer()
       }else{
        return 
       }
       }

       $.post("deleteUser.php", {
        Id: id
    },
        function (data, status) {

            // console.log(data)
            $(e.target.parentElement.parentElement).remove()
            if ($("#userTable1 tr").length == 0) {
                hiddenField.style.visibility = "visible"
            }
        })



    }


    if (e.target.innerText === "Update"){
        setNewValue = e.target.parentElement.parentElement
        updateContentSection.style.visibility = "visible"
        const userData = e.target.parentElement.parentElement.innerText.split("\t")
        // console.log(userData)
        let id = userData[0]
        let username = userData[1]
        let password = userData[2]
        userID.value = id
        Username.value = username
        Password.value = password
    }


}

cancelButton.onclick = (e)=>{
    e.preventDefault()
    updateContentSection.style.visibility = "hidden"
}

updateButton.onclick = (e)=>{
    e.preventDefault()
//    console.log(setNewValue.children[1])
  if(Username.value.length < 5 || Password.value.length < 5){
    messageBox.style.visibility = "visible"
    messageBox.setAttribute("class" , "warning")
    infoBox.innerText = "Username or password length cannot be less than 5"
    setTimeout(()=>{
        messageBox.style.visibility = "hidden"
    },1500)
    return 
  }


 
    $.post("updateUser.php",{
        Id : userID.value,
        Username : Username.value,
        Password : Password.value
    },
    function(data , status){
        console.log(JSON.parse(data))
        if(JSON.parse(data) == 'false'){
            messageBox.style.visibility = "visible"
            messageBox.setAttribute("class" , "warning")
            infoBox.innerText = "User already exist"
        }else{
            let newUserId = JSON.parse(data)[0]
            let newUserName = JSON.parse(data)[1]
            let newUserPassword = JSON.parse(data)[2]
            setNewValue.children[0].innerText = newUserId
            if(setNewValue.children[1].innerText == window.localStorage.getItem("currentUser")){
                window.localStorage.setItem("currentUser" , Username.value)
                document.cookie = `key=${newUserId}`
            }


            
            setNewValue.children[1].innerText = newUserName
            setNewValue.children[2].innerText = newUserPassword
            updateContentSection.style.visibility = "hidden"
            messageBox.style.visibility = "visible"
            messageBox.setAttribute("class" , "success")
            infoBox.innerText = "Data is Updated Successfully"
        }


        setTimeout(()=>{
            messageBox.style.visibility = "hidden"
        },1500)
        // fetchUserData()
        
    })
}

fetchUserData()

document.addEventListener('visibilitychange', function () {
    
    if (!document.hidden) {
           $("#userTable1 tr:not(.tableHeading)").remove()
        fetchUserData()
        let c = checkCookie("key") 
        if(Object.keys(c).length == 0){
            // document.cookie = `key = ${c.val} ; max-age = 0`
            // window.localStorage.removeItem("currentUser")
            // window.location = "login.php"
            logOutUSer()
        }

        $.post("checkID.php",
            {
                Id: c.val
            },
            function (data, err) {
                if (data == "false") {
                    // document.cookie = `key = ${c.val} ; max-age = 0`
                    // window.localStorage.removeItem("currentUser")
                    // window.location = "login.php"
                    logOutUSer()
                }
            })
    }
});

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





let searchUsername = document.getElementById("searchUsername")

searchUsername.onkeyup = (e)=>{
    let searchValue = e.target.value
    // const regex = new RegExp(searchValue, 'i')
    let selectedRows = document.querySelectorAll("#userTable1 tr:not(.tableHeading)")
    
    $.each(selectedRows , (index , value)=>{

        let regex = new RegExp(searchValue , 'gi')
        let test = regex.test((value.children[1].innerText))
        if(test == false){
            console.log("false")
            $(value).hide("fast")
        }else{
            let spa = document.createElement("span")
            spa.innerText = ""
            spa.innerText = searchValue
           let d =  value.children[1].innerText.replace(regex , `<b class="bold">${spa.innerText}</b>`)
           value.children[1].innerHTML = d
            $(value).show("fast")
        }        
    })

}

const logOutUSer = ()=>{
    let c = checkCookie("key") 
    document.cookie = `key = ${c.val} ; max-age = 0`
    window.localStorage.removeItem("currentUser")
    window.location = "login.php"
}
