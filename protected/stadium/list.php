<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else : ?>
	<?php 
		if(array_key_exists('d', $_GET) && !empty($_GET['d'])) {
			$query = "DELETE FROM players WHERE id = :id";
			$params = [':id' => $_GET['d']];
			require_once DATABASE_CONTROLLER;
			if(!executeDML($query, $params)) {
				echo "Hiba törlés közben!";
			}
		}
	?>
<?php 
	$query = "SELECT id, name, club, nationality, league, pace, shooting, defending FROM players ORDER BY name ASC";
	require_once DATABASE_CONTROLLER;
	$players = getList($query);
?>
	<?php if(count($players) <= 0) : ?>
		<h1>Nincsenek játékosok az adatbázisban!</h1>
	<?php else : ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Név</th>
					<th scope="col">Csapat</th>
					<th scope="col">Nemzetiség</th>
					<th scope="col">Liga</th>
					<th scope="col">Gyorsaság</th>
					<th scope="col">Lövés</th>
					<th scope="col">Védekezés</th>
					<th scope="col">Szerkesztés</th>
					<th scope="col">Törlés</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				<?php foreach ($players as $w) : ?>
					<?php $i++; ?>
					<tr>
						<th scope="row"><?=$i ?></th>
						<td><?=$w['name'] ?></td>
						<td><?=$w['club'] ?></td>
						<td><?=$w['nationality'] ?></td>
						<td><?=$w['league'] == 0 ? 'Premier League' : ($w['league'] == 1 ? 'LaLiga' : ($w['league'] == 2 ? 'Serie A' : ($w['league'] == 3 ? 'Bundesliga' : ($w['league'] == 4 ? 'Ligue 1' : ($w['league'] == 5 ? 'Egyéb liga' : 'x'))))) ?></td>
						<td><?=$w['pace'] ?></td>
						<td><?=$w['shooting'] ?></td>
						<td><?=$w['defending'] ?></td>
						<td><a href="?P=edit_player&w=<?=$w['id'] ?>"><img src="img/edit.png"></a></td>
						<td><a href="?P=list_player&d=<?=$w['id'] ?>"><img src="img/delete.png"></a></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	<?php endif; ?>
<?php endif; ?>