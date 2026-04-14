<?php

namespace App\Controllers;

use mysqli;

class BaseController{

    public $twig;
    public $conn;

    public function __construct(){
        $this->conn = new mysqli('localhost','root','','startcodeacademyproject');

        if($this->conn->connect_error){
            die("Lidhja me bazen e te dhenave ka deshtuar ".$this->conn->connect_error);
        }

        // else{
        //     echo "Lidhja me bazen e te dhenave eshte realizuar me sukses";
        // }

        $loader = new \Twig\Loader\FilesystemLoader('App/Views');
        $this->twig = new \Twig\Environment($loader, [
        'cache' => false]);
    }


    public function view($file, $data=[]){
        echo $this->twig->render($file.'.html', $data);
    }


}