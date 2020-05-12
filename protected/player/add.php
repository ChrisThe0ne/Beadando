<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else : ?>

	<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addPlayer'])) {
		$postData = [
			'name' => $_POST['name'],
			'club' => $_POST['club'],
			'nationality' => $_POST['nationality'],
			'league' => $_POST['league'],
			'pace' => $_POST['pace'],
			'shooting' => $_POST['shooting'],
			'defending' => $_POST['defending']
		];

		if(empty($postData['name']) || empty($postData['club']) || empty($postData['nationality']) || empty($postData['league']) || empty($postData['pace']) || empty($postData['shooting']) || empty($postData['defending'])) {
			echo "Hiányzó adat(ok)!";
		} else {
			$query = "INSERT INTO players (name, club, nationality, league, pace, shooting, defending) VALUES (:name, :club, :nationality, :league, :pace, :shooting, :defending )";
			$params = [
				':name' => $postData['name'],
				':club' => $postData['club'],
				':nationality' => $postData['nationality'],
				':league' => $postData['league'],
				':pace' => $postData['pace'],
				':shooting' => $postData['shooting'],
				':defending' => $postData['defending']
			];
			require_once DATABASE_CONTROLLER;
			if(!executeDML($query, $params)) {
				echo "Hiba az adatbevitel során!";
			} header('Location: index.php');
		}
	}
	?>

	<form method="post">
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="playerName">Név</label>
				<input type="text" class="form-control" id="playerName" name="name">
			</div>
			<div class="form-group col-md-6">
				<label for="playerCLub">Klub</label>
				<input type="text" class="form-control" id="playerClub" name="club">
			</div>
		</div>

				<div class="form-row">
			<div class="form-group col-md-12">
				<label for="playerNationality">Nemzetiség</label>
				<input type="text" class="form-control" id="playerNationality" name="nationality">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="workerLeague">Liga</label>
				<select class="form-control" id="workerLeague" name="league">
		      		<option value="0">Premier League</option>
		      		<option value="1">LaLiga</option>
		      		<option value="2">Serie A</option>
		      		<option value="3">Bundesliga</option>
		      		<option value="4">Bundesliga</option>
		      		<option value="5">Other</option>
		    	</select>
			</div>
		</div>
		
		<div class="form-row">
			<div class="form-group col-md-12">
		    	<label for="playerPace">Gyorsaság (1-99)</label>
				<input type="number" class="form-control" id="playerPace" name="pace">
		  	</div>
		</div>

				<div class="form-row">
			<div class="form-group col-md-12">
		    	<label for="playerShooting">Lövés (1-99)</label>
				<input type="number" class="form-control" id="playerShooting" name="shooting">
		  	</div>
		</div>

				<div class="form-row">
			<div class="form-group col-md-12">
		    	<label for="playerDefending">Védekezés (1-99)</label>
				<input type="number" class="form-control" id="playerDefending" name="defending">
		  	</div>
		</div>



		<button type="submit" class="btn btn-primary" name="addPlayer">Játékos hozzáadása</button>
	</form>
<?php endif; ?>