<?php
require_once 'header.inc';
require_once 'setting.php';
session_start();

$mysqli = db_connect();
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (strlen($username) < 3) {
        $message = "Username must be at least 3 characters.";
    } 
    elseif (strlen($password) < 6) {
        $message = "Password must be at least 6 characters.";
    } 
    else {

        // Check if username exists
        $check = $mysqli->prepare("SELECT id FROM managers WHERE username = ?");
        $check->bind_param("s", $username);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $message = "Username already exists.";
        } else {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $mysqli->prepare("INSERT INTO managers (username, password_hash) VALUES (?,?)");
            $stmt->bind_param("ss", $username, $hash);
            $stmt->execute();

            $message = "Manager account created successfully!";
        }
        $check->close();
    }
}
?>

<section class="hero hero-manage">
    <h2>Register Manager Account</h2>
</section>

<main>
    <h2>Create Account</h2>

    <?php if($message): ?>
        <p style="color:#0078d4; font-weight:bold;"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST" class="form-card" style="max-width:450px; margin:auto;">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</main>

<?php require_once 'footer.inc'; ?>
