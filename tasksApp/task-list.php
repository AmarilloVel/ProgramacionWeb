<?php

 include 'conecction.php';

 $query = "SELECT * from task";
 $result = mysqli_query($conex,$query);

 if(!$result){
     echo "resulta fallida ".mysqli_error($connection);
 }
 
 $json = array();
 //fila por cada dato de la bd
 while($row = mysqli_fetch_array($result)){
       $json[] = array(
           'name' => $row['name'],
           'description' => $row['description'],
           'id' => $row['id']
       );
       
 }
 $jsonString = json_encode($json);
 echo($jsonString);
?>