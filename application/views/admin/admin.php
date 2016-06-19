<?php 
    
    include 'includes/header.php';
    include 'includes/nav.php';

?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Admin</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= BASE_URL ?>admin/home/">Home</a>
                </li>
                <li class="active">
                    <strong>Admins</strong>
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
                    <h5> Admin List </h5>
                    
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
                                    <th>Username </th>
                                    <th>Name </th>
                                    <th>Mobile </th>
        							<th>Designation </th>
                                    <th>Last Logged </th>
                                    <th>Added By</th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
        						<?php
        							$admins = $data['admins'];
        							
        							foreach($admins as $key => $admin){
        						?>
        						<tr class="<?= ($admin['block'] != 0) ? 'text-danger' : '' ?>">
        							<td class="client-avatar"><img alt="image" src="<?= BASE_URL ?>public/admin/img/avatars/<?= ($admin['sex'] == 'female') ? 'female' : 'male'?>.png"> </td>
        							<td><?= $admin['username']?></td>
        							<td><?= $admin['name']?></td>
        							<td><?= $admin['mobile']?></td>
        							<td><?= $admin['desgination']?></td>
        							<td><?= date("Y-m-d h:i a", $admin['last_logged'])?></td>
        							<td><?= $admin['added_by']?></td>
                                    <td> 
                                        <button type="button" title="Block" class="btn btn-<?= ($admin['block'] == 0) ? 'danger' : 'primary'?> admin-status <?= ($admin['block'] == 0) ? 'block' : 'unblock'?>" data-admin="<?= $admin['id']?>" > <i class="fa fa-<?= ($admin['block'] == 0) ? 'ban' : 'check-square-o'?>"></i> </button> 
                                    </td>
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