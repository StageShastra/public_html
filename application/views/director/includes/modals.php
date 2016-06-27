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

          <div class="alert alert-info" role="alert"></div>
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

                    <button type="button" class="btn submit-btn firstcolor pull-right addPrevMessage" data-name="sms" data-from="sms" data-offset="0" style="margin-top: 20px; margin-left:10px;" id="btn-search" > Previous Messages </button>
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