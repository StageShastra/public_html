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
                             <li><a href="<?= base_url() . "director/createnewproject" ?>" >Create new project</a></li>
                            </ul>
                        </li>
                        <li >
                            <a href="#" data-toggle="modal" data-target="#advancedSearch" > Search
                            </a>
                        </li>
                        <li >
                            <a href="#" data-toggle="modal" data-target="#<?= ($isAllowed) ? "inviteActors" : "notAllowedModal" ?>">
                               Invite 
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
