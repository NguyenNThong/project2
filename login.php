<?php
session_start();
require_once("settings.php");

$conn = mysqli_connect($host, $user, $pass, $database);
if (!$conn) {
  echo "<p>Database connection failed.</p>";
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $query = "SELECT * FROM hr_users WHERE username = ? AND password = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "ss", $username, $password);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) > 0) {
    $_SESSION["logged_in"] = true;
    header("Location: manage.php");
    exit;
  } else {
    echo "<p>Invalid login. Try again.</p>";
  }
}
?>

<!DOCTYPE html>
<html>
<head><title>HR Login</title></head>
<body>
  <h2>HR Login</h2>
  <form method="post" action="login.php">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <input type="submit" value="Login">
  </form>
</body>
</html>