(() => {
    logOut();
})();
function logOut() {
    let logout = document.querySelector("#logout");
    if (logout != null) {
        logout.onclick = () => {
            fetch("http://localhost/project1/controller/geturl.php/users/logout")
                .then((res) => { return res.json(); })
                .then((result) => {
                    
                    if (result.code == 200) {
                        
                        window.location.href = 'books.php';
                    }
                });
        };
    }
    
}

function alertMsg(change, message) {
    let alertMsg = document.querySelector("#alertMsg");
    alertMsg.innerHTML = message;
    if (change == true) {
        alertMsg.classList.remove('alert-danger');
        alertMsg.classList.add('alert-success');
    } else {
        alertMsg.classList.remove('alert-success');
        alertMsg.classList.add('alert-danger');
    }
    
    alertMsg.style.display = 'block';
    setTimeout(() => {
        alertMsg.style.display = 'none';
    }, 1000);
}