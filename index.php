<?php

require_once("config.php");

if ($require_https && (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on')) {
    if(!headers_sent()) {
        header("Status: 301 Moved Permanently");
        header(sprintf(
            'Location: https://%s%s',
            $_SERVER['HTTP_HOST'],
            $_SERVER['REQUEST_URI']
        ));
        exit();
    }
}

if (isset($_POST['password'])) {
    if ($_POST['password'] === $password) {
        $success = true;
        //header("Location:".$redirect);
        //die();
    }
    elseif (strlen($_POST['password']) == 0) {
        $alert = "Password cannot be empty.";
    }
    else {
        $alert = "Password incorrect. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Redirect Portal</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="redirectportal.css" rel="stylesheet">
    <?php if ($success) { ?><meta http-equiv="refresh" content="3;URL=<?php echo $redirect ?>"><?php } ?>
</head>
<body>
    <div class="container">
        <form class="form-signin" role="form" method="POST">
            <?php if ($success) { ?>
            <div class="alert alert-success" role="alert"><b>Password correct. Redirecting...</b></div>
            <?php } else { ?>
            <?php if(isset($alert)) { ?>
            <div class="alert alert-danger" role="alert"><b><?php echo $alert ?></b></div>
            <?php } ?>
            <h2 class="form-signin-heading">Please enter password</h2>
            <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" autofocus>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Go</button>
            <?php } ?>
        </form>
	</div>
</body>
</html>