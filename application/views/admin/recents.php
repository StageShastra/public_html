<?php 
    
    include 'includes/header.php';
    include 'includes/nav.php';

?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Recent Order</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= BASE_URL ?>admin/home/">Home</a>
                </li>
                <li class="active">
                    <strong>Orders</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
	
	
	<div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5> Orders List </h5>
                    
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
                                    <th>No. of Items </th>
        							<th>Date </th>
                                    <th>Amount </th>
                                    <th>Pay Mode </th>
                                    <th>Payment </th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
        						<?php
        							$orders = $data['orders'];
        							
        							foreach($orders as $key => $order){
        						?>
        						<tr class="<?= ($order['last_admin'] == 0) ? 'text-success' : '' ?>">
        							<td class="client-avatar"> <a href="<?= BASE_URL ?>admin/order/<?= $order['id']?>"> <?= ORDER_PREFIX . sprintf("%03d", $order['id'])?> </a> </td>
        							<td><?= $order['no_of_products']?></td>
        							<td><?= date("Y-m-d h:i a", $order['timestamp'])?></td>
        							<td>&#8358; <?= $order['amount']?></td>
        							<td><span class="label label-success"><?= strtoupper($order['pay_mode'])?></span></td>
                                    <td><span class="label label-<?= ($order['status'] == 1) ? 'danger' : 'success' ?>"><?= ($order['status'] == 1) ? 'pending' : 'received' ?></span></td>
        							<td><span class="label label-warning"><?= $this->orderStatus2String($order['status']) ?></span></td>
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
	
	
<?php include 'includes/footer.php';?>