<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Show All Blogs</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#accordion").accordion();
        });
    </script>
</head>
<body>

<?php
// Include the database connection script
include "db_connect.php";

// Check if a keyword is provided in the GET request. If not, default to an empty string
$keywordfromform = isset($_GET['keyword']) ? $_GET['keyword'] : '';

if ($keywordfromform) {
    // If keyword is provided
    echo "<h2>Show all blogs with the word " . htmlspecialchars($keywordfromform) . "</h2>";

    // SQL statement to retrieve blogs based on keyword
    $stmt = $conn->prepare("SELECT BlogID, Blog_subject, Blog_body, Blogs_table.user_id, user_name 
                            FROM Blogs_table 
                            JOIN users ON users.user_id = Blogs_table.user_id 
                            WHERE Blog_subject LIKE ?");

    $searchLike = "%" . $keywordfromform . "%";
    $stmt->bindParam(1, $searchLike);
} else {
    // If no keyword, show all blogs
    echo "<h2>Show all blogs</h2>";

    // SQL statement to retrieve all blogs
    $stmt = $conn->prepare("SELECT BlogID, Blog_subject, Blog_body, Blogs_table.user_id, user_name 
                            FROM Blogs_table 
                            JOIN users ON users.user_id = Blogs_table.user_id");
}

// Execute the prepared SQL statement
$stmt->execute();

// Fetch all results into an array
$result = $stmt->fetchAll();

// Check if there are any results
if (count($result) > 0) {
    echo "<div id='accordion'>";
    foreach ($result as $row) {
        // Sanitize output data using htmlspecialchars to prevent XSS
        $safe_blog_subject = htmlspecialchars($row['Blog_subject']);
        $safe_blog_body = htmlspecialchars($row['Blog_body']);
        $username = htmlspecialchars($row['user_name']);

        // Display the blog subject as a header and the answer with the username
        echo "<h3>" . $safe_blog_subject . "</h3>";
        echo "<div><p>" . $safe_blog_body  . " -- Submitted by user " . $username ."</p></div>";
    }
    echo "</div>";
} else {
    echo "0 results";
}
?>

</body>
</html>