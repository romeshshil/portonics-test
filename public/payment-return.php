<?php

include_once './layouts/header.php'; ?>

<div class="card mt-5">
    <div class="card-body">
        <div class="text-center">
            <?php if (!empty($_GET['status']) && !empty($_GET["invoice"]) && $_GET["status"] == "ACCEPTED") : ?>
                <span class="text-success">Your payment has been accepted.</span>
            <?php else : ?>
                <span class="text-danger">Your payment has been rejected.</span>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include_once './layouts/footer.php'; ?>