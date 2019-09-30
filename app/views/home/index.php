<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Форма</title>

    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

    <script src="/public/js/site.js" type="text/javascript"></script>
    <script src="/public/js/md5.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="/public/css/site.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/public/css/app.css" />

    <script type="text/javascript">
    </script>

</head>
<body>
<?php
    // подключаем словари, если надо
    require_once($_SERVER['DOCUMENT_ROOT'].'/app/dictionaryEn.php');
    if (isset($_SESSION["lang"])) {
        require_once($_SERVER['DOCUMENT_ROOT'].'/app/dictionaryRu.php');
    }
?>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="/">
                <?=$dictHomePage?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto" id="menu">
                    <!-- Authentication Links -->
                    <?php if (!isset($_SESSION["name"])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" id="link-login"  href="/home/login"><?=$dictLogin?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/home/register"><?=$dictRegister?></a>
                        </li>
                    <?php }else{ ?>
                        <li class="nav-item">
                                <a class="nav-link" href="#">
                                <?php
                                //Возвращаем логин, который записан в сессию
                                echo $_SESSION["name"];
                                ?>
                                </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/home/logout"><?=$dictLogout?></a>
                        </li>
                    <?php } 
                        if (!isset($_SESSION["lang"])) {
                    ?>
                        <li class="nav-item"><a class="nav-link" href="#">en</a>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item"><a class="nav-link" href="#en"></a></li>
                                <li class="nav-item"><a class="nav-link" href="javascript:lang('ru');">ru</a></li>
                            </ul>
                        </li>
                    <?php }else{ ?>
                        <li class="nav-item"><a class="nav-link" href="#">ru</a>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item"><a class="nav-link" href="#ru"></a></li>
                                <li class="nav-item"><a class="nav-link" href="javascript:lang('en');">en</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
        <?php
        if (isset($data['file']))
            require($data['file']);
        ?>
    </main>
</div>
</body>
</html>