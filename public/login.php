<?php
require_once __DIR__ . '../../vendor/autoload.php';

use App\Actions\LoginAction;
use App\Helper\Redirect;

$message = '';
if (isset($_POST['loginBtn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $userId = LoginAction::verifyUser($_POST);
  
  if (!is_null($userId)) {
    session_start();
    $_SESSION['loggedIn'] = true;
    Redirect::toHome();
  } else {
    $message = 'Invalid user credentials';
  }
}

include_once './layouts/header.php'; ?>

<div class="card col-md-6 offset-md-3 mt-5">
  <div class="card-body">
    <div class="card-title text-danger"><?php echo $message ?></div>
    <form method="post">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" />

      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
      </div>

      <input type="submit" name="loginBtn" class="btn btn-success">
    </form>
  </div>
</div>

<?php include_once './layouts/footer.php'; ?>