<?php
  include 'includes/head.php';
 ?>
 
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
          </div>
           <!-- contact modal toggle -->
          <div class="container">


<style>
.datagrid table { border-collapse: collapse !important; text-align: left; width: 100%; } 
.datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #FFFFFF !important; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }
.datagrid table td, 
.datagrid table th { padding: 0.5rem 0.5rem; }
.datagrid table thead th {background-color:#FFFFFF; color:black; font-size: 15px; font-weight: bold; } 
.datagrid table thead th:first-child { border: none; }
.datagrid table tbody td { color: #00557F; font-size: 12px;font-weight: normal; text-align: center;}
.datagrid table tbody td:first-child { border-left: none !important; }
.datagrid table tbody tr:last-child td { border-bottom: none !important; }
.hiddenoption { display: none; }
</style>


<div class="container light-padded">
            <h1> Imported data from <?= $name ?> </h1>
<hr />
            <h3> Few row from upload excel sheet displayed here. Finish if correct or Cancel to re-upload. </h3>
            <br>

            <?php

                function getKeyValue($name = ''){
                  $selectOpt = array(
                                    'name' => 'Name',
                                    'gender' => 'Gender',
                                    'age' => 'Age',
                                    'height' => 'Height',
                                    'email' => 'Email',
                                    'phone' => 'Phone',
                                    'project' => 'Project'
                                );
                  return $selectOpt[$name];
              }


              $handle = fopen("./tmpSheets/{$filename}", 'r');

            ?>

            <div class="datagrid" id="columnHeaders">
            <!-- <label style="font-size:1.5rem;"> Now tell us which column contains which information: </label> -->
              <table>

                <thead>
                  <tr>
                    <?php
                      foreach ($fields as $key => $f) {
                        echo "<th>".getKeyValue($f)."</th>";
                      }
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      $i = true;
                      $index = 1;
                      while (!feof($handle)) {
                        $line = fgets($handle);
                        if($i){
                          $i = false;
                          continue;
                        }


                        $peices = explode(",", $line);

                        echo "<tr>";
                        foreach ($peices as $key => $l) {
                          if($fields[$key] == 'gender')
                            $l = ($l == 1) ? "Male" : "Female";
                          echo "<td>{$l}</td>";
                        }
                        echo "</tr>";
                        if($i == 10){
                          break;
                        }
                        $i++;
                      }
                  ?>
                </tbody>
              </table>
            </div>
            
          
          <br>
<hr />
          <h3> Click finish if all correct or Re-Upload </h3>
          <br>
          <a href="<?= base_url() ?>director/finishUpload/" class="btn submit-btn firstcolor"> Finish <i class="fa fa-check"></i> </a>
          <a href="<?= base_url() ?>director/spreadsheet/" class="btn submit-btn firstcolor">Re-Upload <i class="fa fa-refresh"></i></a>
          
          
            <!-- <table border="1">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
              </tr>
              <tr>
                <td>1</td>
                <td>Dilip Kumar</td>
                <td>dilipkumar@iitr.ac.in</td>
              </tr>
            </table> -->

          </div>


          </div>




      <script>
      var isAllowed = <?= ($isAllowed) ? 1 : 0; ?>;
      </script>
        <!--================================== Navigation Ends Here =======================================-!-->
<?php
  include 'includes/footer.php';
  include 'includes/scripts.php';
?>
</body>
