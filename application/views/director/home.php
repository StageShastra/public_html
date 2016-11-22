<?php
  include 'includes/head.php';


  // to check plan expired
    if($plan['StashDirectorPlan_status'] == 0){
        // Plane Expired 
    }

    
 ?>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>
//this works when data-role is disabled.
$(function(){
  $("#tags").autocomplete({
    source: "http://localhost:8888/public_html/autocomplete/tags" // path to the get_birds method
  });
});


//This is not yet working it is a partial code copied from act.js
$(".bootstrap-tagsinput input").addClass("tags");
var ac = "language";

  function split( val ) {
      return val.split( /,\s*/ );
    }

  function extractList(term) {
    return split( term ).pop();
  }

  $("#tags")
    .autocomplete({
      minLength: 1,
      source: function(request, response){
        $.getJSON(base + "actor/skillSuggestions/" + ac, {
          term: extractList(request.term)
        }, response);
      },
      search: function(){
        var term = extractList(this.value);
        if(term.length < 2){
          return false;
        }
      },
      focus: function(){
        return false;
      },
      select: function(event, ui){
        var terms = split($("input#"+ac).val());
        console.log(terms);
        //terms.pop();
        terms.push(ui.item.value);
        $("#"+ac+"_edit "+ ".bootstrap-tagsinput input").before('<span class="tag label label-info">'+ui.item.value+'<span data-role="remove"></span></span>');
        //terms.push("");
        this.value = '';
        $("input#" + ac).val(terms);
        console.log(terms);
        return false;
      }
    });

