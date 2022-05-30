<?php
require_once "database.php";

class User extends Database {

   public function createUser($first_name,$last_name,$username,$password){
      $sql = "INSERT INTO users (first_name, last_name, username,`password`) VALUES ('$first_name', '$last_name', '$username','$password')";

      if($this->conn->query($sql)){
          header("location: ../views");
          exit;
      } else {
          die("Error creating user: . $this->conn->error");
      }
   }

   public function login($username, $password){
      $sql = "SELECT id, username, `password` FROM users WHERE username = '$username'";

      $result = $this->conn->query($sql);
      if($result->num_rows == 1){
         $user_details = $result->fetch_assoc();
         if(password_verify($password, $user_details['password'])){

            session_start();

            $_SESSION['user_id'] = $user_details['id'];
            $_SESSION['username'] = $user_details['username'];

            header("location: ../views/dashboard.php");
            exit;
         } else {
            die("Password is incorrect.");
         }
      } else {
         die("Username not found.");
      }
   }

   public function getUsers(){
      $sql = "SELECT id, first_name, last_name, username FROM users";

      if($result = $this->conn->query($sql)){
         return $result;
      }else{
         die("Error retrieving users: ");
      }
   }

   public function getUser($user_id){
      $sql = "SELECT * FROM users WHERE id = $user_id";

      if($result = $this->conn->query($sql)){
         return $result->fetch_assoc();
      }else{
         die("Error retrieving user: " . $this->conn->error);
      }
   }

   public function updateUser($user_id, $first_name, $last_name,$username){
      $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', username = '$username' WHERE id = $user_id";

      if($this->conn->query($sql)){
         header("location: ../views/dashboard.php");
         exit;
      }else{
         die("Error updating user: " . $this->conn->error);
      }
   }

   public function uploadPhoto($user_id, $image_name, $tmp_name){
      $sql = "UPDATE users SET photo = '$image_name' WHERE id = $user_id";

      if ($this->conn->query($sql)) {
         $destination = "../images/$image_name";
         if (move_uploaded_file($tmp_name, $destination)) {
            header("location: ../views/profile.php");
            exit;
         } else {
            die("Error moving the photo.");
         }
      } else {
         die("Error uploading photo: " . $this->conn->error);
      }
   }

   public function deleteUser($user_id){
      $sql = "DELETE FROM users WHERE id = $user_id";

      if($this->conn->query($sql)){
         header("location: ../views/dashboard.php");
         exit;
      }else{
         die("Error deleting user: " . $this->conn->error);
      }
   }
}