<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class AdminController extends BaseController{
    public function index(){
        return $this->view('admin/dashboard');
    }
}