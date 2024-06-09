<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'db_connect.php';

$result = $conn->query("SHOW TABLES LIKE 'subscriptions'");
if ($result->num_rows == 1) {
    echo "Table 'subscriptions' exists.";
} else {
    echo "Table 'subscriptions' does not exist.";
}

$conn->close();
?>
