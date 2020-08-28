<?php
include 'db.php';

class Survey extends DB{
    
    private $totalVotes;
    private $optionSelected;


    public function setOptionSelected($option){
        $this->optionSelected = $option;
    }

    public function getOptionSelected(){
        return $this->optionSelected; 
    }


    public function vote(){
        //                                                                                        :variable temporal gracias al PDO 
        $query = $this->connect()->prepare("UPDATE lenguajes SET votos = votos + 1 WHERE opcion = :opcion");
        //cambiamos variable temporal
        $query->execute(['opcion' => $this->optionSelected]);
    }

    public function showResults(){
        //regresamos una consulta
        return $this->connect()->query('SELECT * FROM lenguajes');
    }

    public function getTotalVotes(){
        //regresa conuslta que regresa la suma de los votos/ 
        $query = $this->connect()->query('SELECT SUM(votos) as total_votes FROM lenguajes');
                                    //propiedad para que nos haga un arreglo simple
        $this->totalVotes= $query->fetch(PDO::FETCH_OBJ)->total_votes;
        return $this->totalVotes;
    }

    //funcion que daca porcentages de cada opcion
    public function getPercentageVotes($Opvotes){
        return round(($Opvotes/$this->totalVotes)*100,0);
    }
}

?>