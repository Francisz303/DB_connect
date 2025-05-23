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


	if(isset($_GET['user_id'])){
		$id = (int) $_GET['user_id'];
		$stmt = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$selectedUser=$stmt->get_result()->fetch_object();
		$stmt->close();
	}

	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
	<h2>Lista użytkowników</h2>
	<table>
		<tr>
			<th>ID</th>
			<th>Imię</th>
			<th>E-mail</th>
			<th>Data urodzenia</th>
			<th>Płeć</th>
			<th>Wiek</th>
			<th>Opis</th>
			<th>Utworzono</th>
			<th>Sczegóły</th>
			
			
		</tr>
		<?php
		
		while($row = $result->fetch_object()): 
		?>
		<tr>
			<td><?= $row->id?></td>
			<td><?= htmlspecialchars($row->name)?></td>
			<td><?= htmlspecialchars($row->email)?></td>
			<td><?= $row->birth_date?></td>
			<td><?= $row->gender?></td>
			<td><?= calculateAge($row->birth_date)?></td>
			<td><?= nl2br(htmlspecialchars($row->description))?></td>
			<td><?= $row->created_at?></td>
			<td><a class="detail-link" href="?user_id=<?=$row->id?>">Szczegóły</a></td>
		</tr>
		<?php endwhile;?>
	</table>
	<?php 	if($selectedUser): ?>

			<div class="details">
				<h3>Sczegóły użytkownika: <?= htmlspecialchars($selectedUser->name)?></h3>
				<p>Email: <?=$selectedUser->email?></p> 
				<p>Data urodzenia: <?=$selectedUser->birth_date?></p> 
				<p>Wiek: <?=calculateAge($selectedUser->birth_date)?></p> 
				<p>Płeć: <?=$selectedUser->gender?></p> 
				<p>Opis: <?=nl2br(htmlspecialchars($selectedUser->description))?></p> 
				<p>Utworzono: <?=$selectedUser->created_at?></p> 
				<p><a href="list_users_new_new.php">Ukryj sczegóły</a></p>

			</div>

	<?php endif; ?>
</head>
<body>

</body>
</html>
