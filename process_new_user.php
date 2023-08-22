<?php
// Display all errors for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure that this script is accessed only via a POST request to maintain data integrity and security
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Invalid Access");
}

// Include the database connection script
include "db_connect.php";

// Sanitize the 'username' input and ensure variables are set; if not, set them to empty strings
$new_username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
$new_password1 = isset($_POST['password']) ? $_POST['password'] : '';
$new_password2 = isset($_POST['password-confirm']) ? $_POST['password-confirm'] : '';

// Displaying an informational message about the ongoing registration process
echo "<h2>Trying to add a new user " . $new_username . "</h2>";

// Check the database to see if this username is already taken
$stmt = $conn->prepare("SELECT * FROM users WHERE CAST(user_name AS NVARCHAR(MAX)) = ?");
$stmt->bindParam(1, $new_username);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// If the username is taken, notify the user
if (count($result) > 0) {
    echo "The username " . $new_username . " is already in use. Try another.";
    exit;
} 
// Validate that the two password fields match
else if ($new_password1 !== $new_password2) {
    echo "The passwords do not match. Please try again.";
    exit;
}
// Ensure the password is of minimum length for security
else if (strlen($new_password1) < 8) {
    echo "The password must be at least 8 characters long. Please try again.";
    exit;
}
// Ensure the password contains at least one numeral for complexity
else if (!preg_match('/[0-9]/', $new_password1)) {
    echo "The password must contain at least one number. Please try again.";
    exit;
}
// Ensure the password has at least one special character for complexity
else if (!preg_match('/[^a-zA-Z0-9\s]/', $new_password1)) {
    echo "The password must contain at least one special character. Please try again.";
    exit;
}
// If all validations pass, proceed with the registration process
else {
    // Hash the password using the PASSWORD_DEFAULT algorithm before storing for security
    $hashedPassword = password_hash($new_password1, PASSWORD_DEFAULT);
    
    // Prepare an SQL statement to insert the new user's details into the database
    $stmt = $conn->prepare("INSERT INTO users (user_name, password) VALUES (?, ?)");
    $stmt->bindParam(1, $new_username);
    $stmt->bindParam(2, $hashedPassword);
    $result = $stmt->execute();

    // Notify the user about the success or failure of the registration process
    if ($result) {
        echo "Registration success!";
    } else {
        echo "Something went wrong. Not registered.";
    }
}

// Link to return to the main page
echo "<a href='index.php'>Return to main</a>";

// Close the statement
$stmt = null;  
?>