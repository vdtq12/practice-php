<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Online Store</title>
  <link rel="stylesheet" href="index.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
  <div id="header position-relative">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
      <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left: 5vw;">
        <ul class="navbar-nav mr-auto">
          <?php if (!isset($_SESSION['login']['username'])) {
          ?>
            <li class="nav-item" role='button'>
              <a onclick="toLoginPage()" class="nav-link">Login</a>
            </li>
            <li class="nav-item" role='button'>
              <a onclick="toSignupPage()" class="nav-link">Sign Up</a>
            </li>
            <?php
          } else {
            if ($_SESSION['login']['role'] == 'admin') {
            ?>
              <li class="nav-item" role='button'>
                <a onclick="toDashboardPage()" class="nav-link">Dashboard</a>
              </li>
            <?php
            } else if ($_SESSION['login']['role'] == 'user') {
            ?>
              <li class="nav-item" role='button'>
                <a onclick="toHomePage()" class="nav-link">Home</a>
              </li>
            <?php
            }
            ?>
            <li class="nav-item" role='button'>
              <a onclick="toProductsPage()" class="nav-link">Products</a>
            </li>
            <li class="nav-item" role='button'>
              <a onclick="toLogoutPage()" class="nav-link">Logout</a>
            </li>
        </ul>
        <div class="position-absolute" style="right: 5vw;">
          <p class="text-center mb-0">Welcome, <?php echo $_SESSION['login']['username'] ?></p>
          <p class="text-center mb-0"><?php echo $_SESSION['login']['role'] ?></p>
        </div>
      <?php
          }
      ?>
      </div>
    </nav>
  </div>

  <div id="content-wrapper">
    <p id="content-text"></p>
  </div>

  <script src="js/loadDoc.js"></script>
  <script src="js/getProducts.js"></script>
  <script src="js/searchProducts.js"></script>
  <script src="js/selectCountry.js"></script>
  <script src="js/productPagination.js"></script>
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

    function toLogoutPage() {
      document.location.href = "index.php?page=logout";
    }

    function toDashboardPage() {
      document.location.href = "index.php?page=dashboard";
    }

    function toProductDetailPage(product_id) {
      document.location.href = "index.php?page=product_detail&product_id=" + product_id;
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
if (isset($url_components['query'])) { // isset check if url component query is there or not
  parse_str($url_components['query'], $params);

  if ($params['page'] == "products") {
    require "products.php";
  } else if ($params['page'] == "login") {
    require "login.php";
  } else if ($params['page'] == "signup") {
    require "signup.php";
  } else if ($params['page'] == "logout") {
    require "logout.php";
  } else if ($params['page'] == "dashboard") {
    require "admin_dashboard.php";
  } else if ($params['page'] == "home") {
    require "home.php";
  } else if ($params['page'] == "product_detail") {
    require "product_detail.php";
  }
} else {
  require "login.php";
}

?>