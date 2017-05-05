<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="Las Positas College (LPC)" />
<meta name="keywords" content="Classes Not Meeting Today, Las Positas College, Las Positas, LPC" />
<?php
include_once("../php/conn.php");

session_start();
$count = null;

if (isset($_SESSION['userSession']) != "") {
  header("Location: add.php");
  exit;
}

if (isset($_POST['btn-login'])) {

  $usr_login = strip_tags($_POST['usr_login']);
  $usr_password = strip_tags($_POST['usr_password']);

  $usr_login = mysqli_real_escape_string($conn, $usr_login);
  $usr_password = mysqli_real_escape_string($conn, $usr_password);

  $query = "SELECT * FROM absence_users WHERE usr_name ='" . $usr_login . "'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);

  $count = mysqli_num_rows($result);

  echo "<!-- <p>" . $row['usr_password']. "</p> -->";
  echo "<!-- <p>" . $usr_password . "</p> -->";
  echo "<!-- <p>" . $count . "</p> -->";

  if (password_verify($usr_password, $row['usr_password']) && $count == 1) {
    $_SESSION['userSession'] = $row['id'];
    $_SESSION['user'] = $row['name'];
    header("Location: add.php");
  } else {
    $msg = "<div class=\"alert alert-danger\"><span class=\"glyphicon glyphicon-info-sign\"></span> &nbsp; Invalid Username or Password !</div>";
  }
  mysqli_close($conn);
}

define('root', $_SERVER['DOCUMENT_ROOT'] . '/');
define('blogcategory', ' ');
?>
<title>Classes Not Meeting Today</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

<link href="/files/css/home/base.css" rel="stylesheet" type="text/css" />
<link href="/files/css/home/lpc-bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/page.css" type="text/css" />
<link rel="stylesheet" href="/files/css/navigation/left.css" type="text/css" />

<style type="text/css">
  #page-body {
    min-height: 30em;
  }

  .login-form {
    margin: 3.0em auto;
    width: 20.0em;
    border: 2px solid #850511;
    padding: 1.75em;
    border-radius: 0.65em;
  }
</style>

<link href='https://fonts.googleapis.com/css?family=Oswald:400,700|Open+Sans:400,400italic,700italic' rel='stylesheet' type='text/css'>

</head>

<body>

<?php include_once(root . "files/php/ga/googletags.php"); ?>

<!-- HEADER -->

<?php include_once(root . "files/includes/homepage/header.inc"); ?>

<!-- end of HEADER -->

<div class="container">

    <div class="row">
      <!-- Top Navigation -->
      <?php include_once(root . "files/includes/navigation/top.inc"); ?>
      <!-- End Top Navigation -->
    </div>

    <div class="row">



      <div id="page-body" class="col-md-12 section-content">

        <span id="content-area" class="sr-only sr-only-focusable"></span>

        <div class="row">

          <div class="col-sm-12 col-md-12 col-lg-12">
            <?php
              if(isset($msg)){
                echo $msg;
              }
            ?>

            <div class="login-form">

              <form action="login.php" method="post">
            		<div class="form-group">
                		<label for="usr_login">Username:</label>
                		<input type="text" class="form-control" id="usr_login" name="usr_login" maxlength="30" value="">
              	</div>

            		<div class="form-group">
                		<label for="usr_password">Password</label>
                		<input type="password" class="form-control" id="usr_password" name="usr_password" placeholder="Password" maxlength="30" value="">
              	</div>

                <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary" name="btn-login" id="btn-login">Log in</button>
                </div>
  		        </form>

            </div>

          </div>

        </div>
        <!--  End Row -->
      </div>
      <!--  End #content-area -->

    </div>

</div>


</div>

<!-- Start Footer -->

<?php include_once (root . "files/includes/homepage/footer.inc"); ?>

<!-- End Footer-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<script type='text/javascript'>
$(document).ready(function() {

  var linkURL = document.location.pathname.match(/[^\/]+$/);

  if(linkURL === null) {
    $("a[href='index.php']").addClass("active");
  } else {
    $("a[href='"+linkURL+"']").addClass("active");
  }
});
</script>

<?php include_once(root . "files/includes/js/js.inc"); ?>

</body>
</html>
