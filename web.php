<?php
    session_start();
    if(!isset($_SESSION['userID'])){
        header('Location: recruite.php');
        exit();
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Recruitment Form</title>
    <link rel="icon" href="imgs/fav.png">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
</head>
<body onload="myFunction()" style="margin:0;">
<!-- Display Loader -->
<div id="loader">
    <img src="imgs/loader.gif" alt="IEEE">
</div>
<!-- Display body -->
<div style="display:none;" id="myDiv">
    <!-- Display the countdown timer in an element -->
    <p id="demo"></p>
    <!-- Header -->
    <div class="header">
        <img src="imgs/logo-black.png">
    </div>
    <div class="container">
        <div class="main">
            <h2> Web Question </h2>
            <span id="error">

                <?php
                if(isset($_SESSION['errors'])){
                    if(!empty($_SESSION['errors'])){
                        echo '<div class="alert alert-danger">';
                        echo '<ul>';
                        foreach ($_SESSION['errors'] as $error){
                            echo '<li>' ;
                            echo $error;
                            echo '</li>' ;
                        }
                        echo '</ul>';
                        echo   '</div>';
                    }
                }
                ?>
 </span>
            <form action="webRegistration.php" method="post">
                <label>Why do you choose to join (Web) committee
                    specifically?<span>*</span></label>
                <input name="causeOfChoose" type="text" required value="<?php if(isset($_SESSION['data'])) echo $_SESSION['data']['causeOfChoose'] ?>">
                <label>HTML is brief to ..?<span>*</span></label>
                <input name="HTML" type="text" required value="<?php if(isset($_SESSION['data'])) echo $_SESSION['data']['HTML'] ?>">
                <label>What do you know about Grid System ?<span>*</span></label>
                <input name="gridSystem" type="text" required value="<?php if(isset($_SESSION['data'])) echo $_SESSION['data']['gridSystem'] ?>">
                <label>What is the difference between class and id ?<span>*</span></label>
                <input name="idAndClass" type="text" required value="<?php if(isset($_SESSION['data'])) echo $_SESSION['data']['idAndClass'] ?>">
                <input type="reset" value="Reset" />
                <input type="submit" value="Submit" />
            </form>
            <!-- footer -->
            <p>&copy; 2019 Recruitment form . all rights deserved | design by <span>Alhasan gamal</span></p>
        </div>
    </div>
</div>
</body>
</html>

<?php
if(isset($_SESSION['errors'])){
    unset($_SESSION['errors']);
}
if(isset($_SESSION['data'])){
    unset($_SESSION['data']);
}
?>
