<?php
session_start();
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    unset($_SESSION['errors']);
    unset($_SESSION['data']);

    $causeOfChoose = filter_var($_POST['causeOfChoose'], FILTER_SANITIZE_STRING);
    $onlineMarketing = filter_var($_POST['onlineMarketing'], FILTER_SANITIZE_STRING);
    $englishLevel = filter_var($_POST['englishLevel'], FILTER_SANITIZE_STRING);

    $error_msg = [];

    if(empty($causeOfChoose))
        $error_msg[] = 'Cause of choose is required';

    if(empty($onlineMarketing))
        $error_msg[] = 'Online Marketing question is required';

    if(empty($englishLevel))
        $error_msg[] = 'English Level question is required';

    $data = [
        'causeOfChoose' => $causeOfChoose,
        'onlineMarketing' => $onlineMarketing,
        'englishLevel' => $englishLevel,
    ];

    if(empty($error_msg)){

        $stmt = $con->prepare('INSERT INTO socialMedia (`user_id`, `causeOfChoose`, `onlineMarketing`, `englishLevel`) VALUES (?, ?, ?, ?)');
        $stmt->execute(array($_SESSION['userID'], $causeOfChoose, $onlineMarketing, $englishLevel));
        unset($_SESSION['userID']);
        header('Location: thanksPage.php');
        exit();

    }else{
        $_SESSION['errors'] = $error_msg;
        $_SESSION['data'] = $data;
        header('Location: socialMedia.php');
        exit();
    }


}else{
    header('Location: socialMedia.php');
    exit();
}

