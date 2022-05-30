<?php
session_start();

include_once "../classes/user.php";

$user = new User;
$user_details = $user->getUser($_SESSION['user_id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta name="Description" content="Enter your description here" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
   <title>Profile</title>
</head>

<body>
   <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a href="dashboard.php" class="navbar-brand">
         <h1 class="h3">The Company</h1>
      </a>

      <div class="ml-auto">
         <ul class="navbar-nav">
            <li class="nav-item">
               <a href="profile.php" class="nav-link"><?= $_SESSION['username'] ?></a>
            </li>
            <li class="nav-item">
               <a href="../actions/logout.php" class="nav-link text-danger">Log out</a>
            </li>
         </ul>
      </div>
   </nav>

   <main class="card w-25 mx-auto my-5">
      <img src="../img/<?= $user_details['photo'] ?>" alt="Profile Picture" class="card-img-top">
      <div class="card-body">
         <form enctype="multipart/form-data" action="../actions/uploadPhoto.php" method="post">
            <div class="custom-file mb-2">
               <label for="photo" class="custom-file-label">Choose Photo</label>
               <input type="file" name="photo" id="photo" class="custom-file-input">
            </div>

            <button type="submit" class="btn btn-outline-secondary btn-sm btn-block">Update Photo</button>
         </form>
      </div>
        <div class="card-footer border-0 bg-white">
            <p class="lead font-weight-bold mb-0"><?= $user_details['first_name'] . " " . $user_details['last_name'] ?></p>
            <p class="lead"><?= $user_details['username'] ?></p>
        </div>
   </main>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>