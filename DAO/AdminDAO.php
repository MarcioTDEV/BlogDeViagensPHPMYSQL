<?php

namespace DAO;
require "./Autoload.php";
use Model;


class AdminDAO {
    private \PDO $pdo;

    public function __construct()
    {
        $dsn = "mysql:host=localhost;dbname=blog";
        $this->pdo = new \PDO($dsn, "root","");
    }

    public function buscarPost(Model\AdminModel $model){
        $stmt = $this->pdo->prepare("select artigos.*, admins.nomeCompleto from artigos join admins on artigos.idAdmin = admins.idAdmin where artigos.idArtigo = :id");
        $stmt->bindParam(":id", $model->id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function buscarTodosOsPosts(){
        $stmt = $this->pdo->prepare("select artigos.*, admins.nomeCompleto from artigos join admins on artigos.idAdmin = admins.idAdmin;");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function deletarPost(Model\AdminModel $model){
        $stmt = $this->pdo->prepare("delete from artigos where idArtigo = :id limit 1");
        $stmt->bindParam(":id", $model->id);
        $stmt->execute();
    }

    public function buscarPostsAdmin(Model\AdminModel $model){
        $stmt = $this->pdo->prepare("select * from artigos where idAdmin = :id");
        $stmt->bindParam(":id", $model->id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function inserirNovoPost(Model\AdminModel $model){
        $stmt = $this->pdo->prepare("insert into artigos values (default, :titulo, :foto, :texto, :id)");
        $stmt->bindParam(":titulo", $model->titulo);
        $stmt->bindParam(":foto", $model->foto);
        $stmt->bindParam(":texto", $model->texto);
        $stmt->bindParam(":id", $model->id);
        $stmt->execute();
    }

    // cadastrar um novo usuário após validação
    public function cadastrarNovoUsuário(Model\AdminModel $model){
        $stmt = $this->pdo->prepare("insert into admins values(default, :nome, :email, :senha)");
        $nome = $model->nomeCompleto;
        $email = $model->email;
        $senha = password_hash($model->senha, PASSWORD_DEFAULT);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);
        $stmt->execute();
    }

    // vai verificar se já existe o email cadastrado e recuperar informações de login
    public function buscarCadastroPorEmail(Model\AdminModel $model){
        $stmt = $this->pdo->prepare("select * from admins where email = :email");
        $stmt->bindParam(":email",$model->email);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}