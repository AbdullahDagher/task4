<?php
    session_start();
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
                 <h2>General Information</h2>
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
                 <form action="register.php" method="post">
                     <label>Full Name :<span>*</span></label>
                     <input name="name" type="text" required value="<?php if(isset($_SESSION['data'])) echo $_SESSION['data']['name'] ?>">
                     <label>Email :<span>*</span></label>
                     <input name="email" type="email" required value="<?php if(isset($_SESSION['data'])) echo $_SESSION['data']['email'] ?>">
                     <label>Facebook Url :<span>*</span></label>
                     <input name="facebookUrl" type="url" required value="<?php if(isset($_SESSION['data'])) echo $_SESSION['data']['facebookUrl'] ?>">
                     <label>Phone :<span>*</span></label>
                     <input name="phone" type="text" required value="<?php if(isset($_SESSION['data'])) echo $_SESSION['data']['phone'] ?>"/>
                     <label>University :<span>*</span></label>
                     <input name="university" type="text" required value="<?php if(isset($_SESSION['data'])) echo $_SESSION['data']['university'] ?>">
                     <label>Department :<span>*</span></label>
                     <input name="department" type="text" required value="<?php if(isset($_SESSION['data'])) echo $_SESSION['data']['department'] ?>">
                     <label>Academic year :<span>*</span></label>
                     <select name="academic">
                         <option value="">Choose Academic year ...</option>
                         <option value="1" <?php if(isset($_SESSION['data']) && $_SESSION['data']['academic'] == '1') echo 'selected'?>> 1 </option>
                         <option value="2" <?php if(isset($_SESSION['data']) && $_SESSION['data']['academic'] == '2') echo 'selected'?>> 2 </option>
                         <option value="3" <?php if(isset($_SESSION['data']) && $_SESSION['data']['academic'] == '3') echo 'selected'?>> 3 </option>
                         <option value="4" <?php if(isset($_SESSION['data']) && $_SESSION['data']['academic'] == '4') echo 'selected'?>> 4 </option>
                         <option value="5" <?php if(isset($_SESSION['data']) && $_SESSION['data']['academic'] == '5') echo 'selected'?>> 5 </option>
                     </select>
                     <label>How did you know about us ? :<span>*</span></label>
                     <select name="about">
                         <option value="" >you know about us from ...</option>
                         <option value="friend"  <?php if(isset($_SESSION['data']) && $_SESSION['data']['about'] == 'friend') echo 'selected'?>> Friends </option>
                         <option value="facebook"  <?php if(isset($_SESSION['data']) && $_SESSION['data']['about'] == 'facebook') echo 'selected'?>> Facebook </option>
                         <option value="university"  <?php if(isset($_SESSION['data']) && $_SESSION['data']['about'] == 'university') echo 'selected'?>> University </option>
                         <option value="others"  <?php if(isset($_SESSION['data']) && $_SESSION['data']['about'] == 'others') echo 'selected'?>> Others </option>
                     </select>
                     <label>Selection of committee :<span>*</span></label>
                     <select name="committee">
                         <option value="">Selection of committee ...</option>
                         <option value="PR" <?php if(isset($_SESSION['data']) && $_SESSION['data']['committee'] == 'PR') echo 'selected'?>> Pr Committee </option>
                         <option value="HR" <?php if(isset($_SESSION['data']) && $_SESSION['data']['committee'] == 'HR') echo 'selected'?>> Hr Committee </option>
                         <option value="SOCIAL" <?php if(isset($_SESSION['data']) && $_SESSION['data']['committee'] == 'SOCIAL') echo 'selected'?>> Social Media Committee </option>
                         <option value="MEDIA" <?php if(isset($_SESSION['data']) && $_SESSION['data']['committee'] == 'MEDIA') echo 'selected'?>> Media Committee </option>
                         <option value="JAVA" <?php if(isset($_SESSION['data']) && $_SESSION['data']['committee'] == 'JAVA') echo 'selected'?>> Java Committee </option>
                         <option value="ANDROID" <?php if(isset($_SESSION['data']) && $_SESSION['data']['committee'] == 'ANDROID') echo 'selected'?>> Android Committee </option>
                         <option value="PYTHON" <?php if(isset($_SESSION['data']) && $_SESSION['data']['committee'] == 'PYTHON') echo 'selected'?>> Python Committee </option>
                         <option value="WEB" <?php if(isset($_SESSION['data']) && $_SESSION['data']['committee'] == 'WEB') echo 'selected'?>> Web Committee </option>
                     </select>
                     <input type="reset" value="Reset" />
                     <input type="submit" value="Next" />
                 </form>
                 <!-- footer -->
                 <p>&copy; 2019 Recruitment form . all rights reserved | design by <span>Alhasan gamal</span></p>
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