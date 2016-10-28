<?php header('Access-Control-Allow-Origin: *'); ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
         <title><?=$actor["StashUsers_name"]?> | Castiko </title>
         <meta name="description" content="Castiko is a platform to connect Actors and Casting Directors. Actors – create your own acting profiles with photos & videos. Get auditions. Casting directors – manage all your data, run auditions and find new actors">
        <meta name="keywords" content="<?=$actor["StashUsers_name"]?>,Actor, Audition, Acting, Photos, Videos">
        <meta name="filename" content="http://castiko.com/<?=$actor["StashUsers_username"]?>">
        <meta property="og:title" content="<?=$actor["StashUsers_name"]?> | Castiko "/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="http://castiko.com/<?=$actor["StashUsers_username"]?>"/>
        <meta property="og:image" content="http://castiko.com/assets/img/actors/<?=$profile["StashActor_avatar"]?>"/>
        <meta property="og:description" content="View <?=$actor["StashUsers_name"]?>’s professional portfolio on Castiko. Castiko is a tool for casting directors and actors to work together better"/>
        <meta name="description" content="View <?=$actor["StashUsers_name"]?>’s professional portfolio on Castiko. Castiko is a tool for casting directors and actors to work together better">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="shortcut icon" href="<?= IMG ?>/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?= IMG ?>/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="<?= CSS ?>/bootstrap.min.css">
        <link rel="stylesheet" href="<?= CSS ?>/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?= CSS ?>/jquery-ui.css">
        <link rel="stylesheet" href="<?= CSS ?>/main.css">
        <link rel="stylesheet" href="<?= CSS ?>/lightbox.css">
        <link rel="stylesheet" href="<?= CSS ?>/cropper.css">
        <link rel="stylesheet" href="<?= CSS ?>/introjs.css">
        <link href="<?= CSS ?>/dropzone.css" type="text/css" rel="stylesheet" />
        <link href="<?= CSS ?>/animate.css" type="text/css" rel="stylesheet" />
		<link href="<?= CSS ?>/font-awesome.css" type="text/css" rel="stylesheet" />
		<link href="<?= CSS ?>/navbar.css" type="text/css" rel="stylesheet" />
        
		<!-- jsSocial CSS -->
		<link type="text/css" rel="stylesheet" href="<?= CSS ?>/jsSocial.min.css" />
		<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.2.1/jssocials-theme-flat.css" />
		
		<script type="text/javascript"> CRISP_WEBSITE_ID = "da718c7b-2858-4e48-b3ae-a935261b487d";(function(){ d=document;s=d.createElement("script"); s.src="https://client.crisp.im/l.js"; s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})(); </script>
        <script src="<?= JS ?>/dropzone.js"></script>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,200,300,100' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="<?= CSS ?>/tagsinput.css" />

		  <script type="text/javascript">
    window.heap=window.heap||[],heap.load=function(e,t){window.heap.appid=e,window.heap.config=t=t||{};var r=t.forceSSL||"https:"===document.location.protocol,a=document.createElement("script");a.type="text/javascript",a.async=!0,a.src=(r?"https:":"http:")+"//cdn.heapanalytics.com/js/heap-"+e+".js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(a,n);for(var o=function(e){return function(){heap.push([e].concat(Array.prototype.slice.call(arguments,0)))}},p=["addEventProperties","addUserProperties","clearEventProperties","identify","removeEventProperty","setEventProperties","track","unsetEventProperty"],c=0;c<p.length;c++)heap[p[c]]=o(p[c])};
    heap.load("408837571");
  </script>

    </head>

