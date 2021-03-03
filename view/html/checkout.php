<?php
session_start();
if (empty($_SESSION["email"])) {
    echo "<script>window.location.href='jump.php'</script>";
}
require $_SERVER['DOCUMENT_ROOT'] . "/project1/controller/books.php";
$books = new books();
$carts = $books->getBookFromSession();
$totalNoTax = 0;
//var_dump($_SESSION['checkout']);
?>
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
                    <span style='color:#fff;margin-right:2em;'>Hi, <?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></span>;
                    <a class="btn btn-primary" style="min-width: 100px;" id="logout">Log Out</a>';
                    <!-- <button class="btn btn-outline-secondary" style="min-width: 100px;" href="#">Sign up</button> -->
                </div>
            </div>
        </div>

    </nav>

    <main role="main" class="container">
        <div class="row">
            <div class="col-8">
                <?php 
                    if (!empty($carts)) {
                        foreach ($carts as $key => $value) {
                            $totalNoTax += $value['book_price'] * $value['quantity'];
                            echo '<div class="card mb-3 col-12 pt-2">
                                        <div class="row no-gutters">
                                            <div class="col-md-2" style="min-height: 18em;min-width: 200px;">
                                                <img style="max-height: 266px;max-width:190px;" src="' . $value['book_img'] . '" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body d-flex flex-column" style="height: 100%; padding-top: 0;">
                                                    <h5 class="card-title h3">'. $value['book_name'] .'</h5>
                    
                                                    <p class="card-text"><span style="color:green;">Quantity: '. $value['quantity'] .'</span></p>
                                                    
                                                    <p class="card-text">Total Price: <span style="color: red;font-size: 1.5em;">$CDN
                                                            ' . ($value['book_price'] * $value['quantity']) . '</span></p>
                                                    <button class="btn-remove btn btn-warning mt-auto" number="'. $value['quantity'] .'" bookid="'. $value['book_id'] .'">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                        }
                        
                    }
                ?>
                
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header h3">
                        CheckOut
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Summary</h5>
                        <p class="card-text">Total before tax: $CDN <span id="price"><?php echo round($totalNoTax, 2); ?></span></p>
                        <p class="card-text">Tax: $CDN <span id="tax"><?php echo round($totalNoTax * 0.13, 2); ?></span></p>
                        <p class="card-text">Order Total: $CDN <span id="total"><?php echo round($totalNoTax, 2) + round($totalNoTax * 0.13, 2); ?></span></p>
                        <hr>
                        <h5 class="card-title">Contacter</h5>
                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input type="text" aria="" class="form-control" id="fname" value="<?php echo $_SESSION['fname']; ?>">

                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" aria="" class="form-control" id="lname" value="<?php echo $_SESSION['lname']; ?>">

                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" aria="" class="form-control" id="address" value="<?php echo $_SESSION['address']; ?>">

                        </div>
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="email" class="form-control" id="email" value="<?php echo $_SESSION["email"]; ?>">
                        </div>
                        <button id="clear-contactor" class="btn btn-primary mt-2">Clear</button>
                        <hr>
                        <h5 class="card-title">Payment</h5>
                        <div id="paymentRadio">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input radio" type="radio" name="payment" id="paypalRadio"
                                    value="paypal" checked>
                                <label class="form-check-label" for="paypalRadio">Paypal</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input radio" type="radio" name="payment" id="creditRadio"
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
                        <button type="submit" id="submit-order" class="btn btn-primary mt-2">Submit</button>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <div class="fixed-top w-50 m-auto alert alert-danger text-center" id="alertMsg" style="top:50px;display:none;" role="alert">
      
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
    <script src="../js/index.js"></script>
    <script>
        let fname = document.querySelector("#fname");
        let lname = document.querySelector("#lname");
        let address = document.querySelector("#address");
        let email = document.querySelector("#email");
        let price = document.querySelector("#price");
        let tax = document.querySelector("#tax");
        let total = document.querySelector("#total");
        let radio = document.querySelector("#paymentRadio");
        let credit = document.querySelector("#creditRadio");
        let radioBtns = document.querySelectorAll(".radio");
        let box = document.querySelector("#creditBox");
        let removeBtns = document.querySelectorAll(".btn-remove");
        let submitBtn = document.querySelector("#submit-order");
        let creditV = document.querySelector("#credit");
        let expirV = document.querySelector("#expir");
        let cvvV = document.querySelector("#cvv");
        //let alertMsg = document.querySelector("#alertMsg");

        (() => {
            showCredit();
            clearContactor();
            removeBook();
            submitOrder();
        })();

        function submitOrder() {
            submitBtn.onclick = (() => {
                let booksData = new Array();
                if (removeBtns == null) {
                    return;
                } else {
                    removeBtns.forEach((v) => {
                        let book = {'bookid': Number(v.getAttribute('bookid')), 'quantity': Number(v.getAttribute('number'))};
                        booksData.push(book);
                    });
                    
                }
                let radioBtn = '';
                radioBtns.forEach((v) => {
                    if(v.checked)  radioBtn = v.value;
                })
                let formData = new FormData();
                formData.append("fname", fname.value);
                formData.append("lname", lname.value);
                formData.append("address", address.value);
                formData.append("email", email.value);
                formData.append("payMethod", radioBtn);
                formData.append("price", Number(price.innerText));
                formData.append("tax", Number(tax.innerText));
                formData.append("totalPrice", Number(total.innerText));
                formData.append("books", JSON.stringify(booksData));
                if (radioBtn == 'credit') {
                    formData.append("credit", creditV.value);
                    formData.append("expir", expirV.value);
                    formData.append("cvv", cvvV.value);
                }
                fetch("http://<?php echo $_SERVER['SERVER_NAME']; ?>/project1/controller/geturl.php/orders/comfirmOrders", {
                    method: "POST", 
                    body: formData
                })
                .then((res) => {return res.json();})
                .then((result) => {
                    if (result.code == 200) {
                        alertMsg(true, "submit completely, you will jummp to order page in 3 seconds.");
                        setTimeout(() => {
                            window.location.href='order.php';
                        }, 3000);
                    } else {
                        alertMsg(false, result.message);
                    }
                });
            });
        }

        function showCredit(){
            
            radio.onclick = () => {
                
                if (credit.checked) {
                    box.style.display = 'block';
                } else {
                    box.style.display = 'none'; 
                }
            };
        }

        function clearContactor() {
            let clearBtn = document.querySelector("#clear-contactor");
            clearBtn.onclick = (() => {
                fname.setAttribute('value', '');
                lname.setAttribute('value', '');
                email.setAttribute('value', '');
                address.setAttribute('value', '');
            });
            
        }

        function removeBook() {
            
            if (removeBtns != null) {
                removeBtns.forEach((e) => {
                    e.onclick = () => {
                        let bookid = e.getAttribute('bookid');
                        fetch("http://<?php echo $_SERVER['SERVER_NAME']; ?>/project1/controller/geturl.php/books/removeCheckOutBook?bookid=" + bookid)
                        .then((res) => {return res.json();})
                        .then((result) => {
                            if (result.code == 200) {
                                e.parentElement.parentElement.parentElement.parentElement.remove();
                                price.innerHTML = result.price.price;
                                tax.innerHTML = result.price.tax;
                                total.innerHTML = result.price.total;
                            }
                        });
                    }
                });
            }
        }
    </script>

</html>