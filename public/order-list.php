<?php
require_once __DIR__ . '../../vendor/autoload.php';

use App\Actions\OrderDetailsAction;
use App\Helper\Str;

$orders = OrderDetailsAction::getOrders();

include_once './layouts/admin-header.php'; ?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Order Lists</h5>
    <table class="table" id="list">
      <tr>
        <th>Order ID</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Name</th>
        <th>Amount</th>
        <th>Date</th>
        <th>Status</th>
        <th>Details</th>
      </tr>
      <?php if (is_null($orders)) : ?>
        <tr>
          <td colspan="8" class="text-center">No order found</td>
        </tr>
      <?php else : ?>
        <?php foreach ($orders as $order) : ?>

          <tr>
            <td><?php echo $order['order_id'] ?></td>
            <td><?php echo $order['email'] ?></td>
            <td><?php echo $order['phone'] ?></td>
            <td><?php echo $order['name'] ?></td>
            <td><?php echo $order['amount'] ?></td>
            <td><?php echo $order['created_at'] ?></td>
            <td><?php echo Str::orderStatus($order['status']) ?></td>
            <td><a href="/order-details.php?order=<?php echo $order['order_id'] ?>">Details</a></td>
          </tr>

        <?php endforeach; ?>
      <?php endif; ?>
    </table>
  </div>
</div>

<?php include_once './layouts/footer.php'; ?>