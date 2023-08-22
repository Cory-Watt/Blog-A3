<?php
// Start session
session_start();

// Check if user_name session variable is set to ensure only logged-in users can access this page.
if (!isset($_SESSION['user_name']) || !$_SESSION['user_name']) {
    echo "Only logged in users may access this page. Click <a href='login_form.php'>here</a> to login.<br>";
    exit;  // Exit script if user is not logged in
}

// Ensure this script is only accessible via a POST request
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Invalid Access");
}

// Include database connection script
include "db_connect.php";

// Ensure POST variables are set. If not, default them to empty strings.
$new_blog_subject = isset($_POST['newblog']) ? $_POST['newblog'] : '';
$new_blog_body = isset($_POST['blogbody']) ? $_POST['blogbody'] : '';
$userid = $_SESSION['userid'];  // Get the user ID from the session

// Display an informational message to show which blog is being added safely using htmlspecialchars
echo "<h2>Trying to add a new blog: " . htmlspecialchars($new_blog_subject) . " and " . htmlspecialchars($new_blog_body) . "</h2>";

// Attempt to insert the new blog into the database
try {
    // Prepare the SQL statement using PDO
    $stmt = $conn->prepare("INSERT INTO Blogs_table (Blog_subject, Blog_body, user_id) VALUES (?, ?, ?)");
    // Bind the form inputs to the SQL statement placeholders
    $stmt->bindParam(1, $new_blog_subject);
    $stmt->bindParam(2, $new_blog_body);
    $stmt->bindParam(3, $userid);

    // Execute the statement and inform the user of the result
    if ($stmt->execute()) {
        echo "Blog added successfully!";
    } else {
        echo "Error adding blog.";
    }

} catch (PDOException $e) {
    // Display error message if there's an issue executing the SQL
    die("Error executing SQL query: " . $e->getMessage());
}

// Close the statement
$stmt = null;

// Include script to show all blogs
include "search_all_blogs.php";

// Provide a link back to the main page
echo "<a href='index.php'>Return to main</a>";
?>