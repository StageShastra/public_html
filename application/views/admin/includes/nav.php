<?php

    $adminDetail = $this->ModelAdmin->getAdminDetail( "CstkoAdmins_id", $this->session->userdata("CSTKO_Admin_id") );

?>
<body class="pace-running">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> 
                            <span>
                                <img alt="image" height="50" width="50" class="img-circle" src="<?= ADMIN ?>/img/avatars/<?= $adminDetail['CstkoAdmins_avatar'] ?>" />
                            </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="dashboard_4_1.html#">
                                <span class="clear"> 
                                    <span class="block m-t-xs"> 
                                        <strong class="font-bold"><?= $adminDetail['CstkoAdmins_name'] ?></strong>
                                    </span> 
                                    <span class="text-muted text-xs block">
                                        <?= $adminDetail['CstkoAdmins_designation'] ?>
                                    </span> 
                                </span> 
                            </a>
                        </div>
                    </li>
                    <li class="special_link">
                        <a href="#">
                            <i class="fa fa-th-large"></i> 
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="<?= ($nav_h == 'users') ? 'active' : '' ?>">
                        <a href="#">
                            <i class="fa fa-users"></i> 
                            <span class="nav-label">Users</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level collapse">
                            <li class="<?= ($nav_sh == 'directors') ? 'active' : '' ?>"><a href="<?= base_url() . "admin/directors/" ?>">Casting Directors</a></li>
                            <li class="<?= ($nav_sh == 'actors') ? 'active' : '' ?>"><a href="<?= base_url() . "admin/actors/" ?>">Actors</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="<?= base_url() ?>admin/logout/">
                            <i class="fa fa-sign-out"></i> 
                            <span class="nav-label">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>


<div style="min-height: 1572px;" id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                <!-- <form role="search" class="navbar-form-custom" action="search_results.html">
                    <div class="form-group">
                        <input placeholder="Search for something..." class="form-control" name="top-search" id="top-search" type="text">
                    </div>
                </form> -->
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to <b>Castiko Agile!</b> Admin Panel</span>
                </li>
                <li>
                    <a href="<?= base_url() ?>home/logout/">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
    </div>