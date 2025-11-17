<?php
// Database connection
function db_connect() {
    $mysqli = new mysqli("localhost", "root", "", "glitzers_db");

    if ($mysqli->connect_errno) {
        die("Database connection failed: " . $mysqli->connect_error);
    }

    return $mysqli;
}
