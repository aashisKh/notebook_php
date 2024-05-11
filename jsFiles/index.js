
const userPostSection = document.getElementById("userPostSection")
const showMessage = document.getElementById("showMessage")
const showSuccessMessage = document.getElementById("showSuccessMessage")
const addNewPost = document.getElementById("addNewPost")
let newPostSection = document.getElementById("newPostSection")
let cancelButton = document.getElementById("cancelButton")
const postUserData = document.getElementById("postUserData")

let postTitle = document.getElementById("postTitle")
const postBody = document.getElementById("postBody")

let count = 0

let postID
let toBeUpdatedPostTitle
let toBeUpdatedPostBody
$(document).ready(() => {
    $.post("fetchUserPost.php",
        { User: window.localStorage.getItem("currentUser") },
        function (data, status) {
            // console.log(data)
            let response = JSON.parse(data)
            createPostBox(response)
        })

})

const handleEvent = (e) => {
    e.preventDefault()
    if (e.target.innerText === "Delete") {
        $.post("deleteUserPost.php", {
            ID: e.target.parentElement.parentElement.id
        },
            function (data, status) {
                if (data === "true") {
                    // console.log(data)
                    e.target.parentElement.parentElement.remove()
                    if (userPostSection.children.length == 0) {
                        showMessage.style.visibility = "visible"
                    }
                }
            })
        //    e.target.parentElement.parentElement.remove()
        // console.log(e.target.parentElement.parentElement.id)

    }

    if (e.target.innerText === "Edit") {
        newPostSection.style.visibility = "visible"
        postUserData.value = "Update"
        let title = (e.target.parentElement.parentElement.children[0].innerText)
        let body = (e.target.parentElement.parentElement.children[1].innerText)
        postTitle.value = title
        postBody.value = body
        postID = (e.target.parentElement.parentElement.id)
        toBeUpdatedPostTitle = (e.target.parentElement.parentElement.children[0])
        toBeUpdatedPostBody = (e.target.parentElement.parentElement.children[1])
    }


}

addNewPost.onclick = (e) => {

    newPostSection.style.visibility = "visible"
    postUserData.value = "Post"
    postTitle.value = ''
    postBody.value = ''


}

postUserData.onclick = (e) => {
    e.preventDefault()
    if (e.target.value === "Post") {
        $.post("createUserPost.php",
            {
                User: window.localStorage.getItem("currentUser"),
                Title: postTitle.value,
                Body: postBody.value
            },
            function (data, success) {
                console.log(data)
                let response = JSON.parse(data)

                createPostBox(response)
            }
        )
    }


    if (e.target.value === "Update") {
        $.post("updateUserPost.php",
            {
                Id: postID,
                Title: postTitle.value,
                Body: postBody.value
            },
            function (data, success) {
                console.log(data)
                let response = JSON.parse(data)
                console.log(response)
                let [{ Title, Post }] = response

                toBeUpdatedPostTitle.innerText = Title
                toBeUpdatedPostBody.innerText = Post
                // createPostBox(response)
                showSuccessMessage.innerText = "Post Updated"
            }
        )
    }

    newPostSection.style.visibility = "hidden"

    showSuccessMessage.style.visibility = "visible"

    setTimeout(() => {
        showSuccessMessage.style.visibility = "hidden"
    }, 1000);
}

const createPostBox = (response) => {
    response.forEach((value, index, array) => {
        const { ID, Title, Post } = value

        const postOuter = document.createElement("div")
        postOuter.setAttribute("class", "postOuter")
        postOuter.setAttribute("id", ID)

        const title = document.createElement("p")
        title.setAttribute("class", "title")
        title.innerText = Title

        const body = document.createElement("p")
        body.setAttribute("class", "body")
        body.innerText = Post

        const actionButtonSection = document.createElement("div")
        actionButtonSection.setAttribute("class", "actionButtonSection")

        const edit = document.createElement("button")
        edit.setAttribute("class", "btn edit")
        edit.innerText = "Edit"
        edit.addEventListener("click", handleEvent)

        const del = document.createElement("button")
        del.setAttribute("class", "btn delete")
        del.innerText = "Delete"
        del.addEventListener("click", handleEvent)

        actionButtonSection.appendChild(edit)
        actionButtonSection.appendChild(del)
        postOuter.appendChild(title)
        postOuter.appendChild(body)
        postOuter.appendChild(actionButtonSection)
        userPostSection.appendChild(postOuter)
        // count = (userPostSection.children.length)
        // if (userPostSection.children.length == 0) {
        //     showMessage.style.visibility = "visible"
        // }
    })
    if (userPostSection.children.length == 0) {
        showMessage.style.visibility = "visible"
    } else {
        showMessage.style.visibility = "hidden"
    }
    showSuccessMessage.innerText = "Post is created"
}

cancelButton.onclick = (e) => {
    e.preventDefault()
    newPostSection.style.visibility = "hidden"
}

document.addEventListener('visibilitychange', function () {
    if (!document.hidden) {
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
                console.log(data)
                if (data == "false") {
                    // document.cookie = `key = ${c.val} ; max-age = 0`
                    // window.localStorage.removeItem("currentUser")
                    // window.location = "login.php"
                    logOutUSer()
                }
            })

        // if(Object.keys(c).length != 2){
        //     console.log("no key found")
        //     document.cookie = `key = ${c.val} ; max-age = 0`
        //     window.localStorage.removeItem("currentUser")
        //     window.location = "login.php"
        // }else{
        //     console.log("fond")
        // }
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


document.body.onload = () => {
    // alert("rr")
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
                window.location = "login.php"
                logOutUSer()
            }
        })
}



const logOutUSer = ()=>{
    let c = checkCookie("key") 
    document.cookie = `key = ${c.val} ; max-age = 0`
    window.localStorage.removeItem("currentUser")
    window.location = "login.php"
}


