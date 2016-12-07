<?php
  include 'includes/head.php';
 ?>

<link href="<?= CSS ?>/landingpage.css" rel="stylesheet">
    <body>
        <style>
          body{
            padding-top: 120px;
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
        
      }
      th{
        color: #FF9800;
      }
      table{
        border: 1px solid #ddd;
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
    .heading
    {
      font-size: 18px;
      color: #777788;
      font-family: Raleway;
      margin-top: 20px;
    }
    .sub_heading{
      
    }
    .data{
      font-size: 14px;
      font-family: Roboto;
    }
    .account_box .fa{
      color: #FFC107;
      margin-right: 5px;
      font-size: 10px;
      top: -2px;
      position: relative;
    }
    .account_box{
      margin-top: 20px;
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid #ddd;
      min-height: 300px;
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
.teammates td,th{
  padding: 10px 5px 0px 5px;
  color: black;
  text-align: center;
  border: none;
}
.removesidepadding{
  padding-left:0px;
  padding-right:0px; 
}
.teammates {
  border: none;
  margin-top: 0px;
  margin-bottom: 10px;
}
.projectform{
  background: #fff;
  border-radius: 5px;
  box-shadow:2px 2px 20px 2px #cacaca;
  padding: 20px 5px;
  margin-bottom:10px;
  margin-left: auto;
  margin-right: auto;
  display: block;
}
.projectinput th,td {
  text-align: left;
  padding: 5px 5px 5px 10px;
  border: none;
  vertical-align: middle;
  text-align: right;
}
.projectinput th{
  width: 200px;
}
.projectinput{
  border: none;
  align-self: center;
  width: 100%;
  table-layout: fixed;
}
.btn-center{
  margin-left: auto;
  margin-right: auto;
  display: block;
}
.radiobuttons {
  float:left;
}
button.accordion {
    cursor: pointer;
    padding: 12px;
    width: 100%;
    border-radius: 5px;
    font-size: 20px;
    text-transform: uppercase;
    background-color: white;
    border: 2px solid #f3525b;
    outline:none;
    text-align: left;
    
}
button.accordion.active, button.accordion:hover {  
    border: 2px solid #f3525b;
    background-color: #f3525b;
    color: white;
}
button.accordion.active{
    border-radius: 10px 10px 0px 0px;
}
button.accordion2 {
    cursor: pointer;
    padding: 12px;
    width: 100%;
    border-style:solid;
    border-width:0px 0px 2px 0px;
    border-color: #fcb33e;
    font-size: 16px;
    background-color: white;
    outline:none;
    text-align: left;
}
button.accordion2.active, button.accordion2:hover {
    background-color: #fcb33e;
}
button.accordion2.active{
border-radius: 0px 0px 0px 0px;
}
div.panel {
    background-color: white;
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    width: 100%;
}
div.panel.show {
    opacity: 1;
    max-height: 2000px;
    border:none;
    outline:none;
    background: #e9e9e9;
    margin: 0px 0px 10px 0px;
    border-radius: 0px 0px 10px 10px;
}
div.panel2 {
    padding: 10px 20px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    
    opacity: 0;
    width: 100%; 
}
div.panel2.show {
    opacity: 1;
    max-height: 2000px;
    border-radius: 0px 0px 0px 0px;
    border:2px solid #fcb33e;
    outline: none;
}
.col-centered{
    float: none;
    margin: 0 auto;
}
 .very-light-padded{
  padding: 0px 30px;
 }
    /* Removes the default 20px margin and creates some padding space for the indicators and controls */
              </style>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Modal Section : Contact Form -->
          
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

            <div class="top-alert-bar">
              <p>This is some message.</p>
              <!-- <a href="#" class="close-top-alert"><i class="fa fa-times"></i></a> -->
            </div>
 
<div class="container"> <!-- The Main Container -->
  <div class="col-lg-12 center">
    <h1> Set Up your Company Website </h1>
    <i class="firstcolor"> All changes saved. </i> (When saving show "Saving...")
  </div>
  <br>



  <div class="col-lg-12">
    
    <button type="button" class="accordion col-sm-12 active"><span class="glyphicon glyphicon-star"></span> &nbsp;Basic Details</button>
    <div class="panel very-light-padded show">
      <div class="col-lg-12">
        <form id="form-directorpage-first" method="post" action="" target="_blank" enctype="multipart/form-data">
          <div class="form-group">
              <label class="control-label"><h3>Company Name:</h3></label>
              <input class="form-control" type="text" name="companyname" value="<?= $pagaBasic['DirectorPage_name'] ?>">
          </div>
          <div class="form-group">
              <label class="control-label"><h3>Company URL:</h3></label>
              <input class="form-control" type="text" name="companyurl" value="<?= $pagaBasic['DirectorPage_pagename'] ?>">
              <p class="help-text">http://castiko.com/<span id="pagename-typing"><?= $pagaBasic['DirectorPage_pagename'] ?></span> <span id="pagename-typing-error"></span></p>
          </div>
          <div class="form-group">
            <label class="control-label"><h3>Company Logo:</h3></label>
            <input type="file" name="companylogo" class="showPreview"><br>

            <div class="img-preview">
              <img src="<?= IMG . "/pages/". $pagaBasic['DirectorPage_logo']  ?>" height="100" width="100">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label"><h3>About Us:</h3></label>
            <textarea class="form-control" name="aboutus" rows="3"><?= $pagaBasic['DirectorPage_about']  ?></textarea>
          </div>

          <div class="form-group">
            <button type="submit" class="btn firstcolor submit-btn director-page-update">Update</button>
          </div>
        </form>
      </div> <!-- End of Basic Details panel -->
    </div>
    
    <button type="button" class="accordion col-sm-12"><span class="glyphicon glyphicon-user"></span> &nbsp;Team</button>
    <div class="panel very-light-padded">

      <div class="removesidepadding">
        <table class="table table-striped table-hover" id="display-team-detail">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Title</th>
                <th>Description</th>
                <th>IMDB</th>
                <th>Facebook</th>
                <th>Action</th>
              </tr>
              </thead>

              <tbody>
                <?php
                  foreach ($teams as $key => $team) {
                ?>
                  <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $team['DirectorTeam_name'] ?></td>
                    <td><?= $team['DirectorTeam_title'] ?></td>
                    <td><?= $team['DirectorTeam_desc'] ?></td>
                    <td><?= $team['DirectorTeam_imdb'] ?></td>
                    <td><?= $team['DirectorTeam_fb'] ?></td>
                    <td>
                      <!-- <a href="#" class="team-member-edit" data-member-ref="<?= $team['DirectorTeam_id'] ?>"><i class="fa fa-pencil"></i></a> -->
                      <a href="#" class="team-member-delete" data-member-ref="<?= $team['DirectorTeam_id'] ?>"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                <?php
                  }
                ?>
              </tbody>
          </table>
      </div>

      <div class="col-lg-12 removesidepadding">

        <label class="control-label"> <h3> Number of Members: </h3></label>
          <select class="form-control" name="no-of-teammates" id="no-of-teammates">
            <?php
              $c = count($teams);
              for($i = 0; $i < 11; $i++){
                //$s = ($c== $i) ? 'selected' : "";
                echo "<option value='{$i}'>{$i}</option>";
              }
            ?>
          </select>
          <br>
      </div>      
      <div id="teammates" class="form-group col-lg-12 hidden">
        <label class="control-label"><h3>Team Details: </h3></label>
          <table class="teammates removesidepadding">
          <thead>
            <tr>
              <th> Name* </th>
              <th> Title* </th>
              <th> Description* </th>
              <th> IMDB Link </th>
              <th> Facebook Link </th>
              <th> Image </th>
            </tr>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
            <tr class="dummy-tr" style="display: none;">
              <td> <input class="form-control" type="text" name="name"></td>
              <td> <input class="form-control" type="text" name="title"></td>
              <td> <input class="form-control" type="text" name="desc"></td>
              <td> <div class="input-group"><input class="form-control" type="text" name="imdb" /><span class="input-group-addon"> <i class="glyphicon glyphicon-eye-open"></i></span></div></td>
              <td> <div class="input-group"><input class="form-control" type="text" name="fb" /><span class="input-group-addon"> <i class="glyphicon glyphicon-eye-open"></i></span></div></td>
              <td class="img-preview">
                <img src="<?= IMG ?>/actors/default.png" height="64" width="64">
                <input type="file" name="team_pic[]" style="display: none;" class="team-pic">
                <span class="upload-trigger" style="cursor: pointer;">Upload!</span>
              </td>
            </tr>

            <tr>
              <td>
                <button type="button" class="btn firstcolor submit-btn update-page-team">Update</button>
              </td>
            </tr>
          </tfoot>


        </table>
      </div> <!-- End of Teammates Table div -->
    </div> <!--End of Team panel-->


    <button type="button" class="accordion col-sm-12"><span class="glyphicon glyphicon-film"></span> &nbsp; Work</button>
    <div class="panel very-light-padded">

      <div class="form-group col-lg-12 removesidepadding">
      <br>
       
        <!--Projects that are already added -->
        <div class="col-lg-12" id="display-project-work">
          <?php
            foreach ($works as $key => $work) {
          ?>
            <div class="col-lg-1 removesidepadding" data-work-ref="<?= $work['DirectorWork_id'] ?>"><span class="glyphicon glyphicon-eye-open"> </span> &nbsp;<span class="glyphicon glyphicon-pencil p-work-edit"></span> &nbsp; <span class="glyphicon glyphicon-trash p-work-delete"> </span></div>
              <div class="col-lg-11 removesidepadding"> <b><?= $work['DirectorWork_title'] ?></b> <?= $work['DirectorWork_producer'] . " " . $work['DirectorWork_date'] ?>  </div>
            
          <?php
            }
          ?>
        </div>
      
        <br>
      
      <div class="col-lg-12"> 
        <button id="newprojectbutton" type="button" class="btn btn-primary firstcolor submit-btn" onclick="showProjectForm()">Add a New Project</button>
      <br><br>
      </div>
      
      <div id="projectform" class="col-lg-10 center removesidepadding projectform hidden">
        <h3 class="center"> New Project </h3>
        <table class="projectinput">
            <tr> <th> Title:     </th>   <td> <input class="form-control" type="text" name="projecttitle">    </td></tr>
            <tr> <th> Producer:  </th>   <td> <input class="form-control" type="text" name="projectproducer"> </td></tr>
            <tr> <th> Date:      </th>   <td> <input class="form-control" type="date" name="projectdate">     </td> </tr>
            <tr> <th> Remarks:   </th>   <td> <input class="form-control" type="text" name="projectremarks">  </td></tr>
            <!-- <tr> <th> Team:      </th>   <td> <select class="form-control"><option>Teammate1</option><option>Teammate2</option><option>Teammate3</option><option>Teammate4</option><option>Teammate5</option></select>               </td></tr> -->
            
            <tr> <th> Category:  </th>    <td> <select class="form-control" name="category"><option value="Film">Film</option><option value="TVC">TVC</option><option value="Online">Online</option></select></td></tr>
            
            <tr> <th> Status:    </th>    <td> <select class="form-control" name="status"><option value="Upcoming">Upcoming</option><option value="Ongoing">Ongoing</option><option value="Previous Work">Previous Work</option></select></td></tr>
            
            <tr> <th> Accepting Applications? </th> <td> <label class="radio-inline radiobuttons"><input type="radio" value="1" name="optradio">Yes</label><label class="radio-inline radiobuttons"><input type="radio" name="optradio" value="0" checked>No</label></td></tr>
            
            <tr> <th> YouTube Link:</th> <td> <input type="text" name="youtube" class="form-control" placeholder="Paste a YouTube link here."/></td></tr>

        </table>
        <br><br>
        <div class="center"> 
          <button type="button" class="btn btn-primary firstcolor submit-btn" onclick="saveProjectForm()"><span class="fa fa-times"> </span> &nbsp;Cancel</button>
          <button type="button" class="btn btn-primary firstcolor submit-btn page-project-update"><span class="glyphicon glyphicon-ok"> </span> &nbsp;Save</button>
        </div>
      </div><!-- End of project form -->
      </div> <!--End of form group -->
    </div><!-- End of Work panel --> 
    
    <button type="button" class="accordion col-sm-12"><span class="glyphicon glyphicon-envelope"></span> &nbsp;Contact Us</button>
    <div class="panel very-light-padded">
      <div class="form-group col-lg-12">
        <label class="control-label"><h3>Add Contact Us Text:</h3></label>
        <input  class="form-control" type="text" name="contactustext" value="<?= $pagaBasic['DirectorPage_contact'] ?>">
        <!-- <label  class="control-label"><h3>Enter Your Location to Enable Maps:</h3></label>
        <input  class="form-control" type="text" name="googlemapshere"><br> -->
        <div class="clearfix"></div>
      </div>
    </div><!-- End of Contact panel -->
  </div> <!-- End 12 column Div -->
    
    <br><br>
      

  </div>
</div>
</div>

</div>
       
    
</body>

        <!--================================== Navigation Ends Here =======================================-!-->
<?php
  include 'includes/footer.php';
  include 'includes/scripts.php';
?>

<script>
      var isAllowed = <?= ($isAllowed) ? 1 : 0; ?>;
    $(document).ready(function() {
    $('#myCarousel').carousel({
      interval: 5000
  });
});
function showTeammates(){
  $("#teammates").removeClass('hidden');
};
function saveProjectForm(){
  $("#projectform").toggleClass('hidden');
  $("#newprojectbutton").toggleClass('hidden');
};
function showProjectForm(){
  $("#projectform").toggleClass('hidden');
  $("#newprojectbutton").toggleClass('hidden');
  
};
function showProjectPreview(){
  alert("Take project card from the main page and put it in a modal!")
}
//ACCORDION CODE
var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
  }
}
var acc2 = document.getElementsByClassName("accordion2");
var j;
for (j = 0; j < acc2.length; j++) {
    acc2[j].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
  }
}
</script>