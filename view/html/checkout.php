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
                    <li class="nav-item active">
                        <a class="nav-link" href="checkout.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order.php">Order</a>
                    </li>
                </ul>
                <div class="col-6 d-flex justify-content-end align-items-center">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0 mr-sm-2">Search</button>
                    <button class="btn btn-primary" style="min-width: 100px;" href="login.php">Sign in</button>
                    <!-- <button class="btn btn-outline-secondary" style="min-width: 100px;" href="#">Sign up</button> -->
                </div>
            </div>
        </div>

    </nav>

    <main role="main" class="container">
        <div class="row">
            <div class="col-8">
                <div class="card mb-3 col-12 pt-2">
                    <div class="row no-gutters">
                        <div class="col-md-2" style="min-height: 18em;min-width: 200px;">
                            <img src="../images/download.jpg" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body d-flex flex-column" style="height: 100%; padding-top: 0;">
                                <h5 class="card-title h3">Card title</h5>

                                <p class="card-text"><span style="color:green;">Quantity:</span></p>
                                <input type="number" class="form-control" value="1">
                                <p class="card-text">Total Price: <span style="color: red;font-size: 1.5em;">$CDN
                                        34</span></p>
                                <button class="btn btn-warning mt-auto">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3 col-12 pt-2">
                    <div class="row no-gutters">
                        <div class="col-md-2" style="min-height: 18em;min-width: 200px;">
                            <img src="../images/download.jpg" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body d-flex flex-column" style="height: 100%; padding-top: 0;">
                                <h5 class="card-title h3">Card title</h5>

                                <p class="card-text"><span style="color:green;">Quantity:</span></p>
                                <input type="number" class="form-control" value="1">
                                <p class="card-text">Total Price: <span style="color: red;font-size: 1.5em;">$CDN
                                        34</span></p>
                                <button class="btn btn-warning mt-auto">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3 col-12 pt-2">
                    <div class="row no-gutters">
                        <div class="col-md-2" style="min-height: 18em;min-width: 200px;">
                            <img src="../images/download.jpg" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body d-flex flex-column" style="height: 100%; padding-top: 0;">
                                <h5 class="card-title h3">Card title</h5>

                                <p class="card-text"><span style="color:green;">Quantity:</span></p>
                                <input type="number" class="form-control" value="1">
                                <p class="card-text">Total Price: <span style="color: red;font-size: 1.5em;">$CDN
                                        34</span></p>
                                <button class="btn btn-warning mt-auto">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header h3">
                        CheckOut
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Summary</h5>
                        <p class="card-text">Total before tax: <span>$CDN 131.00</span></p>
                        <p class="card-text">Tax: <span>$CDN 13.00</span></p>
                        <p class="card-text">Order Total: <span>$CDN 131.00</span></p>
                        <hr>
                        <h5 class="card-title">Contacter</h5>
                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input type="text" aria="" class="form-control" id="fname">

                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" aria="" class="form-control" id="lname">

                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" aria="" class="form-control" id="address">

                        </div>
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="text" class="form-control" id="email">
                        </div>

                        <hr>
                        <h5 class="card-title">Payment</h5>
                        <div id="paymentRadio">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="payment" id="paypalRadio"
                                    value="paypal" checked>
                                <label class="form-check-label" for="paypalRadio">Paypal</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="payment" id="creditRadio"
                                    value="credit">
                                <label class="form-check-label" for="creditRadio">Credit card</label>
                            </div>
                        </div>
                        <div id="creditBox">
                            <div class="form-group">
                                <label for="credit">Credit Card:</label>
                                <input type="text" aria="" class="form-control" id="credit">
    
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="expir">Expir Time:</label>
                                    <input type="text" class="form-control" placeholder="05/23" id="expir">
                                </div>
                                <div class="form-group col-6">
                                    <label for="cvv">CVV:</label>
                                    <input type="text" class="form-control" placeholder="250" id="cvv">
                                </div>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let he;
        (function showCredit(){
            let radio = document.querySelector("#paymentRadio");
            radio.onclick = () => {
                let credit = document.querySelector("#creditRadio");
                let box = document.querySelector("#creditBox");
                if (credit.checked) {
                    box.style.display = 'block';
                } else {
                    box.style.display = 'none'; 
                }
            };
        })();
    </script>

</html>