<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_ALL);
ini_set("display_errors", 1);

//require 'phpmailer/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

    $mysqli = new mysqli("localhost", "login", "password", "test");
    $mysqli->set_charset("utf8");

    /* проверяем соединение */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $type = $_GET['type'];
    $need_design = $_GET['need_design'];
    $need_design_mobile = $_GET['need_design_mobile'];
    $adapt_design= $_GET['adapt_design'];
    $without_developer = $_GET['without_developer'];
    $other_functional = $_GET['other_functional'];
    $deadline = $_GET['deadline'];
    $task = $_GET['task'];
    $contact = $_GET['contact'];
    $name = $_GET['name'];
    $price = $_GET['price'];


    $sql = 'INSERT INTO orders (type, need_design, adapt_design, need_design_mobile, without_developer, other_functional, deadline, task, contact, name, price) VALUES ("'.$type.'","'.$need_design.'","'.$adapt_design.'","'.$need_design_mobile.'","'.$without_developer.'","'.$other_functional.'","'.$deadline.'","'.$task.'","'.$contact.'","'.$name.'","'.$price.'")';

    if($mysqli->query($sql)) {
        //echo "New record created successfully";
    } else {
        die('Неверный запрос: ' . $mysqli->error);
    }

    $mail = new PHPMailer(true);
    $mail->isSMTP();

    $mail->SMTPDebug = 1;

    $mail->Host = 'ssl://smtp.mail.ru';

    $mail->SMTPAuth = true;
    $mail->Username = 'fg@mail.ru'; // логин от вашей почты
    $mail->Password = 'qwerty'; // пароль от почтового ящика
    $mail->SMTPSecure = 'SSL';
    $mail->Port = '465';

    $mail->CharSet = 'UTF-8';
    $mail->From = 'fg@mail.ru';  // адрес почты, с которой идет отправка
    $mail->FromName = 'Name'; // имя отправителя
try {
    $mail->addAddress('ty@mail.ru', 'Name');
} catch (\PHPMailer\PHPMailer\Exception $e) {
}

$mail->isHTML(true);

    $mail->Subject = "Деньги пришли";
    $mail->Body = "Посмотри что за хрень";
    $mail->AltBody = "Уууууууууууууууууууууууууу";

    //$mail->SMTPDebug = 1;

try {
    if ($mail->send()) {
        $answer = '1';
        echo 'Письмо может быть отправлено. ';
    } else {
        $answer = '0';
        echo 'Письмо не может быть отправлено. ';
        echo 'Ошибка: ' . $mail->ErrorInfo;
    }
} catch (\PHPMailer\PHPMailer\Exception $e) {
}
die($answer);
