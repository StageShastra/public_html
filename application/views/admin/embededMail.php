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
                   <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://mail.google.com/mail/u/0/"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	
<?php include 'includes/footer.php';?>