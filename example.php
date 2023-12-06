<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content=
		"width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<title>Attendance Page</title>
</head>

<body>
	<div class="container">
		<div class="row">
			<h2>Attendance</h2>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Sno.</th>
						<th>Student Name</th>
						<th>Attendance</th>
					</tr>
				</thead>

				<tbody>
					<?php
						include_once('connection.php');
						$a=1;
						$stmt = $conn->prepare(
								"SELECT * FROM fetch_record");
						$stmt->execute();
						$users = $stmt->fetchAll();
						foreach($users as $user)
						{
					?>
					<tr>
						<td>
							<?php echo $user['id']; ?>
						</td>
						<td>
							<?php echo $user['studentname']; ?>
						</td>

						<td>
							<div class="form-check form-check-inline">
								<input class="form-check-input"
										type="radio" name="''"
										
										id="inlineRadio1"
									value="'..$a..'">
								<label class="form-check-label"
									for="inlineRadio1">A</label>
							</div>

							<div class="form-check form-check-inline">
								<input class="form-check-input"
									type="radio" name="'..$a..'"
									id="inlineRadio2" value="option2">

								<label class="form-check-label"
									for="inlineRadio2">P</label>
							</div>
						</td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>

			<input class="btn btn-primary"
					type="submit" value="Submit">
		</div>
	</div>
</body>

</html>
