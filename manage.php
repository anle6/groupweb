<?php
session_start();
require_once 'setting.php';  // must NOT output anything!

// ✔ Handle Logout Action
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['manager_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'header.inc';

$mysqli = db_connect();
$message = "";

/* -----------------------------------
   DELETE EOI BY JOBREF
----------------------------------- */
if (isset($_POST['delete_jobref'])) {
    $jobRef = trim($_POST['delete_jobref']);
    $del = $mysqli->prepare("DELETE FROM eoi WHERE jobRef = ?");
    $del->bind_param("s", $jobRef);
    $del->execute();
    $message = "EOIs for jobRef <strong>$jobRef</strong> deleted.";
}

/* -----------------------------------
   UPDATE STATUS
----------------------------------- */
if (isset($_POST['update_status_id']) && isset($_POST['new_status'])) {
    $id = intval($_POST['update_status_id']);
    $new = $_POST['new_status'];

    $update = $mysqli->prepare("UPDATE eoi SET status = ? WHERE EOInumber = ?");
    $update->bind_param("si", $new, $id);
    $update->execute();

    $message = "Status updated successfully.";
}

/* -----------------------------------
   BUILD SEARCH QUERY
----------------------------------- */
$where = "1";
$params = [];
$types = "";

if (!empty($_GET['filter_jobref'])) {
    $where .= " AND jobRef = ?";
    $params[] = $_GET['filter_jobref'];
    $types .= "s";
}

if (!empty($_GET['filter_name'])) {
    $where .= " AND (firstName LIKE ? OR lastName LIKE ?)";
    $name = "%" . $_GET['filter_name'] . "%";
    $params[] = $name;
    $params[] = $name;
    $types .= "ss";
}

$sort = "";
$allowed_sorts = ["EOInumber", "firstName", "lastName", "status", "created_at"];

if (!empty($_GET["sort"]) && in_array($_GET['sort'], $allowed_sorts)) {
    $sort = " ORDER BY " . $_GET['sort'];
}

$sql = "SELECT * FROM eoi WHERE $where $sort";
$stmt = $mysqli->prepare($sql);

if (!empty($params))
    $stmt->bind_param($types, ...$params);

$stmt->execute();
$result = $stmt->get_result();
?>

<section class="hero hero-manage">
    <h2>EOI Management</h2>
    <p>Welcome, <?= htmlspecialchars($_SESSION['manager_username']) ?></p>
</section>

<main class="manage-panel">

    <?php if ($message): ?>
        <p style="color:green; font-weight:bold;"><?= $message ?></p>
    <?php endif; ?>

    <h2>Search & Filter</h2>

    <form method="GET" class="manage-card search-card">
        <div class="form-row">
            <div class="col">
                <label>Filter by Job Reference</label>
                <input type="text" name="filter_jobref">
            </div>

            <div class="col">
                <label>Search by Name</label>
                <input type="text" name="filter_name">
            </div>

            <div class="col">
                <label>Sort By</label>
                <select name="sort">
                    <option value="">None</option>
                    <option value="EOInumber">EOI Number</option>
                    <option value="firstName">First Name</option>
                    <option value="lastName">Last Name</option>
                    <option value="status">Status</option>
                    <option value="created_at">Submission Time</option>
                </select>
            </div>
        </div>

        <button class="btn btn-primary">Apply Filters</button>
    </form>

    <h2>EOI Results</h2>
    <table class="table">
        <tr>
            <th>EOI #</th>
            <th>JobRef</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Skills</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['EOInumber'] ?></td>
                <td><?= $row['jobRef'] ?></td>
                <td><?= $row['firstName'] ?> <?= $row['lastName'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone'] ?></td>

                <td>
                    <span class="badge <?= strtolower($row['status']) ?>">
                        <?= $row['status'] ?>
                    </span>
                </td>

                <td>
                    <?= $row['skill1'] ?> 
                    <?= $row['skill2'] ? ", ".$row['skill2'] : "" ?>
                    <?= $row['skill3'] ? ", ".$row['skill3'] : "" ?>
                </td>

                <td>
                    <form method="POST" style="display:inline-block;">
                        <input type="hidden" name="update_status_id" value="<?= $row['EOInumber'] ?>">
                        <select name="new_status">
                            <option <?= $row['status']=="New"?"selected":"" ?>>New</option>
                            <option <?= $row['status']=="Current"?"selected":"" ?>>Current</option>
                            <option <?= $row['status']=="Final"?"selected":"" ?>>Final</option>
                        </select>
                        <button class="btn small btn-primary">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Delete EOIs by Job Reference</h2>

    <form method="POST" class="manage-card delete-card" style="max-width:400px;">
        <label>Job Reference</label>
        <input type="text" name="delete_jobref" required>
        <button class="btn btn-primary">Delete All EOIs</button>
    </form>

    <p style="margin-top:20px;">
        <!-- ✔ CONVERTED TO POST LOGOUT FORM -->
        <form method="POST">
            <button type="submit" name="logout" class="btn btn-primary">Logout</button>
        </form>
    </p>

</main>

<?php require_once 'footer.inc'; ?>
