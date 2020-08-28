<div class="opcion">
<?php
    $widthBar = $porcentaje *5;
    $estilo = "barra";  

    //damos  diferente color al lenguaje seleccionado
    if($survey->getOptionSelected() == $lenguaje['opcion']){
        $estilo = "seleccionado";
    }

    echo($lenguaje['opcion']);
?>
    <div class="<?php echo $estilo; ?>" style ="width: <?php echo $widthBar.'px;' ?>"><?php echo $porcentaje.'%'?></div>
</div>