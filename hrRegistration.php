<?php
session_start();
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    unset($_SESSION['errors']);
    unset($_SESSION['data']);

    $causeOfChoose = filter_var($_POST['causeOfChoose'], FILTER_SANITIZE_STRING);
    $hrImportance = filter_var($_POST['hrImportance'], FILTER_SANITIZE_STRING);
    $cycle = filter_var($_POST['cycle'], FILTER_SANITIZE_STRING);
    $interviewsType = filter_var($_POST['interviewsType'], FILTER_SANITIZE_STRING);

    $error_msg = [];

    if(empty($causeOfChoose))
        $error_msg[] = 'Cause of choose is required';

    if(empty($hrImportance))
        $error_msg[] = 'HR Importance question is required';

    if(empty($cycle))
        $error_msg[] = 'HR’s cycle question is required';

    if(empty($interviewsType))
        $error_msg[] = 'Different types of interviews question is required';

    $data = [
        'causeOfChoose' => $causeOfChoose,
        'hrImportance' => $hrImportance,
        'cycle' => $cycle,
        'interviewsType' => $interviewsType,
    ];

    if(empty($error_msg)){

        $stmt = $con->prepare('INSERT INTO hr (`user_id`, `causeOfChoose`, `hrImportance`, `cycle`, `interviewsType`) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($_SESSION['userID'], $causeOfChoose, $hrImportance, $cycle, $interviewsType));
        unset($_SESSION['userID']);
        header('Location: thanksPage.php');
        exit();

    }else{
        $_SESSION['errors'] = $error_msg;
        $_SESSION['data'] = $data;
        header('Location: hr.php');
        exit();
    }


}else{
    header('Location: hr    .php');
    exit();
}

