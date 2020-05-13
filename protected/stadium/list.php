<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else : ?>
	<?php 
		if(array_key_exists('d', $_GET) && !empty($_GET['d'])) {
			$query = "DELETE FROM stadiums WHERE id = :id";
			$params = [':id' => $_GET['d']];
			require_once DATABASE_CONTROLLER;
			if(!executeDML($query, $params)) {
				echo "Hiba törlés közben!";
			}
		}
	?>
<?php 
	$query = "SELECT id, name, country, city, club, capacity, level FROM stadiums ORDER BY name ASC";
	require_once DATABASE_CONTROLLER;
	$stadiums = getList($query);
?>
	<?php if(count($stadiums) <= 0) : ?>
		<h1>Nincsenek stadionok az adatbázisban!</h1>
	<?php else : ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Név</th>
					<th scope="col">Ország</th>
					<th scope="col">Város</th>
					<th scope="col">Csapat</th>
					<th scope="col">Férőhely</th>
					<th scope="col">Szint</th>
					<th scope="col">Szerkesztés</th>
					<th scope="col">Törlés</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				<?php foreach ($stadiums as $w) : ?>
					<?php $i++; ?>
					<tr>
						<th scope="row"><?=$i ?></th>
						<td><?=$w['name'] ?></td>
						<td><?=$w['country'] ?></td>
						<td><?=$w['city'] ?></td>
						<td><?=$w['club'] ?></td>
						<td><?=$w['capacity'] ?></td>
						<td><?=$w['level'] == 0 ? 'Emeletes' : 'Földszintes' ?></td>
						<td><a href="?P=edit_stadium&w=<?=$w['id'] ?>"><img src="img/edit.png"></a></td>
						<td><a href="?P=list_stadium&d=<?=$w['id'] ?>">Törlés</a></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	<?php endif; ?>
<?php endif; ?>