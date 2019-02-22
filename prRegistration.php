<?php
session_start();
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    unset($_SESSION['errors']);
    unset($_SESSION['data']);

    $causeOfChoose = filter_var($_POST['causeOfChoose'], FILTER_SANITIZE_STRING);
    $prQualifications = filter_var($_POST['prQualifications'], FILTER_SANITIZE_STRING);
    $expectation = filter_var($_POST['expectation'], FILTER_SANITIZE_STRING);
    $aboutFR = filter_var($_POST['aboutFR'], FILTER_SANITIZE_STRING);

    $error_msg = [];

    if(empty($causeOfChoose))
        $error_msg[] = 'Cause of choose is required';

    if(empty($prQualifications))
        $error_msg[] = 'Pr Qualifications question is required';

    if(empty($expectation))
        $error_msg[] = 'Expectation question is required';

    if(empty($aboutFR))
        $error_msg[] = 'About FR question is required';

    $data = [
        'causeOfChoose' => $causeOfChoose,
        'prQualifications' => $prQualifications,
        'expectation' => $expectation,
        'aboutFR' => $aboutFR,
    ];

    if(empty($error_msg)){

        $stmt = $con->prepare('INSERT INTO pr (`user_id`, `causeOfChoose`, `prQualifications`, `expectation`, `aboutFR`) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($_SESSION['userID'], $causeOfChoose, $prQualifications, $expectation, $aboutFR));
        unset($_SESSION['userID']);
        header('Location: thanksPage.php');
        exit();

    }else{
        $_SESSION['errors'] = $error_msg;
        $_SESSION['data'] = $data;
        header('Location: pr.php');
        exit();
    }


}else{
    header('Location: pr.php');
    exit();
}

