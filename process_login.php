<?php
// Start a new session or continue the existing one
session_start();

// Setting error reporting to display all types of errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Including the database connection script
include "db_connect.php";

// Retrieving user input from the login form
$user_name = $_POST['user_name'];
$password = $_POST['password'];

// Display the attempted username to the user
echo "<h2>You attempted to login with " . $user_name . "</h2>";

// Prepare a statement to fetch the hashed password from the DB for the provided username
$stmt = $conn->prepare("SELECT user_id, user_name, password FROM users WHERE CAST(user_name AS nvarchar(MAX)) = ?");

// Bind the input username to the placeholder in the SQL statement
$stmt->bindParam(1, $user_name);

// Execute the prepared statement
$stmt->execute();

// Fetch the result row as an associative array
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Display the executed SQL for debugging 
echo "SQL = SELECT user_id, user_name, password FROM users WHERE user_name = ?<br>";

if ($result) {
    // Check if the provided password matches the hashed password in the database
    if (password_verify($password, $result['password'])) {
        echo "<p>Login success</p>";
        // Set session variables upon successful login
        $_SESSION['user_name'] = $result['user_name'];
        $_SESSION['userid'] = $result['user_id'];
    } else {
        // Display login failure if passwords do not match
        echo "Login failed.<br>";
        // Clear session data and destroy the session on failure
        $_SESSION = [];
        session_destroy();
    }
} else {
    // Display user not found if the username isn't found in the database
    echo "User not found.<br>";
    // Clear session data and destroy the session
    $_SESSION = [];
    session_destroy();
}

// Close the statement 
$stmt = null;

// Display the session variable's current state for debugging 
echo "Session variable = ";
print_r($_SESSION);
echo "<br>";

// Provide a link back to the main page
echo "<a href='index.php'>Return to main page</a>";
?>