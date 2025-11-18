    <?php 
include('header.inc');  
require_once("settings.php");

$conn = mysqli_connect($host, $user, $pass, $database);
if (!$conn) {
  echo "<p>Database connection failed.</p>";
  exit;
}

$query = "SELECT jobRef, title FROM jobs";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h2>📌 Application Form</h2>
<form action="process_eoi.php"
      method="post"
      class="apply-form"
      autocomplete="on"
      novalidate>

  <fieldset>
      <legend>Position</legend>
      <label for="jobRef">Job reference number</label>
      <select id="jobRef" name="jobRef" required>
        <option value="disabled selected">-- Select a job --</option>
        <?php
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . htmlspecialchars($row['jobRef']) . "'>";
            echo htmlspecialchars($row['jobRef']) . " - " . htmlspecialchars($row['title']);
            echo "</option>";
          }
        }
        ?>
      </select>
    </fieldset>

  <fieldset>
    <legend>Personal details</legend>

    <label for="firstName">First name</label>
    <input id="firstName" name="firstName" type="text" maxlength="20"
           pattern="[A-Za-z\-'\s]{1,20}" title="Up to 20 letters, spaces, hyphens or apostrophes" required />

    <label for="lastName">Last name</label>
    <input id="lastName" name="lastName" type="text" maxlength="20"
           pattern="[A-Za-z\-'\s]{1,20}" title="Up to 20 letters, spaces, hyphens or apostrophes" required />

    <label for="dob">Date of birth</label>
    <input id="dob" name="dob" type="text" placeholder="dd/mm/yyyy"
           pattern="^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/\d{4}$" title="Format dd/mm/yyyy" required />

    <fieldset class="gender-group">
      <legend>Gender</legend>
      <label><input type="radio" name="gender" value="Female" required /> Female</label>
      <label><input type="radio" name="gender" value="Male" /> Male</label>
      <label><input type="radio" name="gender" value="Other" /> Other</label>
      <label><input type="radio" name="gender" value="Prefer not to say" /> Prefer not to say</label>
    </fieldset>
  </fieldset>

  <fieldset>
    <legend>Address</legend>

    <label for="street">Street address</label>
    <input id="street" name="street" type="text" maxlength="40" required />

    <label for="suburb">Suburb / town</label>
    <input id="suburb" name="suburb" type="text" maxlength="40" required />

    <label for="state">State</label>
    <select id="state" name="state" required>
      <option value="disabled selected">-- Select state --</option>
      <option value="VIC">VIC</option>
      <option value="NSW">NSW</option>
      <option value="QLD">QLD</option>
      <option value="NT">NT</option>
      <option value="WA">WA</option>
      <option value="SA">SA</option>
      <option value="TAS">TAS</option>
      <option value="ACT">ACT</option>
    </select>

    <label for="postcode">Postcode</label>
    <input id="postcode" name="postcode" type="text" pattern="\d{4}" inputmode="numeric"
           title="Exactly 4 digits" required />
  </fieldset>

  <fieldset>
    <legend>Contact</legend>

    <label for="email">Email address</label>
    <input id="email" name="email" type="email" maxlength="254" required />

    <label for="phone">Phone number</label>
    <input id="phone" name="phone" type="tel" pattern="^[0-9\s]{8,12}$"
           title="8 to 12 digits or spaces" required />
  </fieldset>

  <fieldset>
  <legend>Technical Skills</legend>

  <div class="skills-grid">
    <label><input type="checkbox" name="skills[]" value="HTML/CSS"> HTML/CSS</label>
    <label><input type="checkbox" name="skills[]" value="JavaScript"> JavaScript</label>
    <label><input type="checkbox" name="skills[]" value="React"> React</label>
    <label><input type="checkbox" name="skills[]" value="Vue"> Vue</label>
    <label><input type="checkbox" name="skills[]" value="TypeScript"> TypeScript</label>
    <label><input type="checkbox" name="skills[]" value="Next.js"> Next.js</label>
    <label><input type="checkbox" name="skills[]" value="Python"> Python</label>
    <label><input type="checkbox" name="skills[]" value="TensorFlow"> TensorFlow</label>
    <label><input type="checkbox" name="skills[]" value="scikit-learn"> scikit-learn</label>
    <label><input type="checkbox" name="skills[]" value="Machine Learning"> Machine Learning</label>
    <label><input type="checkbox" name="skills[]" value="Data Analysis"> Data Analysis</label>
    <label><input type="checkbox" name="skills[]" value="Cloud Services"> Cloud Services</label>
    <label><input type="checkbox" name="skills[]" value="NLP"> NLP</label>
    <label><input type="checkbox" name="skills[]" value="Power BI/Tableau"> Power BI / Tableau</label>
    <label><input type="checkbox" name="skills[]" value="UI/UX Design"> UI/UX Design</label>
    <label><input type="checkbox" name="skills[]" value="SEO/Accessibility"> SEO / Accessibility</label>
    <label><input type="checkbox" name="skills[]" value="API Integration"> API Integration</label>
    <label><input type="checkbox" name="skills[]" value="Agile Development"> Agile Development</label>
  </div>

  <div class="other-skill">
    <label><input type="checkbox" name="skills[]" value="Other"> Other:
      <input type="text" name="otherSkills" placeholder="Please specify">
    </label>
  </div>
</fieldset>
  <div class="form-actions">
    <button type="submit">Apply</button>
    <button type="reset">Reset</button>
  </div>
</form>

    </body>
</html>
<?php include('footer.inc'); ?>
