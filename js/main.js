var img = document.querySelector('img');

function saveUserData() {
    let link = window.location.href;
    let url = "ajax.php";
    let xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send();
    xhr.onload = function () {
        console.log(xhr);
        if(xhr.status === 200) {
            console.log("Post successfully created!");
        }
    }
}

if (img.complete) {
    saveUserData();
} else {
    img.addEventListener('load', saveUserData);
    img.addEventListener('error', function() {
        alert('error')
    })
}