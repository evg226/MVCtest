<h1>Личный кабинет</h1>
<div class="user__page">
<div class="user__info">
<!--    <div class="user__string">-->
    <h3 class="user__char">Инфо</h3>
<!--    </div>-->
    <div class="user__string">
        <div class="user__char">Логин</div>
        <div class="user_value"><?=$data["user"]['login']?></div>
    </div>
    <div class="user__string">
    <div class="user__char">Имя</div>
    <div class="user_value"><?=$data["user"]['name']?></div>
    </div>
    <div class="user__string">
    <div class="user__char">Фамилия</div>
    <div class="user_value"><?=$data["user"]['surname']?></div>
    </div>
    <div class="user__string">
    <div class="user__char">Привиллегии</div>
    <div class="user_value"><?=$data["user"]['role']?></div>
    </div>

</div>
<div class="user__info">
    <h3 class="user__char">Страницы</h3>
    <?php
        if(isset($data["pages"]))
            foreach ($data["pages"] as $page)
                echo "<a href='".$page["path"]."'>".
                    "<div class='user__string'>".
                    "<span>".$page["path"].
                    "</span><span class='user__span'>".$page["pageCount"].
                    "</span></div></a>";
    ?>
</div>

</div>
<div class="user__button">
    <a href="/user/logout" class="user__logout">Выйти из кабинета</a>
</div>






