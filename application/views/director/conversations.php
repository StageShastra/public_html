<?php
  include 'includes/head.php';
 ?>
    <body>
        <style>
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
      
        .ui-autocomplete.ui-widget-content{
        z-index: 1200;
        }
        #emailPreview, #previewSMS{
          z-index: 1200;
        }
        iframe#emailPreviewiFrame{
          border: none;
        }
        #emailtab, #smstab .active{
          border: 1px solid #FF3B49;
          padding: 0px;
          /* margin: 0px; */
          border-bottom: 0px;
          border-radius: 4px 4px 0px 0px;
        }
        .nav-tabs>li>a {
          margin-right: 0px;
        }
        .contact_inputs{
          height: 40px;
          border: 2px solid #EAEAEA;
          font-size: 14px;
          padding: 8px 8px 8px 8px;
          margin-bottom: 5px;
          border-radius: 0px;
              -webkit-box-shadow: none;
        }
        .contact_textarea{
          height: 340px;
        }
        .contact_inputs :focus{
          border: 1px solid #ff3b49;
        }
        .form-control:focus {
          border-color: #FF003A;
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 2px rgba(255, 0, 0, 0.6);
          border: 1px;
      }
      .form-group{
        margin-bottom: 0px;
      }
      .margintop80{
        margin-top: 80px;
      }
      .conversation_container{
        border:1px solid #ddd;
        padding-left: 0px;
        padding-right: 0px; 
        border-radius:6px; 
      }
      .messages{
        padding: 10px 30px;
      }
      .thumbnails{
        height: 50px;
        border-radius: 50%;
        border: 1px solid #ddd;
      }
      .thumbnails_small
      {
        height: 35px;
      }
      .row_text{
        font-family: "Open Sans","Raleway";
        font-size: 14px;
        color: #777;
      }
      .sentto{
        font-family: "Raleway";
        font-size: 30px;
        color: #fff;
        height: 50px;
        width: 50px;
        border-radius: 50%;
        background: #009688;
        border: 0px;
        box-shadow: 2px 2px 10px gray;
        vertical-align: middle;
      }
      .subject
      {
        text-align: left;
        vertical-align: middle !important;
        font-family: "Open Sans","helvetica";
        font-size: 14px;
        color: #777;
      }
      .sent_on{
        text-align: center;
        vertical-align: middle !important;
        font-family: "Open Sans","helvetica";
        font-size: 14px;
        color: #777;

      }
      table{
        margin-top: 0px;
      }
      .addresse_details{
        font-weight: 800;
      }
      iframe#emailPreviewiFrame{
          border: none;
      }
      .vertical_middle{
        vertical-align: middle;
      }
      .nohover:hover{
        background: #fff;
      }
      .preview{
        display: none;
      }
      .label-info {
        background-color: #5bc0de;
      }
      .btn-info{
        background-color: #5bc0de; 
      }
      .reciepients{
        max-height: 500px;
        overflow-y: scroll; 
      }
      .contact_info{
        font-size: 11px;
        font-style: italic;
        color: #4a444a;

      }
      .ul_list a{
          color:#A4A6A9 !important;
          font-size: 14px !important;
      }
      .ul_list a:hover {
          background-color: #ffd6d9 !important;
          background-image: none;
          color : #fff !important;
      }
      .btn{
        font-size: 12px;
        margin-right: 5px;
        margin-top: 5px;
      }
      .btn-info:hover{
        background: #0288D1;
      }
      .badge{
        font-size: 9px;
      }
      .btn .badge {
        position: relative;
        top: 0px;
      }
      tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
    color: #555;
    cursor: default;
    background-color: #fff;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
    outline: none;
    border-color: #607D8B;
    box-shadow:0px 0px 10px #607D8B;
}
@media screen and (min-width: 992px) and (max-width:1199px) {
.conversation_summary{
    background: rgba(255,255,255,00.9);
    box-shadow: 2px 2px 10px gray;
    padding: 10px 5px 10px 10px;
    border-radius: 10px;
}
}
      </style>
     
        

        <!--===========================================================================================!-->

        <!-- Ths section is post selection !-->
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
                    <style>
                    .ul_list a{
                        color:#A4A6A9 !important;
                        font-size: 14px !important;
                    }
                    .ul_list a:hover {
                        background-color: #ffd6d9 !important;
                        background-image: none;
                        color : #fff !important;
                    }
                    </style>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  
                      <ul class="nav navbar-nav navbar-right ul_list">
                        <li >
                            <a href="<?= base_url()?>director/"  > Dashboard
                            </a>
                        </li>
                        <li >
                            <a href="<?= base_url()?>director/account"  > Account
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Project</a>
                            </a>
                            <ul class="dropdown-menu">
                             <li><a href="<?= base_url() . "director/allprojects" ?>" >View all projects</a></li>
                             <li><a href="<?= base_url() . "director/newproject" ?>" >Create new project</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-chevron-down firstcolor" aria-hidden="true"></span></a>
                          <ul class="dropdown-menu">
                           <li><a href="#" class="changeCategory">Change Category</a></li>
                           <li><a href="<?= base_url() . "director/conversations" ?>" >Conversations</a></li>
                            <!--<li><a href="add_actor.php">Add</a></li>
                            <li><a class="not-active" href="#">Import</a></li>
                            <li><a class="not-active" href="#">Export</a></li>
                            <li role="separator" class="divider"></li>-->
                            <li><a href="<?= base_url() ?>home/logout/">Sign-Out</a></li>
                          </ul>
                        </li>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>


            
            <div class="container-fluid margintop80 conversation_container">
              <ul class="nav nav-tabs nav-justified">
                <li class="active"><a data-toggle="tab" href="#email" class="contactListNav" id='clickFirst' data-for="cEmail">Email</a></li>
                <li><a data-toggle="tab" href="#sms" class="contactListNav" data-for="cSMS">SMS</a></li>
                <li ><a data-toggle="tab" href="#email-invites" class="contactListNav" data-for="iEmail">Email Invites</a></li>
                <li><a data-toggle="tab" href="#sms-invites" class="contactListNav" data-for="iSMS">SMS Invites</a></li>
              </ul>
              <div class="iid" style="cursor:default;">
              <div class="tab-content">
                <div id="email" class="tab-pane fade in active">
                  <table id="email_table" class="messages table table-striped">
                    <thead>
                      <tr>
                        <th class="col-sm-3">Sent to</th>
                        <th class="col-sm-7">Subject</th>
                        <th class="col-sm-2">Time</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
                <div id="sms" class="tab-pane fade">
                  <table class="messages table table-striped">
                    <thead>
                      <tr>
                        <th class="col-sm-3">Sent to</th>
                        <th class="col-sm-7">Subject</th>
                        <th class="col-sm-2">Time</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
                <div id="email-invites" class="tab-pane fade ">
                  <table class="messages table table-striped">
                    <thead>
                      <tr>
                        <th class="col-sm-3">Sent to</th>
                        <th class="col-sm-7">Subject</th>
                        <th class="col-sm-2">Time</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
                <div id="sms-invites" class="tab-pane fade">
                  <table class="messages table table-striped">
                    <thead>
                      <tr>
                        <th class="col-sm-3">Sent to</th>
                        <th class="col-sm-7">Subject</th>
                        <th class="col-sm-2">Time</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
           <!-- contact modal toggle -->
           <?php include 'includes/modals.php'; ?>
            
           

         
    

      
      <!-- Preview SMS End -->
      

            <!-- Enter Email and Mobile Modal -->
            
        <!--================================== Navigation Ends Here =======================================-!-->
<script type="text/javascript">
  convo = true;
</script>
<?php
  include 'includes/scripts.php';
?>
