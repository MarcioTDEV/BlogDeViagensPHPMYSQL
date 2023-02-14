<?php 

namespace Control;
require './Autoload.php';
use Model;

class Control{

    public static function BuscarPost(){
        $model = new Model\AdminModel();
        $model->id = $_POST['post'];
        $model->buscarPost();
        $items = $model->array;
        require "View/Header.php";
        require "View/Posts.php";
    }

    public static function index(){
        $model = new Model\AdminModel();
        $model->buscarTodosOsPosts();
        $items = $model->array;
        
        require "View/Header.php";
        require "View/Home.php";
    }
    public static function buscarPaginaLogin(){
        require "View/Header.php";
        require "View/Login.php";
    }


}