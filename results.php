<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="Las Positas College (LPC)" />
<meta name="keywords" content="Las Positas College, Las Positas, LPC" />
<?php
include_once("php/conn.php");

define('root', $_SERVER['DOCUMENT_ROOT'] . '/');
define('blogcategory', ' ');
?>
<title>Faculty &amp; Staff Directory</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

<link href="/files/css/home/base.css" rel="stylesheet" type="text/css" />
<link href="/files/css/home/lpc-bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/page.css" type="text/css" />
<link rel="stylesheet" href="/files/css/navigation/left.css" type="text/css" />

<style type="text/css">

.page-nav {
  width: 100%;
  text-align: center;
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

    <!-- <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 dept-banner">
        <img src="images/" alt="" class="img-responsive" />
      </div>
    </div> -->

    <div class="row">
      <div class="col-md-3">
        <?php include_once ("left-nav.php"); ?>
      </div>

      <div class="col-md-9 section-content">

        <span id="content-area" class="sr-only sr-only-focusable"></span>

        <h1>Faculty, Staff &amp; Administration Directory</h1>

        <div class="row">

          <div class="col-sm-12 col-md-12 col-lg-12">
            <h2>Search Results</h2>

            <p>For more information, click on the employee's name.</p>

            <?php
              if(!$conn) { // creation of the connection object failed
                die("connection object not created: ".mysqli_error($conn));
              }

              if (mysqli_connect_errno()) { // creation of the connection object has some other error
                die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
              }

              $first_var = isset($_POST['firstName']) ? $_POST['firstName'] : "";
              $last_var = isset($_POST['lastName']) ? $_POST['lastName'] : "";
              $title_var = isset($_POST['title']) ? $_POST['title'] : "";
              $class_var = isset($_POST['classification']) ? $_POST['classification'] : "";

              if (!empty($_POST['firstName'])) {
                $first_var = mysqli_real_escape_string($conn, $first_var);
                $select_results = "SELECT * FROM directorymain WHERE firstName LIKE '%" . $first_var . "%' ORDER BY firstName, lastName";
              }

              if (!empty($_POST['lastName'])) {
                $last_var = mysqli_real_escape_string($conn, $last_var);
                $select_results = "SELECT * FROM directorymain WHERE lastName LIKE '%" . $last_var . "%' ORDER BY lastName, firstName";
              }

              if (!empty($_POST['title'])) {
                $title_var = mysqli_real_escape_string($conn, $title_var);
                $select_results = "SELECT * FROM directorymain WHERE title LIKE '%" . $title_var . "%' ORDER BY lastName, firstName";
              }

              if (!empty($_POST['classification'])) {
                $class_var = mysqli_real_escape_string($conn, $class_var);
                $select_results = "SELECT * FROM directorymain WHERE classification='" . $class_var . "'ORDER BY lastName, firstName";
              }

              $result = mysqli_query($conn, $select_results);

              ?>

              <table class="table table-striped" summary="List of Faculty, Staff and Adminstration">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Title</th>
                    <th scope="col">Classification</th>
                    <th scope="col">Phone</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  while($row = mysqli_fetch_array($result)) {
                     echo "<tr>";
                     if (!empty($first_var)) {
                       echo "<td><a href=\"profile.php?empid=". $row['id'] ."\">" . $row["firstName"] . ", " . $row["lastName"] . "</a></td>";
                     } else {
                       echo "<td><a href=\"profile.php?empid=". $row['id'] ."\">" . $row["lastName"] . ", " . $row["firstName"] . "</a></td>";
                     }
                     echo "<td>" . $row["title"] . "</td>";
                     echo "<td>" . $row["classification"] . "</td>";
                     echo "<td>" . $row["phone"] . "</td>";
                     echo "</tr>";
                  }
                  ?>
                </tbody>
              </table>

            <?php
              mysqli_close($conn);
            ?>

          </div>
        </div>
      </div>

    </div>

</div>


</div>

<!-- Start Footer -->

<?php include_once (root . "files/includes/homepage/footer.inc"); ?>

<!-- End Footer-->

<!-- <div class="container-fluid">
  Current viewport width:<span id="monitor"></span>
</div> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<script type='text/javascript'>
$(document).ready(function() {
  // $('#monitor').html($(window).width());

  // $(window).resize(function() {
  //     var viewportWidth = $(window).width();
  //     $('#monitor').html(viewportWidth);
  // });
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
