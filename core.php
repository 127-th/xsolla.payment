<?php
header('Content-type: text/html; charset=utf-8');

// define('ERROR_SHOW', 'DEV');
define('ERROR_SHOW', 'PRODUCTION');


class CCore
{

    /**
     * Роутинг
     */
    private $route = array(
        'index',
        'preload',
        'success',
    );

    private $defaultModule = 'index';

    public $module, $pdo, $price;

    private $param = array();

    function __construct()
    {
        $this -> connectDB(array('localhost', 'root', '', 'xsolla'));
        $this -> setModule();
    }

    /**
     * Устанавливаем соединение с MySQL
     */
    private function connectDB($dataDB)
    {
        $dsn = "mysql:host=$dataDB[0];dbname=$dataDB[3];charset=UTF8";
        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        $this -> pdo = new PDO($dsn, $dataDB[1], $dataDB[2], $opt);
        $this -> pdo -> exec("SET NAMES utf8");
    }

    /**
     * Подгружаем шаблон
     */
    public function tpl($template = '')
    {
        global $core;
        $template = ($template === '') ? 'index' : str_replace(array('../', '\\'), '/', $template);
        include_once 'tpl/' . $template . '.php';
    }

    /**
     * Записываем данные для передачи в шаблон
     */
    public function setParam(array $param)
    {
        $this -> param = array_merge($this -> param, $param);
    }

    /**
     * Получаем данные для шаблона
     * @return (mixed)
     */
    public function getParam($key)
    {
        if(empty($this -> param[$key])){
            return null;
        }

        return $this -> param[$key];
    }

    /**
     * Получаем рандомную цену
     * @return (int)
     */
    public function getPrice()
    {
        if(empty($this -> price)){
            $this -> price = mt_rand(10000, 999999);
        }

        return $this -> price;
    }


    /**
     * Получаем имя раздела из $_GET
     */
    public function setModule()
    {
        if(!empty($_GET['module']) and in_array($_GET['module'], $this -> route)){
            $this -> module = $_GET['module'];
        }
        else
        {
            // default
            $this -> module = $this -> defaultModule;
        }
    }
}

/**
 *
 */
class CCard extends CCore
{
    /**
     * Данные по карте
     */
    private $dataCard = array();

    function __construct()
    {
        parent::__construct();
        // принимаем POST данные с формы
        $this -> getPostData();
    }

    /**
     * Формируем массив данных для записи в базу
     */
    private function getPostData()
    {
        $data = array(
            'price'         => true,
            'cardNumber'    => true,
            'month'         => true,
            'year'          => true,
            'name'          => true,
            'cvc'           => true,
            'email'         => true
        );

        foreach($data as $key => $row){
            if(empty($_POST[$key])){
                return false;
            }
            else
            {
                $this -> {'set'. ucfirst($key)}($_POST[$key]);
            }
        }

        return $this -> insert();
    }

    /**
     * Записываем в базу данные по карте
     */
    private function insert()
    {
        $set = array();
        foreach ($this -> dataCard as $key => $value) {
            $set[] = "`$key` = :$key";
        }
        $set = implode(", ", $set);
        $sql = "INSERT INTO paymentList SET " . $set;

        $sql = $this -> pdo -> prepare($sql);
        $sql -> execute($this -> dataCard);
    }

    /**
     * Устанавливаем номер карты
     */
    public function setCardNumber($row)
    {
        /**
         * Проверки данных нет, по ТЗ.
         */
        $this -> dataCard['cardNumber'] = $row;
    }

    /**
     * Устанавливаем цену
     */
    public function setPrice($row)
    {
        /**
         * Проверки данных нет, по ТЗ.
         */
        $this -> dataCard['price'] = $row;
    }

    /**
     * Устанавливаем год
     */
    public function setYear($row)
    {
        /**
         * Проверки данных нет, по ТЗ.
         */
        $this -> dataCard['year'] = $row;
    }

    /**
     * Устанавливаем месяц
     */
    public function setMonth($row)
    {
        /**
         * Проверки данных нет, по ТЗ.
         */
        $this -> dataCard['month'] = $row;
    }

    /**
     * Устанавливаем код CVC
     */
    public function setCvc($row)
    {
        /**
         * Проверки данных нет, по ТЗ.
         */
        $this -> dataCard['cvc'] = $row;
    }

    /**
     * Устанавливаем E-mail адрес
     */
    public function setEmail($row)
    {
        /**
         * Проверки данных нет, по ТЗ.
         */
        $this -> dataCard['email'] = $row;
    }

    /**
     * Устанавливаем имя носителя карты
     */
    public function setName($row)
    {
        /**
         * Проверки данных нет, по ТЗ.
         */
        $this -> dataCard['name'] = $row;
    }
}

/**
 * Вывод ошибок
 */
if(ERROR_SHOW == 'PRODUCTION'){
    error_reporting(0);
}
else
{
    error_reporting(E_ALL ^ E_NOTICE);
}

/**
 * Создаем экземпляр основного класса
 */
$core = new CCore;