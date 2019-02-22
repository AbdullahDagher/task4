<?php
session_start();
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    unset($_SESSION['errors']);
    unset($_SESSION['data']);

    $causeOfChoose = filter_var($_POST['causeOfChoose'], FILTER_SANITIZE_STRING);
    $designingPrograms = filter_var($_POST['designingPrograms'], FILTER_SANITIZE_STRING);
    $pixelAndVector = filter_var($_POST['pixelAndVector'], FILTER_SANITIZE_STRING);
    $expectation = filter_var($_POST['expectation'], FILTER_SANITIZE_STRING);

    $error_msg = [];

    if(empty($causeOfChoose))
        $error_msg[] = 'Cause of choose is required';

    if(empty($designingPrograms))
        $error_msg[] = 'Designing programs question is required';

    if(empty($pixelAndVector))
        $error_msg[] = 'Difference between pixel and vector question is required';

    if(empty($expectation))
        $error_msg[] = 'Expectation question is required';

    $data = [
        'causeOfChoose' => $causeOfChoose,
        'designingPrograms' => $designingPrograms,
        'pixelAndVector' => $pixelAndVector,
        'expectation' => $expectation,
    ];

    if(empty($error_msg)){

        $stmt = $con->prepare('INSERT INTO media (`user_id`, `causeOfChoose`, `designingPrograms`, `pixelAndVector`, `expectation`) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($_SESSION['userID'], $causeOfChoose, $designingPrograms, $pixelAndVector, $expectation));
        unset($_SESSION['userID']);
        header('Location: thanksPage.php');
        exit();

    }else{
        $_SESSION['errors'] = $error_msg;
        $_SESSION['data'] = $data;
        header('Location: media.php');
        exit();
    }


}else{
    header('Location: media.php');
    exit();
}

