<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  $postData = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
  ];

  if(empty($postData['email']) || empty($postData['password'])) {
    echo "Hiányzó adat(ok)!";
  } else if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
    echo "Hibás email formátum!";
  } else if(!UserLogin($postData['email'], $postData['password'])) {
    echo "Hibás email cím vagy jelszó!";
  }

  $postData['password'] = "";
}
?>

<table id="keret" align="center" width="60%" border="4pt" cellpadding="20pt">
    <tr><td>
<form method="post">
  <div class="form-group">
    <label for="loginEmail"><b>Email-cím</b></label>
    <input type="email" class="form-control" id="loginEmail" aria-describedby="emailHelp" name="email" value="<?= isset($postData) ? $postData['email'] : '';?>">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="loginPassword"><b>Jelszó</b></label>
    <input type="password" class="form-control" id="loginPassword" name="password" value="">
  </div>
  <button type="submit" class="btn btn-primary" name="login" id="gomb">Belépés</button>
</form>
</td>
  </table>