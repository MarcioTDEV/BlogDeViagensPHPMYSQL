<?php

namespace Model;

require "./Autoload.php";
use DAO;


class AdminModel{
    public string $id;
    public string $nomeCompleto;
    public string $email;
    public string $senha;

    public string $titulo;
    public string $foto;
    public string $texto;

    public $array;

    public function buscarPost(){
        $dao = new DAO\AdminDAO();
        $this->array = $dao->buscarPost($this);
    }

    public function buscarTodosOsPosts(){
        $dao = new DAO\AdminDAO();
        $this->array = $dao->buscarTodosOsPosts();
    }

    public function deletarPostagemAdmin(){
        $dao = new DAO\AdminDAO();
        $dao->deletarPost($this);
    }

    public function buscarArtigosDoUsuario(){
        $dao = new DAO\AdminDAO();
        $this->array = $dao->buscarPostsAdmin($this);
    }

    public function realizarLogin(){
        //verificar se o email existe
        $dao = new DAO\AdminDAO();
        $result = $dao->buscarCadastroPorEmail($this);
        if($result === false) return $result;
        return $result;
        // verificar se a senha bate

    }
    
    public function adicionarArtigo(){
        $dao = new DAO\AdminDAO();
        $dao->inserirNovoPost($this);
    }

    public function cadastrarNovoUsuário(){
        $dao = new DAO\AdminDAO();
        $verificarSeExisteEmail = $dao->buscarCadastroPorEmail($this);
        if(count($verificarSeExisteEmail)>0) return false;
        try{
        $cadastrarUsuario = $dao->cadastrarNovoUsuário($this);
        $buscarDadosUsuario = $dao->buscarCadastroPorEmail($this);
        return $buscarDadosUsuario;
        }catch(\PDOException $err){
            echo $err;
        }
        
    }
}