<?php

include 'conecction.php';

if(isset($_POST['name'])){
   $name = $_POST['name'];
   $description = $_POST['description'];
   $query = "INSERT into task(name, description) VALUES ('$name','$description')";

   $result = mysqli_query($conex,$query);
   if(!$result){
       die('Query Failed');
   }
   echo 'Task added successfully';
}

?>