</script>

    <body>
        <style>
          body{
            padding-top: 90px;
            padding-bottom: 0px;
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
      .info{
        font-family: "Roboto","Open Sans";
        font-size: 15px;
      }
      .profile_image{
        height: 75px;
        width: 75px;
        border-radius: 50%;
        border: 2px solid white;
        transition: all .2s ease-in-out;

      }
      .profile_image:hover{
        transform: scale(1.1);
      }
      thead{
        font-family: "Open Sans";
        font-size: 16px;
        font-weight: 600;
        background: white;
        text-align: left;
        
      }
      th{
        color: #FF9800;
      }
      table{
        border: 1px solid #ddd;
        margin-top: 10px;
      }
      .row_btn{
        color:#FF9800;
        margin-left: 5px;
      }
      .row_btn:hover{
        color: #F44336;
      }
      .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
    
        border-color: #ddd;
        box-shadow:none; 
    }
    .submit-btn {
    padding: 4px 8px;
    }
    .navbar-nav > li > a:hover{
      color: #fff;
      background:#F7A9A9;
      border-radius:30px; 
    }
    .footer-items a {
      color: rgba(255,255,255,0.7);
    }
    .footer-items a:hover {
      color: rgba(255,255,255,1);
      text-decoration: none;
    }

    .composeBox-input input {
      font-size: 13px;
    }

    .toggleSearchfilter {
      margin: 0 5px;
      width:auto; 
      min-width:1px;
      background-color: #F44336;
      color:white;
      margin-left: 15px;
    }
    .toggleSearchfilter:hover{
      color:white;
    }
    .removeSearchFilter{
      color: white;
      transition: all .2s ease-in-out;
    }
    .removeSearchFilter:hover{
      transform:scale(1.3);
    }

    .actormodaltitle{
      font-weight: bold;
      text-transform: uppercase;
      font-size: 2rem !important;
      padding: 5px;
      border-radius: 5px;
    }

    .actormodaltitle:hover {
      text-decoration: none !important;
      background: #ff9800 !important;
      color: black !important;
    }
    div.panel {
      background-color: white;
      max-height: 90px;
      overflow-x: scroll;
      opacity: 1;
      width: 100%;
    }
              </style>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Modal Section : Contact Form -->
          <div id="contactmodal" class="col-sm-8 fade contact-form" style="max-width: 550px;display:none;">
            <div class="row">
              <div class="col-sm-4">
                <font class="info dark-gray"> <span id="totalSelected"></span> Selected</font>
                <hr>
                <div class="selectedActors"></div>
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
                    
                    <div class="row composeBox-input">
                      <div class="col-sm-6 form-group">
                        <input type="text" class="form-control contact_inputs projectName" name="project_name" id='cEmail_PName' placeholder="Project Name" required />
                      </div>
                      <div class="col-sm-6 form-group"> 
                        <input type="date" class="form-control contact_inputs" name="project_date" id='cEmail_PDate' value="<?= date("Y-m-d") ?>" required>
                      </div>
                    </div>

                    <input type="text" class="contact-subject email-field" id="subject" placeholder="Subject"/>
                    <textarea class="contact-message email-field" id="message" placeholder="Type your message here."></textarea>
                    <input type="checkbox" id='emailCheck' name="emailCheck" class="css-checkbox" value="1"><label for='emailCheck' class="css-label">Is this an Audition Message ?</label>
                    <button type="submit" class="btn submit-btn firstcolor sendMail" id="btn-login" ><span class="glyphicon glyphicon-send"></span> &nbsp; Send Email</button>
                    <button type="button" class="btn submit-btn firstcolor previewEmailBtn" data-id="#message" style="margin-left:10px;" ><span class="glyphicon glyphicon-camera "></span> &nbsp; Preview</button>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="contactViaSMS">

                    <div class="row composeBox-input">
                      <div class="col-sm-6 form-group">
                        <input type="text" class="form-control contact_inputs projectName" name="project_name" id='cSMS_PName' placeholder="Project Name" required />
                      </div>
                      <div class="col-sm-6 form-group"> 
                        <input type="date" class="form-control contact_inputs" name="project_date" id='cSMS_PDate' value="<?= date("Y-m-d") ?>" required>
                      </div>
                    </div>

                    <textarea class="contact-sms sms-field" id="textsms"  maxlength=410 placeholder="Type your sms text here."></textarea>

                    <span class="info-small gray pull-right">
                      ( <span id="audi-charCounter">160</span> / 
                      <span id="audi-msgCounter">0</span> )
                    </span>
                    <input type="checkbox" id='smsCheck' name="smsCheck" class="css-checkbox" value="1"><label for='smsCheck' class="css-label">Is this an Audition Message ?</label>
                    <button type="submit" class="btn submit-btn firstcolor sendSMS" id="btn-login" ><span class="glyphicon glyphicon-send"></span> &nbsp; Send SMS</button>
                    <button type="button" class="btn submit-btn firstcolor previewSMSBtn" data-id="#textsms" style="margin-left:10px;" ><span class="glyphicon glyphicon-camera "></span> &nbsp; Preview</button>
                  </div>
                </div>

                
              </div>  
            </div>  
          </div>
          <!-- Advanced Search Modal -->
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
                        <div class="col-sm-6 form-group no-paddinglr">
                          <span class="info-small gray">Tags </span> <input type="text" class="form-control add" id="tags"  name="tags" placeholder= "Tags"  />
                          
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-6 form-group no-paddinglr">
                          <!-- Insert a checkbox here and with name='dponly' -->
                          <br>
                          <input type="checkbox" id='dponly' name="dponly" class="css-checkbox" value="1"><label for='dponly' class="css-label info-small gray"> <small>Include profiles only with display pictures.</small>  </label>
                          <hr>
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

          <!-- Modal Section : Bulk Actions -->
          <div id="bulkActionModel" class="col-sm-8 fade contact-form" style="max-width: 550px;max-height:440px;display:none;">
            <div class="row">
              <div class="col-sm-4">
                <font class="info dark-gray"> <span id="totalSelected"></span> Selected</font>
                <hr>
                <div class="selectedActors"></div>
                <div id="deleteAllSelected">
                  <button type="button" title="Remove All" class="btn submit-btn firstcolor " id="deleteAllSelectedBtn"><i class="glyphicon glyphicon-trash"></i></button>
                  
                  <button type="button" class="btn submit-btn firstcolor resetAllContact" data-form="" style="margin-left:10px;" ><span class="glyphicon glyphicon-repeat"></span></button>
                </div>
              </div>
              <div class="col-sm-8 contact-right">
                <font class="info dark-gray">Bulk Action</font>
                <hr>
                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="contactViaEmail">

                    <button type="submit" class="btn submit-btn firstcolor bulkUserRemove" id="btn-login" ><span class="fa fa-ban"></span> &nbsp; Delete Selected</button>

                    <button type="button" class="btn submit-btn firstcolor toggleProjectBox" data-hide='1' style="margin-left:10px;" ><span class="fa fa-tags"></span> &nbsp; Tag to Project</button>

                     <button type="button" class="btn submit-btn firstcolor toggleEditTagBox" data-hide='1' style="margin-left:10px;" ><span class="fa fa-tags"></span> &nbsp; Edit Tag</button>

                    <br><br>
                    <div class="row project-box" style="display:none;">
                      <p id="tagProjectErr" style="display:none;"></p>
                      <span class="info-small gray">
                        Select Project:   
                      </span> 
                      <input type="text" class="form-control contact_inputs" name="project_name" id="addPName" placeholder="Project Name" required />
                      <button type="button" class="btn submit-btn firstcolor confirmTag" style="margin-left:10px;" ><span class="fa fa-tags"></span> &nbsp; Confirm Tag</button>
                    </div>

                     <div class="row edittag-box tags" style="display:none;">
                      <p id="tagProjectErr" style="display:none;"></p>
                      <span class="info-small gray" for="tags">
                        Select Tags:   
                      </span> 
                      <input type="text" class="form-control tags autoComplete" name="tags" id="tags" placeholder="Tags" data-role="tagsinput" required />
                      <br><font class="sortbuttons"></font>

                      <button type="button" class="btn submit-btn firstcolor confirmeditTag" style="margin-left:10px;" ><span class="fa fa-tags"></span> &nbsp; Confirm Tag </button>

                      <button type="button" class="btn submit-btn firstcolor backTag" data-hide='1' style="margin-left:10px;" ><span class=""></span> Back </button>

                    </div>


                  </div>
                </div>

                
              </div>  
            </div>  
          </div>



        <!-- Ths section is pre selection !-->
        <div class="container" id="prelogin">
          <div class="col-sm-1">
          </div>
          <div class="container-fluid col-sm-10 center"> <!--container fluid starts -->
            <div class="center headname padded">
              <img src="<?= IMG ?>/logo.png" class="logo img-fluid center" id="logo_start"/><br><span class="title"><?= M_Title ?></span>
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
           
        <?php include 'includes/nav.php'; ?>


           <!-- contact modal toggle -->
            <div class="container-fluid padded">
                <span class="firstcolor notice-selected-actors">
                  <p><span>2</span> Selected</p>
                </span>


                <!---floating buttons -->
                <div>
                  <button type="submit" class="btn submit-btn firstcolor bulk-btn dropdown-toggle" data-toggle="modal" data-target='#bulkActionModel' ><span class="glyphicon glyphicon-pencil"></span></button>

                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>

                <button type="submit" class="btn submit-btn firstcolor contact-btn populateContactForm" data-toggle="modal" data-target="#<?= ($isAllowed) ? "contactmodal" : "notAllowedModal" ?>"><span class="glyphicon glyphicon-edit"></span></button>
                <!--floating buttons end-->


                <div class="alert alert-success" id="success_send" role="alert">Mail sent to all the actors.</div>
                <div class="alert alert-danger"  id="failure_send" role="alert">Error sending mail! Please try again.</div>


                <div class="filterblocks">
                  <!-- <button type="button" class="btn taga taga-selected" style="width:auto; min-width:1px;background-color: #FF9800; color:white;" aria-label="Left Align" id="Name" data-cate="Name">
                    <font class="">Name</font>
                    <span class="glyphicon glyphicon-remove pull-right no-top removeCate" aria-hidden="true" id="Name-remove" data-cate="Name"></span>
                  </button> -->
                </div>

                
                <div  class="container col-sm-12 center" style="text-align:left;" id="browse-table">
                      
                </div>
                <div class='container col-sm-12 center' id="main-container"></div>
            </div>
            <input type="checkbox" name="checkboxG1" id="checkboxG1" class="css-checkbox" />
   
           </div>


          
      </div>
      <!-- Preview EMail Start -->
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

      <!-- Invitation Success start-->
      <div id="successInvitation" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title firstcolor info"> Invitation Success  </h4>
            <span class="info-small gray"></span>
          </div>
          <div class="modal-body" style="background-color:#f2f2f2;">
            <div class="container" style="max-width:100%; ">
              <h5 style="font-family: 'Open sans';">
                We found that following contacts are already in your database. Do you want to tag them in the project or Re-Invite?   
              </h5>
              <div class="panel panel-default">
                <div class="panel-body" id='contactsDuplicate'>
                </div>
              </div>
              <button type="button" class="btn submit-btn firstcolor pull-right duplicateTags" style="margin-top: 20px; margin-left:10px;" id="btn-search" > <i class="fa fa-plus"></i> Tag </button>
              <button type="button" class="btn submit-btn firstcolor pull-right duplicateReInvite" style="margin-top: 20px; margin-left:10px;" id="btn-search" > <i class="fa fa-refresh"></i> Re-invite </button>
            </div>
          </div>
          
          </div>

        </div>
      </div>

      <div id="dupTagSucess" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title firstcolor info"> Status </h4><span class="info-small gray"></span>
          </div>
          <div class="modal-body" style="background-color:#fff;">
              <p id="dupTagSucessMsg" class="info gray" style="font-family:'Roboto',sans-serif; font-size:15px;margin-top:15px;margin-bottom:18px;">
              </p>
          </div>
          
          </div>

        </div>
      </div>
      <!-- Invitation Success End -->


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
              <p id="inviteSuccessMsg info gray" style="font-family:'Roboto',sans-serif; font-size:15px;margin-top:15px;margin-bottom:18px;">
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

          <!--
          <div class="alert alert-info" role="alert">-->
            <!--<?
              if($count_emails==1)
              {
                echo "You have sent " .$count_emails." Email and have used". $count_sms ." SMS credit till today.";
              }
              else
              {
                echo "You have sent " .$count_emails." Emails and have used". $count_sms ." SMS credits till today.";
              }
            ?>
            </div>-->
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

                                <button type="button" class="btn submit-btn firstcolor pull-right addPrevMessage" data-name="email-msg" data-from="email" data-offset="0" style="margin-top: 20px; margin-left:10px;" id="btn-search" > Previous Messages </button>
                                <br>
                                <p class="firstcolor pull-right" id="displaydate-email"></p>
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
                                <br>
                                <p class="firstcolor pull-right" id="displaydate-sms"></p>

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

            <div id="detailsActor" class="modal col-sm-10 center" role="dialog" >
            <div class="modal-dialog" style="width:100%;">

              <!-- Modal content-->
              <div class="modal-content center" style="width:100%; height: 500px;">
                <div class="" id="actor_detail">
                  
                </div>
                </div>
                
              </div>

            </div>
          </div>
      <script>
      var isAllowed = <?= ($isAllowed) ? true : false; ?>;
      </script>
        <!--================================== Navigation Ends Here =======================================-!-->
<?php
  include 'includes/footer.php';
  include 'includes/scripts.php';
?>
