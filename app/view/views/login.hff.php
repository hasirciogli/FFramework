<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test login page...</title>
</head>
<body>

<?php $err = empty($_GET["err"]) ? null : $_GET["err"];

if($err)
{

    \app\route\Router::Route("/login", 2);

    ?>

    <div>
        <?php echo $err; ?>
    </div>

<?php }

?>

<form action="/login" method="post">
    <input type="submit" value="login">
</form>

</body>
</html>