<?php
session_start();
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    unset($_SESSION['errors']);
    unset($_SESSION['data']);

    $causeOfChoose = filter_var($_POST['causeOfChoose'], FILTER_SANITIZE_STRING);
    $html = filter_var($_POST['HTML'], FILTER_SANITIZE_STRING);
    $gridSystem = filter_var($_POST['gridSystem'], FILTER_SANITIZE_STRING);
    $idAndClass = filter_var($_POST['idAndClass'], FILTER_SANITIZE_STRING);

    $error_msg = [];

    if(empty($causeOfChoose))
        $error_msg[] = 'Cause of choose is required';

    if(empty($html))
        $error_msg[] = 'HTML brief is required';

    if(empty($gridSystem))
        $error_msg[] = 'GridSystem question is required';

    if(empty($idAndClass))
        $error_msg[] = 'Difference between class and id question is required';

    $data = [
        'causeOfChoose' => $causeOfChoose,
        'html' => $html,
        'gridSystem' => $gridSystem,
        'idAndClass' => $idAndClass,
    ];

    if(empty($error_msg)){

        $stmt = $con->prepare('INSERT INTO web (`user_id`, `causeOfChoose`, `HTML`, `gridSystem`, `idAndClass`) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($_SESSION['userID'], $causeOfChoose, $html, $gridSystem, $idAndClass));
        unset($_SESSION['userID']);
        header('Location: thanksPage.php');
        exit();

    }else{
        $_SESSION['errors'] = $error_msg;
        $_SESSION['data'] = $data;
        header('Location: web.php');
        exit();
    }


}else{
    header('Location: web.php');
    exit();
}

