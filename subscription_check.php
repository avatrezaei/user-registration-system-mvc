<?php
require 'config.php';  // Assuming you have a database.php for db connection

// Connect to the database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all subscriptions that are active and where the end date is less than today's date
$sql = "SELECT id FROM subscriptions WHERE status = 'active' AND end_date < CURDATE()";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $subscription_id = $row['id'];
        
        // Update the subscription status to expired
        $update_sql = "UPDATE subscriptions SET status = 'expired' WHERE id = $subscription_id";
        if (!$conn->query($update_sql)) {
            echo "Error updating subscription $subscription_id: " . $conn->error . "\n";
        }
    }
}

$conn->close();
?>
