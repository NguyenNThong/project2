<?php include('header.inc'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Enhancements</title>
  <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
  <h2>✨ Enhancements Implemented</h2>

  <section>
    <h3>1. Sticky Navbar</h3>
    <p>I used <code>position: fixed</code> in CSS to make the navigation bar stay at the top of the page when scrolling. This improves usability and keeps navigation accessible at all times.</p>
  </section>

  <section>
    <h3>2. Highlight Active Page in Navbar</h3>
    <p>In <code>header.inc</code>, I used PHP to detect the current page using <code>basename($_SERVER['PHP_SELF'])</code> and added an <code>active</code> class to the corresponding menu item. This helps users know which page they are on.</p>
  </section>

  <section>
    <h3>3. Dynamic Job Reference Dropdown</h3>
    <p>In <code>apply.php</code>, I replaced hardcoded job reference options with a dynamic dropdown using PHP and MySQL. It fetches jobRef and title from the <code>jobs</code> table, ensuring the form always reflects current job listings.</p>
  </section>

  <section>
    <h3>4. Delete EOI by EOInumber</h3>
    <p>In <code>manage.php</code>, I implemented deletion of EOI records using <code>EOInumber</code> instead of <code>jobRef</code>. This ensures precise deletion since EOInumber is unique and avoids affecting multiple records.</p>
  </section>

  <section>
    <h3>5. Manager Login System</h3>
    <p>I created <code>login.php</code> and <code>logout.php</code> to allow managers to log in securely. Access to <code>manage.php</code> is restricted using PHP sessions. Only authenticated users can view or manage EOI records.</p>
  </section>

  <section>
    <h3>7. Server-side Validation in Registration</h3>
    <p>In <code>register.php</code>, I added server-side validation for manager registration. It checks for unique usernames and enforces password rules (minimum length, character types). Data is stored in a <code>managers</code> table.</p>
  </section>


</body>
</html>
<?php include('footer.inc'); ?>