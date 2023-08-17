<?php
include 'component/connect.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)) {
    header('location:login.php');
}

if(isset($_POST['add_product'])) {
    $matric = $_POST['matric'];
    $matric = filter_var($matric, FILTER_SANITIZE_STRING);
    $department = $_POST['department'];
    $department = filter_var($department, FILTER_SANITIZE_STRING);
    $details = $_POST['details'];
    $details = filter_var($details, FILTER_SANITIZE_STRING);

    $image_01 = $_FILES['image_01']['name'];
    $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
    $image_01_size = $_FILES['image_01']['size'];
    $image_01_tmp_name = $_FILES['image_01']['tmp_name'];
    $image_01_folder = 'uploaded_img/'.$image_01;

    $image_02 = $_FILES['image_02']['name'];
    $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
    $image_02_size = $_FILES['image_02']['size'];
    $image_02_tmp_name = $_FILES['image_02']['tmp_name'];
    $image_02_folder = 'uploaded_img/'.$image_02;

    $image_03 = $_FILES['image_03']['name'];
    $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
    $image_03_size = $_FILES['image_03']['size'];
    $image_03_tmp_name = $_FILES['image_03']['tmp_name'];
    $image_03_folder = 'uploaded_img/'.$image_03;

    $select_products = $conn->prepare("SELECT * FROM `answer` WHERE matric = ?");
    $select_products->execute([$matric]);

    if($select_products->rowCount() > 0) {
        $message[] = 'Answer name already exists';
    }else {
        if($image_01_size > 2000000 OR $image_02_size > 2000000 OR $image_03_size > 2000000) {
            $message[] = 'image size is too large';
        }else {

            move_uploaded_file($image_01_tmp_name, $image_01_folder);
            move_uploaded_file($image_02_tmp_name, $image_02_folder);
            move_uploaded_file($image_03_tmp_name, $image_03_folder);


            $insert_product = $conn->prepare("INSERT INTO `answer`(matric, department, details, image_01, image_02, 
            image_03) VALUES(?,?,?,?,?,?)");
            $insert_product->execute([$matric, $department, $details, $image_01, $image_02, $image_03]);

            $message[] = 'Answer Posted';
        }
    }



}

if(isset($_GET['delete'])) {

    $delete_id = $_GET['delete'];
    $delete_product_image = $conn->prepare("SELECT * FROM `answer` WHERE id = ?");
    $delete_product_image->execute([$delete_id]);
    $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
    unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
    unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
    unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
    $delete_product = $conn->prepare("DELETE FROM `answer` WHERE id = ?");
    $delete_product->execute([$delete_id]);
    header('location:assignment.php');

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
    <link rel="stylesheet" href="other.css">
    <link rel="icon" href="img/logo.png">
    <title>Student Answer</title>
</head>
<body>

<div class="loader"></div>

<header class="header">
    <section class="flex">
        <a href="dashboard.php" class="logo">Student<span>Panel</span></a>

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
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
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


<h1 class="heading">Post Answer</h1>
<!-- add products section starts -->
<section class="add-products">
    <form action="" method="POST" enctype="multipart/form-data">
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
        <div class="flex">
            <div class="inputBox">
                <span>Matric (required)</span>
                <input type="text" placeholder="Enter Matric" name="matric" maxlength="100" class="box" required>
            </div>
            <div class="inputBox">
                <span>Department (required)</span>
                <input type="text" placeholder="Enter Department" name="department" maxlength="100" class="box" required>
            </div>
            <div class="inputBox">
                <span>Image 01 (required)</span>
                <input type="file" name="image_01" class="box" accept="image/jpg, image/png, image/jpeg, image/webp" required>
            </div>
            <div class="inputBox">
                <span>Image 02 (required)</span>
                <input type="file" name="image_02" class="box" accept="image/jpg, image/png, image/jpeg, image/webp" required>
            </div>
            <div class="inputBox">
                <span>Image 03 (required)</span>
                <input type="file" name="image_03" class="box" accept="image/jpg, image/png, image/jpeg, image/webp" required>
            </div>
            <div class="inputBox">
                <span>Assignment Details (required)</span>
                <textarea name="details" class="box" placeholder="Enter Assignment Details" maxlength="500" cols="30" rows="10" required></textarea>
            </div>
            <input type="submit" value="Post Answer" name="add_product" class="outer-btn">
        </div>
    </form>




</section>
<!-- add products section sends -->

<!-- show products section starts -->
<section class="show-products" style="padding-top: 0;">
    <h1 class="heading">Answer Added</h1>
    <div class="box-container">
        <?php
        $show_answer = $conn->prepare("SELECT * FROM `answer`");
        $show_answer->execute();
        if($show_answer->rowCount() > 0) {
            while($fetch_answer = $show_answer->fetch(PDO::FETCH_ASSOC)){
        ?>
        <div class="box">
            <img src="uploaded_img/<?= $fetch_answer['image_01']; ?>">
            <div class="name"><span>Matric Number:</span> <?= $fetch_answer['matric']; ?></div>
            <div class="price"><?= $fetch_answer['department']; ?></div>
            <div class="details"><?= $fetch_answer['details']; ?></div>
            <p>Answer Status: <span style="color:<?php if($fetch_answer['status'] == 'wrong'){echo 'red';}else{echo 'green';}?>;"><?= $fetch_answer['status']; ?></span></p>
            <div class="flex-btn">
                <a href="update_answer.php?update=<?= $fetch_answer['id']; ?>" class="option-btn">Update</a>
                <a href="answer.php?delete=<?= $fetch_answer['id']; ?>" 
                class="delete-btn" onclick="return confirm('Are you sure you want to delet this answer')">Delete</a>
            </div>
        </div>
        <?php }
        }
        else {
            echo ' <p class="empty">No Answer posted yet?</p>';
        }
        ?>
    </div>
</section>
<!-- show products section ends -->


<script type="text/javascript" src="main.js"></script>
<script type="text/javascript" src="script.js"></script>

</body>
</html>