<?php
class Operaciones extends CI_Controller{
    function __construct(){
        parent::__construct();
        echo "<h2>Controlador de Operaciones</h2>";
    }
    public function index(){

    }
    public function todas($intA=0, $intB=0){
        $this->suma($intA, $intB);
        $this->resta($intA, $intB);
    }
    public function suma($intA=0,$intB=0){
        echo "<h3>SUMA</h3>";
        $intRes= $intA+$intB;
        echo "<p>La suma de $intA + $intB es igual a: $intRes";
    }
    public function resta($intA=0,$intB=0){
        echo "<h3>RESTA</h3>";
        $intRes=$this->realizarResta($intA,$intB);
        echo "<p>La resta de $intA - $intB es igual a: $intRes</p>";
    }
    public function realizarResta($parA,$parB){
        return $parA-$parB;
    }
}
?>