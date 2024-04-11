<div id='backModalLogIn'></div>
    <div id="logInModal">
        <img id="closeLogIn" src="../images/close.png" alt="closeLogIn">
        <h3>Войти</h3>
        <?php
            if(!empty($_SESSION['errors'])){
                echo $_SESSION['errors'];
                unset($_SESSION['errors']);
            }

            if(!empty($_SESSION['success'])){
                echo $_SESSION['sucess'];
                unset($_SESSION['success']);
            }
        ?>
        <form action="../checkSignLog/logIn.php" method="post" id="formLogIn">
            <label class="label" for="email"> Логин </label>
            <input class="input" type="text" name="email" required>
            <label class="label" for="pass"> Пароль </label>
            <input class="input" type="text" name="pass" required>
            <input id="submitLogIn" type="submit" value="Войти">
        </form>
        <span id="uzhe">Нет аккаунта? <span id="changeToSignIn">Зарегистрируйтесь.</span></span>
    </div>


    <div id="signInModal">
        <img id="closeSignIn" src="../images/close.png" alt="closeSignIn">
        <h3>Зарегистрироваться</h3>
        <?php
            if(!empty($_SESSION['errors'])){
                echo $_SESSION['errors'];
                unset($_SESSION['errors']);
            }

            if(!empty($_SESSION['success'])){
                echo $_SESSION['sucess'];
                unset($_SESSION['success']);
            }
        ?>
        <form action="../checkSignLog/signIn.php" method="post" id="formSignIn">
            <label class="label" for="email"> Логин </label>
            <input class="input" type="text" name="email" required pattern='([A-z0-9_.]{1,})@([A-z]{1,}).([A-z]{2,8})'>
            <label class="label" for="pass"> Пароль </label>
            <input class="input" type="text" name="pass" required>
            <input id="submitSignIn" type="submit" value="Войти">
        </form>
        <span id="uzhe">Уже есть аккаунт? <span id="changeToLogIn">Войдите.</span></span>
    </div>