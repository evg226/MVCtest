<?php
    if (isset($_SESSION["user"])) header("Location: /user");
?>
<h1><?php echo $data['type']==="login"?"Вход в систему":"Регистрация"?></h1>
<div class="login__form">

<form method="post" action=
    <?php echo $data['type']==="login"?"/user/login":"/user/signup"?>>
    <p>Логин
    <input type="text" name="userLogin" placeholder="User Name" />
    </p>
    <p>Пароль<input type="password" name="userPwd" placeholder="User Password" /></p>

    <?php if($data['type']!=="login"):?>
        <p>Имя<input type="text" name="userName" placeholder="User Name" /></p>
        <p>Фамилия<input type="text" name="userSurname" placeholder="User Surname" /></p>
    <?php endif; ?>
    <p class="login__button">
    <input type="submit" value="Выполнить">
    </p>
    <p class="message"><?php if(isset($data['message'])) echo $data['message'] ?></p>
    <p>
        <?php echo $data['type']==="login"?
            "<a href='/user/signup'>Регистрация >></a>":
            "<a href='/user/login'>Войти >></a>"
        ?>
    </p>
</form>
</div>
