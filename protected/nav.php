<hr>

<a href="index.php">Kezdőlap</a>
<?php if(!IsUserLoggedIn()) : ?>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=login">Belépés</a>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=register">Regisztráció</a>
<?php else : ?>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=test">Jogosultsági szint</a>

	<?php if(isset($_SESSION['permission']) && $_SESSION['permission'] >= 1) : ?>
		<span> &nbsp; || &nbsp; </span>
		<a href="index.php?P=users">Felhasználók listája</a>
		<span> &nbsp; | &nbsp; </span>
		<a href="index.php?P=list_worker">Égitestek lista</a>
		<span> &nbsp; | &nbsp; </span>
		<a href="index.php?P=add_worker">Égitest hozzáadása</a>
		<span> &nbsp; || &nbsp; </span>
	<?php else : ?>
		<span> &nbsp; | &nbsp; </span>
	<?php endif; ?>

	<a href="index.php?P=logout">Kilépés</a>
<?php endif; ?>

<hr>