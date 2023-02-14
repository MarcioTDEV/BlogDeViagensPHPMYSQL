<div class="login">
<div class="container_form_cadastro">
    <h2>FAÇA PARTE DA NOSSA REDAÇÃO!</h2>
    <form method="post" action="/cadastro">
        <input type="text" name="cadastroNome" placeholder="Nome Completo">
        <input type="email" name="cadastroEmail" placeholder="Email Preferido">
        <input type="password" name="cadastroSenha" placeholder="Senha Forte">
        <input type="submit" name="cadastrar" value="Cadastrar!"/>
        <span class="erro">
        <?php 
            if (isset($_SESSION['erro_cadastro'])){
                echo $_SESSION['erro_cadastro'];
                unset($_SESSION['erro_cadastro']);
            }
        ?>
        </span>
    </form>
</div>
<div class="container_login">
    <div class="container_form_login">
        <h2>REALIZAR LOGIN</h2>
        <form method="post" action="/logar">
            <input type="email" name="loginEmail" placeholder="Email">
            <input type="password" name="loginSenha" placeholder="Senha">
            <input type="submit" name="logar" value="Logar!"/>
        </form>
        <span class="erro">
        <?php 
            if (isset($_SESSION['erro_login'])){
                echo $_SESSION['erro_login'];
                unset($_SESSION['erro_login']);
            }
        ?>
        </span>
    </div>
</div>
</div>