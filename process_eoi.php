<?php
require_once 'header.inc';
require_once 'setting.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: apply.php");
    exit;
}

function clean($v) {
    return htmlspecialchars(trim(stripslashes($v)), ENT_QUOTES, 'UTF-8');
}

// Collect input
$jobRef     = clean($_POST['jobRef'] ?? '');
$firstName  = clean($_POST['firstName'] ?? '');
$lastName   = clean($_POST['lastName'] ?? '');
$dob_raw    = clean($_POST['dob'] ?? '');
$gender     = clean($_POST['gender'] ?? '');
$street = clean($_POST['streetAddress'] ?? '');
$suburb     = clean($_POST['suburb'] ?? '');
$state      = strtoupper(clean($_POST['state'] ?? ''));
$postcode   = clean($_POST['postcode'] ?? '');
$email      = clean($_POST['email'] ?? '');
$phone      = clean($_POST['phone'] ?? '');

$skills     = $_POST['skills'] ?? [];
$skill1     = $skills[0] ?? NULL;
$skill2     = $skills[1] ?? NULL;
$skill3     = $skills[2] ?? NULL;

$otherSkills = clean($_POST['otherSkills'] ?? NULL);

$errors = [];

/* ------------------ VALIDATION ------------------ */

// First / Last name
if (!preg_match('/^[A-Za-z]{1,20}$/', $firstName)) $errors[] = "Invalid first name.";
if (!preg_match('/^[A-Za-z]{1,20}$/', $lastName))  $errors[] = "Invalid last name.";

// DOB conversion dd/mm/yyyy → yyyy-mm-dd
if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $dob_raw)) {
    $errors[] = "DOB must be in dd/mm/yyyy format.";
} else {
    list($d, $m, $y) = explode('/', $dob_raw);
    if (!checkdate($m, $d, $y)) {
        $errors[] = "Invalid date of birth.";
    } else {
        $dob = "$y-$m-$d";
    }
}

// Postcode
if (!preg_match('/^\d{4}$/', $postcode)) $errors[] = "Postcode must be 4 digits.";

// Email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email.";

// Phone (digits only)
$phone_digits = preg_replace('/\D+/', '', $phone);
if (strlen($phone_digits) < 8 || strlen($phone_digits) > 12)
    $errors[] = "Phone must contain 8–12 digits.";

// Skills
if (count($skills) < 1)
    $errors[] = "Select at least one skill.";

if (!empty($errors)) {
    echo "<main><h2>Validation Errors</h2><ul>";
    foreach ($errors as $e) echo "<li>$e</li>";
    echo "</ul><p><a href='apply.php'>Go Back</a></p></main>";
    require_once 'footer.inc';
    exit;
}

/* ------------------ DATABASE INSERT ------------------ */

$mysqli = db_connect();

$stmt = $mysqli->prepare("
    INSERT INTO eoi (
        jobRef, firstName, lastName, dob, gender,
        streetAddress, suburb, state, postcode,
        email, phone,
        skill1, skill2, skill3,
        otherSkills, status
    )
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'New')
");

$stmt->bind_param(
    "sssssssssssssss",
    $jobRef,
    $firstName,
    $lastName,
    $dob,
    $gender,
    $street,
    $suburb,
    $state,
    $postcode,
    $email,
    $phone,
    $skill1,
    $skill2,
    $skill3,
    $otherSkills
);


$stmt->execute();

$lastId = $mysqli->insert_id;

echo "<main><h2>Application Submitted</h2>";
echo "<p>Your Expression of Interest has been received.</p>";
echo "<p><strong>Your EOI Number: $lastId</strong></p></main>";

require_once 'footer.inc';
?>
