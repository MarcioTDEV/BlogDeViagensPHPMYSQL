<?php

namespace Control;


require "./Autoload.php";

use Model;


class AdminControl
{

    public static function DeletarPost (){
        $model = new Model\AdminModel();
        unlink("View/Assets/img/".$_POST['foto']);
        $model->id = $_POST['idArtigo'];
        $model->deletarPostagemAdmin();
        header("Location: /home");
    }

    public static function salvarPost()
    {
        //VERIFICAR SE TODOS OS CAMPOS ESTÃO PREENCHIDOS
        if (
            empty($_POST['tituloArtigo']) ||
            empty($_FILES['fotoDeCapa']) ||
            empty($_POST['textoArtigo'])
            ) {
                $_SESSION['erroCriarPost'] = "Todos os campos devem ser preenchidos";
                header("Location: /novoPost");
                return;
            }
            
            //VALIDAR O FORMATO DA FOTO
            $formatos = ['jpg', 'jpeg', 'png'];
            $extensaoDaFoto = pathinfo($_FILES['fotoDeCapa']['name'], PATHINFO_EXTENSION);
            if (!in_array($extensaoDaFoto, $formatos)) {
                $_SESSION['erroCriarPost'] = "O formato da imagem precisa ser jpg, png ou jpeg";
                header("Location: /novoPost");
                return;
            }
            
            $path = "View/Assets/img/";
            $tmpNome = $_FILES['fotoDeCapa']['tmp_name'];
            $novoNome = uniqid() . ".$extensaoDaFoto";
            
            //ADICIONAR FOTOS NO SERVIDOR
            move_uploaded_file($tmpNome, $path . $novoNome);
            
            //MANDAR OS DADOS PARA O BANCO, INSTANCIANDO A MODEL
        $model = new Model\AdminModel();
        $model->texto = $_POST['textoArtigo'];
        $model->titulo = $_POST['tituloArtigo'];
        $model->id = $_POST['id'];
        $model->foto = $novoNome;
        $model->adicionarArtigo();
        header("Location: /home");
    }
    
    public static function HomeAdmin(){
        if(!isset($_SESSION['user'])){
            header("Location: /");
            return;
        }
        $model = new Model\AdminModel();
        $model->id = $_SESSION['user']['0']['idAdmin'];
        $model->buscarArtigosDoUsuario();
        $items = $model->array;
        require "View/Admin/Home.php";
    }
    
    public static function realizarLogin()
    {
        //campos vazios?
        if (empty($_POST['loginEmail']) || empty($_POST['loginSenha'])) {
            $_SESSION['erro_login'] = "Login ou senha não podem ficar vazios";
            header("Location: /login");
            return;
        }
        // validar email e senha verificando model dao
        $model = new Model\AdminModel();
        $model->email = $_POST['loginEmail'];
        $model->senha = $_POST['loginSenha'];

        $resultado = $model->realizarLogin();
        //verificando se há registro de email cadastrado
        if (count($resultado) == 0) {
            $_SESSION['erro_login'] = "Email não encontrado no sistema";
            header("Location: /login");
            return false;
        }
        // verificando se a senha coincide
        if (!password_verify($_POST['loginSenha'], $resultado[0]['senha'])) {
            $_SESSION['erro_login'] = "A senha está incorreta";
            header("Location: /login");
            return false;
        }


        $_SESSION['user'] = $resultado;
        header("Location: /home");
    }

    public static function encerrarSessao()
    {
        unset($_SESSION['user']);
        session_destroy();
        header("Location: /");
    }


    public static function paginaNovoPost()
    {
        require "View/Admin/NovoPost.php";
    }

    public static function ValidarCadastroAdmin()
    {
        $model = new Model\AdminModel();

        if (empty($_POST['cadastroEmail']) || empty($_POST['cadastroNome']) || empty($_POST['cadastroSenha'])) {
            header("Location: /login");
            $_SESSION['erro_cadastro'] = "Todos os campos devem ser preenchidos";
        } else {
            $model->email = $_POST['cadastroEmail'];
            $model->nomeCompleto = $_POST['cadastroNome'];
            $model->senha = $_POST['cadastroSenha'];
            $resultadoDoCadastro =  $model->cadastrarNovoUsuário();

            if ($resultadoDoCadastro === false) {
                $_SESSION['erro_cadastro'] = "Já existe um usuário cadastrado com esse email";
                header("Location: /login");
                return;
            }

            $_SESSION['user'] = $resultadoDoCadastro;
            header("Location: /home");
        }
    }
}
