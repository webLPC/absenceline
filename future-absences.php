<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="Las Positas College (LPC)" />
<meta name="keywords" content="Upcoming Cancelled Classes, Las Positas College, Las Positas, LPC" />
<?php
include_once("php/conn.php");

define('root', $_SERVER['DOCUMENT_ROOT'] . '/');
define('blogcategory', ' ');
?>
<title>Upcoming Cancelled Classes</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

<link href="/files/css/home/base.css" rel="stylesheet" type="text/css" />
<link href="/files/css/home/lpc-bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/page.css" type="text/css" />
<link rel="stylesheet" href="/files/css/navigation/left.css" type="text/css" />

<style type="text/css">
.ab_date {
  font-size: 1.4em;
  font-weight: bold;
  color: #850511;
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

      <?php

        if(!$conn) { // creation of the connection object failed
          die("connection object not created: ".mysqli_error($conn));
        }

        if (mysqli_connect_errno()) { // creation of the connection object has some other error
          die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
        }
        // Get current date
        $currentDate = date("Y-m-d");

        // Run select date query
        $currentDate = mysqli_real_escape_string($conn, $currentDate);
        $select_results = "SELECT * FROM absencelog WHERE AbsenceStartDate > '" . $currentDate . "'";

        $result = mysqli_query($conn, $select_results);

      ?>

      <div class="col-md-9 section-content">

        <span id="content-area" class="sr-only sr-only-focusable"></span>

        <h1>Upcoming Cancelled Classes</h1>

        <div class="row">

          <div class="col-sm-12 col-md-12 col-lg-12">
            <p>The following table displays upcoming cancelled classes.</p>

            <p><strong><em>Disclaimer: Only absences reported in advance have been displayed. Last-minute cancellations might not be included.</em></strong></p>

            <table class="table table-striped" summary="List of Faculty, Staff and Adminstration">
              <thead>
                <tr>
                  <th scope="col">Instructor</th>
                  <th scope="col">Start Time</th>
                  <th scope="col">Absent For</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Course</th>
                  <th scope="col">Section</th>
                  <th scope="col">Room Number</th>
              </tr>
              </thead>
              <tbody>
                <?php
                while($row = mysqli_fetch_array($result)) {
                  echo "<tr>";
                  echo "<td>" . $row["Name"] . "</td>";
                  echo "<td>" . $row["StartTimeOfAbsence"] . "</td>";
                  echo "<td>" . $row["AbsentFor"] . "</td>";

                  // Get subject id
                  $subjectId = $row["SubjectId"];

                  // Run select subject tile query
                  $currentDate = mysqli_real_escape_string($conn, $subjectId);
                  $select_subject = "SELECT * FROM subjects WHERE ID = '" . $subjectId . "'";

                  $results_subject = mysqli_query($conn, $select_subject);

                  while ($row_subject = mysqli_fetch_array($results_subject)) {
                    echo "<td>" . $row_subject["SubjectName"] . "</td>";
                  }

                  echo "<td>" . $row["SubjectId"] . "</td>";
                  echo "<td>" . $row["CourseOfMissedClass"] . "</td>";
                  echo "<td>" . $row["SecOfMissedClass"] . "</td>";
                  echo "<td>" . $row["RoomNumber"] . "</td>";
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
