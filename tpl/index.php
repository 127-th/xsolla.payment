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

        <div class="body">
            Оплата на сумму <b><?= number_format($core -> getPrice(), 2, ',', ' '); ?> руб</b>
            <form action="" method="post">
                <!-- example -->
                <input type="hidden" name="price" value="<?= $core -> getPrice(); ?>">

                <div class="card">
                    <div class="card-front">
                        <div class="text" style="float: left;">Номер карты</div>
                        <div style="float: right; margin-bottom: 3px;">
                            <div class="card-image visa"></div>
                            <div class="card-image mastercard"></div>
                        </div>
                        <input type="text" name="cardNumber" id="cardNumber" placeholder="0000 1111 2222 3333">

                        <div class="selects">
                            <div class="text inline small">Срок действия</div>
                            <select name="month" id="month">
                                <option value="0" selected></option>
                                <? for($i = 1; $i <= 12; $i++): ?>
                                <?= $num = str_pad($i, 2, 0, STR_PAD_LEFT); ?>
                                <option value="<?= $num; ?>"><?= $num; ?></option>
                                <? endfor; ?>
                            </select>
                            /
                            <select name="year" id="year">
                                <option value="0" selected></option>
                                <? for($i = date('Y'); $i <= (date('Y') + 10); $i++): ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                <? endfor; ?>
                            </select>
                        </div>

                        <input class="small" type="text" name="name" id="name" placeholder="IVAN IVANOV">
                        <div class="mini">Латинские буквы, вводить как на карте.</div>
                    </div>

                    <div class="card-back">
                        <div class="line"></div>
                        <div class="cvc">
                            <div class="text small">CVC/CVV</div>
                            <input type="text" name="cvc" id="cvc" value="" placeholder="123" class="small">
                            <div class="mini">Три цифры с оборотной стороны карты.</div>
                        </div>
                    </div>
                </div>

                <div class="info">
                    <div class="text small">E-mail:</div>
                    <input type="text" name="email" id="email" placeholder="ivan.ivanov@domain.com">
                    <div class="mini">На этот адрес придет информация о платеже.</div>
                    <div class="buttons">
                        <div class="inline">
                            <input id="button" type="submit" name="submit" value="Оплатить">
                        </div>
                        <div class="inline rules">
                            Нажимая на кнопку, я принимаю условия использования сервиса ОНЛАЙНДеньги.
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="/styles/js/jquery.creditCardValidator.js"></script>

    <!-- Build -->
    <script src="/styles/js/core.js"></script>
</body>
</html>