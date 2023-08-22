<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- jQuery and jQuery UI -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Accordion -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script>
        $(function() {
            $("#accordion").accordion();
        });
    </script>
</head>

<body>

<?php
// Connect to the database
include "db_connect.php";

// Check if 'keyword' is provided in the GET request
if(isset($_GET['keyword'])) {
    // Fetch keyword from the GET request
    $keywordfromform = $_GET['keyword'];

    // Display the keyword to the user
    echo $keywordfromform;

    // Display the header for blogs with the provided keyword
    echo "<h2>Show all blogs with the word " . $keywordfromform . "</h2>";

    // SQL query to fetch blogs that match the keyword
    $stmt = $conn->prepare("SELECT BlogID, Blog_subject, Blog_body, Blogs_table.user_id, user_name 
                            FROM Blogs_table 
                            JOIN users ON users.user_id = Blogs_table.user_id 
                            WHERE Blog_subject LIKE ?");
    $searchLike = "%" . $keywordfromform . "%";
    $stmt->bindParam(1, $searchLike);
    $stmt->execute();
    $result = $stmt->fetchAll();

    // Check if there are blogs that match the keyword
    if (count($result) > 0) {
        echo "<div id='accordion'>";
        foreach ($result as $row) {
            // Ensure the blog content is displayed safely and prevent XSS
            $safe_blog_subject = htmlspecialchars($row['Blog_subject']);
            $safe_blog_body = htmlspecialchars($row['Blog_body']);
            $username = $row['user_name'];

            // Display each blog in an accordion format
            echo "<h3>" . $safe_blog_subject . "</h3>";
            echo "<div><p>" . $safe_blog_body  . " -- Submitted by user " . $username ."</p></div>";
        }
        echo "</div>";
    } else {
        // Inform the user if no matching blogs are found
        echo "0 results";
    }
} else {
    // Inform the user if no keyword is provided
    echo "Keyword not provided.";
}
?>

</body>
</html>
