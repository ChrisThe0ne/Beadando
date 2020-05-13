<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else :
	if(!array_key_exists('w', $_GET) || empty($_GET['w'])) : 
		header('Location: index.php');
else: 
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editPlayer'])) {
		$postData = [
			'id' => $_POST['playerId'],
			'name' => $_POST['name'],
			'club' => $_POST['club'],
			'nationality' => $_POST['nationality'],
			'league' => $_POST['league'],
			'pace' => $_POST['pace'],
			'shooting' => $_POST['shooting'],
			'defending' => $_POST['defending']
		];
		if($postData['id'] != $_GET['w']) {
			echo "Hiba a játékos azonosítása során!";
		} else {
			if(empty($postData['name']) || empty($postData['club']) || empty($postData['nationality']) || empty($postData['pace']) || empty($postData['shooting']) || empty($postData['defending'])) {
				echo "Hiányzó adat(ok)!";

			} else {
				$query = "UPDATE players SET name = :name, club = :club, nationality = :nationality, league = :league, pace = :pace, shooting = :shooting, defending = :defending WHERE id = :id";
				$params = [
					':name' => $postData['name'],
					':club' => $postData['club'],
					':nationality' => $postData['nationality'],
					':league' => $postData['league'],
					':pace' => $postData['pace'],
					':shooting' => $postData['shooting'],
					':defending' => $postData['defending'],
					':id' => $postData['id']
				];
				require_once DATABASE_CONTROLLER;
				if(!executeDML($query, $params)) {
					echo "Hiba az adatbevitel során!";
				} header('Location: ?P=list_player');
			}
		}
	}
	$query = "SELECT id, name, club, nationality, league, pace, shooting, defending FROM players WHERE id = :id";
	$params = [':id' => $_GET['w']];
	require_once DATABASE_CONTROLLER;
	$player = getRecord($query, $params);
	if(empty($player)) :
		header('Location: index.php');
		else : ?>
		<table id="keret" align="center" width="60%" border="4pt" cellpadding="20pt">
		<tr><td>
	<form method="post">
		<h1><b>Játékos szerkesztése</b></h1>
		<input type="hidden" name="playerId" value="<?=$player['id'] ?>">
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="playerName"><b>Név</b></label>
				<input type="text" class="form-control" id="playerName" name="name">
			</div>
			<div class="form-group col-md-12">
				<label for="playerCLub"><b>Klub</b></label>
				<input type="text" class="form-control" id="playerClub" name="club">
			</div>
		</div>

				<div class="form-row">
			<div class="form-group col-md-12">
				<label for="playerNationality"><b>Nemzetiség</b></label>
				<input type="text" class="form-control" id="playerNationality" name="nationality">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="playerLeague"><b>Liga</b></label>
				<select class="form-control" id="playerLeague" name="league">
		      		<option value="0">Premier League</option>
		      		<option value="1">LaLiga</option>
		      		<option value="2">Serie A</option>
		      		<option value="3">Bundesliga</option>
		      		<option value="4">Ligue 1</option>
		      		<option value="5">Egyéb liga</option>
		    	</select>
			</div>
		</div>
		
		<div class="form-row">
			<div class="form-group col-md-12">
		    	<label for="playerPace"><b>Gyorsaság (1-99)</b></label>
				<input type="number" class="form-control" id="playerPace" name="pace">
		  	</div>
		</div>

				<div class="form-row">
			<div class="form-group col-md-12">
		    	<label for="playerShooting"><b>Lövés (1-99)</b></label>
				<input type="number" class="form-control" id="playerShooting" name="shooting">
		  	</div>
		</div>

				<div class="form-row">
			<div class="form-group col-md-12">
		    	<label for="playerDefending"><b>Védekezés (1-99)</b></label>
				<input type="number" class="form-control" id="playerDefending" name="defending">
		  	</div>
		</div>



		<button type="submit" class="btn btn-primary" name="editPlayer" id="gomb">Mentés</button>
	</form>
	</td>
	<td id="leiras">
		<p><b>Név</b> - A játékos neve, maximum 64 karakter</p>
		<p><b>Klub</b> - A játékos jelenlegi csapataának neve, maximum 64 karakter</p>
		<p><b>Nemzetiség</b> - Az ország ahonnan származik a játékos, maximum 64 karakter</p>
		<p><b>Liga</b> - Az 5 legjobb ligában, vagy egyéb ligában játszik a játékos?</p>
		<p><b>Gyorsaság</b> - A játékos gyorsasága, 1 és 99 közötti érték</p>
		<p><b>Lövés</b> - A játékos rúgási képessége, 1 és 99 közötti érték</p>
		<p><b>Védekezés</b> - A játékos védekezési képessége,1 és 99 közötti érték</p>
	</td>
	</table>
		<?php endif;
	endif;
endif;
?>