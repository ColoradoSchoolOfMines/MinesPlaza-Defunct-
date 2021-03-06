<?php 
    include '../includes/login_func.php';
    $add = $_SERVER['REQUEST_URI'];
    $add = split('/', $add)[count($add)];
    $add = split("\?", $add)[0];
    defineUser();
?>
<!--DOCTYPE HTML-->
<html>
<head>
    <script src="jquery/jquery-1.11.2.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/navbar.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>

    <!-- Colleaeonstiasuetnct the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="<?php if($add == "home.php") echo ' active' ?> clickable"><a href="home.php">Home</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Browse <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a style="text-align:center;" href="buy-browse.php">Buyers</a></li>
            <li class="divider"></li>
            <li><a style="text-align:center;" href="#">Sellers</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <?php
            if(loggedIn(-1)){
                echo '
                    <p class="navbar-text" style="cursor:default">'.$GLOBALS['USERNAME'].'</p>
                    <li><a href="logout.php">Logout</a></li>
                ';
            }
            else{
                echo '
                    <li class="';
                if($add == "login.php") echo ' active';
                echo ' clickable"><a href="login.php">Login</a></li>
                    <li class="';
                if($add == "register.php") echo ' active';
                echo ' clickable"><a href="register.php">Register</a></li>  
                ';
            }
        ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php
if(isset($_REQUEST['msg'])){
    $msg = $_REQUEST['msg'];
    $msg = str_replace("||", "<br>", $msg);
    echo '
    <div id="alert" class="alert alert-warning alert-dismissible" role="alert" 
    style="width:80%;min-width:600px;margin:auto;text-align:center;border:1px solid #faebcc;
    -moz-box-shadow: 0 1px 3px -1px #1c1c1c;-webkit-box-shadow: 0 1px 3px -1px #1c1c1c;
    box-shadow: 0 1px 3px -1px #1c1c1c;margin-bottom:5px;" aria-label="Close" onclick="jQuery(\'#alert\').fadeOut();">
            '.$msg.'
    </div>
    ';
}
?>
</body>
</html>