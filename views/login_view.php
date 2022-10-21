<div class="row">
    <div class="loginform" align=center>
        <h1>Вход</h1>
        <form action="" method="post"> <br>
            <input type="text" class="form-control" name="login" placeholder="Введите логин" value="<?=htmlspecialchars($values["login"])?>" required> <br>
            <input type="password" name="password" class="form-control" placeholder="Введите пароль" value="<?=htmlspecialchars($values["password"])?>" required> <br>
            <button class="btn btn-outline-dark" name="enter"> Войти </button>
            <?php
                $controller = new Controller_Login();
                $controller->enter();
            ?>
        </form>
    </div>
</div>