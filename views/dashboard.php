<?php
session_start();

include_once "../classes/user.php";

$user = new User;
$user_list = $user->getUsers();

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
   <title>Dashboard</title>
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

   <main class="container-fluid" style="padding-top: 80px">
      <div class="row">
         <div class="col-6 mx-auto">
            <h2 class="text-muted">User List</h2>
            <table class="table table-hover">
               <thead class="thead-light">
                  <tr>
                     <th>#</th>
                     <th>First Name</th>
                     <th>Last Name</th>
                     <th>Username</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  while ($user_details = $user_list->fetch_assoc()) {
                  ?>
                     <tr>
                        <td><?= $user_details['id'] ?></td>
                        <td><?= $user_details['first_name'] ?></td>
                        <td><?= $user_details['last_name'] ?></td>
                        <td><?= $user_details['username'] ?></td>
                        <td>
                           <a href="editUser.php?user_id=<?= $user_details['id'] ?>" class="btn btn-outline-warning"><i class="fas fa-pencil-alt"></i></a>
                           <a href="../actions/removeUser.php?user_id=<?= $user_details['id'] ?>" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></a>
                        </td>
                     </tr>
                  <?php
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
   </main>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>