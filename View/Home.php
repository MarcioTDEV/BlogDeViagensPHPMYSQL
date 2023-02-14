<div class="grid_index_home">
    <?php
    if (isset($items)) {
        foreach ($items as $key => $value) { ?>


            <div class="box_grid_index_home">
                <img src="View/Assets/img/<?= $value['backgroundImg'] ?>">
                <h3><?= $value['titulo'] ?></h3>
                <p><em>Escrito por <?= $value['nomeCompleto'] ?></em></p>
                <form method="POST" action="/post">
                    <input type="hidden" name="post" value="<?= $value['idArtigo'] ?>">
                    <input  class="input_ver_mais" type="submit" value="Ver mais">
                </form>
            </div>


    <?php

        }
    }

    ?>

</div>