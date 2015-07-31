<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title><?= $core -> getParam('title'); ?></title>
    <link rel="stylesheet" href="/styles/css/reset.css">
    <link rel="stylesheet" href="/styles/css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
</head>
<body>
    <div class="box">
        <div class="title"><?= $core -> getParam('title'); ?></div>

        <div class="body" style="text-align: center;">
            <h3>Проходит оплата. Пожалуйста подождите</h3>

            <img src="/styles/images/preloader.gif" alt="">
        </div>
    </div>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="/styles/js/jquery.creditCardValidator.js"></script>

    <!-- Build -->
    <script src="/styles/js/core.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout("document.location.href = '/?module=success'", 3000);
        });
    </script>
</body>
</html>