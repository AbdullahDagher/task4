<?php
session_start();
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    unset($_SESSION['errors']);
    unset($_SESSION['data']);

    $causeOfChoose = filter_var($_POST['causeOfChoose'], FILTER_SANITIZE_STRING);
    $programmingExperience = filter_var($_POST['programmingExperience'], FILTER_SANITIZE_STRING);
    $cources = filter_var($_POST['cources'], FILTER_SANITIZE_STRING);
    $pythonLibraries = filter_var($_POST['pythonLibraries'], FILTER_SANITIZE_STRING);

    $error_msg = [];

    if(empty($causeOfChoose))
        $error_msg[] = 'Cause of choose is required';

    if(empty($programmingExperience))
        $error_msg[] = 'Experience in programming question is required';

    if(empty($cources))
        $error_msg[] = 'Cources question is required';

    if(empty($pythonLibraries))
        $error_msg[] = 'PythonLibraries question is required';

    $data = [
        'causeOfChoose' => $causeOfChoose,
        'programmingExperience' => $programmingExperience,
        'cources' => $cources,
        'pythonLibraries' => $pythonLibraries,
    ];

    if(empty($error_msg)){

        $stmt = $con->prepare('INSERT INTO web (`user_id`, `causeOfChoose`, `programmingExperience`, `cources`, `pythonLibraries`) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($_SESSION['userID'], $causeOfChoose, $programmingExperience, $cources, $pythonLibraries));
        unset($_SESSION['userID']);
        header('Location: thanksPage.php');
        exit();

    }else{
        $_SESSION['errors'] = $error_msg;
        $_SESSION['data'] = $data;
        header('Location: python.php');
        exit();
    }


}else{
    header('Location: python.php');
    exit();
}

