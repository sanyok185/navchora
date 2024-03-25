<?php 
    session_start();
    if (!empty($_SESSION['user']))
        header("Location: admin.php");

    if (!empty($_POST))
    {
        $file = file('protected/users.txt');
        $adminInfo  = $file[0];
        list($login, $pass) = explode(';', trim($adminInfo));

        $loginPost = trim(strip_tags($_POST['login']));
        $passwordPost = trim(strip_tags($_POST['password']));

        if ($login == $loginPost)
        {
            if($pass == md5($passwordPost))
            {
                $_SESSION['user'] = md5(md5($login).$pass);
                if ($_SESSION['user'])
                    header("Location: admin.php");
            }
            else
                $error = "Bad password entered!";
        }
        else
            $error = "Bad login entered!";

    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/bootstrap.min2.3.css" rel="stylesheet" media="screen"> 
        <script type="text/javascript" src="js/jquery2"></script> 
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <a class="brand" href="#">Inline Redactor</a>
                <ul class="nav">
                    <li><a href="admin.php">Inline Redactor</a></li>
                    <li><a href="/" target="_blank" >Основная страница</a></li>
                </ul>
                <ul class="nav pull-right"> <li ><a href="logout.php"><i class="icon-off icon-white"></i> Выйти</a></li> </li></ul>
        </div>
    </div>
<div class="container">
    <div class="row">
        <div class="span4 offset4 well">
            <legend>Вход в Онлайн Редактор</legend>
            <?php if (isset($error)): ?>
            <div class="alert alert-error">
                <a class="close" data-dismiss="alert" href="#">×</a><?php echo $error; ?>
            </div>
            <?php endif; ?>
            <form method="POST" action="login.php" accept-charset="UTF-8">
            <input type="text" id="username" class="span4" name="login" placeholder="Логин">
            <input type="password" id="password" class="span4" name="password" placeholder="Пароль">
            <button type="submit" name="submit" class="btn btn-info btn-block">Войти</button>
            </form>    
        </div>
    </div>
</div>
</body>
</html>