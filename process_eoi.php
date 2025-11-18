<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: apply.php");
  exit;
}

require_once("settings.php");

$conn = mysqli_connect($host, $user, $pass, $database);
if (!$conn) {
  echo "<p>Database connection failed.</p>";
  exit;
}

$jobRef     = $_POST["jobRef"] ?? '';
$firstName  = $_POST["firstName"] ?? '';
$lastName   = $_POST["lastName"] ?? '';
$dob        = $_POST["dob"] ?? '';
$gender     = $_POST["gender"] ?? '';
$street     = $_POST["street"] ?? '';
$suburb     = $_POST["suburb"] ?? '';
$state      = $_POST["state"] ?? '';
$postcode   = $_POST["postcode"] ?? '';
$email      = $_POST["email"] ?? '';
$phone      = $_POST["phone"] ?? '';
$skills     = $_POST["skills"] ?? [];
$otherSkills= $_POST["otherSkills"] ?? '';

$skillsString = implode(", ", $skills);

$errors = [];
if (!preg_match("/^[A-Za-z]{1,40}$/", $firstName)) $errors[] = "Invalid first name.";
if (!preg_match("/^[A-Za-z]{1,40}$/", $lastName)) $errors[] = "Invalid last name.";
if (!preg_match("/^\d{4}$/", $postcode)) $errors[] = "Postcode must be 4 digits.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email.";
if (!preg_match("/^\d{8,15}$/", $phone)) $errors[] = "Phone must be 8–15 digits.";

if (count($errors) > 0) {
  echo "<h2>Form submission failed</h2><ul>";
  foreach ($errors as $e) echo "<li>$e</li>";
  echo "</ul><p><a href='apply.php'>Go back to form</a></p>";
  exit;
}

$query = "INSERT INTO eoi (jobRef, firstName, lastName, dob, gender, street, suburb, state, postcode, email, phone,
  skills, otherSkills)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "sssssssssssss",
  $jobRef, $firstName, $lastName, $dob, $gender, $street, $suburb, $state, $postcode,
  $email, $phone, $skillsString, $otherSkills);

if (mysqli_stmt_execute($stmt)) {
  $eoiNumber = mysqli_insert_id($conn);
  echo "<h2>Application submitted successfully!</h2>";
  echo "<p>Your EOI Number is: <strong>$eoiNumber</strong></p>";
  echo "<p><a href='index.php'>Return to Home</a></p>";
} else {
  echo "<p>Error submitting application.</p>";
}

mysqli_close($conn);
?>