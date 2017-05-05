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

define('root', $_SERVER['DOCUMENT_ROOT'] . '/');
define('blogcategory', ' ');

if (isset($_POST['btn-login'])) {
  $a = $_POST["abs-date"];
  $i = count($a) - 1;
  $x = 0;

  $instructor = strip_tags($_POST["instructor"]);
  $office = strip_tags($_POST["office"]);
  $phone = strip_tags($_POST["phone"]);
  $division = strip_tags($_POST["division"]);
  $subject = strip_tags($_POST["subject"]);
  $semester = strip_tags($_POST["semester"]);
  $sem_year = strip_tags($_POST["semester-year"]);
  $call_date = $_POST["call-month"] . "-" . $_POST["call-date"] . "-" . $_POST["call-year"];
  $call_date = strip_tags($call_date);
  $call_time = $_POST["call-hour"] . $_POST["call-min"] . " " . $_POST["call-ampm"];
  $call_time = strip_tags($call_time);
  $by = strip_tags($_POST["data_entry"]);

  $instructor = mysqli_real_escape_string($conn, $instructor);
  $office = mysqli_real_escape_string($conn, $office);
  $phone = mysqli_real_escape_string($conn, $phone);
  $division = mysqli_real_escape_string($conn, $division);
  $subject = mysqli_real_escape_string($conn, $subject);
  $semester = mysqli_real_escape_string($conn, $semester);
  $sem_year = mysqli_real_escape_string($conn, $sem_year);
  $call_date = mysqli_real_escape_string($conn, $call_date);
  $call_time = mysqli_real_escape_string($conn, $call_time);
  $by = mysqli_real_escape_string($conn, $by);

  while ($x <= $i) {

    if ($_POST["abs-date"][$x] != "") {
      $abs_course = strip_tags($_POST["abs-course"][$x]);
      $section = strip_tags($_POST["abs-section"][$x]);
      $abs_date = $_POST["abs-month"][$x] . "-" . $_POST["abs-date"][$x] . "-" . $_POST["abs-year"][$x];
      $abs_date = strip_tags($abs_date);
      $start_time = $_POST["start-hour"][$x] . $_POST["start-min"][$x] . " " . $_POST["start-ampm"][$x];
      $start_time = strip_tags($start_time);
      $end_time = $_POST["end-hour"][$x] . $_POST["end-min"][$x] . " " . $_POST["end-ampm"][$x];
      $end_time = strip_tags($end_time);
      $abs_for = strip_tags($_POST["abs-for"][$x]);
      $room = strip_tags($_POST["room"][$x]);

      $abs_course = mysqli_real_escape_string($conn, $abs_course);
      $section = mysqli_real_escape_string($conn, $section);
      $abs_date = mysqli_real_escape_string($conn, $abs_date);
      $start_time = mysqli_real_escape_string($conn, $start_time);
      $end_time = mysqli_real_escape_string($conn, $end_time);
      $abs_for = mysqli_real_escape_string($conn, $abs_for);
      $room = mysqli_real_escape_string($conn, $room);

      $query ="INSERT INTO absence_log (name, office, phone, division, subject, semester, sem_year, call_date, call_time, abs_date, start_time, end_time, absent_for, room, entered_by) VALUES ";

      $query .= "('" . $instructor . "', '" . $office . "', '" . $phone . "', '" . $division . "', '" . $subject . "', '" . $semester . "', '" . $sem_year . "', '" . $call_date . "', '" . $call_time . "', '" . $abs_date . "', '" . $start_time . "', '" . $end_time . "', '" . $abs_for . "', '" . $room . "','" . $by . "')";

      if (mysqli_query($conn, $query)) {
        $msg = "<div class=\"alert alert-success\"><span class=\"glyphicon glyphicon-info-sign\"></span> &nbsp; New record created successfully!</div>";
      } else {
        $msg = "<div class=\"alert alert-danger\"><span class=\"glyphicon glyphicon-info-sign\"></span> &nbsp; Error: " . $query . "<br />" . mysqli_error($conn) . "</div>";
      }
    }
    if ($_POST["abs-date"][0] = "") {
      $msg = "<div class=\"alert alert-warning\"><span class=\"glyphicon glyphicon-info-sign\"></span> &nbsp; Please enter date of absence !</div>";
    }
    $x++;
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
    margin: 3.0em auto;
    width: 20.0em;
    border: 2px solid #850511;
    padding: 1.75em;
    border-radius: 0.65em;
  }

  h1, h2 {
    color: #fff !important;
    font-size: 1.4em !important;
    background-color: #850511;
  }

  #cloneArea > div.clonedInput {
    padding: 0.75em 0;
    margin: 0.75em 0;
  }

  #cloneArea > div.clonedInput:nth-child(odd) {
    background-color: #fff !important;
    border-radius: 0.45em;
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

            ?>

            <form id="add-form" class="" action="add.php" method="post">
              <input type="hidden" name="data_entry" id="data_entry" value="<?php echo $_SESSION['user']; ?>" />
              <input type="hidden" name="call-year" id="call-year" value="<?php echo date("Y"); ?>" />

              <div class="col-md-12 red-bg">
                <h2 class="text-center">Add Absence</h1>
              </div>

              <div class="form-group col-md-6">
                <label for="instructor">Instrucotr's Name</label>
                <input type="text" class="form-control" name="instructor" id="instructor" value=""/>
              </div>
              <div class="form-group col-md-2">
                <label for="office">Office Number</label>
                <input type="text" class="form-control" name="office" id="office" value=""/>
              </div>
              <div class="form-group col-md-4">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" name="phone" id="phone" value=""/>
              </div>
              <div class="form-group col-md-4">
                <label for="division">Division</label>
                <select class="form-control" name="division" id="division">
                  <option value="AH">Arts &amp; Humanities</option>
                  <option value="CATSS">Computing, Applied Technology &amp; Social Sciences</option>
                  <option value="MSEPS">Math, Science, Engineering &amp; Public Safety</option>
                  <option value="BHAWK">Business, Health, Athletics &amp; Work Experience</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="subject">Subject</label>
                <select class="form-control" name="subject" id="subject">
                  <option value="AJ">Administration of Justice</option>
                  <option value="ASL">Americal Sign Language</option>
                  <option value="ANTR">Anthropology</option>
                  <option value="ARTS">Art &amp; Art History</option>
                  <option value="ASTR">Astronomy</option>
                  <option value="AUTO">Automotive Technology</option>
                  <option value="BIO">Biology</option>
                  <option value="BUSN">Business</option>
                  <option value="CHEM">Chemistry</option>
                  <option value="CMST">Communication Studies</option>
                  <option value="CIS">Computer Information Systems</option>
                  <option value="CNT">Computer Network Technology</option>
                  <option value="CS">Computer Science</option>
                  <option value="DANC">Dance</option>
                  <option value="ECD">Early Childhood Development</option>
                  <option value="ECON">Economics</option>
                  <option value="EMS">Emergency Medical Services</option>
                  <option value="ENGR">Engineering</option>
                  <option value="ENG">English</option>
                  <option value="ESL">English As A Second Language</option>
                  <option value="EVST">Environmental Science</option>
                  <option value="FST">Fire Service Tech</option>
                  <option value="FREN">French</option>
                  <option value="GEOG">Geography</option>
                  <option value="GEOL">Geology</option>
                  <option value="HSCI">Health</option>
                  <option value="HIST">History</option>
                  <option value="HORT">Horticulture</option>
                  <option value="HUMN">Humanities</option>
                  <option value="INTD">Interior Design</option>
                  <option value="INTN">Internship</option>
                  <option value="ITLN">Italian</option>
                  <option value="KIN">Kinesiology</option>
                  <option value="LRNS">Leatning Skills</option>
                  <option value="LIBR">Library Studies</option>
                  <option value="MKTG">Marketing</option>
                  <option value="MSCM">Mass Communications</option>
                  <option value="MATH">Mathematics</option>
                  <option value="MUS">Music</option>
                  <option value="NUTR">Nutrition</option>
                  <option value="OSH">Occupational Safety &amp; Health</option>
                  <option value="PHIL">Philosophy</option>
                  <option value="PHTO">Photography</option>
                  <option value="PHYS">Physics</option>
                  <option value="POLI">Political Science</option>
                  <option value="PSYC">Psychology</option>
                  <option value="PCN">Psychology - Counseling</option>
                  <option value="RADS">Radiation Safety</option>
                  <option value="RELS">Religious Studies</option>
                  <option value="SOC">Sociology</option>
                  <option value="SPAN">Spanish</option>
                  <option value="THEA">Theater Arts</option>
                  <option value="VCOM">Visual Communications</option>
                  <option value="VWT">Viticulture / Winery Tech</option>
                  <option value="WLDT">Welding</option>
                  <option value="WRKX">Work Experience</option>
                  <option value="WMST">Women's Studies</option>
                </select>
              </div>

              <div class="form-group col-md-2">
                <label for="semester">Semester</label>
                <select class="form-control" name="semester" id="semester">
                  <option value="Fall">Fall</option>
                  <option value="Spring">Spring</option>
                  <option value="Summer">Summer</option>
                </select>
              </div>

              <div class="form-group col-md-2">
                <label for="semester-year">Year</label>
                <select class="form-control" name="semester-year" id="semester-year">
                  <option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
                  <option value="<?php echo date("Y") + 1; ?>"><?php echo date("Y") + 1; ?></option>
                </select>
              </div>

              <div class="form-group col-md-2">
                <label for="call-month">Call Month</label>

                  <select class="form-control" name="call-month" id="call-month">
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
              </div>

              <div class="form-group col-md-2">
                <label for="call-date">Call Date</label>
                <input type="text" class="form-control" name="call-date" id="call-date" value="" />
              </div>

              <div class="form-group col-md-2">
              </div>

              <div class="form-group col-md-2">
                <label for="call-hour">Call Time: Hour</label>
                <select class="form-control" name="call-hour" id="call-hour">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                </select>
              </div>

              <div class="form-group col-md-2">
                <label for="call-min">Minute</label>
                <select class="form-control" name="call-min" id="call-min">
                  <option value=":00">:00</option>
                  <option value=":05">:05</option>
                  <option value=":10">:10</option>
                  <option value=":15">:15</option>
                  <option value=":20">:20</option>
                  <option value=":25">:25</option>
                  <option value=":30">:30</option>
                  <option value=":35">:35</option>
                  <option value=":40">:40</option>
                  <option value=":45">:45</option>
                  <option value=":50">:50</option>
                  <option value=":55">:55</option>
                </select>
              </div>

              <div class="form-group col-md-2">
                <label for="call-ampm">AM /PM</label>
                <select class="form-control" name="call-ampm" id="call-ampm">
                  <option value="AM">AM</option>
                  <option value="PM">PM</option>
                </select>
              </div>

              <div class="col-md-12 red-bg">
                <h2 class="text-center">Absence Info</h2>
              </div>
              <div id="cloneArea">
              <div id="clonedInput1" class="clonedInput col-md-12">
              <!--  Clone Input Fields -->
              <div class="form-group col-md-2">
                <label for="abs-month">Month</label>

                  <select class="form-control" name="abs-month[]" id="abs-month1">
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
              </div>

              <div class="form-group col-md-2">
                <label for="abs-date">Date</label>
                <input type="text" class="form-control" name="abs-date[]" id="abs-date1" value="" />
              </div>

              <div class="form-group col-md-2">
                <label for="abs-year">Year</label>
                <select class="form-control" name="abs-year[]" id="abs-year1">
                  <option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
                  <option value="<?php echo date("Y") + 1; ?>"><?php echo date("Y") + 1; ?></option>
                </select>
              </div>

              <div class="form-group col-md-4">
                <label for="abs-course">Course</label>
                <input type="text" class="form-control" name="abs-course[]" id="abs-course1" value="" />
              </div>

              <div class="form-group col-md-2">
                <label for="abs-section">Section</label>
                <input type="text" class="form-control" name="abs-section[]" id="abs-section1" value="" />
              </div>

              <div class="form-group col-md-2">
                <label for="start-hour">Start Time: Hour</label>
                <select class="form-control" name="start-hour[]" id="start-hour1">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                </select>
              </div>

              <div class="form-group col-md-2">
                <label for="start-hour">Minute</label>
                <select class="form-control" name="start-min[]" id="start-min1">
                  <option value=":00">:00</option>
                  <option value=":05">:05</option>
                  <option value=":10">:10</option>
                  <option value=":15">:15</option>
                  <option value=":20">:20</option>
                  <option value=":25">:25</option>
                  <option value=":30">:30</option>
                  <option value=":35">:35</option>
                  <option value=":40">:40</option>
                  <option value=":45">:45</option>
                  <option value=":50">:50</option>
                  <option value=":55">:55</option>
                </select>
              </div>

              <div class="form-group col-md-2">
                <label for="start-ampm">AM /PM</label>
                <select class="form-control" name="start-ampm[]" id="start-ampm1">
                  <option value="AM">AM</option>
                  <option value="PM">PM</option>
                </select>
              </div>

              <div class="form-group col-md-2">
                <label for="end-hour">End Time: Hour</label>
                <select class="form-control" name="end-hour[]" id="end-hour1">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                </select>
              </div>

              <div class="form-group col-md-2">
                <label for="end-hour">Minute</label>
                <select class="form-control" name="end-min[]" id="end-min1">
                  <option value=":00">:00</option>
                  <option value=":05">:05</option>
                  <option value=":10">:10</option>
                  <option value=":15">:15</option>
                  <option value=":20">:20</option>
                  <option value=":25">:25</option>
                  <option value=":30">:30</option>
                  <option value=":35">:35</option>
                  <option value=":40">:40</option>
                  <option value=":45">:45</option>
                  <option value=":50">:50</option>
                  <option value=":55">:55</option>
                </select>
              </div>

              <div class="form-group col-md-2">
                <label for="end-ampm">AM /PM</label>
                <select class="form-control" name="end-ampm[]" id="end-ampm1">
                  <option value="AM">AM</option>
                  <option value="PM">PM</option>
                </select>
              </div>

              <div class="form-group col-md-4">
                <label for="abs-for">Absent For</label>
                <select class="form-control" name="abs-for[]" id="abs-for1">
                  <option value="Class and Lab">Class &amp; Lab</option>
                  <option value="Class Only">Class Only</option>
                  <option value="Lab Only">Lab Only</option>
                  <option value="Office Hour">Office Hour</option>
                </select>
              </div>

              <div class="form-group col-md-2">
                <label for="room">Room #</label>
                <input type="text" class="form-control" name="room[]" id="room1" value="" />
              </div>

              <div class="col-md-6"></div>

              <div class="form-group col-md-12">
                <div class="actions">
                  <button class="btn btn-primary clone">Add</button>
                  <!-- <button class="btn btn-danger remove">Remove</button> -->
                </div>
              </div>
            <!--  End Cloned Input -->
            </div>
            <!--  End Clone Area-->
            </div>

            <div class="form-group col-md-12 text-center">
              <button type="submit" class="btn btn-success" name="btn-login" id="btn-login">Submit</button> <button type="reset" class="btn btn-danger reset" name="btn-reset" id="btn-reset">Reset</button>
            </div>
            </form>

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

  // Clone fields
  var regex = /^(.+?)(\d+)$/i;
  var cloneIndex = $(".clonedInput").length;

  function clone(){

    if (cloneIndex <= 4) {
      $(this).parents(".clonedInput").clone()
          .appendTo("#cloneArea")
          .attr("id", "clonedInput" +  cloneIndex)
          .find("*")
          .each(function() {
              var id = this.id || "";
              var match = id.match(regex) || [];
              if (match.length == 3) {
                  this.id = match[1] + (cloneIndex);
              }
          })
          .on('click', 'button.clone', clone)
          .on('click', 'button.remove', remove);
      cloneIndex++;
      if (cloneIndex == 5) {
        $("button.clone:eq( 4 )").hide();
      }
      return false;
    } else {
      return false;
    }

  }
  function remove(){
      $(this).parents(".clonedInput").remove();
  }

  function reset() {
    location.reload();
  }

  $("button.reset").on("click", reset);

  $("button.clone").on("click", clone);

  $("button.remove").on("click", remove);
});
</script>

<?php include_once(root . "files/includes/js/js.inc"); ?>

</body>
</html>
