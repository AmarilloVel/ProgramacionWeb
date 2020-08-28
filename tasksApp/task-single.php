<?php
//Obtener una tarea a traves de un id
include 'conecction.php';

$id = $_POST['id'];
$query = "SELECT * FROM task WHERE id = $id";
$result = mysqli_query($conex,$query);
if(!$result){
    die('Query Failed');
}

//convertimos los resultado a un obj json 
$json = array();

while($row = mysqli_fetch_array($result)){

    $json[] = array(
        'name' => $row['name'],
        'description' => $row['description'],
        'id' => $row['id']
    );
    
}

$jsonString = json_encode($json[0]);
echo $jsonString;
