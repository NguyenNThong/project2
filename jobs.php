<?php
require_once("settings.php");

$conn = mysqli_connect($host, $user, $pass, $database);
if (!$conn) {
  echo "<p>Database connection failed.</p>";
  exit;
}

$query = "SELECT * FROM jobs";
$result = mysqli_query($conn, $query);
?>

<?php include('header.inc'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Company XXX - Job Descriptions</title>
  <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
  <main>
    <h2>📋 Job Descriptions</h2>

    <div class="container">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div>
        <section>
          <h3>📌 <?= htmlspecialchars($row['title']) ?></h3>
          <p><strong>Reference Number:</strong> <?= $row['jobRef'] ?></p>
          <p><strong>Salary Range:</strong> <?= $row['salaryRange'] ?></p>
          <p><strong>Reports To:</strong> <?= $row['reportsTo'] ?></p>

          <article>
            <h4>Position Description</h4>
            <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
          </article>

          <article>
            <h4>Key Responsibilities</h4>
            <ul>
              <?php
              $tasks = explode("\n", $row['responsibilities']);
              foreach ($tasks as $task) {
                echo "<li>" . htmlspecialchars(trim($task)) . "</li>";
              }
              ?>
            </ul>
          </article>

          <article>
            <h4>Essential:</h4>
            <ol>
              <?php
              $essentials = explode("\n", $row['essential']);
              foreach ($essentials as $item) {
                echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
              }
              ?>
            </ol>

            <h4>Preferable:</h4>
            <ul>
              <?php
              $preferables = explode("\n", $row['preferable']);
              foreach ($preferables as $item) {
                echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
              }
              ?>
            </ul>
          </article>
        </section>
        </div>
      <?php } ?>
    </div>

    <aside>
      <h3>Why Join Company XXX?</h3>
      <ul>
        <li>Work with innovative and diverse teams.</li>
        <li>Opportunities for career growth and global collaboration.</li>
        <li>Access to modern tools and cloud-based technologies.</li>
        <li>Supportive and inclusive work environment.</li>
      </ul>
    </aside>
  </main>
</body>
</html>
<?php include('footer.inc'); ?>
<?php mysqli_close($conn); ?>
