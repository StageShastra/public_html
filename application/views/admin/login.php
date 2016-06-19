<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Castiko | Admin Panel | Login </title>
        <link href="<?= ADMIN ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= ADMIN ?>/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?= ADMIN ?>/css/animate.css" rel="stylesheet">
        <link href="<?= ADMIN ?>/css/style.css" rel="stylesheet">
    </head>

    <body class="gray-bg">
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>
                    <h1 class="logo-name">CASTIKO</h1>
                </div>
                <h3>Welcome to Castiko Agile</h3>
                <p>
                    Only for Member of Castiko Agile Admin. Only can be access with you Admin Credentials.
                </p>
                <p>Login in. To see it in action.</p>
                <p style="color:red;"><?= $error_msg ?></p>
                <form class="m-t" role="form" action="" method="post">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username" required="">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required="">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary block full-width m-b">Login</button>

                    <a href="#"><small>Forgot password ?</small></a>
                    <p class="text-muted text-center"><small>Do not have an account? Ask to connect@castiko.com for access...</small></p>

                </form>
                <p class="m-t"> <small>Castiko Agile &copy; <?= date('Y') ?></small> </p>
            </div>
        </div>
        <script src="<?= ADMIN ?>/js/jquery-2.1.1.js"></script>
        <script src="<?= ADMIN ?>/js/bootstrap.min.js"></script>
    </body>

</html>