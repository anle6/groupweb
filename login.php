<?php
session_start();   // ← FIXED: start session first
require_once 'setting.php';
require_once 'header.inc';

$mysqli = db_connect();
$message = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Fetch manager by username
    $stmt = $mysqli->prepare("SELECT id, password_hash, failed_attempts, locked_until 
                              FROM managers WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $password_hash, $failed_attempts, $locked_until);
        $stmt->fetch();

// Check if the account is currently locked
if ($locked_until !== NULL && strtotime($locked_until) > time()) {
    $remaining = strtotime($locked_until) - time();
    $seconds = $remaining;
    $message = "Account locked. Try again in $seconds seconds.";
}
else {

    // Correct password
    if (password_verify($password, $password_hash)) {

        // Reset failed attempts
        $reset = $mysqli->prepare("UPDATE managers SET failed_attempts = 0, locked_until = NULL WHERE id = ?");
        $reset->bind_param("i", $id);
        $reset->execute();

        $_SESSION['manager_id'] = $id;
        $_SESSION['manager_username'] = $username;

        header("Location: manage.php");
        exit;
    }

    // Wrong password → increase failed attempts
    else {
        $failed_attempts++;

        if ($failed_attempts >= 10) {
            // Lock for 1 minute
            $lock_time = date("Y-m-d H:i:s", strtotime("+1 minute"));
            $update = $mysqli->prepare("UPDATE managers SET failed_attempts = ?, locked_until = ? WHERE id = ?");
            $update->bind_param("isi", $failed_attempts, $lock_time, $id);
            $update->execute();

            $message = "Too many attempts (10). Account locked for 1 minute.";
        } 
        else {
            // Update failed attempts only
            $update = $mysqli->prepare("UPDATE managers SET failed_attempts = ? WHERE id = ?");
            $update->bind_param("ii", $failed_attempts, $id);
            $update->execute();

            $remainingAttempts = 10 - $failed_attempts;
            $message = "Invalid password. Attempts remaining: $remainingAttempts";
        }
    }
}


    } else {
        $message = "Username does not exist.";
    }

    $stmt->close();
}
?>

<section class="hero hero-manage">
    <h2>Manager Login</h2>
    <p>Authorised access only.</p>
</section>

<main>
    <h2>Login</h2>

    <?php if ($message): ?>
        <p style="color:red; font-weight:bold;"><?= $message ?></p>
    <?php endif; ?>

<form action="" method="POST" class="form-card" style="max-width:450px; margin:auto;">
    <label>Username</label>
    <input type="text" name="username" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <div style="display:flex; justify-content:space-between; gap:10px; margin-top:15px;">
        <button class="btn btn-primary" type="submit" style="flex:1;">Login</button>

        <a href="register_manager.php" 
           class="btn btn-primary" 
           style="flex:1; text-align:center; line-height:38px; text-decoration:none;">
            Register
        </a>
    </div>
</form>

</main>

<?php require_once 'footer.inc'; ?>
