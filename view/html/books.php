<?php
require "E:/xampp/htdocs/project1/controller/books.php";
$books = new books();
$allBooks = $books->books();
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
          <li class="nav-item active">
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
      <?php
        if (!empty($allBooks)) {
          foreach($allBooks as $value) {
            //var_dump($value);
            echo '<div class="card mb-3 col-12 pt-2">
                    <div class="row no-gutters">
                      <div class="col-md-2" >
                        <img style="max-height: 266px;max-width:190px;" src="' . $value['book_img'] . '" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body d-flex flex-column" style="height: 100%; padding-top: 0;">
                          <h5 class="card-title h3">' . $value['book_name'] . '</h5>
                          <p class="card-text">' . $value['book_description'] . '</p>
                          <p class="card-text h5">PRICE: <span style="color:red;">CDN$ '. $value['book_price'] .'</span></p>
                          <p class="card-text">'. $value['book_quality'] .' <span style="color:green;">In Stock</span></p>
                          <input type="number" class="form-control mb-1" value="1" id="quantity'. $value['book_id'] .'">
                          <button class="btn btn-success mt-auto add-cart" bookid="' . $value['book_id'] . '">Add to Cart</button>
                        </div>
                      </div>
                    </div>
                  </div>';
          }
          
        }
      ?>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    (() => {
      let allBtn = document.querySelectorAll(".add-cart");
      
      allBtn.forEach((v) => {
        v.onclick = () => {
          let bookId = v.getAttribute("bookid");
          let quantity = document.querySelector("#quantity" + bookId).value;
          fetch('http://localhost/project1/controller/geturl.php/books/checkoutSession?book_id=' + bookId + "&quanlity=" + quantity)
            .then((res) => {return res.json();})
            .then((result) => {
              if (result.code == 200) {
                alert("success");
              }
            });
        };
      });
    })();
  </script>

</html>