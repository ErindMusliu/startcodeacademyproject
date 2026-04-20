<?php

namespace App\Models;
use App\Models\Model;
use mysqli;

class Category extends Model{
    public static function all(){
        $conn = new mysqli('localhost','root','','startcodeacademyproject');
        $sql = "select * from kategorite";
        $result = $conn->query($sql);

        if($result->num_rows>0){
            return $articles = $result->fetch_all(MYSQLI_ASSOC);
        }
    }
}