<?php

class imagen {

    private $tmp_name;
    private $name;
    private $type;

    function __Construct($tmp_name,$name,$type){

        $this->tmp_name=$tmp_name;
        $this->name=$name;
        $this->type=$type;

    }

    function esta_cargado(){
    
        return is_uploaded_file($this->tmp_name);

    }

    function cambiar_nombre(){

        if(!$name ){
            
        }

    }

    function mover(){


    }
}