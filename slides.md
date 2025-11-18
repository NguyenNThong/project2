---
marp: true
theme: gaia
paginate: true
---

# Project 2: Manage EOIs
📌 A PHP/MySQL application  
- Manage Expressions of Interest (EOIs)  
- Functions: Delete, Update Status, Filter, Display list  
- Simple interface with HTML + CSS

---

# Database Connection
```php
$conn = mysqli_connect($host, $user, $pass, $database);
if (!$conn) {
  echo "<p>Database connection failed.</p>";
  exit;
}
if (isset($_POST['delete'])) {
  $EOInumber = $_POST['EOInumber'];
  $query = "DELETE FROM eoi WHERE EOInumber = ?";
  ...
}
if (isset($_POST['updateStatus'])) {
  $eoiNumber = $_POST['eoiNumber'];
  $newStatus = $_POST['newStatus'];
  ...
}
if (!empty($_GET['jobRef'])) { ... }
if (!empty($_GET['name'])) { ... }
