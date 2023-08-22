<?php
// Attempt to establish a connection with the SQL Server using PDO
try {
    // Create a new PDO instance for SQL Server with the provided credentials and settings
    $conn = new PDO("sqlsrv:server = tcp:cst323a3server.database.windows.net,1433; Database = BlogsDB-Act3", "snywdnrydv", "J60123G3V3J4ZN2B$");

    // Set the PDO error mode attribute to throw exceptionsfor error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // If there's an issue connecting to the database, terminate the script and display an error message
    die("Error connecting to SQL Server: " . $e->getMessage());
}
?>