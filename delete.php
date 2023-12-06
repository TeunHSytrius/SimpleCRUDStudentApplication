<?php
// Include the database connection
require "./dbcon.php";

// Check if the student ID is provided in the URL
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $studentId = $_GET['id'];

    // Prepare and execute the SQL query to delete the student
    $stmt = $conn->prepare("DELETE FROM student WHERE id = ?");
    $stmt->execute([$studentId]);

    // Check if the deletion was successful
    if($stmt->rowCount() > 0) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting student.";
    }
} else {
    echo "Invalid student ID.";
}

// Close the database connection
$conn = null;
?>
