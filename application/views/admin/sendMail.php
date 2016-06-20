<?php 
    
    include 'includes/header.php';
    include 'includes/nav.php';

?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Compose Mail</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= base_url() ?>admin/home/">Home</a>
                </li>
                <li class="active">
                    <strong>Mail</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1 animated fadeInRight">
                <div class="mail-box-header">
                    <h2>
                        Compse mail
                    </h2>
                </div>
                <div class="mail-box">


                    <div class="mail-body">

                        <form class="form-horizontal" method="post" action="" id="composeMail">
                            <div class="form-group">
                                <p class="col-sm-8 col-sm-offset-2 text-left <?= $success ?>">
                                    <?php echo validation_errors("<p class='text-danger'>"); ?>
                                    <?= $error_msg ?>
                                </p>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">To:</label>

                                <div class="col-sm-10"><input type="text" name="to" class="form-control" value="<?= $email ?>"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Cc:</label>

                                <div class="col-sm-10"><input type="text" name="cc" class="form-control" value="<?= $this->input->post('cc') ?>"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Bcc:</label>

                                <div class="col-sm-10"><input type="text" name="bcc" class="form-control" value="<?= $this->input->post('bcc') ?>"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Subject:</label>

                                <div class="col-sm-10"><input type="text" name="subject" class="form-control" value="<?= $this->input->post('subject') ?>"></div>
                            </div>
                            <textarea style="display:none;" id="mailMessage" name="message"><?= $this->input->post('message') ?></textarea>
                        </form>

                    </div>

                    <div class="mail-text h-200">

                        <div class="summernote"><?= $this->input->post('message') ?></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="mail-body text-right tooltip-demo">
                        <a href="#" class="btn btn-sm btn-primary sendMail" data-toggle="tooltip" data-placement="top" title="Send"><i class="fa fa-reply"></i> Send</a>
                        <a href="#" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
                        <a href="#" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
	
	
<?php include 'includes/footer.php';?>