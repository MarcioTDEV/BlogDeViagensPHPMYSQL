<?php

if(!isset($_SESSION['user'])){
    header("Location: /");
}
?>
<div class="nPostTitulo">
<h1>NOVO POST</h1>
<p>Insira abaixo as informações do seu post</p>
<a href="/home">Voltar</a>
</div>

<div class="nPostForm">
    <form method="POST" action="/novoPost/salvarPost" enctype="multipart/form-data">
        <input type="text" name="tituloArtigo" placeholder="O título do post">
    <label>Foto de capa
        <input type="file" name="fotoDeCapa" placeholder="">
        </label>
        
        <textarea name="textoArtigo" placeholder="Texto do post"></textarea>
        <input type="submit" name="InserirPost" value="Inserir Post"/>
        <input type="hidden" name="id" value="<?= $_SESSION['user'][0]['idAdmin'] ?>"/>
    </form>
    <span class="errro">
        <?php
            if(isset($_SESSION['erroCriarPost'])){
                echo $_SESSION['erroCriarPost'];
                unset($_SESSION['erroCriarPost']);
            }

?>
    </span>
</div>
