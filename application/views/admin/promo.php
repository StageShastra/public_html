<?php 
    
    include 'includes/header.php';
    include 'includes/nav.php';

?>

	<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Referal Code</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= base_url() ?>/admin/">Home</a>
                </li>
                <li>
                    <a href="<?= base_url() ?>admin/directors/">Referal</a>
                </li>
                <li class="active">
                    <strong><?= ucfirst($promo['StashPromo_code']) ?></strong>
                </li>
            </ol>
        </div>
    </div>    

    <div class="wrapper wrapper-content">
        <div class="row animated fadeInRight">
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Referal Code Detail</h5>
                    </div>

                    <div>
                        <div class="ibox-content profile-content">
                            <h4><strong><?= $promo['StashPromo_code'] ?></strong></h4>
                            <p>Created On: <b><?= $this->ModelAdmin->timeElapsedString($promo['StashPromo_time']) ?></b></p>
                            <?php $adm = $this->ModelAdmin->getAdminName( $promo['StashPromo_admin_id_ref'] ); ?>
                            <p>Added By: <a href="<?= base_url() . "admin/profile/" . $adm['CstkoAdmins_username'] ?>"><?= $adm['CstkoAdmins_name'] ?></a></p>
                            <p>Status: <span class="label label-<?= ($promo['StashPromo_status']) ? 'primary' : 'warning' ?>"><?= ($promo['StashPromo_status']) ? 'Active' : 'Inactive' ?></span> </p>
                            <p>Used: <a href="#"><b><?= count($used) ?></b></a></p>
                            <p>Visited/Opened: <a href="#visited"><b><?= count($opened) ?></b></a></p>
                            <p>Director: <a href="#directors"><b><?= count(json_decode($promo['StashPromo_directors'], 1)) ?></b></a></p>
                            <p>Project: <a href="#projects"><b><?= count(json_decode($promo['StashPromo_projects'], 1)) ?></b></a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="ibox float-e-margins" id="visited">
                    <div class="ibox-title">
                        <h5> Visted</h5>
                        
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="footable table table-stripped toggle-arrow-tiny" id="tableData" data-page-size='10'>
                                <thead>
                                    <tr>
                                        <th data-toggle="true">#</th>
                                        <th>IP</th>
                                        <th>User Agent</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        
                                        foreach($opened as $key => $open){
                                    ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td><?= $open['StashPromoOpen_ip'] ?></td>
                                        <td><?= $open['StashPromoOpen_user_agent'] ?></td>
                                        <td><?= $this->ModelAdmin->timeElapsedString($open['StashPromoOpen_time'])?></td>
                                    </tr>

                                    <?php } ?>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="9">
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

        <div class="row animated fadeInRight">
        	<div class="col-lg-6">
                <div class="ibox float-e-margins" id="directors">
                    <div class="ibox-title">
                        <h5> Director in List </h5>
                        
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="footable table table-stripped toggle-arrow-tiny" id="tableData" data-page-size='20'>
                                <thead>
                                    <tr>
                                        <th data-toggle="true">#</th>
                                        <!-- <th>Img</th> -->
                                        <th>Id</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $directors = $this->ModelAdmin->getDirectorInList( json_decode($promo['StashPromo_directors'], 1) );
                                        foreach($directors as $key => $director){
                                    ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td> <a href="<?= base_url() ?>admin/director/<?= $director['StashDirector_director_id_ref']?>"><?= sprintf("%04d", $director['StashDirector_director_id_ref'])  ?></a></td>
                                        <td><?= $director['StashDirector_name']  ?></td>
                                        
                                    </tr>

                                    <?php } ?>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="9">
                                            <ul class="pagination pagination-centered hide-if-no-paging"></ul>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox float-e-margins" id="projects">
                    <div class="ibox-title">
                        <h5> Projects in List </h5>
                        
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="footable table table-stripped toggle-arrow-tiny" id="tableData" data-page-size='20'>
                                <thead>
                                    <tr>
                                        <th data-toggle="true">#</th>
                                        <!-- <th>Img</th> -->
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Tag</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $projects = $this->ModelAdmin->getProjectInList( json_decode($promo['StashPromo_projects'], 1) );
                                        foreach($projects as $key => $project){
                                    ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td> <a href="<?= base_url() ?>admin/project/<?= $project['StashProject_id']?>"><?= sprintf("%04d", $project['StashProject_id'])  ?></a></td>
                                        <td><?= $project['StashProject_name']  ?></td>
                                        <td><?= $project['StashProject_tag']  ?></td>
                                        
                                    </tr>

                                    <?php } ?>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="9">
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

        <div class="row animated fadeInRight">
            <div class="col-lg-12">
                <div class="ibox float-e-margins" id="directors">
                    <div class="ibox-title">
                        <h5> Registered Actor by this Referal Code </h5>
                        
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="footable table table-stripped toggle-arrow-tiny" id="tableData" data-page-size='20'>
                                <thead>
                                    <tr>
                                        <th data-toggle="true">#</th>
                                        <!-- <th>Img</th> -->
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Joined</th>
                                        <th>Status</th>
                                        <th>Mobile Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($used as $key => $use){
                                    ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td> <a href="<?= base_url() ?>admin/actor/<?= $use['StashUsers_id']?>"><?= sprintf("%04d", $use['StashUsers_id'])  ?></a></td>
                                        <td><?= $use['StashUsers_id']  ?></td>
                                        <td><?= $use['StashUsers_email']  ?></td>
                                        <td><?= $this->ModelAdmin->timeElapsedString($use['StashUsers_time'])  ?></td>
                                        <td><span class="label label-<?= ($use['StashUsers_status']) ? 'primary' : 'warning' ?>"><?= ($use['StashUsers_status']) ? 'verified' : 'pending' ?></span></td>
                                        <td><span class="label label-<?= ($use['StashUsers_mobile_status']) ? 'primary' : 'warning' ?>"><?= ($use['StashUsers_mobile_status']) ? 'verified' : 'pending' ?></span></td>
                                        
                                    </tr>

                                    <?php } ?>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="9">
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


    </div>
    <?php
		include "includes/footer.php";
    ?>