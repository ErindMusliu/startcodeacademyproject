<?php

namespace App\Models;
use mysqli;

class Model{
    public $conn;

    public function __construct(){
        $this->conn = new mysqli('localhost','root','','startcodeacademyproject');

        if($this->conn->connect_error){
            die("Lidhja me bazen e te dhenave ka deshtuar ".$this->conn->connect_error);
        }
    }
}