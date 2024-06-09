<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection script
    require 'db_connect.php';

    // Get the email from the POST request and sanitize it
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO subscriptions (email) VALUES (?)");

        if ($stmt === false) {
            $response = "<div class='error-message'>Error preparing statement: " . $conn->error . "</div>";
        } else {
            $stmt->bind_param("s", $email);

            // Execute the statement
            if ($stmt->execute()) {
                $response = "<div class='sent-message'>Your subscription request has been sent. Thank you!</div>";
            } else {
                $response = "<div class='error-message'>Error executing statement: " . $stmt->error . "</div>";
            }

            // Close the statement
            $stmt->close();
        }

        // Close the connection
        $conn->close();
    } else {
        $response = "<div class='error-message'>Invalid email address.</div>";
    }

    // Output the response to be handled by JavaScript
    echo $response;
}
?>
