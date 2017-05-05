<nav role="navigation" area-label="Section Navigation" class="left-navigation-wrapper">
  <ul class="list-group list-group-menu left-navigation">
    <?php
      if ($_SESSION['userSession'] == 1) {
        echo "<li class=\"list-group-item navigation-item\"><a href=\"add-user.php\">Add User</a></li>";
      }
    ?>
    <li class="list-group-item navigation-item"><a href="add.php">Add Absence</a></li>
    <li class="list-group-item navigation-item"><a href="edit.php">Edit Absence</a></li>
    <li class="list-group-item navigation-item"><a href="all.php">View All</a></li>
    <li class="list-group-item navigation-item"><a href="logout.php?logout=true">Log Out</a></li>
  </ul>
</nav>
