<?php
session_start();
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    unset($_SESSION['errors']);
    unset($_SESSION['data']);

    $causeOfChoose = filter_var($_POST['causeOfChoose'], FILTER_SANITIZE_STRING);
    $experience = filter_var($_POST['experience'], FILTER_SANITIZE_STRING);
    $usesOrApplications = filter_var($_POST['usesOrApplications'], FILTER_SANITIZE_STRING);
    $desktopApplications = filter_var($_POST['desktopApplications'], FILTER_SANITIZE_STRING);

    $error_msg = [];

    if(empty($causeOfChoose))
        $error_msg[] = 'Cause of choose is required';

    if(empty($experience))
        $error_msg[] = 'Your experience in JAVA is required';

    if(empty($usesOrApplications))
        $error_msg[] = 'Knowing about uses or applications of JAVA programming question is required';

    if(empty($desktopApplications))
        $error_msg[] = 'Knowing about Desktop Applications question is required';

    $data = [
        'causeOfChoose' => $causeOfChoose,
        'experience' => $experience,
        'usesOrApplications' => $usesOrApplications,
        'desktopApplications' => $desktopApplications,
    ];

    if(empty($error_msg)){

        $stmt = $con->prepare('INSERT INTO java (`user_id`, `causeOfChoose`, `experience`, `usesOrApplications`, `desktopApplications`) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($_SESSION['userID'], $causeOfChoose, $experience, $usesOrApplications, $desktopApplications));
        unset($_SESSION['userID']);
        header('Location: thanksPage.php');
        exit();

    }else{
        $_SESSION['errors'] = $error_msg;
        $_SESSION['data'] = $data;
        header('Location: java.php');
        exit();
    }


}else{
    header('Location: java.php');
    exit();
}

