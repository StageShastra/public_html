<?php
	include 'includes/header.php';
	include 'includes/nav.php';

	$orders = $data['order'];
	$address = $data['address'];
?>

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>DASHBOARD</h2>
		<ol class="breadcrumb">
			<li class="active">
				<a href="<?= BASE_URL ?>/admin/home/">Home</a>
			</li>
		</ol>
	</div>
</div>

<div class="wrapper wrapper-content">
	<div class="row animated fadeInRight">
        <div class="col-md-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><i class="fa fa-map-gear"></i> Order Details</h5>
                </div>
                <div class="ibox-content">
                	<div>
                		<p><b>Order No: </b> <?= ORDER_PREFIX . sprintf("%03d", $orders['id']) ?></p>
                		<p><b>Date: </b> <?= date("Y-m-d h:i:s a", $orders['timestamp']) ?></p>
                		<p><b>No. of Products: </b> <?= $orders['no_of_products'] ?></p>
                		<p><b>Amount: </b> &#8358; <?= $orders['amount'] ?></p>
                		<p><b>Payment Status: </b> <span class="label label-<?= ($orders['status'] == 1) ? 'danger':'success' ?>"> <?= ($orders['status'] == 1) ? 'pending':'Received' ?> </span></p>
                		<p><b>Payment Mode: </b> <?= strtoupper($orders['pay_mode']) ?></p>
                		<p><b>Order Status: </b> <span class="label label-warning"> <?= $this->orderStatus2String($orders['status']) ?> </span></p>
                	</div>
                </div>
                <div class="ibox-content">
                	<p class="display_message" style="display:none;color:red;"></p>
                	<form action="#" method="post" id="update-order-status" class="form-horizontal">
                		<div class="form-group">
                			<label class="col-sm-2 control-label">Update Order Status</label>

                            <div class="col-sm-10">
                            	<select class="form-control m-b" name="status">
	                                <?php
	                                	for ($i=1; $i < 7; $i++) { 
	                                		echo "<option value='{$i}' > ".$this->orderStatus2Status($i)." </option>";
	                                	}
	                                ?>
	                            </select>
                            </div>
                        </div>
                        <div class="form-group">
							<div class="col-sm-4 col-sm-offset-2">
								<input type="hidden" name="order" value="<?= $orders['id']?>">
								<button class="btn btn-primary" name="submit" type="submit" >Update</button>
							</div>
						</div>
                	</form>
                </div>

            </div>
        </div>
        <span style="display:none;" class="span-token" data-token="<?= $_SESSION['_CSRF_Admin']?>"></span>
        <div class="col-md-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><i class="fa fa-map-gear"></i> Delivery Address</h5>
                </div>
                <div class="ibox-content">
                	<div>
                		<p><?= $address['name']?></p>
						<p><?= $address['mobile']?></p>
						<p><?= $address['email']?></p>
						<p><?= $address['addr']?></p>
						<p><?= $address['city']?></p>
						<p><?= $address['state']?></p>
						<p><?= $address['country']?></p>
                	</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row animated fadeInRight">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5> Products </h5>
                    
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-9 m-b-xs">
                           
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input placeholder="Search" id="searchTable" class="input-sm form-control" type="text"> 
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-primary"> Go!</button> 
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="tableData">
                            <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Web Id</th>
                                    <th>Title</th>
                                    <th>Price </th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
        						<?php
        							$carts = json_decode($orders['order_data'], true);
        							
        							foreach($carts as $key => $cart){
        								$title = trim($this->modal("Encryption")->decrypt(trim($cart['p_data']['name'])));
        						?>
            						<tr>
            							<td class="client-avatar"> <a href="<?= $cart['p_link']?>" target="_blank"><img src="<?= $cart['p_image']?>" height="64" width="64" ></a> </td>
            							<td><?= $cart['p_data']['web_id']?></td>
            							<td><?= $title ?></td>
            							<td>&#8358; <?= $cart['p_data']['promo_price']?></td>
            							<td><?= $cart['p_qty']?></td>
            						</tr>
        						<?php } ?>
        					</tbody>
                        </table>
                        <span style="display:none;" class="span-token" data-token="<?= $_SESSION['_CSRF_Admin']?>"></span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
	include 'includes/footer.php';
?>