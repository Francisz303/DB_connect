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

	$sql = "SELECT * FROM `users`;";
	$result = $mysqli->query($sql);

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
				echo "<td>WIEK - poprawić";
				echo "<td>$row->description";
				echo "<td>$row->created_at";
			echo "</tr>";
		}
	}else{
		echo "Brak danych w tabeli użytkowników";
	}

	$mysqli->close();
?>
</body>
</html>
