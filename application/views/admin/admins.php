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
                                    <th>Designation</th>
                                    <th>Added By</th>
                                    <th>Last Login</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    
                                    foreach($admins as $key => $admin){
                                ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <!-- <td class="client-avatar"> <a href="#"> <img src="#" height="64" width="64" > </a> </td> -->
                                    <td> <a href="<?= base_url() ?>admin/profile/<?= $admin['CstkoAdmins_username']?>"><?= sprintf("%05d", $admin['CstkoAdmins_id'])  ?></a></td>
                                    <td><?= $admin['CstkoAdmins_name']?></td>
                                    <td><?= $admin['CstkoAdmins_designation']?></td>
                                    <td><a href="<?= base_url() ?>admin/profile/<?= $admin['AddedBy'] ?>" title="<?= $admin['AddedByName'] ?>"><?= $admin['AddedBy'] ?></a></td>
                                    <td><?= $this->ModelAdmin->timeElapsedString($admin['CstkoAdmins_last_login']) ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- <button class="btn-warning btn btn-xs">View</button> -->
                                            <button class="btn-danger btn btn-xs">Block</button>
                                        </div>
                                    </td>
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