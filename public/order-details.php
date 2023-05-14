<?php
require_once __DIR__ . '../../vendor/autoload.php';

use App\Actions\OrderDetailsAction;
use App\Configs\Config;
use App\Helper\Redirect;
use App\Helper\Str;
use App\Services\OrderUpdateService;

if (isset($_GET['order']) && !empty($_GET['order'])) {
    $order = OrderDetailsAction::getDetails($_GET['order']);
    if (is_null($order)) {
        Redirect::toHome();
    }
    $link  = "/order-pay.php?order={$order['order_id']}";
}

$message = '';
if (isset($_POST['statusSubmitBtn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = OrderUpdateService::changeStatus($_POST['orderId'], intval($_POST['status']));
    if (is_null($order)) {
        $message = 'Status is not changed';
    }else{
        Redirect::toDetails($orderId);
    }
}


include_once './layouts/admin-header.php';

?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Order Details</h5>
        <table class="table">
            <tr>
                <th>Payment Link</th>
                <td>
                    <a id="link" href="<?php echo $link ?>"><?php echo Config::BASE_URL . $link ?></a>
                    <button id="copyBtn" class="btn btn-secondary btn-sm float-right">Copy</button>
                </td>
            </tr>
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
                <th>Invoice ID</th>
                <td><?php echo $order['order_id'] ?? 'N/A' ?></td>
            </tr>
            <tr>
                <th>Date</th>
                <td><?php echo $order['created_at'] ?></td>
            </tr>
            <tr>
                <th>Payment Status</th>
                <td><?php echo Str::orderPayStatus($order['is_paid']) ?></td>
            </tr>
            <tr>
                <th>Order Status</th>
                <td>
                    <div class="showStatus">
                        <?php echo Str::orderStatus($order['status']) ?>
                        <button id="changeStatusBtn" class="btn btn-info btn-sm">Change Status</button>
                    </div>

                    <div class="changeStatus d-none">
                        <div>
                            <form method="post" class="form-inline">
                                <input type="hidden" name="orderId" value="<?php echo $order['order_id'] ?>">
                                <div class="form-group mx-sm-3">
                                    <select id="status" class="form-control" name="status">
                                        <option value="0">Pending</option>
                                        <option value="1">Paid</option>
                                        <option value="2">Fulfilled</option>
                                        <option value="3">Refund</option>
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-success" value="Update" name="statusSubmitBtn">
                                <span class="text-danger ml-2"><?php echo $message?></span>
                            </form>
                        </div>
                    </div>

                </td>
            </tr>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {

        $("#copyBtn").click(function() {
            var copyText = document.getElementById("link");
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = copyText.text;
            document.body.appendChild(tempInput);
            tempInput.select();
            tempInput.setSelectionRange(0, 99999);
            document.execCommand("copy");
            document.body.removeChild(tempInput);
        });

        $("#changeStatusBtn").click(function() {
            $(".showStatus").addClass('d-none');
            $(".changeStatus").removeClass('d-none');
            $("#status").val(<?php echo $order['status'] ?>);

        });


    });
</script>


<?php include_once './layouts/footer.php'; ?>