<?php

require "autoload.php";



$path = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);

switch ($path) {
    case '/':
        Control\Control::index();
        break;


        case "/post":{
            Control\Control::BuscarPost();
            break;
        }

        // REDIRECIONAMENTO PARA A PÁGINA DE LOGIN
    case '/login':
        Control\Control::buscarPaginaLogin();
        break;
       
        // ENCERRAMENTO DE SESSÃO
    case '/sair':
        Control\AdminControl::encerrarSessao();
        break;
       
        // REALIZAR O LOGIN
    case '/logar':
        Control\AdminControl::realizarLogin();
        break;
    
        // vai instanciar a model com os dados do form, validar e iniciar sessão
    case '/cadastro':
        Control\AdminControl::ValidarCadastroAdmin();
        break;

    case "/home":
        Control\AdminControl::HomeAdmin();
        break;

    case "/novoPost":
        Control\AdminControl::paginaNovoPost();
        break;

    case "/novoPost/salvarPost":
        Control\AdminControl::salvarPost();
        break;

    case "/deletarPost":
        Control\AdminControl::DeletarPost();
        break;
    
    default:
        require "./View/NotFound.php";
        break;
}