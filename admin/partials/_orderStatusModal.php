<?php
$itemModalSql = "SELECT * FROM `orders`";
$itemModalResult = mysqli_query($conn, $itemModalSql);
while ($itemModalRow = mysqli_fetch_assoc($itemModalResult)) {
    $orderid = $itemModalRow['orderId'];
    $userid = $itemModalRow['userId'];
    $orderStatus = $itemModalRow['orderStatus'];

?>

    <!-- Modal -->
    <div class="modal fade" id="orderStatus<?php echo $orderid; ?>" tabindex="-1" role="dialog" aria-labelledby="orderStatus<?php echo $orderid; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #48adea;">
                    <h5 class="modal-title" id="orderStatus<?php echo $orderid; ?>">Order Status and Delivery Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <form action="partials/_orderManage.php" method="post" style="border-bottom: 2px solid #dee2e6;">
                        <div class="text-left my-2">
                            <b><label for="name">Order Status</label></b>
                            <div class="row mx-2">
                                <input class="form-control col-md-3" id="status" name="status" value="<?php echo $orderStatus; ?>" type="number" min="0" max="6" required>
                                <small>0 = Order Placed<br> 1 = Order Confirmed<br> 2 = Preparing Order<br> 3 = Order on the Way<br> 4 = Order Delivered<br> 5 = Order Denied<br> 6 = Order Cancelled</small>
                            </div><br>
                        </div>
                        <input type="hidden" id="orderId" name="orderId" value="<?php echo $orderid; ?>">
                        <button type="submit" class="btn btn-success mb-2" name="updateStatus">Update</button>
                    </form>
                    <?php
                    error_reporting(0);
                    ini_set('display_errors', 0);

                    $deliveryDetailSql = "SELECT * FROM `deliverydetails` WHERE `orderId`= $orderid";
                    $deliveryDetailResult = mysqli_query($conn, $deliveryDetailSql);
                    $deliveryDetailRow = mysqli_fetch_assoc($deliveryDetailResult);
                    $trackId = $deliveryDetailRow['id'];
                    $deliveryBoyName = $deliveryDetailRow['deliveryBoyName'];
                    $deliveryBoyPhoneNo = $deliveryDetailRow['deliveryBoyPhoneNo'];
                    $deliveryTime = $deliveryDetailRow['deliveryTime'];
                    if ($orderStatus > 0 && $orderStatus < 5) {
                    ?>
                        <form action="partials/_orderManage.php" method="post">
                            <div class="text-left my-2">
                                <b><label for="name">Delivery In-Charge</label></b>
                                <input class="form-control" id="name" name="name" value="<?php echo $deliveryBoyName; ?>" type="text" required>
                            </div>
                            <div class="text-left my-2 row">
                                <div class="form-group col-md-6">
                                    <b><label for="phone">Phone No</label></b>
                                    <input class="form-control" id="phone" name="phone" value="<?php echo $deliveryBoyPhoneNo; ?>" type="tel" required pattern="[0-9]{10}">
                                </div>
                                <div class="form-group col-md-6">
                                    <b><label for="catId">ETA (minutes)</label></b>
                                    <input class="form-control" id="time" name="time" value="<?php echo $deliveryTime; ?>" type="number" min="1" max="120" required>
                                </div>
                            </div>
                            <input type="hidden" id="trackId" name="trackId" value="<?php echo $trackId; ?>">
                            <input type="hidden" id="orderId" name="orderId" value="<?php echo $orderid; ?>">
                            <button type="submit" class="btn btn-success" name="updateDeliveryDetails">Update</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>

<style>
    .popover {
        top: -77px !important;
    }
</style>

<script>
    $(function() {
        $('[data-toggle="popover"]').popover();
    });
</script>