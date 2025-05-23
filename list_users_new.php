<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">

</head>
<body>
<?php
	require_once 'db_connect.php';

	$selectedUser = null;


	$sql = "SELECT * FROM `users`;";
	$result = $mysqli->query($sql);


	function calculateAge($birthDate){
		$today = new DateTime();
		$dob = new DateTime($birthDate);
		
		$age = $today->diff($dob)->y;
		return $age;
	}

	if ($result->num_rows > 0) {
		echo "<h2>Lista użytkowników</h2>";
		echo "<table border='1'><tr><th>ID</th><th>Imię</th><th>Email</th><th>Data urodzenia</th><th>Płeć</th><th>Wiek</th><th>Opis</th><th>Utworzono</th></tr>";
		while ($row = $result->fetch_object()) {
			echo "<tr>";
				echo "<td>$row->id";
				echo "<td>$row->name";
				echo "<td>$row->email";
				echo "<td>$row->birth_date";
				echo "<td>$row->gender";
				echo "<td>".calculateAge($row->birth_date);
				echo "<td>$row->description";
				echo "<td>$row->created_at";
			echo "</td></tr>";
		}
	}else{
		echo "Brak danych w tabeli użytkowników";
	}

	$mysqli->close();
?>
</body>
</html>
