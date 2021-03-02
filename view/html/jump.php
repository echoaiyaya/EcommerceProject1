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

            <h1>Please Sign in first! <br>You will jump back to home page in 3 seconds!</h1>


        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
    <script>
        setTimeout(() => {
            window.location.href="books.php";
        }, 3000);
        
    </script>
</html>