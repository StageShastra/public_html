<?php 
    
    include 'includes/header.php';
    include 'includes/nav.php';

?>

	<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Actor</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= base_url() ?>/admin/">Home</a>
                </li>
                <li>
                    <a href="<?= base_url() ?>admin/directors/">Admins</a>
                </li>
                <li class="active">
                    <strong><?= ucfirst($profile['CstkoAdmins_name']) ?></strong>
                </li>
            </ol>
        </div>
    </div>    

    <div class="wrapper wrapper-content">
        <div class="row animated fadeInRight">
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Profile Detail</h5>
                    </div>

                    <div>
                        <div class="ibox-content border-left-right">
                            <img alt="image" height="228" class="img-responsive" src="<?= ADMIN . "/img/avatars/" . $profile['CstkoAdmins_avatar'] ?>">
                        </div>
                        <div class="ibox-content profile-content">
                            <h4><strong><?= $profile['CstkoAdmins_name'] ?></strong></h4>
                            <p><i class="fa fa-globe"></i> <a href="<?= base_url() . "admin/profile/" . $profile['CstkoAdmins_username'] ?>"><?= base_url() . "admin/profile/" . $profile['CstkoAdmins_username'] ?></a></p>
                            <p><i class="fa fa-mobile"></i>  <?= $profile['CstkoAdmins_mobile'] ?></p>
                            <p><i class="fa fa-envelope"></i>  <?= $profile['CstkoAdmins_email'] ?></p>

                            <p><b>Registered On: </b><i class="fa fa-clock-o"> <?= date('Y-m-d h:i a', $profile['CstkoAdmins_added_on'])?></i> </p>
                            <p><b>Last Login: </b><i class="fa fa-clock-o"> <?= date('Y-m-d h:i a', end($lastLogin)['CstkoAdminLoggin_time'] )?></i> </p>
                            <p><b>Last Login IP : </b><?= end($lastLogin)['CstkoAdminLoggin_ip']  ?></i> </p>
                                                        
                            <!-- <div class="user-button">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="<?= base_url() ?>admin/compose_mail/<?= urldecode($profile['CstkoAdmins_email']) ?>/" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Send Message</a>
                                    </div>                                    
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>

                
            </div>
            <div class="col-md-8">
                <?php
                    if( $this->session->userdata( "CSTKO_Admin_id" ) == $profile['CstkoAdmins_id']  ){
                ?>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><i class="fa fa-map-gear"></i> Change Password </h5>
                    </div>
                    <div class="ibox-content">
                        
                        <form method="post" action="#" id="updatePassword" enctype="multipart/form-data" class="form-horizontal" target="_blank">
                            
                            <p style="color:red;display:none;" class="err_msg">  </p>
                            
                            <div class="form-group"><label class="col-sm-2 control-label">Current Password</label>

                                <div class="col-sm-10">
                                    <input class="form-control" value="" type="password" name="old_pass" placeholder="Current Password">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">New Password</label>

                                <div class="col-sm-10">
                                    <input class="form-control" value="" type="password" name="new_pass" placeholder="New Password">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Confirm Password</label>

                                <div class="col-sm-10">
                                    <input class="form-control" value="" type="password" name="cnf_pass" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" name="submit" type="submit">Update</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
                <?php } ?>

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5> Login Activities ( Last 10 Only)</h5>
                        
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="footable table table-stripped toggle-arrow-tiny" id="tableData" data-page-size='20'>
                                <thead>
                                    <tr>
                                        <th data-toggle="true">#</th>
                                        <th>Time</th>
                                        <th>IP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        
                                        foreach($lastLogin as $key => $login){
                                    ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td><?= date("Y-m-d h:i a", (int)$login['CstkoAdminLoggin_time'])?></td>
                                        <td><?= $login['CstkoAdminLoggin_ip'] ?></td>
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Col Ends -->

    </div>
    <?php
		include "includes/footer.php";
    ?>