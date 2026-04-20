<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class CategoryController extends BaseController{
    public function index(){
        $sql = "select * from kategorite";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $articles = $result->fetch_all(MYSQLI_ASSOC);
            return $this->view('categories/categories',['articles'=>$articles]);
        }
    }
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

        else{
            $sql = "insert into kategorite(emri_kategorise,pershkrimi_kategorise) value('$emri_i_kategorise','$pershkrimi_i_kategorise')";
            $result = $this->conn->query($sql);

            if($result){
                $flash_success = "Te dhenat u ruajten me sukses";
                return $this->view('categories/create',['flash_success'=>$flash_success]);
            }

            else{
                $flash_error = "Te dhenat nuk u ruajten me sukses";
                return $this->view('categories/create',['flash_error'=>$flash_error]);
            }
        }
    }

    public function edit($id){
        $category_id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);

        $sql = "select * from kategorite where id='$category_id'";

        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $category = $result->fetch_assoc();
            return $this->view('categories/edit',['category'=>$category]);
        }
    }

    public function update($id){
        $category_id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
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
            return $this->view('categories/edit',['error_emri_kategorise'=>$error_emri_kategorise,'error_pershkrimi_kategorise'=>$error_pershkrimi_kategorise]);
        }

        else{
            $sql = "update kategorite set emri_kategorise='$emri_i_kategorise',pershkrimi_kategorise='$pershkrimi_i_kategorise' where id='$category_id'";
            $result = $this->conn->query($sql);

            if($result){
                $flash_success = "Te dhenat u perditesuan me sukses";
                return $this->view('categories/edit',['flash_success'=>$flash_success]);
            }

            else{
                $flash_error = "Te dhenat nuk u perditesuan";
                return $this->view('categories/edit',['flash_error'=>$flash_error]);
            }
        }
    }
}