<?php

// Loading required libraries and dependencies
require 'vendor/autoload.php';

// Including the script to connect to the database
include "db_connect.php";

// Starting a new session to manage user state
session_start();

// Setting up the PHP Data Objects to show exceptions for errors
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Initializing the Google Client to set up OAuth 2.0 authentication
$client = new Google_Client();
$client->setClientId('978762936400-tbms5iruo7jmjhiccduekbs93mhjmc2e.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://activity-3-blog.azurewebsites.net/index.php');
$client->addScope("email");
$client->addScope("profile");

// Check if an ID token is provided after Google Sign-In
if (isset($_GET['idtoken'])) {
    $id_token = $_GET['idtoken'];

    // Debugging statement
    echo "About to verify ID token.<br>";

    // Using the Google Client to verify the ID token
    $payload = $client->verifyIdToken($id_token);

    // If the token is verified, extract user details
    if ($payload) {
        $email = $payload['email'];
        $name = $payload['name'];
        echo "Token verified.<br>";
    } else {
        echo "Token verification failed.";
    }

    try {
        // Checking if a user with the same email already exists in the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE email_address = ?");
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // If the user does not exist in the database, insert the new user
        if (count($result) == 0) {
            // Inserting new user into the database
            $stmt = $conn->prepare("INSERT INTO users (user_name, email_address, admin_role) VALUES (?, ?, 0)");
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $email);
            $stmt->execute();

            // Fetching the ID of the newly created user
            $userid = $conn->lastInsertId();
        } else {
            // If user exists, get the user ID from the database
            $userid = $result[0]['id'];
        }

        // Storing user details in session variables for access throughout the application
        $_SESSION['username'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $userid;

        // Redirecting to the main index page
        header('Location: index.php');
    } catch (PDOException $e) {
        // Handling database errors and exceptions
        echo "Database Error: " . $e->getMessage();
        exit;
    }
} elseif (isset($_GET['error'])) {
    // Handling OAuth errors provided by the Google API
    echo "OAuth Error: " . $_GET['error'];
    exit;
} elseif (isset($_GET['code'])) {
    // This section handles the traditional OAuth2.0 'code' workflow
    // Fetching an access token using the code from Google
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (isset($token['error'])) {
        // Handle token errors, if any
        echo "Token Error: " . $token['error'];
        exit;
    }

    // Setting the fetched token to the client
    $client->setAccessToken($token['access_token']);

    // Fetching user details using Google's OAuth2 service
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email = $google_account_info->email;
    $name = $google_account_info->name;

} else {
    // Catch-all error for unexpected scenarios during authentication
    echo "Error during authentication!";
    exit;
}

?>