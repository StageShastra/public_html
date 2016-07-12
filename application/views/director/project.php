<?php
  include 'includes/head.php';
 ?>
    <body>
        <style type="text/css">
          body{
            padding-top: 90px;
          }
          .rotate-img {
            -webkit-animation: rotation 2s infinite linear;
          }
          @-webkit-keyframes rotation {
              from {-webkit-transform: rotate(0deg);}
              to   {-webkit-transform: rotate(359deg);}
          }
          .email-templete {
            
          }
          .tab-content {
            padding: 10px 5px;
          }
          .conversation_container{
            padding-left: 0px;
            padding-right: 0px; 
            border-radius:6px; 
          }
          .margintop80{
            margin-top: 80px;
          }

          .message-box {
            border: 1px solid #ddd;
            padding: 5px 5px;
          }
        </style>
        <div class="container-fluid" id="home">
           
           
            <nav class="navbar navbar-default navbar-fixed-top custom-navbar">
                <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?= base_url() ?>">
                            <img src="<?= IMG ?>/logo.png" class="brands img-responsive "/>
                            <div class="vertical-middle brandname title">
                                <?= M_Title ?>
                                <br>
                                <span id="tag-line" class="firstcolor info-small hidden-xs">
                                Making Casting easier!                      
                                </span>
                            </div>
                            
                        </a>
                    </div>
                </div>
            </nav>

            
            <div class="container margintop80 conversation_container">
              
              <div class="row">
                  <div class="col-sm-8 projectSection">
                    <h3>Notification <br><small style="font-size: 13px;">On: <?= date("d/m/Y", $time) ?></small></h3>
                    <p>Sent By: <a href="#"><?= $director ?></a></p>
                    <?php
                      if( count($project) ){
                        echo "<p> Project Name: <b>{$project['StashProject_name']}</b> </p><p>Date: <b>".date('d/m/Y', $project['StashProject_date'])."</b></p>";
                      }
                    ?>
                    <hr>
                    <h4>Subject: <?= $message['StashInviteMsg_subject'] ?></h4>
                    <br>
                    <p class="message-box"><?= $message['StashInviteMsg_message'] ?></p>
                  </div>
                  <div class="col-sm-4">
                    
                    <?php
                      if(count($project)){
                          if( $response != 6 ){
                            echo "<p id='res-message'><hr>Are you coming to the audition ?</p>";
                          }else{
                            if($response == 1){
                              $l = 'success';
                              $a = 'Yes';
                            }elseif($response == 2){
                              $l = "danger";
                              $a = "No";
                            }else{
                              $l = "warning";
                              $a = "May be";
                            }
                            echo "<p id='res-message'><br> You have selected <span class='label label-{$l}'>{$a}</span>. You can change your choice anytime. </p>";
                          }
                    ?>
                    <h3>Response</h3>
                    <hr>
                    <br>
                    <i id="projectInfoId" data-id='<?= $forRef ?>' data-for='<?= $for ?>'></i>
                    <button type="button" class="btn btn-success responseToAudtion <?= ($response == 1) ? 'disabled' : '' ?>" data-response='1'>Yes</button>
                    <button type="button" class="btn btn-danger responseToAudtion <?= ($response == 2) ? 'disabled' : '' ?>" data-response='2'>No</button>
                    <button type="button" class="btn btn-warning responseToAudtion <?= ($response == 3) ? 'disabled' : '' ?>" data-response='3'>May be</button>
                    <?php } ?>
                  </div>
              </div>

            </div>
      </div>
<?php
  include 'includes/scripts.php';
?>
