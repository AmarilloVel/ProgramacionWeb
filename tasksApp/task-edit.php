<?php

include 'conecction.php'; 

$id = $_POST['id'];
$name = $_POST['name'];    
$description = $_POST['description'];   

//actualiza la tarea donde coincida el id 
$query = "UPDATE task SET name = '$name', description = '$description' WHERE id=$id";

$result = mysqli_query($conex,$query);
if(!$result){
    die('Query Failed');
}{
    echo "Task edited successfully"; 
}