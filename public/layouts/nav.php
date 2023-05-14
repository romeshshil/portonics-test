<?php
require_once __DIR__ . '../../../vendor/autoload.php';

use App\Helper\Redirect;

if (isset($_POST['logoutBtn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  unset($_SESSION['loggedIn']);
  unset($_SESSION['userId']);
  Redirect::toLogin();
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">Bills</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/">New Order</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/order-list.php">Order Lists</a>
      </li>
      <li class="nav-item">
        <form method="post">
          <input type="submit" class="nav-link btn bg-none" name="logoutBtn" value="Logout">
        </form>
      </li>
    </ul>
  </div>
</nav>