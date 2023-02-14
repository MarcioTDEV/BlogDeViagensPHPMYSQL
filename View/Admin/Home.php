<div class="home_cabecalho">
<h1>Seja bem vindo(a), <?= $_SESSION['user'][0]['nomeCompleto']?></h1>
<p>Fique à vontade para <a href="/novoPost">criar um novo post</a></p>
<p><a href="/sair">Encerrar Sessão</a></p>
</div>

<div class="posts_criados">
    <h2>Posts criados</h2>

    <div class="grid_posts_criados">
    <?php
    if(count($items)> 0){
        foreach ($items as $key => $value) { ?>
            
            <div class="box_post_criado">
                <img src="View/Assets/img/<?= $value['backgroundImg'] ?>">
                <h3><?= $value['titulo'] ?>  </h3>
                <form method="POST" action="/deletarPost">
                    <input type="hidden" name="idArtigo" value="<?= $value['idArtigo'] ?>">
                    <input type="hidden" name="foto" value="<?= $value['backgroundImg']?>">
                    <input type="submit" name="deletar" value="Deletar Post">
                </form>
            </div>
        
        
        
        
        
        <?php }


    }else{
        echo "<h2>Crie a sua primeira postagem!</h2>";
    }

?>
</div>
</div>