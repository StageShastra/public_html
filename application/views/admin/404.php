<!DOCTYPE html>
<html>

<?php 
    
    include 'includes/header.php';

?>

<body class="gray-bg">


    <div class="middle-box text-center animated fadeInDown">
        <h1>404</h1>
        <h3 class="font-bold">Page Not Found</h3>

        <div class="error-desc">
            Sorry, but the page you are looking for has note been found. Try checking the URL for error, then hit the refresh button on your browser or try found something else in our app.
            <a href="<?= base_url() ?>admin/">Go To Home <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?= ADMIN ?>/js/jquery-2.1.1.js"></script>
    <script src="<?= ADMIN ?>js/bootstrap.min.js"></script>

</body>

</html>
