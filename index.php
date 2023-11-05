<!DOCTYPE html>
<html>
  <head>
    <title>Online Store</title>
    <link rel="stylesheet" href="index.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <div id="header">
      <ul class="nav justify-content-center">
        <li class="nav-item">
          <button onclick="toHomePage()" class="btn btn-outline-success">Home</button>
        </li>
        <li class="nav-item">
            <button onclick="toProductsPage()" class="btn btn-outline-success">Products</button>
        </li>
        <li class="nav-item">
            <button onclick="toLoginPage()" class="btn btn-outline-success">Login</button>
        </li>
        <li class="nav-item">
            <button onclick="toSignupPage()" class="btn btn-outline-success">Sign Up</button>
        </li>
      </ul>
    </div>

    <div id="content-wrapper">
      <p id="content-text"></p>
    </div>

    <script>
      function toHomePage() {
          document.location.href = "index.php?page=home";
      }

      function toProductsPage() {
          document.location.href = "index.php?page=products";
      }

      function toLoginPage() {
          document.location.href = "index.php?page=login";
      }

      function toSignupPage() {
          document.location.href = "index.php?page=signup";
      }
    </script>
  </body>
</html>

<?php
    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] 
                                === 'on' ? "https" : "http") . 
                                "://" . $_SERVER['HTTP_HOST'] . 
                                $_SERVER['REQUEST_URI'];
    // echo $link;

    $url_components = parse_url($link);
    if (isset($url_components['query'])){ // isset check if url component query is there or not
        parse_str($url_components['query'], $params);

        if ($params['page'] == "products"){
            require "products.php";
        }
        else if ($params['page'] == "login"){
            require "login.php";
        }
        else if ($params['page'] == "signup"){
            require "signup.php";
        }
        else {
            require "home.php";
        }
    }
    else {
        require "home.php";
    }
    
?>