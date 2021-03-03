<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BookStore-Home</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>

    </style>
    <!-- Custom styles for this template -->
    <link href="../css/index.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">ECHOAIYAYA BOOKSHOP</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="books.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="checkout.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order.php">Order</a>
                    </li>
                </ul>
                <div class="col-6 d-flex justify-content-end align-items-center">
                    
                    <a class="btn btn-primary mr-2" style="min-width: 100px;" href="login.php">Sign in</a>
                    <a class="btn btn-primary" style="min-width: 100px;" href="register.php">Register</a>
                    <!-- <button class="btn btn-outline-secondary" style="min-width: 100px;" href="#">Sign up</button> -->
                </div>
            </div>
        </div>

    </nav>

    <main role="main" class="container">
        <div class="row w-50 m-auto">

            <div class="form-group col-12">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email">
            </div>
            <div class="form-group col-12">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password">
            </div>
            <div class="form-group col-12">
                <p id="msg"></p>
            </div>
            <div class="form-group col-12">
                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
            </div>
            
        
        </div>
    </main>
    <div class="fixed-top w-50 m-auto alert alert-danger text-center" id="alertMsg" style="top:50px;display:none;" role="alert">
      
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
    <script>
        let alertMsg = document.querySelector("#alertMsg");
        let email = document.querySelector("#email");
        let password = document.querySelector("#password");
        let submitBtn = document.querySelector("#submit");
        let msg = document.querySelector("#msg");
        (() => {
            login();
        })();

        function login() {  
            
            submitBtn.onclick = () => {
                let formData = new FormData();
                formData.append('email', email.value);
                formData.append('password', password.value);

                fetch('http://<?php echo $_SERVER['SERVER_NAME'];?>/project1/controller/geturl.php/users/login', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .catch(error => console.error('Error:', error))
                .then(response => {
                    msg.innerHTML = '';
                    if (response.code == 400) {
                        let msgHtml = '';
                        if (response.detail != null) {
                            response.detail.forEach((v) => {
                        
                                msgHtml += v + ' is error<br>';
                            });
                            console.log(msgHtml);
                            msg.style.color = 'red';
                            msg.innerHTML = msgHtml;
                        } else {
                            alertMsg.innerHTML = response.message;
                            alertMsg.style.display = 'block';
                            setTimeout(() => {
                                alertMsg.style.display = 'none';
                            }, 1000);
                        }
                        
                        
                    } else if (response.code == 200) {
                        msg.style.color = 'green';
                        msg.innerHTML = response.message + '<br>you will jump to home page in 5 seconds.';
                        setTimeout(() => {
                            window.location.href = "books.php";
                        }, 5000);
                    }
                });
            };  
            
        }
    </script>
</html>