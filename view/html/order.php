<?php
require $_SERVER['DOCUMENT_ROOT'] . "/project1/controller/orders.php";
session_start();
if (empty($_SESSION["email"])) {
    echo "<script>window.location.href='jump.php'</script>";
}
$orders = new orders();
$ordersData = $orders->getOrdersFromSession();
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
                        <a class="nav-link" href="books.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="checkout.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="order.php">Order <span class="sr-only">(current)</span></a>
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
            <h1>Your Order</h1>
            <?php 
                if (!empty($ordersData)) {
                    foreach($ordersData as $value) {
                        echo '<div class="card col-12 mb-2">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="d-flex flex-column mr-3">
                                            <h5 class="card-title">Order Place</h5>
                                            <p class="card-text">'. $value['public_time'] .'</p>
                                        </div>
                                        <div class="d-flex flex-column mr-3">
                                            <h5 class="card-title">Total</h5>
                                            <p class="card-text">CDN$ '. $value['total_price'] .'</p>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h5 class="card-title">Ship To</h5>
                                            <p class="card-text">'. $value['first_name'] .' '. $value['last_name'] .' / '. $value['address'] .'</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row order-detail">
                                        
                                    </div>
                                    <a href="#" class="btn btn-primary detailbtn" orderid="'. $value['order_id'] .'" reqed="no" open="false">Detail</a>
                                </div>
                            </div>';
                    }
                    
                }
            ?>
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
        let detailBtn = document.querySelectorAll(".detailbtn");
        (() => {
            detailOpen();
        })();

        function detailOpen() {
            
            detailBtn.forEach((e, k) => {
                e.onclick = () => {
                    let displayDiv = e.previousElementSibling;
                    if (e.getAttribute("open") == "false") {
                        
                        if (e.getAttribute('reqed') == 'no') {
                            let orderId = e.getAttribute('orderid')
                            
                            fetch("http://<?php echo $_SERVER['SERVER_NAME']; ?>/project1/controller/geturl.php/orders/getOrderBooks?orderId=" + orderId)
                            .then((res) => {return res.json();})
                            .then((result) => {
                                if (result.code == 200) {
                                    
                                    if (result.detail != null) {
                                        childHtml = '';
                                        result.detail.forEach((v) => {
                                            childHtml += `<div class="col-12 mb-2">
                                                            <div class="row">
                                                                <div class="col-2" >
                                                                    <img style="max-height: 10em; max-width: 10em;" src="${v.book_img}" alt="...">
                                                                </div>
                                                                <div class="col-10">
                                                                    <p class="card-text">price: CDN$ ${v.book_price}</p>
                                                                    <p class="card-text">Quantity: ${v.quanlity}</p>
                                                                    <p class="card-text">items price: CDN$ ${v.itemsPrice}</p>
                                                                </div>
                                                            </div>
                                                        </div>`;
                                        
                                        });
                                       
                                        displayDiv.innerHTML = childHtml;
    
                                    }
                                    e.setAttribute('reqed', 'yes');
                                } else {
                                    alertMsg(false, result.message);
                                }
                            })
                        }
                        displayDiv.style.display = "block";
                        e.setAttribute("open", "true");
                        e.innerHTML = "Hidden";
                    } else {
                        displayDiv.style.display = "none";
                        e.setAttribute("open", "false");
                        e.innerHTML = "Detail";
                    } 
                };
            });
        }
    </script>
</html>