<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class CategoryController extends BaseController{
    public function create(){
        return $this->view('categories/create');
    }

    public function store(){
        var_dump($_POST['emri_kategorise'],$_POST['pershkrimi_kategorise']);
    }
}