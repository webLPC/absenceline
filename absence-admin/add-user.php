<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="Las Positas College (LPC)" />
<meta name="keywords" content="" />
<?php
include_once("../php/conn.php");

session_start();

if (!isset($_SESSION['userSession'])) {
  header("Location: login.php");
}

if ($_SESSION['userSession'] != 1) {
  header("Location: add.php");
}

define('root', $_SERVER['DOCUMENT_ROOT'] . '/');
define('blogcategory', ' ');

if (isset($_POST['btn-adduser'])) {
  $usr_login = strip_tags($_POST['usr_login']);
  $usr_password = strip_tags($_POST['usr_password']);
  $confirm_password = strip_tags($_POST['confirm_password']);
  $name = strip_tags($_POST['name']);

  $usr_login = mysqli_real_escape_string($conn, $usr_login);
  $usr_password = mysqli_real_escape_string($conn, $usr_password);
  $confirm_password = mysqli_real_escape_string($conn, $confirm_password);
  $name = mysqli_real_escape_string($conn, $name);

  if ($usr_login != "") {
    if($usr_password == $confirm_password) {

      $usr_password = password_hash("$usr_password", PASSWORD_DEFAULT);

      $query = "INSERT INTO absence_users (usr_name, usr_password, name) VALUES ('" . $usr_login . "', '" . $usr_password . "', '" . $name . "')";
      // $result = mysqli_query($conn, $query);

      if (mysqli_query($conn, $query)) {
        $msg = "<div class=\"alert alert-success\"><span class=\"glyphicon glyphicon-info-sign\"></span> &nbsp; New record created successfully!</div>";
      } else {
        $msg = "<div class=\"alert alert-danger\"><span class=\"glyphicon glyphicon-info-sign\"></span> &nbsp; Error: " . $query . "<br />" . mysqli_error($conn) . "</div>";
      }

    } else {
      $msg = "<div class=\"alert alert-danger\"><span class=\"glyphicon glyphicon-info-sign\"></span> &nbsp; Passwords do not match !</div>";
    }
  } else {
    $msg = "<div class=\"alert alert-danger\"><span class=\"glyphicon glyphicon-info-sign\"></span> &nbsp; Please enter a user name.</div>";
  }

}
?>
<title>Absence Line</title>

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
    /*margin: 3.0em auto;*/
    width: 25.0em;
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
      <div class="col-md-3">
        <?php include_once ("left-nav.php"); ?>
      </div>

      <div id="page-body" class="col-md-9 section-content">

        <span id="content-area" class="sr-only sr-only-focusable"></span>

        <div class="row">

          <div class="col-sm-12 col-md-12 col-lg-12">
            <?php
              if(isset($msg)){
                echo $msg;
              }

              echo "<p>SESSION = <strong>" . $_SESSION['user'] . "</strong></p>";
            ?>

            <div class="login-form">
              <h1>Add User</h1>

              <form action="add-user.php" method="post">
            		<div class="form-group">
                		<label for="usr_login">Username:</label>
                		<input type="text" class="form-control" id="usr_login" name="usr_login" maxlength="30" value="">
              	</div>

                <div class="form-group">
                		<label for="name">Name:</label>
                		<input type="text" class="form-control" id="name" name="name" maxlength="100" value="">
              	</div>

            		<div class="form-group">
                		<label for="usr_password">Password</label>
                		<input type="password" class="form-control" id="usr_password" name="usr_password" placeholder="Password" maxlength="30" value="">
              	</div>

                <div class="form-group">
                		<label for="confirm_password">Confirm Password</label>
                		<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Password" maxlength="30" value="">
              	</div>

                <div class="form-group text-center">
                  <button type="submit" class="btn btn-success" name="btn-adduser" id="btn-adduser">Add User</button>
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
