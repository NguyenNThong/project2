<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>


<nav>
  <div class="brand">
  <img src="images/1.jpg" alt="Company Logo" class="logo" />
  <span class="company-name">Company XXX</span>
  </div>

  <div class="nav-center">
    <ul class="nav-menu">
      <li><a href="index.php" class="<?= $currentPage == 'index.php' ? 'active' : '' ?>">Home</a></li>
      <li><a href="jobs.php" class="<?= $currentPage == 'jobs.php' ? 'active' : '' ?>">Jobs</a></li>
      <li><a href="apply.php" class="<?= $currentPage == 'apply.php' ? 'active' : '' ?>">Apply</a></li>
      <li><a href="about.php" class="<?= $currentPage == 'about.php' ? 'active' : '' ?>">About us</a></li>
    </ul>
  </div>
</nav>

 
