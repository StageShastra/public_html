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
                    <?php
                        function getFaIcon($identifier = ''){
                            $fa = "dashboard";
                            if( $identifier == 'dashboard' )
                                $fa = "dashboard";
                            elseif( $identifier == 'users' )
                                $fa = "users";
                            elseif( $identifier == 'projects' )
                                $fa = "briefcase";
                            elseif( $identifier == 'promo' )
                                $fa = "tags";
                            elseif( $identifier == 'contact' )
                                $fa = "envelope";
                            else
                                $fa = "user-secret";
                            return $fa;
                        }

                        $authPages = json_decode($adminDetail['CstkoAdmins_pages'], 1);
                        foreach ($authPages as $key => $pages) {
                            $splink = ($pages['identifier'] == "dashboard") ? "special_link" : "";
                            $arrow = (count($pages['pages']))? "<span class='fa arrow'></span>" : "";
                            $activeLi = ( $nav_h == $pages['identifier'] ) ? " active" : "";
                            $fa = getFaIcon( $pages['identifier'] );
                            $a = ($pages['identifier'] == "dashboard") ? base_url() . "admin/dashboard/" : "#";
                            echo "<li class='{$splink} {$activeLi}'>
                                    <a href='{$a}'>
                                        <i class='fa fa-{$fa}'></i>
                                        <span class='nav-label'>{$pages['name']}</span>
                                        {$arrow}
                                    </a>";
                                    if(count($pages['pages'])){
                                        echo "<ul class='nav nav-second-level'>";
                                        foreach ($pages['pages'] as $key => $page) {
                                            $activeN = ($nav_sh == $page['method']) ? " active" : "";
                                            if($page['view'] == 0)
                                                continue;
                                            echo "<li class='{$activeN}'><a href='".base_url()."admin/{$page['method']}'> {$page['name']} </a></li>";
                                        }
                                        echo "</ul>";
                                    }
                                echo "</li>";
                        }
                    ?>
                    <li class="<?= ($nav_h == 'admin') ? 'active' : '' ?>">
                        <a href="#">
                            <i class="fa fa-user-secret"></i>
                            <span class="nav-label">Admin</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?= base_url() . "admin/profile/" . $adminDetail['CstkoAdmins_username'] ?>">Profile</a></li>
                            <?php if($adminDetail['CstkoAdmins_auth'] == 1){ ?>
                            <li><a href="<?= base_url() . "admin/admins" ?>">All Admins</a></li>
                            <li><a href="<?= base_url() . "admin/addAdmin" ?>">Add Admin</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li>
                        <a href="<? base_url() ?>home/logout">
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