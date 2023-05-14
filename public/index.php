<?php
require_once __DIR__ . '../../vendor/autoload.php';

use App\Actions\OrderCreateAction;
use App\Helper\Redirect;

$message = '';
if (isset($_POST['createBtn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $orderId = OrderCreateAction::create($_POST);
  if (!is_null($orderId)) {
    Redirect::toDetails($orderId);
  } else {
    $message = 'Something went wrong';
  }
}

include_once './layouts/admin-header.php';
?>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Create a order <?php echo $message ?></h5>
    <form method="post">
      <div class="form-group">
        <label for="customer_name">Customer Name</label>
        <input type="text" class="form-control" id="customer_name" name="customer_name" required />
      </div>
      <div class="form-group">
        <label for="customer_email">Customer Email</label>
        <input type="email" class="form-control" id="customer_email" name="customer_email" required />
      </div>
      <div class="form-group">
        <label for="customer_phone">Customer Phone</label>
        <input type="tel" class="form-control" id="customer_phone" name="customer_phone" required />
      </div>
      <div class="form-group">
        <label for="customer_address">Customer Address</label>
        <textarea class="form-control" id="customer_address" name="customer_address" rows="3" required></textarea>
      </div>
      <div class="form-group">
        <label for="amount">Amount</label>
        <input type="number" class="form-control" id="amount" name="amount" required />
      </div>
      <div class="form-group">
        <label for="product_name">Product Name</label>
        <input type="text" class="form-control" id="product_name" name="product_name" required />
      </div>
      <div class="form-group">
        <label for="product_details">Product Details</label>
        <textarea class="form-control" id="product_details" name="product_details" rows="3" required></textarea>
      </div>
      <input type="submit" class="btn btn-primary" name="createBtn" value="Submit">
    </form>
  </div>
</div>
<?php include_once './layouts/footer.php'; ?>