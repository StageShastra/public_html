<?php 
    
    include 'includes/header.php';
    include 'includes/nav.php';

?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Past Order</h2>
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
                                    <th>Title</th>
        							<th>Date </th>
                                    <th>User </th>
                                </tr>
                            </thead>
                            <tbody>
        						<?php
        							$carts = $data['favs'];
        							
        							foreach($carts as $key => $cart){
                                        $user = $this->modal("AccountAccess")->getUserInfoById($cart['user_ref']);
                                        $title = trim($this->modal("Encryption")->decrypt(trim($cart['title'])));
        						?>
            						<tr>
            							<td class="client-avatar"> <a href="<?= $cart['link']?>" target="_blank"><img src="<?= $cart['image']?>" height="64" width="64" ></a> </td>
            							<td><?= $title ?></td>
            							<td><?= date("Y-m-d h:i a", $cart['timetamp'])?></td>
                                        <td> <a href="<?= BASE_URL ?>admin/user/<?= $user['user_ref'] ?>" target="_blank"> <b><?= $user['name'] ?></b> </a> </td>
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