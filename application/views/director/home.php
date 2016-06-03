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
              </style>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Modal Section : Contact Form -->
          <div id="contactmodal" class="col-sm-8 fade contact-form" style="max-width: 550px;max-height:440px;display:none;">
            <div class="row">
              <div class="col-sm-4">
                <font class="info dark-gray"> <span id="totalSelected"></span> Selected</font>
                <hr>
                <div id="selected-actors"></div>
                <div id="deleteAllSelected">
                  <button type="button" title="Remove All" class="btn submit-btn firstcolor " id="deleteAllSelectedBtn"><i class="glyphicon glyphicon-trash"></i></button>
          <button type="button" class="btn submit-btn firstcolor resetAllContact" data-form="" style="margin-left:10px;" ><span class="glyphicon glyphicon-repeat"></span></button>
                </div>
              </div>
              <div class="col-sm-8 contact-right">
                <font class="info dark-gray">Contact</font>
                <hr>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#contactViaEmail" aria-controls="home" role="tab" data-toggle="tab">Via Email</a></li>
                  <li role="presentation"><a href="#contactViaSMS" aria-controls="profile" role="tab" data-toggle="tab">Via SMS</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="contactViaEmail">
          <input type="text" class="contact-subject email-field" id="subject" placeholder="Subject"/>
          <textarea class="contact-message email-field" id="message" placeholder="Type your message here."></textarea>
            
          <button type="submit" class="btn submit-btn firstcolor sendMail" id="btn-login" ><span class="glyphicon glyphicon-send"></span> &nbsp; Send Email</button>
          <button type="button" class="btn submit-btn firstcolor previewEmailBtn" data-id="#message" style="margin-left:10px;" ><span class="glyphicon glyphicon-camera "></span> &nbsp; Preview</button>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="contactViaSMS">
                    <textarea class="contact-sms sms-field" id="textsms" maxlength=280 placeholder="Type your sms text here."></textarea>

                    <span class="info-small gray pull-right">
                      ( <span id="audi-charCounter">160</span> / 
                      <span id="audi-msgCounter">0</span> )
                    </span>

                    <button type="submit" class="btn submit-btn firstcolor sendSMS" id="btn-login" ><span class="glyphicon glyphicon-send"></span> &nbsp; Send SMS</button>
                    <button type="button" class="btn submit-btn firstcolor previewSMSBtn" data-id="#textsms" style="margin-left:10px;" ><span class="glyphicon glyphicon-camera "></span> &nbsp; Preview</button>
                  </div>
                </div>

                
              </div>  
            </div>  
          </div>
        <!-- Ths section is pre selection !-->
        <div class="container" id="prelogin">
          <div class="col-sm-1">
          </div>
          <div class="container-fluid col-sm-10"> <!--container fluid starts -->
            <div class="center headname padded">
              <img src="<?= IMG ?>/logo.png" class="logo img-fluid rotate-img"/><span class="title"><?= M_Title ?></span>
            </div>
            <div class="row center light-padded">
              <div class="col-sm-10 center" id="categories">
              </div>
            </div>
          </div>
          <div class="col-sm-1">
          </div>
        </div>
        <!-- Ths section is pre selection !-->

        <!--===========================================================================================!-->

        <!-- Ths section is post selection !-->
        <div class="container-fluid hidden" id="home">
           
           
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
           <!-- contact modal toggle -->
            <div class="container-fluid padded">
                <span class="submit-btn firstcolor notice-selected-actors">
                  <p><span>2</span> Selected</p>
                </span>
                <button type="submit" class="btn submit-btn firstcolor contact-btn populateContactForm" data-toggle="modal" data-target="#<?= ($isAllowed) ? "contactmodal" : "notAllowedModal" ?>"><span class="glyphicon glyphicon-edit"></span></button>
                <div class="alert alert-success" id="success_send" role="alert">Mail sent to all the actors.</div>
                <div class="alert alert-danger"  id="failure_send" role="alert">Error sending mail! Please try again.</div>
                <div class="container col-sm-12 center" id="browse-table">
                      
                </div>
                <div class='container col-sm-12 center' id="main-container"></div>
            </div>
            <input type="checkbox" name="checkboxG1" id="checkboxG1" class="css-checkbox" />
   
           </div>
           

          <!-- Advanced Search Modal -->
          <div id="advancedSearch" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title firstcolor info"><?= CD_AdvSearch ?></h4><span class="info-small gray"><?= CD_AdvSearchSmall ?></span>
                </div>
                <div class="modal-body" style="background-color:#f2f2f2;">
                  <div class="container" style="max-width:100%; ">
                    <form action="#" method="post" id="advanceSearch">
                        <div class="row">
                          <div class="col-sm-6 form-group no-paddinglr">
                              <span class="info-small gray">Age Range (Min)</span> <input type="text" class="form-control add" id="aagemin" name="agemin"  placeholder= "from age:"  />
                              <span class="info-small gray">Sex(M/F) </span> <input type="text" class="form-control add" id="asex" name="sex" placeholder= "M/F:"  />

                          </div>
                          <div class="col-sm-6 form-group no-paddinglr">
                              <span class="info-small gray">Age Range (Max) </span> <input type="text" class="form-control add" id="aagemax"  name="agemax" placeholder= "upto age :"  />
                              <span class="info-small gray">Skills(tag)</span>  <input type="text" data-role="tagsinput" class="form-control add" id="askills" name="skills" placeholder= "Skills :"  />
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6 form-group no-paddinglr">
                              <span class="info-small gray">Min. Height (in cm) </span> <input type="text" class="form-control add" id="aheightmin" name="heightmin" placeholder= "from height (in cms) :"  />
                              <span class="info-small gray">Projects(tag) <input type="text" data-role="tagsinput" class="form-control add" id="aprojects" name="projects" placeholder= "Projects"  />
                          </div>
                          <div class="col-sm-6 form-group no-paddinglr">
                              <span class="info-small gray">Max. Height (in cm) </span> <input type="text" class="form-control add" id="aheightmax"  name="heightmax" placeholder= "upto height (in cms) :"  />
                              <span class="info-small gray">Actor Names(tag) <input type="text" data-role="tagsinput" class="form-control add" id="actr_name" name="actor_names" placeholder= "Actor Names"  />
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6 form-group no-paddinglr">
                             <button type="submit" class="btn submit-btn firstcolor" style="margin-top: 20px; margin-left:10px;" id="btn-search" ><span class="glyphicon glyphicon-filter"></span> &nbsp; Search</button>
                             <button type="button" class="btn submit-btn firstcolor resetAll" data-form="advanceSearch" style="margin-top: 20px; margin-left:10px;" id="btn-search" ><span class="glyphicon glyphicon-repeat"></span> &nbsp; Clear Form</button>
                          </div>
                          <div class="col-sm-6 form-group no-paddinglr">
                             
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
                
              </div>

            </div>
    </div>
    

      <!-- Preview  Email start-->
      <div id="emailPreview" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content" style="min-width: 680px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title firstcolor info"> Email Preview </h4>
            <span class="info-small gray"></span>
          </div>
          <div class="modal-body" style="background-color:#f2f2f2;">
            <div class="container" style="max-width:100%; ">
            <iframe src="#" id="emailPreviewiFrame" width="620" height="550">
              
            </iframe>
            </div>
          </div>
          
          </div>

        </div>
      </div>
      <!-- Preview Email End -->

      <!-- Preview  SMS start-->
      <div id="previewSMS" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title firstcolor info"> SMS Preview </h4>
            <span class="info-small gray"></span>
          </div>
          <div class="modal-body" style="background-color:#f2f2f2;">
            <div class="container" style="max-width:100%; ">
              <p id="previewSMSTxt"></p>
            </div>
          </div>
          
          </div>

        </div>
      </div>
      <!-- Preview SMS End -->


      <div id="notAllowedModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title firstcolor info"> <?= CD_ModWaitingAct?> </h4>
            <span class="info-small gray"></span>
          </div>
          <div class="modal-body" style="background-color:#f2f2f2;">
            <div class="container" style="max-width:100%; ">
            <div class="jumbotron">
              <p>
                <?= CD_ModWaitingActMsg ?>
              </p>
            </div>
            </div>
          </div>
          
          </div>

        </div>
      </div>
      
      <div id="inviteSuccess" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title firstcolor info"> <?= CD_InviteSuc ?> </h4><span class="info-small gray"></span>
          </div>
          <div class="modal-body" style="background-color:#fff;">
              <p id="inviteSuccessMsg info gray" style="font-family:'Raleway',sans-serif; font-size:15px;margin-top:15px;margin-bottom:18px;">
                <?= CD_InviteSucMsg ?>
              </p>
          </div>
          
          </div>

        </div>
      </div>

            <!-- Enter Email and Mobile Modal -->
            <div id="inviteActors" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title firstcolor info"> Invite Actors </h4>
                    <span class="info-small gray"><?= CD_InviteActMsg ?></span>
                  </div>
                  <div class="modal-body" style="background-color:#fff;">
                    <div class="container" style="max-width:100%; ">

          <div class="alert alert-info" role="alert">
            <?
              if($count_emails==1)
              {
                echo "You have sent " .$count_emails." Email and have used". $count_sms ." SMS credit till today.";
              }
              else
              {
                echo "You have sent " .$count_emails." Emails and have used". $count_sms ." SMS credits till today.";
              }
            ?>
            </div>
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" id="#emailtab" class="active"><a href="#viaEmail" aria-controls="home" role="tab" data-toggle="tab">Via Email</a></li>
                        <li role="presentation" id"#smstab"><a href="#viaSMS" aria-controls="profile" role="tab" data-toggle="tab">Via SMS</a></li>
                      </ul>
                      <div class="clearfix"></div>
                      

                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="viaEmail">
                          <form action="#" method="post" id="emailInvitationForm">
              <div class="row">
                              <div class="col-sm-6 form-group no-paddinglr">
                                <span class="info-small">
                                  <b></b>
                                </span>
                                <span class="info-small gray">
                                  Project Name: <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="<?= CD_ProjTitle ?>"></i>
                                </span> 
                                <input type="text" class="form-control  contact_inputs projectName"  name="project_name"  placeholder="Project Name" required/>
                
                </div>
                              <div class="col-sm-6 form-group no-paddinglr">
                                <span class="info-small gray">
                                  Project Date: <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="<?= CD_TitleDate ?>"></i>
                                </span> 
                                <input type="date" class="form-control contact_inputs" name="project_date" value="<?= date("Y-m-d") ?>" required />
                              </div>
                            </div>
                            <div class="row">

                              <div class="col-sm-12 form-group no-paddinglr">
                                <!-- <span class="info-small gray">
                                  Emails (comma seperated)
                                </span>  -->
                                <textarea class="form-control contact_inputs contact_textareas" name="emails"  placeholder="Emails (comma seperated)" required rows="3" /></textarea>
                              </div>

                            </div>
              <div class="row">

                              <div class="col-sm-12 form-group no-paddinglr">
                                <input class="form-control contact_inputs" name="subject"  placeholder="Subject" required  />
                              </div>

                            </div>
                            <div class="row email-templete">

                              <div class="col-sm-12 form-group no-paddinglr">

                                <span class="info-small gray">
                                  Dear Actor, <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="<?= CD_TitleTxt ?>"></i>
                      
                                </span> 
                                <textarea class="form-control contact_inputs contact_textareas" name="email-msg" id="emailtxtMsg"  placeholder="Message Text" rows="5" required /></textarea>
                                <button type="button" class="btn submit-btn firstcolor pull-right addSuggestionText" data-name="email-msg" data-add="Please click the button below and follow the steps to share your details with us." style="margin-top: 20px; margin-left:10px;" id="btn-search" > Suggested Text </button>
                              </div>

                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-12 form-group no-paddinglr center">
                                <button type="submit" class="btn submit-btn firstcolor" style=" margin-left:10px;" id="btn-search" ><span class="glyphicon glyphicon-envelope"></span> Send </button>
                                <button type="button" class="btn submit-btn firstcolor resetAll" data-form="emailInvitationForm" style="margin-left:10px;" ><span class="glyphicon glyphicon-repeat"></span> &nbsp; Clear Form</button>
                                
                                <button type="button" class="btn submit-btn firstcolor previewEmailBtn" data-id="#emailtxtMsg" style="margin-left:10px;" ><span class="glyphicon glyphicon-camera "></span> &nbsp; Preview</button>
                             </div>
                            </div>
                          </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="viaSMS">
                            
                          <form action="#" method="post" id="smsInvitationForm">
              <div class="row">
                              <div class="col-sm-6 form-group no-paddinglr">
                                <span class="info-small">
                                  <b></b>
                                </span>
                                <span class="info-small gray">
                                  Project Name: <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="<?= CD_ProjTitle ?>"></i>
                                </span> 
                                <input type="text" class="form-control contact_inputs projectName" name="project_name" placeholder="Project Name" required />
                              </div>
                              <div class="col-sm-6 form-group no-paddinglr">
                                <span class="info-small gray">
                                  Project Date: <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="<?= CD_TitleDate ?>"></i>
                                </span> 
                                <input type="date" class="form-control contact_inputs" name="project_date" value="<?= date("Y-m-d") ?>" required>
                              </div>
                            </div>
                            <div class="row">

                              <div class="col-sm-12 form-group no-paddinglr">
                                <!-- <span class="info-small gray">
                                  Emails (comma seperated)
                                </span>  -->
                                <textarea class="form-control contact_inputs contact_textareas" name="mobiles"   placeholder="Mobile Numbers (comma seperated)" required rows="3" ></textarea>
                
                </div>

                            </div>

                            <div class="row email-templete">

                              <div class="col-sm-12 form-group no-paddinglr">

                                <span class="info-small gray">
                                  Dear Actor, <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="<?= CD_TitleTxt ?>"></i>
                                </span> 
                                <textarea class="form-control contact_inputs" name="sms" id="text-sms" placeholder="Message Text" rows="3" required ></textarea>

                                <span class="info-small gray pull-right">
                                  ( <span id="invite-charCounter">160</span> / 
                                  <span id="invite-msgCounter">0</span> )
                                </span>

                                <button type="button" class="btn submit-btn firstcolor pull-right addSuggestionText" data-name="sms" data-add="<?= CD_SuggTxt ?>" style="margin-top: 20px; margin-left:10px;" id="btn-search" > Suggested Text </button>

                                <span class="info-small">
                                  Powered by Castiko
                                </span> 
                              </div>

                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-12 form-group no-paddinglr center">
                                <button type="submit" class="btn submit-btn firstcolor" style="margin-left:10px;" id="btn-search" ><span class="glyphicon glyphicon-envelope"></span> Send </button>
                                <button type="button" class="btn submit-btn firstcolor resetAll" data-form="smsInvitationForm" style=" margin-left:10px;" ><span class="glyphicon glyphicon-repeat"></span> &nbsp; Clear Form</button>
                                <button type="button" class="btn submit-btn firstcolor previewSMSBtn" data-id="#text-sms" style=" margin-left:10px;" ><span class="glyphicon glyphicon-camera "></span> &nbsp; Preview</button>


                              </div>
                            </div>
                          </form>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div id="detailsActor" class="modal fade col-sm-10 center" role="dialog">
            <div class="modal-dialog" style="width:100%;">

              <!-- Modal content-->
              <div class="modal-content center" style="width:100%;">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title firstcolor info">Actor's Details</h4>
                </div>
                <div class="modal-body" id="actor_detail"  style="background-color:#fff;">
                  
                </div>
                </div>
                
              </div>

            </div>
          </div>
      <script>
      var isAllowed = <?= ($isAllowed) ? 1 : 0; ?>;
      </script>
        <!--================================== Navigation Ends Here =======================================-!-->
<?php
  include 'includes/scripts.php';
?>