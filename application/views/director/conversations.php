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
                            <img src="<?= IMG ?>/logo.png" class="brands "/>
                            <span class="vertical-middle brandname title"><?= M_Title ?></span><p><span id="tag-line" class="firstcolor info-small"><?= M_TagLine?></span>
                        </a>
                    </div> 

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  
                      <ul class="nav navbar-nav navbar-right vertical-middle">
                        <li >
                            <a href="#" class="not-active">Discover<span class="info-small"><i>(Coming Soon)</i></span></a>
                        </li>
                        <li >
                            <a href="#" data-toggle="modal" data-target="#advancedSearch" ><span class="firstcolor"> Search<sup><span class="info-small">New!</span></sup></span>
                            </a>
                        </li>
                        <li >
                            <a href="#" data-toggle="modal" data-target="#<?= ($isAllowed) ? "inviteActors" : "notAllowedModal" ?>">
                              <span class="firstcolor" > Invite </span>
                            </a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-chevron-down firstcolor" aria-hidden="true"></span></a>
                          <ul class="dropdown-menu">
                           <li><a href="#" class="changeCategory">Change Category</a></li>
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
                <li ><a data-toggle="tab" href="#email" class="contactListNav" data-for="cEmail">Email</a></li>
                <li><a data-toggle="tab" href="#sms" class="contactListNav" data-for="cSMS">SMS</a></li>
                <li class="active"><a data-toggle="tab" href="#email-invites" class="contactListNav" data-for="iEmail">Email Invites</a></li>
                <li><a data-toggle="tab" href="#sms-invites" class="contactListNav" data-for="iSMS">SMS Invites</a></li>
              </ul>

              <div class="tab-content">
                <div id="email" class="tab-pane fade in active">
                  <table class="messages table table-striped">
                    <thead>
                      <tr>
                        <th class="col-sm-3">Sent to</th>
                        <th class="col-sm-7">Subject</th>
                        <th class="col-sm-2">Time</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="toggleview" data-unhide-id="#test1">
                        <td class="col-sm-3">
                          <div class="addresse_details">
                            <img src="<?= IMG ?>/actors/5cc3650da2aa782ea3052bd7b240fa9c.jpg" class="thumbnails" data-id="'+i+'" />
                            <span class="row_text">Prashant Kiran </span>
                          </div>
                        </td>
                        <td class="col-sm-8 subject">Please come for audition on 27th of June</td>
                        <td class="col-sm-1 sent_on">22nd June</td>
                      </tr>
                      <tr>
                        <td colspan="12">
                          <div class="preview row" id="test1">
                            <div class="col-sm-3 reciepients">
                              <table class="messages table table-striped">
                                <tbody>
                                  <tr>
                                    <td class="col-sm-2 vertical_middle">
                                      <img src="<?= IMG ?>/actors/5cc3650da2aa782ea3052bd7b240fa9c.jpg" class="thumbnails_small"/>
                                    </td>
                                    <td class="col-sm-4 row_text vertical_middle">
                                      Prashant Kiran
                                      <br>
                                      <span class="contact_info">
                                        prasht63@gmail.com
                                      </span>
                                    </td>
                                    <td class="col-sm-3 vertical_middle">
                                      <span class="label label-success">Yes</span>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="col-sm-2 vertical_middle">
                                      <img src="<?= IMG ?>/actors/5cc3650da2aa782ea3052bd7b240fa9c.jpg" class="thumbnails_small" data-id="'+i+'" />
                                    </td>
                                    <td class="col-sm-4 row_text vertical_middle">
                                      Martin Brown
                                      <span class="contact_info">
                                        martinbrown@gmail.com
                                      </span>
                                    </td>
                                    <td class="col-sm-3 vertical_middle">
                                      <span class="label label-warning">Maybe</span>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="col-sm-2 vertical_middle">
                                      <img src="<?= IMG ?>/actors/5cc3650da2aa782ea3052bd7b240fa9c.jpg" class="thumbnails_small" data-id="'+i+'" />
                                    </td>
                                    <td class="col-sm-4 row_text vertical_middle">
                                      Dev Anand
                                      <span class="contact_info">
                                        devsahab63@gmail.com
                                      </span>
                                    </td>
                                    <td class="col-sm-3 vertical_middle">
                                      <span class="label label-info">Seen</span>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="col-sm-2 vertical_middle">
                                      <img src="<?= IMG ?>/actors/5cc3650da2aa782ea3052bd7b240fa9c.jpg" class="thumbnails_small" data-id="'+i+'" />
                                    </td>
                                    <td class="col-sm-4 row_text vertical_middle">
                                      Annie Besant
                                      <span class="contact_info">
                                        anniemadam@gmail.com
                                      </span>
                                    </td>
                                    <td class="col-sm-3 vertical_middle">
                                      <span class="label label-danger">No</span>
                                    </td>
                                  </tr>

                                </tbody>
                              </table>
                            </div>
                            <div class="col-sm-6">
                               <iframe src="<?= base_url() ?>director/emailPreview/?msg=dsnakjdkjahskdjhaksjhdkjhas" class="center" id="emailPreviewiFrame" width="600" height="500"></iframe>
                            </div>
                            <div class="col-sm-3">
                              <div class="conversation_summary">
                                <h3> Conversation Summary</h3>
                                <hr>
                                <span class="row_text">Recipients : 45</span>
                          
                                <span class="row_text">Responses</span><br>
                                <button class="btn btn-info" type="button">
                                  Seen <span class="badge">12</span>
                                </button>
                                <button class="btn btn-success" type="button">
                                  Yes <span class="badge">5</span>
                                </button>
                                <button class="btn btn-warning" type="button">
                                  Maybe <span class="badge">3</span>
                                </button>
                                <button class="btn btn-danger" type="button">
                                  No <span class="badge">2</span>
                                </button>
                                <br>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="col-sm-3">
                          <div class="addresse_details">
                            <button class="sentto">R</button>
                            <span class="row_text">Rachel Greene and 21 others</span>
                          </div>
                        </td>
                        <td class="col-sm-8 subject">Call for 2nd Audition for Dharma Production's Filmwale </td>
                        <td class="col-sm-1 sent_on">21st June</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div id="sms" class="tab-pane fade">
                  <h3>Menu 1</h3>
                  <p>Some content in menu 1.</p>
                </div>
                <div id="menu2" class="tab-pane fade">
                  <h3>Menu 2</h3>
                  <p>Some content in menu 2.</p>
                </div>
              </div>
            </div>
      </div>
           <!-- contact modal toggle -->
            
           

         
    

      
      <!-- Preview SMS End -->
      

            <!-- Enter Email and Mobile Modal -->
            
        <!--================================== Navigation Ends Here =======================================-!-->
<?php
  include 'includes/scripts.php';
?>
