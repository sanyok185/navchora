<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Админ панель</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/bootstrap.min2.3.css" rel="stylesheet" media="screen"> 
    </head>
<body>
<?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>

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

<textarea name="editor1" id="editor1">
<?php
$content = file_get_contents("index.html");
echo $content;
?>
</textarea>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/config.js"></script>

<script>
window.onload = function() {
CKEDITOR.replace('editor1', {
        fullPage: true,
        allowedContent: true,
        extraPlugins: 'savebtn',
        height:"700", 
        width: "100%"
    });
};
</script>
<?php 
if (!empty($_POST["text"]))
{
    $content  = $_POST["text"];
    file_put_contents("index.html", $content);
}
?>
<?php else: ?>
<div class="container">
    <div class="row">
        <div class="span7 offset2 well">
            <h3 align="center">У вас нет доступа к этой странице!</h3>
            <h4 align="center"><a href="login.php">Войти на страницу редактирования!</a></h4>
        </div>
    </div>
</div>
<?php endif; ?>
</body>
</html>


