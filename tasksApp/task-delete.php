<?php
include 'conecction.php';

if(isset($_POST['id'])){

    $id = $_POST['id'];
    $query = "DELETE FROM task WHERE id = $id";
    $res = mysqli_query($conex,$query);

    if(!$res){
        die('query failed');
    }
    echo "Task deleted successfully";

}
