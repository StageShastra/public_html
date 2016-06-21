<?php 
    
    include 'includes/header.php';
    include 'includes/nav.php';

?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Make/Edit Admin</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= BASE_URL ?>/admin/home/">Home</a>
                </li>
                <li class="active">
                    <strong>Admin Setting</strong>
                </li>
            </ol>
        </div>
    </div>

	<div class="wrapper wrapper-content">

		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Make/Edit Admin </small></h5>
					</div>
					<div class="ibox-content">
						<form method="post" action=""  enctype="multipart/form-data" class="form-horizontal">
							<?php
	                        	if(isset($data['error']) && $data['error']){
	                        ?>
	                        <div class="alert alert-<?= $data['class']?>" role="alert">
	                        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                        	<p> <?= $data['err_msg']?></p>
	                        </div>
	                        <?php
	                        	}
	                        ?>
							<div class="form-group"><label class="col-sm-2 control-label"> Admin Access Control 
								<br>
								<small class="text-navy">Custom Access</small>
							</label>

                                <div class="col-sm-10">
                                	<input type="checkbox" name="admin_1" value="1" checked> Full Access
                                	<input type="checkbox" name="admin_2" value="2"> Orders Access
                                	<input type="checkbox" name="admin_3" value="3"> Users Access
                                	<input type="checkbox" name="admin_4" value="4"> Website Access
                                	<input type="checkbox" name="admin_5" value="5"> Messages Access
                                </div>
                            </div>
							<div class="form-group"><label class="col-sm-2 control-label">Username</label>

								<div class="col-sm-10"><input class="form-control" type="text" name="username" placeholder="Set Username"></div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group"><label class="col-sm-2 control-label">Admin Name</label>
								<div class="col-sm-10">
									<input class="form-control" type="text" name="name" placeholder="Admin Name"> 
								</div>
							</div>
							
							<div class="hr-line-dashed"></div>
							<div class="form-group"><label class="col-sm-2 control-label">Email</label>

								<div class="col-sm-10"><input placeholder="Email" class="form-control" name="email" type="email"></div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group"><label class="col-sm-2 control-label">Mobile</label>
								<div class="col-sm-10">
									<input class="form-control" type="text" name="mobile" placeholder="Mobile No"> 
								</div>
							</div>
							<div class="form-group"><label class="col-sm-2 control-label"> Gender </label>

                                <div class="col-sm-10">
                                	<input type="radio" name="sex" value="male" checked> Male
                                	<input type="radio" name="sex" value="female"> Female
                                	<input type="radio" name="sex" value="other"> Other
                                </div>
                            </div>
							
							<div class="hr-line-dashed"></div>
							<div class="form-group"><label class="col-sm-2 control-label">Designation</label>
								<div class="col-sm-10">
									<input class="form-control" type="text" name="designation" placeholder="Designation"> 
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
			</div>
		</div>

	</div>
	
	<?php include 'includes/footer.php';?>