<?php
// Include the database connection
require "./dbcon.php";

// Initialize variables to store form data and errors
$fullname = $email = $course = "";
$errors = [];

// Check if the student ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $studentId = $_GET['id'];

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate form data
        $fullname = trim($_POST["fullname"]);
        $email = trim($_POST["email"]);
        $course = trim($_POST["course"]);

        // Basic validation (you should enhance this based on your specific requirements)
        if (empty($fullname)) {
            $errors[] = "Fullname is required.";
        }

        if (empty($email)) {
            $errors[] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        if (empty($course)) {
            $errors[] = "Course is required.";
        }

        // If there are no validation errors, update the student in the database
        if (empty($errors)) {
            $stmt = $conn->prepare("UPDATE student SET fullname=?, email=?, course=? WHERE id=?");
            $stmt->execute([$fullname, $email, $course, $studentId]);

            // Check if the update was successful
            if ($stmt->rowCount() > 0) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error updating student.";
            }
        }
    }

    // Retrieve the existing student data for pre-filling the form
    $stmt = $conn->prepare("SELECT * FROM student WHERE id = ?");
    $stmt->execute([$studentId]);
    $student = $stmt->fetch();

    // Check if a student with the given ID exists
    if (!$student) {
        echo "Student not found.";
        exit();
    }

    $fullname = $student['fullname'];
    $email = $student['email'];
    $course = $student['course'];
} else {
    echo "Invalid student ID.";
    exit();
}

// Close the database connection
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <h2>Edit Student</h2>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Fullname:</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                </div>
                <div class="mb-3">
                    <label for="course" class="form-label">Course:</label>
                    <input type="text" class="form-control" id="course" name="course" value="<?php echo htmlspecialchars($course); ?>">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>

            <?php
            // Display validation errors, if any
            if (!empty($errors)) {
                echo "<div class='alert alert-danger mt-3'><ul>";
                foreach ($errors as $error) {
                    echo "<li>$error</li>";
                }
                echo "</ul></div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
