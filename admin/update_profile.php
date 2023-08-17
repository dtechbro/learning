<?php

include '../component/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

   $username = $_POST['username'];
   $username = filter_var($username, FILTER_SANITIZE_STRING);

   $update_profile_name = $conn->prepare("UPDATE `admins` SET username = ? WHERE id = ?");
   $update_profile_name->execute([$username, $admin_id]);

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = md5($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = md5($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = md5($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass == $empty_pass){
      $message[] = 'Please enter old password!';
   }elseif($old_pass != $prev_pass){
      $message[] = 'Old password not matched!';
   }elseif($new_pass != $confirm_pass){
      $message[] = 'Confirm password not matched!';
   }elseif($new_pass < 8){
      $message[] = 'Password must be atleast 8 digit!';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
         $update_admin_pass->execute([$confirm_pass, $admin_id]);
         $message[] = 'Password updated successfully!';
      }else{
         $message[] = 'Please enter a new password!';
      }
   }
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/brands.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/regular.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/solid.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/svg-with-js.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/v4-font-face.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/v4-shims.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/6.0.2/esm/ionicons.min.js">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,500;1,300;1,400&family=Poppins:ital,wght@0,900;1,500;1,700;1,800;1,900&family=Roboto:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
    <!-- Animation Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Swiper Js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <!-- MDB-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link rel="stylesheet" href="form.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../img/logo.png">
    <title>Lecturer Update Profile</title>
</head>
<body>

<div class="loader"></div>

<header class="header">
    <section class="flex">
        <a href="dashboard.php" class="logo">Lecturer<span>Panel</span></a>

        <nav class="navbar">
            <a href="dashboard.php">Home</a>
            <a href="assignment.php">Assignment</a>
            <a href="answer.php">Answers</a>
            <a href="messages.php">Question</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="profile">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <p><?= $fetch_profile['username']?></p>
            <a href="update_profile.php" class="outer-btn">Update Profile</a>
            <div class="flex-btn">
                <a href="login.php" class="option-btn">Login</a>
                <a href="register.php" class="option-btn">Register</a>
            </div>
            <a href="logout.php" onclick="return confirm('Are you sure you want to Logout');" class="delete-btn">Logout</a>
        </div>

    </section>
</header>

<section id="form-container">
    <div class="container">
        <form action="" method="POST">
            <div class="logo text-center">
                <img src="../img/logo.png">
                <h4>Update Profile</h4>
            </div>
            <?php
            if(isset($message)) {
                foreach($message as $message) {
                    echo '
                    <div class="message">
                        <span>'.$message.'</span>
                        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                    </div>
                    ';
                }
            }
            ?>
            <input type="hidden" name="prev_pass" value="<?= $fetch_profile['password']; ?>">
             <!-- Username input -->
             <div class="mb-3">
            <label class="form-label" for="form1Example2">User Name</label>
            <input type="text" id="form1Example2" name="username" value="<?= $fetch_profile['username']; ?>" class="form-control" />
            </div>

            <!-- Email input -->
            <div class="mb-3">
            <label class="form-label" for="form1Example1">Email address</label>
            <input type="email" id="form1Example1" name="email" value="<?= $fetch_profile['email']; ?>" aria-describedby="emailHelp" class="form-control" />
            <div id="emailHelp" class="form-text"> We'll never share your email with anyone else</div>
            </div>
        
            <!-- Old Password input -->
            <div class="mb-3">
            <label class="form-label" for="form1Example3">Old Password</label>
            <input type="password" name="old_pass" id="form1Example3" class="form-control" />
            </div>

            <!-- New Password input -->
            <div class="mb-3">
            <label class="form-label" for="form1Example4">New Password</label>
            <input type="password" name="new_pass" id="form1Example4" class="form-control" />
            </div>

            <!-- Confirm New Password input -->
            <div class="mb-3">
            <label class="form-label" for="form1Example4">Confirm New Password</label>
            <input type="password" name="confirm_pass" id="form1Example4" class="form-control" />
            </div>
        
            <!-- Password input
            <div class="mb-3">
            <label class="form-label" for="form1Example4">Login As</label>
            <select class="form-control" id="form1Example4">
                <option value="Admin">Admin</option>
                <option value="Student">Student</option>
                <option value="Teacher">Teacher</option>
            </select>
            </div> -->
        
            <!-- Submit button -->
            <input type="submit" value="Update" name="submit" class="btn btn-primary btn-block">
            <a href="dashboard.php" class="btn btn-warning btn-block text-center text-decoration-none">Go back</a>
        </form>
    </div>
</section>



<script type="text/javascript" src="main.js"></script>

</body>
</html>