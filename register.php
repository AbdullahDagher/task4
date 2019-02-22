<?php
session_start();
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    unset($_SESSION['errors']);
    unset($_SESSION['data']);

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $facebookUrl = filter_var($_POST['facebookUrl'], FILTER_SANITIZE_STRING);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $university = filter_var($_POST['university'], FILTER_SANITIZE_STRING);
    $department = filter_var($_POST['department'], FILTER_SANITIZE_STRING);
    $academic = filter_var($_POST['academic'], FILTER_SANITIZE_STRING);
    $about = filter_var($_POST['about'], FILTER_SANITIZE_STRING);
    $committee = filter_var($_POST['committee'], FILTER_SANITIZE_STRING);

    $error_msg = [];

    if($phone!=''){
        if(strlen($phone) != 11 && !preg_match('/01[0125]{1}[0-9]{8}/', $phone ))
            $error_msg[] = 'Enter valid phone number';
    }

    if(empty($name) || strlen($name) < 5)
        $error_msg[] = 'Name must be more than 5 char';

    if(empty($university) || strlen($university) < 5)
        $error_msg[] = 'University is required';
    if(empty($facebookUrl) || strlen($facebookUrl) < 5)
        $error_msg[] = 'Facebook Url is required';
    if(empty($department))
        $error_msg[] = 'Department is required';
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error_msg[] = 'Enter valid email';
    }

    if($academic == ''){
        $error_msg[] = 'Academic is required';
    }

    if($about == ''){
        $error_msg[] = 'About Us is required';
    }

    if($committee == ''){
        $error_msg[] = 'Committee is required';
    }

    $data = [
        'name' => $name,
        'email' => $email,
        'facebookUrl' => $facebookUrl,
        'phone' => $phone,
        'university' => $university,
        'department' => $department,
        'academic' => $academic,
        'about' => $about,
        'committee' => $committee,
    ];

    if(empty($error_msg)){

        $stmt = $con->prepare('INSERT INTO users (`fullName`, `email`, `facebook`, `phone`, `university`, `department`, `academic`, `about`, `committee`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($name, $email, $facebookUrl, $phone, $university, $department, $academic, $about, $committee));
        $stmt2 = $con->prepare('SELECT id FROM users WHERE phone = ? ORDER BY id DESC LIMIT 1');
        $stmt2->execute([$phone]);
        $row = $stmt2->fetch(PDO::FETCH_ASSOC);
        $_SESSION['userID'] = $row['id'];

        if($committee == 'WEB'){
            header('Location: web.php');
            exit();
        }
        if($committee == 'ANDROID'){
            header('Location: android.php');
            exit();
        }
        if($committee == 'PR'){
            header('Location: pr.php');
            exit();
        }
        if($committee == 'HR'){
            header('Location: hr.php');
            exit();
        }
        if($committee == 'SOCIAL'){
            header('Location: socialMedia.php');
            exit();
        }
        if($committee == 'MEDIA'){
            header('Location: media.php');
            exit();
        }
        if($committee == 'JAVA'){
            header('Location: java.php');
            exit();
        }
        if($committee == 'PYTHON'){
            header('Location: python.php');
            exit();
        }
    }else{
        $_SESSION['errors'] = $error_msg;
        $_SESSION['data'] = $data;
        header('Location: recruite.php');
        exit();
    }


}else{
    header('Location: recruite.php');
    exit();
}

