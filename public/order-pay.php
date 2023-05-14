<?php
require_once __DIR__ . '../../vendor/autoload.php';

use App\Actions\OrderDetailsAction;
use App\Actions\PaymentAction;
use App\Helper\Redirect;

if (isset($_GET['order']) && !empty($_GET['order'])) {
    $order = OrderDetailsAction::getDetails($_GET['order']);
    if (is_null($order)) {
        Redirect::toHome();
    }
}

$message = '';
if (isset($_POST['payBtn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (is_null(PaymentAction::create($_POST['order_id']))) {
        $message = 'Something went wrong!';
    }
}

include_once './layouts/header.php'; ?>

<div class="card mt-5">
    <div class="card-body">
        <h5 class="card-title">Order Details <span class="text-danger"><?php echo $message ?></span></h5>
        <table class="table table-borderless">
            <table class="table">

                <tr>
                    <th>Order ID</th>
                    <td><?php echo $order['order_id'] ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $order['email'] ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?php echo $order['phone'] ?></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><?php echo $order['name'] ?></td>

                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php echo $order['address'] ?></td>
                </tr>
                <tr>
                    <th>Product Name</th>
                    <td><?php echo $order['product'] ?></td>
                </tr>
                <tr>
                    <th>Product Description</th>
                    <td><?php echo $order['description'] ?></td>
                </tr>
                <tr>
                    <th>Transaction Amount</th>
                    <td><?php echo $order['amount'] ?></td>
                </tr>

                <tr>
                    <th>Date</th>
                    <td><?php echo $order['created_at'] ?></td>
                </tr>
                <?php if (!$order['is_paid']) : ?>
                    <tr>
                        <td colspan="2" class="text-center">
                            <form method="post">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id'] ?>" />
                                <input type="submit" name="payBtn" class="btn btn-success col-3" value="Pay">
                            </form>
                        </td>
                    </tr>
                <?php endif; ?>
            </table>
    </div>
</div>
<?php include_once './layouts/footer.php'; ?>