<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class CategoryController extends BaseController{
    public function create(){
        return $this->view('categories/create');
    }

    public function store(){
        $error = 0;
        // Emri i Kategorise

        $emri_i_kategorise = htmlspecialchars(strip_tags(trim($_POST['emri_kategorise'])));

        if(mb_strlen($emri_i_kategorise) < 3){
            $error_emri_kategorise = "Ju lutemi te shenoni se paku 3 karaktere";
            ++$error;
        }

        // Pershkrimi i Kategorise

        $pershkrimi_i_kategorise = htmlspecialchars(strip_tags(trim($_POST['pershkrimi_kategorise'])));

        if(mb_strlen($pershkrimi_i_kategorise) < 3){
            $error_pershkrimi_kategorise = "Ju lutemi te shenoni se paku 3 karaktere";
            ++$error;
        }

        // Error

        if($error > 0){
            return $this->view('categories/create',['error_emri_kategorise'=>$error_emri_kategorise,'error_pershkrimi_kategorise'=>$error_pershkrimi_kategorise]);
        }
    }
}