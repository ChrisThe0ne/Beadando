<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else : ?>

	<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addStadium'])) {
		$postData = [
			'name' => $_POST['name'],
			'country' => $_POST['country'],
			'city' => $_POST['city'],
			'club' => $_POST['club'],
			'capacity' => $_POST['capacity'],
			'level' => $_POST['level']
		];

		if(empty($postData['name']) || empty($postData['country']) || empty($postData['city']) || empty($postData['club']) || empty($postData['capacity'])) {
			echo "Hiányzó adat(ok)!";
		} else {
			$query = "INSERT INTO stadiums (name, country, city, club, capacity, level) VALUES (:name, :country, :city, :club, :capacity, :level)";
			$params = [
				':name' => $postData['name'],
				':country' => $postData['country'],
				':city' => $postData['city'],
				':club' => $postData['club'],
				':capacity' => $postData['capacity'],
				':level' => $postData['level'],
			];
			require_once DATABASE_CONTROLLER;
			if(!executeDML($query, $params)) {
				echo "Hiba az adatbevitel során!";
			} header('Location: index.php');
		}
	}
	?>

	<table id="keret" align="center" width="60%" border="4pt" cellpadding="20pt">
		<tr><td>
	<form method="post">

		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="stadiumName"><b>Név</b></label>
				<input type="text" class="form-control" id="stadiumName" name="name">
			</div>
			<div class="form-group col-md-12">
				<label for="stadiumCountry"><b>Ország</b></label>
				<input type="text" class="form-control" id="stadiumCountry" name="country">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="stadiumCity"><b>Város</b></label>
				<input type="text" class="form-control" id="stadiumCity" name="city">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="stadiumClub"><b>Csapat</b></label>
				<input type="text" class="form-control" id="stadiumClub" name="club">
			</div>
		</div>
		
		<div class="form-row">
			<div class="form-group col-md-12">
		    	<label for="stadiumCapacity"><b>Kapacitás</b></label>
				<input type="number" class="form-control" id="stadiumCapacity" name="capacity">
		  	</div>
		</div>

				<div class="form-row">
			<div class="form-group col-md-6">
		    	<label for="stadiumLevel"><b>Több emeletes</b></label>
				<input type="checkbox" class="form-control" id="stadiumLevel" name="level">
		  	</div>
		</div>



		<button type="submit" class="btn btn-primary" name="addStadium" id="gomb">Stadion hozzáadása</button>
	</form>
	</td>
	<td id="leiras">
		<p><b>Név</b> - A stadion neve, maximum 64 karakter</p>
		<p><b>Ország</b> - Az ország neve, ahol a stadion van, maximum 64 karakter</p>
		<p><b>Város</b> - Az város neve ahol a stadion van, maximum 64 karakter</p>
		<p><b>Csapat</b> - A csapat neve, amely birtokolja a stadiont, maximum 64 karakter</p>
		<p><b>Kapacitás</b> - A stadionban lévő ülő, és állóhelyek összege</p>
		<p><b>Emeletes</b> - Emeletes-e a stadion?</p>
	</td>
	</table>
<?php endif; ?>