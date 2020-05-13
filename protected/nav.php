<hr>

<a href="index.php"><b>Kezdőlap</b></a>
<?php if(!IsUserLoggedIn()) : ?>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=login"><b>Belépés</b></a>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=register"><b>Regisztráció</b></a>
<?php else : ?>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=test"><b>Jogosultsági szint</b></a>

	<?php if(isset($_SESSION['permission']) && $_SESSION['permission'] >= 1) : ?>
		<span> &nbsp; | &nbsp; </span>
		<a href="index.php?P=users"><b>Felhasználók listája</b></a>
		<span> &nbsp; || &nbsp; </span>
		<a href="index.php?P=add_player"><b>Játékos hozzáadása</b></a>
		<span> &nbsp; | &nbsp; </span>
		<a href="index.php?P=add_stadium"><b>Stadion hozzáadása</b></a>
		<span> &nbsp; | &nbsp; </span>
		<a href="index.php?P=list_player"><b>Játékosok listája</b></a>
		<span> &nbsp; | &nbsp; </span>
		<a href="index.php?P=list_stadium"><b>Stadionok listája</b></a>
		<span> &nbsp; || &nbsp; </span>
	<?php else : ?>
		<span> &nbsp; | &nbsp; </span>
	<?php endif; ?>

	<a href="index.php?P=logout"><b>Kilépés</b></a>
<?php endif; ?>

<hr>