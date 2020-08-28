<?php

    include 'includes/survey.php'



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Encuesta</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css" >
    <link rel="stylesheet" href="main.css" >

</head>
<body>
     <center>
           <br> <h2>Con que lenguaje prefieres desarrollar backend?</h1><br>
    </center>
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <form action="#" method="POST">
                
                        
                    <div class="form-group form-check">
                        
                        <div class="card ">
                            <div class="card-body">
                            <?php   
                                
                                $survey = new Survey();
                                $showResults = false;
  
                                //validamos si queremos mostrar el fomr o los result de la votacion
                                //  
                                if(isset($_POST['lenguaje'])){
                                    
                                     $showResults = true;

                                     $survey->setOptionSelected($_POST['lenguaje']);
                                     $survey->vote();

                                     //echo ($survey->getTotalVotes());
                                     
                                    
                                }

                                if($showResults){
                                    $result = $survey->showResults();
                                    echo '<h2>'.$survey->getTotalVotes().'votos totales</h2>';
                                   

                                    foreach($result  as $lenguaje){
                                        
                                        $porcentaje =   $survey->getPercentageVotes($lenguaje['votos']);
                                        include 'vistas/vista-result.php';
                                        
                                    }
                                
                                }else{
                                     include 'vistas/vista-votacion.php';
                                }
                            ?>

                            </div>
                        </div>
                            
                    </div>    
                    
             </form>
             
        </div>
        <div class="col"></div>
       
    </div>
    
    
</body>
</html>