<?php 
    
    include 'includes/header.php';
    include 'includes/nav.php';

?>

	<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Promo Code</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= base_url() ?>/admin/">Home</a>
                </li>
                <li>
                    <a href="<?= base_url() ?>admin/promos/">Promo</a>
                </li>
                <li class="active">
                    <strong>Add Promo</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row animated fadeInRight">
            <div class="col-md-10 col-md-offset-1">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Add Promo <small></small></h5>
                    </div>
                    <div class="ibox-content">
                        <?php
                            echo validation_errors("<p class='text-danger'>");
                            if( $error ){
                                echo "<p class='{$success}'>{$error_msg}</p>";
                            }
                        ?>
                        <form method="post" action="" id="createPromoFrom" enctype="multipart/form-data" class="form-horizontal" >
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Code</label>

                                <div class="col-sm-9">
                                    <input class="form-control" placeholder="Enter Promo Code" id="promoCode" name="code" value="" type="text" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Directors</label>

                                <div class="col-sm-9">
                                    <p class="form-control-static"><span id="director_list">Not Selected</span> 
                                    <div class="btn-group"><button type="button" class="btn-primary btn btn-xs toggleAddModal" data-for="director"><span class='addOrUpdate'>Add</span> Directors</button></div></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Projects</label>

                                <div class="col-sm-9">
                                    <p class="form-control-static"><span id="project_list">Not Selected</span> 
                                    <div class="btn-group"><button type="button" class="btn-primary btn btn-xs toggleAddModal" data-for="project"><span class='addOrUpdate'>Add</span> Projects</button></div></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Make It Live</label>

                                <div class="col-sm-9">
                                    <label class="checkbox-inline"> 
                                        <input value="1" name="live" type="radio" checked=""> Yes
                                        <input value="0" name="live" type="radio"> No                                  
                                    </label>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <input type="hidden" name="director_ids" value="[]">
                            <input type="hidden" name="project_ids" value="[]">
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

        <div class="modal inmodal" id="modelDisplay" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> -->
                        <h4 class="modal-title"><span class="updateModelTitle">Direct</span> List</h4>
                        <small>Select <span class="updateModelTitle">Direct</span> from the list.</small>
                    </div>
                    <div class="modal-body">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-sm-12 m-b-xs">
                                       <div class="input-group">
                                            <input placeholder="Type Director Name, Email, Mobile here..." id="searchTableRefer" class="input-sm form-control" type="text"> 
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
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="modelTBody" data-for="director">
                                            <!-- <tr>
                                                <td colspan="2">No <span class="updateModelTitle">Direct</span> selected...</td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary saveChanges">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Col Ends -->

    </div>
<?php
	include "includes/footer.php";
?>