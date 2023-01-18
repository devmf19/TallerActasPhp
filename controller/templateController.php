<?php

class TemplateController{
    //Se encarga de invocar el archivo template.php que es la interfaz o plantilla principal
    public function template(){
        include "view/template.php";
    }

}