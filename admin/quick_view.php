<?php
include '../component/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)) {
    header('location:login.php');
}

if(isset($_POST['update_payment'])) {

    $answer_id = $_POST['answer_id'];
    $status = $_POST['status'];
    $update_status = $conn->prepare("UPDATE `answer` SET status = ? WHERE id = ?");
    $update_status->execute([$status, $answer_id]);
    $message[] = 'Payment Status Updated';
}

// if(isset($_GET['delete'])) {
//     $delete_id = $_GET['delete'];
//     $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
//     $delete_order->execute([$delete_id]);
//     header('location:placed_orders.php');
// }


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
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../img/logo.png">
    <title>Quick View</title>
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
<!-- quick view section starts -->
<section class="quick-view">
    <h1 class="heading">Quick View</h1>


    <div class="box-container">

    <?php
    $pid = $_GET['pid'];
    $select_answer = $conn->prepare("SELECT * FROM `answer` WHERE id = ?");
    $select_answer->execute([$pid]);
    if($select_answer->rowCount() > 0) {
    while($fetch_answer = $select_answer->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <form action="" method="POST" class="box">
        <input type="hidden" name="pid" value="<?= $fetch_answer['id']; ?>">
        <input type="hidden" name="matric" value="<?= $fetch_answer['matric']; ?>">
        <input type="hidden" name="department" value="<?= $fetch_answer['department']; ?>">
        <input type="hidden" name="image" value="<?= $fetch_answer['image_01']; ?>">
        <div class="image-container">
            <div class="big-image">
            <img src="../uploaded_img/<?= $fetch_answer['image_01']; ?>" class="main">
            </div>
            <div class="small-images">
                <img src="../uploaded_img/<?= $fetch_answer['image_01']; ?>" class="sub">
                <img src="../uploaded_img/<?= $fetch_answer['image_02']; ?>" class="sub">
                <img src="../uploaded_img/<?= $fetch_answer['image_03']; ?>" class="sub">
            </div>
        </div>
        <div class="content">

            
            <div class="name"><?= $fetch_answer['matric']; ?></div>
            <div class="name"><?= $fetch_answer['department']; ?></div>
            <!-- <div class="flex">
                <div class="price">$<span><?= $fetch_answer['price']; ?></span>/-</div>
                <input type="number" name="qty" class="qty" min="1" value="1" onkeypress="if(this.value.length == 2) return false;">
            </div> -->
            <div class="details"><?= $fetch_answer['details']; ?></div>
            <form action="" method="POST">
                <input type="hidden" name="answer_id" value="<?= $fetch_answer['id']; ?>"> 
                <select name="status" class="drop-down">
                    <option value="" selected disabled><?= $fetch_answer['status'];?></option>
                    <option value="wrong">Wrong</option>
                    <option value="correct">Correct</option>
                </select>
                <div class="flex-btn">
                    <a href="quick_view.php?pid=<?= $fetch_answer['id']; ?>" class="outer-btn"><i class="fas fa-eye"></i> View</a>
                    <input type="submit" value="Update" class="option-btn" name="update_payment">
                </div>
            </form>
        </div>
    </form>
    <?php
    }
    }else {
            echo '<p class="empty">No Assignment Found</p>';
    }
    ?>
    </div>
</section>

<!-- quick view section ends -->

<script type="text/javascript" src="main.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>