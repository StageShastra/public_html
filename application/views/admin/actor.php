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
                    <a href="<?= base_url() ?>admin/directors/">Actors</a>
                </li>
                <li class="active">
                    <strong><?= ucfirst($profile['StashActor_name']) ?></strong>
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
                            <img alt="image" height="228" class="img-responsive" src="<?= IMG . "/actors/" . $profile['StashActor_avatar'] ?>">
                        </div>
                        <div class="ibox-content profile-content">
                            <h4><strong><?= $profile['StashActor_name'] ?></strong></h4>
                            <p><i class="fa fa-user"></i> <a href="<?= base_url() . $profile['StashUsers_username'] ?>"><?= base_url() . $profile['StashUsers_username'] ?></a></p>
                            <p><i class="fa fa-mobile"></i>  <?= $profile['StashActor_mobile'] ?></p>
                            <p><i class="fa fa-envelope"></i>  <?= $profile['StashActor_email'] ?></p>

                            <p><b>Registered On: </b><i class="fa fa-clock-o"> <?= date('Y-m-d h:i a', $profile['StashUsers_time'])?></i> </p>
                            
                            <p><b>Last Profile Update: </b><i class="fa fa-clock-o"> <?= $this->ModelAdmin->timeElapsedString($profile['StashActor_last_update'])?></i> </p>
                            <p><b>Last Login: </b><i class="fa fa-clock-o"> <?= $this->ModelAdmin->timeElapsedString(end($lastLogin)['StashLogins_time'] )?></i> </p>
                            <p><b>Last Login IP : </b><?= end($lastLogin)['StashLogins_ip']  ?></i> </p>
                            <p><b>Email Confirmation: </b> <span class='label label-<?= ($profile['StashUsers_status']) ? 'success' : 'warning' ?>'><?= ($profile['StashUsers_status']) ? 'Active' : 'Pending' ?></span> </p>
                            <p><b>Mobile Confirmation: </b> <span class='label label-<?= ($profile['StashUsers_mobile_status']) ? 'success' : 'warning' ?>'><?= ($profile['StashUsers_mobile_status']) ? 'Verified' : 'Pending' ?></span> </p>
                            
                            <div class="user-button">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="<?= base_url() ?>admin/compose_mail/<?= urldecode($profile['StashActor_email']) ?>/" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Send Message</a>
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
                        <h5> Casting Directors </h5>
                        
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="footable table table-stripped toggle-arrow-tiny" id="tableData" data-page-size='20'>
                                <thead>
                                    <tr>
                                        <th data-toggle="true">#</th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Added On</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        
                                        foreach($directors as $key => $director){
                                    ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td> <a href="<?= base_url() . "admin/director/" . $director['StashDirector_director_id_ref'] ?>"><?= sprintf("%05d", $director['StashDirector_director_id_ref'])  ?></a></td>
                                        <td><?= $director['StashDirector_name']?></td>
                                        <td><?= $this->ModelAdmin->timeElapsedString($director['StashDirectorActorLink_time'])?></td>
                                        <td><label class='label label-<?= ($director['StashDirectorActorLink_status']) ? "primary" : "warning" ?>'><?= ($director['StashDirectorActorLink_status']) ? "In List" : "Removed" ?></label></td>
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
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
                <div class="ibox float-e-margins">

                    <div class="ibox-content">

                        <h2>Image Gallery</h2>
                        <div class="lightGallery" id='links'>
                            <?php
                                $images = json_decode($profile['StashActor_images'], true);

                                foreach ($images as $key => $image) {
                                    $a = IMG . "/actors/" . $image;
                                    echo "<a href='{$a}' target='_blank' title='{$profile['StashActor_name']} Image'> <img src='{$a}' class='img-responsive'> </a>";
                                }


                            ?>

                        </div>

                    </div>
                </div>

                <div class="ibox float-e-margins" id="actorsInList">
                    <div class="ibox-title">
                        <h5> Experiences ( <?= count($experiences) ?> )</h5>
                        
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="footable table table-stripped toggle-arrow-tiny" id="tableData" data-page-size='20'>
                                <thead>
                                    <tr>
                                        <th data-toggle="true">#</th>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Role</th>
                                        <th>Desc</th>
                                        <th>Video</th>
                                        <th>Added On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        
                                        foreach($experiences as $key => $experience){
                                    ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td> <a href="#"><?= sprintf("%05d", $experience['StashActorExperience_id'])  ?></a></td>
                                        <td><?= $experience['StashActorExperience_title']?></td>
                                        <td><?= $experience['StashActorExperience_role']?></td>
                                        <td><?= $experience['StashActorExperience_blurb']?></td>
                                        <td><a href='<?= $experience['StashActorExperience_link']?>' target='_blank'> view </a></td>
                                        <td><?= $this->ModelAdmin->timeElapsedString($experience['StashActorExperience_time'])?></td>
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="ibox float-e-margins" id="actorsInList">
                    <div class="ibox-title">
                        <h5> Trainings ( <?= count($trainings) ?> )</h5>
                        
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="footable table table-stripped toggle-arrow-tiny" id="tableData" data-page-size='20'>
                                <thead>
                                    <tr>
                                        <th data-toggle="true">#</th>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Course</th>
                                        <th>Period</th>
                                        <th>Desc</th>
                                        <th>Added On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        
                                        foreach($trainings as $key => $training){
                                    ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td> <a href="#"><?= sprintf("%05d", $training['StashActorTraining_id'])  ?></a></td>
                                        <td><?= $training['StashActorTraining_title']?></td>
                                        <td><?= $training['StashActorTraining_course']?></td>
                                        <td><?= $training['StashActorTraining_start_time'] . " - " . $training['StashActorTraining_end_time']?></td>
                                        <td><?= $training['StashActorTraining_blurb']?></td>
                                        <td><?= $this->ModelAdmin->timeElapsedString($training['StashActorTraining_time'])?></td>
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