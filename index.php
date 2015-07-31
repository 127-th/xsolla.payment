<?php
include './core.php';


switch($core -> module){
    default:
    case 'index':
        if(!empty($_POST['submit'])){
            $buy = new CCard();

            if(!$buy){
                header('Location: ?module=error');
            }
            else
            {
                header('Location: ?module=preload');
            }
            exit;
        }

        // подгружаю шаблон
        $core -> setParam(array('title' => 'Оплата по карте VISA / MasterCard'));
        $core -> tpl('index');

        break;

    case 'success':
        $core -> setParam(array('title' => 'Успешная оплата'));
        $core -> tpl('success');
        break;

    case 'preload':
        $core -> setParam(array('title' => 'Проходит оплата'));
        $core -> tpl('preload');
        break;
}

