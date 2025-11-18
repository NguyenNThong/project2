<?php
require_once("settings.php");

$conn = mysqli_connect($host, $user, $pass, $database);
if (!$conn) {
  echo "<p>Database connection failed.</p>";
  exit;
}

if (isset($_POST['delete'])) {
  $EOInumber = $_POST['EOInumber'];

  $query = "DELETE FROM eoi WHERE EOInumber = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "i", $EOInumber);
  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo "<p>EOI number $EOInumber deleted successfully.</p>";
  } else {
    echo "<p>No record found with EOI number $EOInumber.</p>";
  }
}


if (isset($_POST['updateStatus'])) {
  $eoiNumber = $_POST['eoiNumber'];
  $newStatus = $_POST['newStatus'];
  $updateQuery = "UPDATE eoi SET status = ? WHERE EOInumber = ?";
  $stmt = mysqli_prepare($conn, $updateQuery);
  mysqli_stmt_bind_param($stmt, "si", $newStatus, $eoiNumber);
  mysqli_stmt_execute($stmt);
  echo "<p>EOI #$eoiNumber status updated to $newStatus.</p>";
}

$whereClause = "";
$params = [];
$types = "";

if (!empty($_GET['jobRef'])) {
  $whereClause .= " jobRef = ? ";
  $params[] = $_GET['jobRef'];
  $types .= "s";
}

if (!empty($_GET['name'])) {
  if ($whereClause) $whereClause .= " AND ";
  $whereClause .= " (firstName LIKE ? OR lastName LIKE ?) ";
  $searchName = "%" . $_GET['name'] . "%";
  $params[] = $searchName;
  $params[] = $searchName;
  $types .= "ss";
}

$query = "SELECT * FROM eoi";
if ($whereClause) $query .= " WHERE $whereClause";

$stmt = mysqli_prepare($conn, $query);
if ($params) {
  mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage EOIs</title>
  <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
<fieldset class="apply-form">
  <legend>Manage EOIs</legend>
  <form method="get" action="manage.php" class="delete-form">
    <label>Filter by Job Reference:
      <input type="text" name="jobRef">
    </label>
    <label>Search by Name:
      <input type="text" name="name">
    </label>
    <input type="submit" value="Filter">
  </form>
</fieldset><br><br><br><br>
  <form method="post" action="manage.php" class="delete">
    <label for="EOInumber">Enter EOI Number to delete:</label>
  <input type="number" name="EOInumber" id="EOInumber" required>
  <button type="submit" name="delete">Delete</button>

  </form>

  <table>
    <tr>
      <th>EOI #</th>
      <th>Job Ref</th>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Skills</th>
      <th>Status</th>
      <th>Update Status</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?= $row['EOInumber'] ?></td>
        <td><?= $row['jobRef'] ?></td>
        <td><?= $row['firstName'] . " " . $row['lastName'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['phone'] ?></td>
        <td><?= $row['skills'] ?></td>
        <td><?= $row['status'] ?></td>
        <td>
          <form method="post" action="manage.php">
            <input type="hidden" name="eoiNumber" value="<?= $row['EOInumber'] ?>">
            <select name="newStatus">
              <option value="New">New</option>
              <option value="Current">Current</option>
              <option value="Final">Final</option>
            </select>
            <input type="submit" name="updateStatus" value="Update">
          </form>
        </td>
      </tr>
    <?php } ?>
  </table>
</body>
<p><a href="index.php" class="homepage">Return homepage</a></p>
</html>
<?php
?>