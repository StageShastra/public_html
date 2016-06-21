<?php 
    
    include 'includes/header.php';
    include 'includes/nav.php';

?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Actors</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= base_url() ?>admin/home/">Home</a>
                </li>
                <li class="active">
                    <strong>Actors</strong>
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
                    <h5> Actors List </h5>
                    
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
                        <table class="footable table table-stripped toggle-arrow-tiny" id="tableData" data-page-size='20'>

                            <thead>
                                <tr>
                                    <th data-toggle="true">#</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Registered</th>
                                    <th>IP</th>
                                    <th>Account</th>
                                    <th>Mobile</th>
                                </tr>
                            </thead>
                            <tbody>
        						<?php
        							
        							foreach($actors as $key => $actor){
        						?>
        						<tr>
                                    <td><?= ++$key ?></td>
        							<!-- <td class="client-avatar"> <a href="#"> <img src="#" height="64" width="64" > </a> </td> -->
        							<td> <a href="<?= base_url() ?>admin/actor/<?= $actor['StashUsers_id']?>"><?= sprintf("%05d", $actor['StashUsers_id'])  ?></a></td>
                                    <td><?= $actor['StashUsers_name']?></td>
                                    <td><?= $actor['StashUsers_email']?></td>
                                    <td><?= $actor['StashUsers_mobile']?></td>
        							<td><?= $this->ModelAdmin->timeElapsedString($actor['StashUsers_time'])?></td>
                                    <td><?= $actor['StashUsers_ip']?></td>
                                    <td><label class='label label-<?= ($actor['StashUsers_status']) ? "primary" : "warning" ?>'><?= ($actor['StashUsers_status']) ? "active" : "pending" ?></label></td>
                                    <td><label class='label label-<?= ($actor['StashUsers_mobile_status']) ? "primary" : "warning" ?>'><?= ($actor['StashUsers_mobile_status']) ? "verified" : "pending" ?></label></td>
                                    <td></td>
        						</tr>

        						<?php } ?>
        					</tbody>
                            <tfoot class="hide-if-no-paging">
                                <tr>
                                    <td colspan="10">
                                        <ul class="pagination pagination-centered hide-if-no-paging"></ul>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
	
	
<?php include 'includes/footer.php';?>