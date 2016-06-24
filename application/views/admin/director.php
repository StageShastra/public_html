<?php 
    
    include 'includes/header.php';
    include 'includes/nav.php';

?>

	<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Casting Director</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= base_url() ?>/admin/">Home</a>
                </li>
                <li>
                    <a href="<?= base_url() ?>admin/directors/">Director</a>
                </li>
                <li class="active">
                    <strong><?= ucfirst($profile['StashDirector_name']) ?></strong>
                </li>
            </ol>
        </div>
    </div>    

    <div class="wrapper wrapper-content">
        <div class="row animated fadeInRight">
            <div class="col-md-5">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Profile Detail</h5>
                    </div>

                    <div>
                        <div class="ibox-content border-left-right">
                            <img alt="image" height="228" class="img-responsive" src="<?= IMG . "/actors/" . $profile['StashDirector_avatar'] ?>">
                        </div>
                        <div class="ibox-content profile-content">
                            <h4><strong><?= $profile['StashDirector_name'] ?></strong></h4>
                            <p><i class="fa fa-user"></i>  <?= $profile['StashUsers_username'] ?></p>
                            <p><i class="fa fa-mobile"></i>  <?= $profile['StashDirector_mobile'] ?></p>
                            <p><i class="fa fa-envelope"></i>  <?= $profile['StashDirector_email'] ?></p>

                            <p><b>Registered On: </b><i class="fa fa-clock-o"> <?= $this->ModelAdmin->timeElapsedString($profile['StashUsers_time'])?></i> </p>
                            
                            <p><b>Last Profile Update: </b><i class="fa fa-clock-o"> <?= $this->ModelAdmin->timeElapsedString($profile['StashDirector_last_update'])?></i> </p>
                            <p><b>Last Login: </b><i class="fa fa-clock-o"> <?= $this->ModelAdmin->timeElapsedString(end($lastLogin)['StashLogins_time'] )?></i> </p>
                            <p><b>Last Login IP : </b><?= end($lastLogin)['StashLogins_ip']  ?></i> </p>
                            <p><b>Email Confirmation: </b> <span class='label label-<?= ($profile['StashUsers_status']) ? 'success' : 'warning' ?>'><?= ($profile['StashUsers_status']) ? 'Active' : 'Pending' ?></span> </p>
                            <p><b>Mobile Confirmation: </b> <span class='label label-<?= ($profile['StashUsers_mobile_status']) ? 'success' : 'warning' ?>'><?= ($profile['StashUsers_mobile_status']) ? 'Verified' : 'Pending' ?></span> </p>
                            
                            <div class="user-button">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="<?= base_url() ?>admin/sendMail/<?= urlencode($profile['StashDirector_email']) ?>/" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Send Message</a>
                                    </div>
                                    <!-- IF Have Permission. -->
                                    <!-- <div class="col-md-6">

                                    	<button type="button" class="btn btn-danger btn-sm btn-block update-activation-status" data-id="" data-type="doctor" data-todo="2"><i class="fa fa-ban"></i>Block User</button>
                                       
                                    </div>
                                    --> 
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><i class="fa fa-map-marker"></i> Activity Details </h5>
                    </div>
                    <div class="ibox-content">
                    	<div>
                    		<p><b>Actors in List: </b> <?= $actors['count'] ?> <a href="#actorsInList">show</a></p>
                    		<p><b>Projects: </b> <?= $projects['count'] ?> <a href="#cdProjects">show</a></p>
                    		<p><b>Invitation Sent: </b> <i class="fa fa-comment"></i> <a href="#" title="View All SMSs"><?= $invitation['sms'] ?></a>, <i class="fa fa-envelope"></i> <a href="#" title="View All Emails"><?= $invitation['email'] ?></a> </p>
                    		<p><b>Message Sent: </b> <i class="fa fa-comment"></i> <a href="#" title="View All SMS"><?= $messages['sms'] ?></a>, <i class="fa fa-envelope"></i> <a href="#" title="View All SMS"><?= $messages['email'] ?></a> </p>
                    		<!-- <p><b>Pin: </b> <?= $address['pin']?></p> -->
                    	</div>
                    </div>
                </div>
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
                                        <td><?= $this->ModelAdmin->timeElapsedString($login['StashLogins_time'])?></td>
                                        <td><?= $login['StashLogins_ip'] ?></td>
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><i class="fa fa-user-secret"></i> Contact Persons</h5>
                    </div>
                    <div class="ibox-content">
                    	<?php 
                    		$index = 1;
                    		foreach ($contactPerson as $key => $person) {
                    	?>
                    	<div>
                    		<h5>Person - <?= $index++ ?></h5>
                    		<p><b>Name: </b> <?= $person['name']?></p>
                    		<p><b>Mobile: </b> <?= $person['mobile']?></p>
                    		<p><b>Email: </b> <?= $person['email']?></p>
                    		<p><b>Service: </b> <?= $person['service']?></p>
                    		<p><b>Description: </b> <?= $person['description']?></p>
                    		<p><b>Added On: </b> <?= date('Y-m-d h:i a', $person['lastUpdate'])?></p>
                    	</div>
                    	<?php } ?>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><i class="fa fa-calendar"></i> Timing Slots</h5>
                    </div>
                    <div class="ibox-content">
                    	<div>
                    		<p><b>Last Updated: </b> <?= date('Y-m-d h:i a', $timing['lastUpdated'])?></p>
                    		<div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Days</th>
                                        <th>Morning</th>
                                        <th>Afternoon</th>
                                        <th>Evening</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $color = '#239AD2';
                                    $schedule = json_decode($timing['timeSlots'], true);
                                    foreach ($schedule as $key => $days) {
                                ?>
                                    <tr>
                                        <td><b><?= ucfirst($key) ?></b></td>
                                <?php
                                    foreach ($days as $day => $slot) {
                                        if($slot == 'No Slot')
                                            $color = '#EE2E23';
                                        echo "<td style='color:{$color}'>{$slot}</td>";
                                        $color = '#239AD2';
                                    }
                                ?>
                                    </tr>
                                <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    	</div>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="row animated fadeInRight">
        	<div class="col-lg-12">
                <div class="ibox float-e-margins" id="actorsInList">
                    <div class="ibox-title">
                        <h5> Actors in List </h5>
                        
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
                                        <th>Mobile</th>
                                        <th>Added On</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        
                                        foreach($actors['profiles'] as $key => $actor){
                                    ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td> <a href="<?= base_url() ?>admin/actor/<?= $actor['StashActor_actor_id_ref']?>"><?= sprintf("%05d", $actor['StashActor_actor_id_ref'])  ?></a></td>
                                        <td><?= $actor['StashActor_name']?></td>
                                        <td><?= $actor['StashActor_email']?></td>
                                        <td><?= $actor['StashActor_mobile']?></td>
                                        <td><?= $this->ModelAdmin->timeElapsedString($actor['StashDirectorActorLink_time'])?></td>
                                        <td><label class='label label-<?= ($actor['StashDirectorActorLink_status']) ? "primary" : "warning" ?>'><?= ($actor['StashDirectorActorLink_status']) ? "In List" : "Removed" ?></label></td>
                                        
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="ibox float-e-margins" id="cdProjects">
                    <div class="ibox-title">
                        <h5> Projects </h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="footable table table-stripped toggle-arrow-tiny" id="tableData" data-page-size='20'>
                                <thead>
                                    <tr>
                                        <th data-toggle="true">#</th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Tag</th>
                                        <th>Actors</th>
                                        <th>Added On</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        
                                        foreach($projects['lists'] as $key => $list){
                                            $project = $list['project'];
                                    ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td> <a href="#"><?= sprintf("%05d", $project['StashProject_id'])  ?></a></td>
                                        <td><?= $project['StashProject_name']?></td>
                                        <td><?= $this->ModelAdmin->timeElapsedString($project['StashProject_date'])?></td>
                                        <td><?= $project['StashProject_tag']?></td>
                                        <td><?= count($list['actors'])?></td>
                                        <td><?= $this->ModelAdmin->timeElapsedString($project['StashProject_time'])?></td>
                                        <td><label class='label label-<?= ($project['StashProject_status']) ? "primary" : "warning" ?>'><?= ($project['StashProject_status']) ? "Active" : "Over" ?></label></td>
                                        
                                    </tr>

                                    <?php } ?>
                                </tbody>
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