<?php 
    
    include 'includes/header.php';
    include 'includes/nav.php';

?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Promos</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= base_url() ?>admin/home/">Home</a>
                </li>
                <li class="active">
                    <strong>Promos</strong>
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
                    <h5> Promo List </h5>
                    
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
                                    <th>Code</th>
                                    <th>Created</th>
                                    <th>Created By</th>
                                    <th>Opened</th>
                                    <th>Registered</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
        						<?php
        							
        							foreach($promos as $key => $promo){
        						?>
        						<tr>
                                    <td><?= ++$key ?></td>
        							<!-- <td class="client-avatar"> <a href="#"> <img src="#" height="64" width="64" > </a> </td> -->
        							<td> <a href="<?= base_url() ?>admin/promo/<?= $promo['StashPromo_id']?>"><?= sprintf("%05d", $promo['StashPromo_id'])  ?></a></td>
                                    <td><?= $promo['StashPromo_code']?></td>
        							<td><?= $this->ModelAdmin->timeElapsedString($promo['StashPromo_time'])?></td>
                                    <td><a href="<?= base_url() ?>admin/profile/<?= $promo['AddedBy'] ?>" title="<?= $promo['AddedByName'] ?>"><?= $promo['AddedBy'] ?></a></td>
                                    
                                    <td><?= $promo['opened'] ?></td>
                                    <td><?= $promo['used'] ?></td>
                                    <td><label class='label label-<?= ($promo['StashPromo_status']) ? "primary" : "warning" ?>'><?= ($promo['StashPromo_status']) ? "active" : "pending" ?></label></td>
        						</tr>

        						<?php } ?>
        					</tbody>
                            <tfoot class="hide-if-no-paging">
                                <tr>
                                    <td colspan="8">
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