<?php 
    
    include 'includes/header.php';
    include 'includes/nav.php';

?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Admins</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= base_url() ?>admin/home/">Home</a>
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
                                    
                                    foreach($directors as $key => $director){
                                ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <!-- <td class="client-avatar"> <a href="#"> <img src="#" height="64" width="64" > </a> </td> -->
                                    <td> <a href="<?= base_url() ?>admin/director/<?= $director['StashUsers_id']?>"><?= sprintf("%05d", $director['StashUsers_id'])  ?></a></td>
                                    <td><?= $director['StashUsers_name']?></td>
                                    <td><?= $director['StashUsers_email']?></td>
                                    <td><?= $director['StashUsers_mobile']?></td>
                                    <td><?= date("Y-m-d h:i a", (int)$director['StashUsers_time'])?></td>
                                    <td><?= $director['StashUsers_ip']?></td>
                                    <td><label class='label label-<?= ($director['StashUsers_status']) ? "primary" : "warning" ?>'><?= ($director['StashUsers_status']) ? "active" : "pending" ?></label></td>
                                    <td><label class='label label-<?= ($director['StashUsers_mobile_status']) ? "primary" : "warning" ?>'><?= ($director['StashUsers_mobile_status']) ? "verified" : "pending" ?></label></td>
                                    <td></td>
                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    
<?php include 'includes/footer.php';?>