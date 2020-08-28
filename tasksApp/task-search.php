<?php
include 'conecction.php';

$search = $_POST['search'];

if(!empty($search)){
    //consulta de busqueda
    $query = "SELECT * FROM task WHERE name LIKE '$search%'";
    $result = mysqli_query($conex,$query);
    if(!$result){
        die('Query Error'.mysqli_error($conex));
    }

    //recorrimos resultados, los convertimos a json y los metemos a un array
    $json = array();
    while($row =mysqli_fetch_array($result)){
        
        $json[] = array(
            'name' => $row['name'],
            'description' => $row['description'],
            'id' => $row['id']
            //acomodar los id autoincrement

        );
    }
    
    $jsonstring = json_encode($json);
    echo($jsonstring);
}


?>
