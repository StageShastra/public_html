<?php 
    
    include 'includes/header.php';
    include 'includes/nav.php';

?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Contact Message</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= base_url() ?>admin/home/">Home</a>
                </li>
                <li class="active">
                    <strong>Messages</strong>
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
                    <h5> Message List </h5>
                    
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
                        <table class="footable table table-stripped toggle-arrow-tiny" id="tableData" data-page-size='20' data-page-navigation=".pagination">

                            <thead>
                                <tr>
                                    <th data-toggle="true">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
        						<?php
        							
        							foreach($messages as $key => $message){
        						?>
        						<tr>
                                    <td><a href="<?= base_url() ?>admin/message/<?= $message['StashContactMessage_id']?>"><?= ++$key ?></a></td>
                                    <td><?= $message['StashContactMessage_name']?></td>
                                    <td><?= $message['StashContactMessage_email']?></td>
                                    <td><?= $message['StashContactMessage_phone']?></td>
                                    <td><?= $message['StashContactMessage_message']?></td>
        							<td><?= $this->ModelAdmin->timeElapsedString($message['StashContactMessage_time'])?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href='<?= base_url() ?>admin/sendMail/<?= urlencode($message['StashContactMessage_email']) ?>' class="btn-success btn btn-xs"><i class='fa fa-reply'></i> Reply</a>
                                        </div>
                                    </td>
        						</tr>

        						<?php } ?>
        					</tbody>
                            <tfoot class="hide-if-no-paging">
                                <tr>
                                    <td colspan="7">
                                        <ul class="pagination pagination-centered"></ul>
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