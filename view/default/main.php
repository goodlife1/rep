<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Тести</title>
<meta name="keywords" content="test" />
<meta name="description" content="Тестове завдання" />
<link href="/view/default/templatemo_style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="/public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <link href="/public/css/star-rating.css" rel="stylesheet" type="text/css" />

    <script src="/view/default/js/jquery-3.1.1.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
    <script src="/public/js/star-rating.js"></script>

</head>
<body>
<div id="logo"><a href="/"><img src="/view/default/images/logo.png" width="250" height="34"><a></div>
<div id="menu">
    <div class="btn-group" role="group" aria-label="...">
        <?php if(isset($_SESSION['user'])): ?>
            <a href="/login/logout" class="btn btn-default">Вихід</a>
            <a href="/login/edit" class="btn btn-default">змінити фотографію</a>
        <?php else: ?>
        <a href="/login" class="btn btn-default">Вхід</a>
        <a href="/register" class="btn btn-default">Регістрація</a>
        <?php endif; ?>
    </div>
</div>

</div>
<div id="templatemo_sidebar">
<ul class="templatemo_list">
    <li><a href="/books" > Всі книжки </a></li>
    <li><a href="/books/new_book" > Нова книжка </a></li>

   
</ul>

</div>
<div id="content">

    <?php $this->render_view($this->tpl);?>
</div>

</body>
</html>