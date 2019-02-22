<?php
session_start();
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    unset($_SESSION['errors']);
    unset($_SESSION['data']);

    $causeOfChoose = filter_var($_POST['causeOfChoose'], FILTER_SANITIZE_STRING);
    $constructors = filter_var($_POST['constructors'], FILTER_SANITIZE_STRING);
    $polymorphism = filter_var($_POST['polymorphism'], FILTER_SANITIZE_STRING);
    $overloadingAndOverriding = filter_var($_POST['overloadingAndOverriding'], FILTER_SANITIZE_STRING);

    $error_msg = [];

    if(empty($causeOfChoose))
        $error_msg[] = 'Cause of choose is required';

    if(empty($constructors))
        $error_msg[] = 'Constructors question is required';

    if(empty($polymorphism))
        $error_msg[] = 'Polymorphism question is required';

    if(empty($overloadingAndOverriding))
        $error_msg[] = 'Overloading and Overriding question is required';

    $data = [
        'causeOfChoose' => $causeOfChoose,
        'constructors' => $constructors,
        'polymorphism' => $polymorphism,
        'overloadingAndOverriding' => $overloadingAndOverriding,
    ];

    if(empty($error_msg)){

        $stmt = $con->prepare('INSERT INTO android (`user_id`, `causeOfChoose`, `constructors`, `polymorphism`, `overloadingAndOverriding`) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($_SESSION['userID'], $causeOfChoose, $constructors, $polymorphism, $overloadingAndOverriding));
        unset($_SESSION['userID']);
        header('Location: thanksPage.php');
        exit();

    }else{
        $_SESSION['errors'] = $error_msg;
        $_SESSION['data'] = $data;
        header('Location: android.php');
        exit();
    }


}else{
    header('Location: android.php');
    exit();
}

