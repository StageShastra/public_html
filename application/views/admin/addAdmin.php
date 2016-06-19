<?php 
    
    include 'includes/header.php';
    include 'includes/nav.php';

?>

	<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Add Admin</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= base_url() ?>/admin/">Home</a>
                </li>
                <li>
                    <a href="<?= base_url() ?>admin/directors/">Admins</a>
                </li>
                <li class="active">
                    <strong>Add Admin</strong>
                </li>
            </ol>
        </div>
    </div>

    <script type="text/javascript">
        var adminPages = <?= $adminPages ?>;
        //console.log(adminPages);
    </script> 

    <div class="wrapper wrapper-content">
        <div class="row animated fadeInRight">
            <div class="col-md-10 col-md-offset-1">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Add Admin <small></small></h5>
                    </div>
                    <div class="ibox-content">
                        <?php
                            echo validation_errors("<p class='text-danger'>");
                            if( $error ){
                                echo "<p class='{$success}'>{$error_msg}</p>";
                            }
                        ?>
                        <form method="post" action="" id="addAdminform" enctype="multipart/form-data" class="form-horizontal" >
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Userame</label>

                                <div class="col-sm-9">
                                    <input class="form-control" name="username" value="" type="text" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email</label>

                                <div class="col-sm-9">
                                    <input class="form-control" name="email" value="" type="email" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Name</label>

                                <div class="col-sm-9">
                                    <input class="form-control" name="name" value="" type="text" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Mobile</label>

                                <div class="col-sm-9">
                                    <input class="form-control" name="mobile" value="" type="text" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Gender</label>

                                <div class="col-sm-9">
                                    <label class="checkbox-inline"> 
                                        <input value="1" name="gender" type="radio" checked=""> Male
                                        <input value="2" name="gender" type="radio"> Female                                  
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Profile Avatar </label>
                                <div class="col-sm-5">
                                    <input type="hidden" name="currentdp" value="male.jpg">
                                    <input type="file" name="profilePic" data-for="#profile-image-display" class="live-display">
                                </div>
                                <div class="col-sm-4">
                                    <img src="<?= ADMIN . "/img/avatars/male.png" ?>" id="profile-image-display" class="img-responsive img-thumbnail" height="96" width="96">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Admin Authority</label>

                                <div class="col-sm-9">
                                    <label class="checkbox-inline"> 
                                        <input value="1" class="adminAuth" name="auth" type="radio" checked=""> Super Admin <!-- <i data-toggle='tooltip' data-placement='top' data-original-title='Have unrestricted access to all pages' class="fa fa-info"></i> -->
                                        <input value="2" class="adminAuth" name="auth" type="radio"> Admin <!-- <i data-toggle='tooltip' data-placement='top' data-original-title='Have unrestricted access to selected pages' class="fa fa-info"></i> -->
                                        <input value="3" class="adminAuth" name="auth" type="radio"> Sub Admin <!-- <i data-toggle='tooltip' data-placement='top' data-original-title='Have view only permission to selected pages' class="fa fa-info"></i>  -->              
                                    </label>
                                </div>
                            </div>
                            <div class="form-group" id="allowedPages">
                                <label class="col-sm-3 control-label">Pages Allowed <br>
                                <small class="text-navy">Select Allowed page for admin.</small></label>
                                </label>

                                <div class="col-sm-9">
                                    <?php

                                        $adminPages = json_decode($adminPages, 1);

                                        foreach ($adminPages as $key => $pages) {
                                            $mdash = (count($pages['pages'])) ? "&mdash;" : "";
                                            echo "<div id='pageList-{$key}' data-checked='false'>";
                                                echo "<label> <input type='checkbox' value=\"{$pages['name']}\" class='pageInit' data-id='#pageList-{$key}' data-key='{$key}' data-name=\"{$pages['name']}\" data-identifier='{$pages['identifier']}'> {$pages['name']} {$mdash} </label>";
                                                foreach ($pages['pages'] as $k => $page) {
                                                    echo " <label class='checkbox-inline'>
                                                            <input type='checkbox' value='{$page['method']}' class='pageSub' data-id='#pageList-{$key}' data-key='{$k}' data-key-main='{$key}' data-name='{$page['name']}' data-method='{$page['method']}' data-view='{$page['view']}'> {$page['name']}
                                                           </label>";
                                                }
                                            echo "</div>";
                                        }

                                    ?>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <input type="hidden" name="allowedpages" value="">
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" name="submit" type="submit">Add + </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Col Ends -->

    </div>
<?php
	include "includes/footer.php";
?>