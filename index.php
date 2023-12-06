<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<body>
    <div class="container">
        <div class="row">
            <h2 class="text-decoration-underline fs-2 text text-center">Studenten overzicht</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Volledige naam</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                       require "./dbcon.php";
                       $stmt = $conn->prepare("SELECT * FROM student");
                       $stmt->execute();
                       $students = $stmt->fetchAll();
                       foreach($students as $student) {
                    ?>
                    <tr>
                        <td><?php echo $student['id'];?></td>
                        <td><?php echo $student['fullname']?></td>
                        <td><?php echo $student['email']?></td>
                        <td><?php echo $student['course']?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $student['id'];?>" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                        <td>
                            <a href="delete.php?id=<?php echo $student['id'];?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <a href="create.php" class="btn btn-success mb-3">Create</a>
        </div>
    </div>
</body>
</html>
